<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminOrderRequest;
use App\Http\Requests\AdminOrderUpdateRequest;
use App\Jobs\SendEmailJob;
use App\Mail\OrderMail;
use App\Models\Getway;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Tenant;
use App\Models\Option;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(!Auth()->user()->can('order.index'), 401);
        $all      = Order::count();
        $active   = Order::where('status', '1')->count();
        $inactive = Order::where('status', '0')->count();
        $pending  = Order::where('status', '2')->count();
        $expired  = Order::where('status', '3')->count();
        $st       = '';
        $orders=Order::with('plan', 'getway', 'user');
        if (isset($request->type)) {
            $str = $request->q;
            if ($request->type == 'user') {
                $orders = $orders->whereHas('user', function ($q) use ($str) {
                    return $q->where('name', 'LIKE', "%$str%");
                });
            } elseif ($request->type == 'getway') {
                $orders = $orders->whereHas('getway', function ($q) use ($str) {
                    return $q->where('name', 'LIKE', "%$str%");
                });
            } elseif ($request->type == 'plan') {
                $orders = $orders->whereHas('plan', function ($q) use ($str) {
                    return $q->where('name', 'LIKE', "%$str%");
                });
            }
            elseif ($request->type == 'invoice_no') {
                 
                 $orders = $orders->where('invoice_no',$request->q);
            }
        } elseif ($request->has('1') || $request->has('0') || $request->has('3') || $request->has('2')) {
            if ($request->has('1')) {
                $st     = '1';
                $orders = $orders->where('status', '1');
            } elseif ($request->has('3')) {
                $st     = '3';
                $orders = $orders->where('status', '3');
            } elseif ($request->has('2')) {
                $st     = '2';
                $orders = $orders->where('status', '2');
            } else {
                $st     = '0';
                $orders = $orders->where('status', '0');
            }
        } 
        $orders = $orders->latest()->paginate(20);
        return view('admin.order.index', compact('orders', 'active', 'inactive', 'all', 'pending', 'expired', 'st','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth()->user()->can('order.create'), 401);

        $plans   = Plan::where('status', 1)->get();
        $getways = Getway::all();
        return view('admin.order.create', compact('plans', 'getways'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminOrderRequest $request)
    {
        //using custom request validator form App\Http\Requests\AdminOrderRequest;

        $plan_data   = [];
        $tenant_name = Str::slug($request->tenant);
        $user        = User::where('email', $request->email)->first();
        if (!$user) {
            $msg['errors']['error'] = "User Not Found";
            return response()->json($msg, 401);
        }
        $tenant = Tenant::where([['id', $tenant_name], ['user_id', $user->id]])->first();
        if ($tenant == null) {
            $msg['errors']['error'] = "Username Not Found!";
            return response()->json($msg, 401);
        }

        $plan   = Plan::where('id', $request->plan_id)->first();
        $getway = Getway::where('id', $request->getway_id)->first();

        $plan_data = [
            'duration'            => $plan->duration,
            'storage_size'        => $plan->storage_size,
            'name'                => $plan->name,
            'resume_builder'      => $plan->resume_builder,
            'portfolio_builder'   => $plan->portfolio_builder,
            'custom_domain'       => $plan->custom_domain,
            'sub_domain'          => $plan->sub_domain,
            'analytics'           => $plan->analytics,
            'online_businesscard' => $plan->online_businesscard,
            'qrcode'              => $plan->qrcode,
            'postlimit'           => $plan->postlimit,
            'is_featured'         => $plan->is_featured,
            'data'                => $plan->data ?? "",
        ];
        

        DB::beginTransaction();
        try {
                
            $tax = Option::where('key','tax')->first();
            $tax_amount= ($plan->price / 100) * $tax->value;

            $max_order=Order::count();
            $max_order=$max_order++;
            $invoice_prefix=Option::where('key','invoice_prefix')->first()->value;
            $invoice_no=$invoice_prefix.$max_order;

            $order                  = new Order;
            $order->invoice_no      =$invoice_no;
            $order->plan_id         = $request->plan_id;
            $order->user_id         = $user->id;
            $order->getway_id       = $request->getway_id;
            $order->trx             = $request->trx;
            $order->price           = $plan->price;
            $order->status          = 1;
            $order->tax             = $tax_amount;
            $order->payment_status  = 1;
            $order->will_expire     = Carbon::now()->addDays($plan->duration);
            $order->save();


            $tenantupdate                     = Tenant::findOrFail($tenant_name);
            $tenantupdate->storage_size       = $plan->storage_size;
            $tenantupdate->resume_builder     = $plan->resume_builder;
            $tenantupdate->portfolio_builder  = $plan->portfolio_builder;
            $tenantupdate->custom_domain      = $plan->custom_domain;
            $tenantupdate->sub_domain         = $plan->sub_domain;
            $tenantupdate->vcard              = $plan->vcard;
            $tenantupdate->online_cv          = $plan->online_cv;
            $tenantupdate->analytics          = $plan->analytics;
            $tenantupdate->qrcode             = $plan->qrcode;
            $tenantupdate->postlimit          = $plan->postlimit;
            $tenantupdate->will_expire        = Carbon::now()->addDays($plan->duration);
            $tenantupdate->order_id           = $order->id;
            $tenantupdate->save();
            

            $order->Orderlog()->create(['tenant_id'=>$tenant_name]);

            
            $user->is_trial = $plan->is_trial;
            $user->save();


            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg['errors']['error'] = "Error Occured!";
            return response()->json($msg, 401);
        }

        if ($request->email_status == '1') {
            $currency_name=Option::where('key','curency_name')->first()->value;
            $invoice_mail_messages=Option::where('key','invoice_mail_messages')->first()->value;
            if ($order->payment_status == 1) {
                $payment_status='Approved';
            }
            elseif ($order->payment_status == 2) {
               $payment_status='Pending';
            }
            else{
                $payment_status='Declined';
            }

            if ($order->status == 1) {
               $order_status = 'Active';
            }
            elseif($order->status == 2){
                $order_status = 'Pending';
            }
            elseif($order->status == 3){
                $order_status = 'Expired';
            }
            else{
                $order_status = 'Declined';
            }


            $data = [
                'type'           => 'order',
                'invoice_no'     => $order->invoice_no,
                'email'          => $user->email,
                'name'           => $user->name,
                'price'          => $plan->price,
                'plan'           => $plan->name,
                'tax'            => $order->tax,
                'expire_date'    => $order->will_expire->format('d-F-Y'),
                'currency_name'  => $currency_name,
                'status'         => $order_status,
                'payment_status' => $payment_status,
                'message'        => $invoice_mail_messages,
                'created_at'     => $order->created_at,
            ];

            if (env('QUEUE_MAIL') == 'on') {
                dispatch(new SendEmailJob($data));
            } else {
                Mail::to($user->email)->send(new OrderMail($data));
            }
        }
        return response()->json('Order Added Successfully');
    }

    public function status(Request $request)
    {
        if ($request->ids && count($request->ids) > 0 && $request->status != null) {
            if ($request->status == 5) {
                Order::whereIn('id', $request->ids)->delete();
            } else {
                Order::whereIn('id', $request->ids)->update(['status' => $request->status]);
            }
            return back();
        }
        return back()->with('alert', 'Nothing selected!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(!Auth()->user()->can('order.show'), 401);

        $data = Order::with('plan', 'getway', 'user','ordermeta')->findOrFail($id);
        return view('admin.order.show', compact('data'));
    }

    public function orderByPlanName($id)
    {
        $planName  = Plan::findOrFail($id);
        $planOrder = Order::with('plan', 'getway', 'user')->where('plan_id', $id)->paginate(20);
        return view('admin.order.plan-name-index', compact('planName', 'planOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(!Auth()->user()->can('order.edit'), 401);
        $plans   = Plan::where('status', 1)->get();
        $getways = Getway::all();
        $order   = Order::findOrFail($id);
        $tenant  = Tenant::where('user_id', $order->user_id)->first();
        return view('admin.order.edit', compact('order', 'plans', 'getways', 'tenant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminOrderUpdateRequest $request, $id)
    {
        //using custom request validator form App\Http\Requests\AdminOrderUpdateRequest;

        $user        = User::where('email', $request->email)->first();
        $plan        = Plan::where('id', $request->plan_id)->first();
        $getway      = Getway::where('id', $request->getway_id)->first();
        $tenant_name = Str::slug($request->tenant);
        if (!$user) {
            $msg['errors']['error'] = "User Not Found";
            return response()->json($msg, 401);
        }

        $tenant = Tenant::where([['id', $tenant_name], ['user_id', $user->id]])->first();
        if ($tenant == null) {
            $msg['errors']['error'] = "Tenant Not Found!";
            return response()->json($msg, 401);
        }

        $order              = Order::findOrFail($id);
        $plan               = Plan::findOrFail($order->plan_id);
        $order->plan_id     = $request->plan_id;
        $order->user_id     = $user->id;
        $order->getway_id   = $request->getway_id;
        $order->trx         = $request->trx;
        $order->price       = $plan->price;
        $order->status      = $request->status;
        $order->payment_status      = $request->payment_status;
        $order->will_expire = Carbon::now()->addDays($plan->duration);
        $order->save();

        $plan_data = [
            'duration'            => $plan->duration,
            'storage_size'        => $plan->storage_size,
            'name'                => $plan->name,
            'resume_builder'      => $plan->resume_builder,
            'portfolio_builder'   => $plan->portfolio_builder,
            'custom_domain'       => $plan->custom_domain,
            'sub_domain'          => $plan->sub_domain,
            'analytics'           => $plan->analytics,
            'online_businesscard' => $plan->online_businesscard,
            'qrcode'              => $plan->qrcode,
            'postlimit'           => $plan->postlimit,
            'is_featured'         => $plan->is_featured,
            'data'                => $plan->data ?? "",
        ];
       
        if ($request->plan_assign == 'yes') {
            $tenantupdate                     = Tenant::findOrFail($tenant_name);
            $tenantupdate->order_id           = $order->id;
            $tenantupdate->storage_size       = $plan->storage_size;
            $tenantupdate->resume_builder     = $plan->resume_builder;
            $tenantupdate->portfolio_builder  = $plan->portfolio_builder;
            $tenantupdate->custom_domain      = $plan->custom_domain;
            $tenantupdate->sub_domain         = $plan->sub_domain;
            $tenantupdate->vcard              = $plan->vcard;
            $tenantupdate->online_cv          = $plan->online_cv;
            $tenantupdate->analytics          = $plan->analytics;
            $tenantupdate->qrcode             = $plan->qrcode;
            $tenantupdate->postlimit          = $plan->postlimit;
            $tenantupdate->will_expire        = Carbon::now()->addDays($plan->duration);
            $tenantupdate->save();
            $order->Orderlog()->create(['tenant_id'=>$tenant_name]);

            $user->is_trial = $plan->is_trial;
            $user->save();
        }

       
        if ($request->email_status == '1') {
            $currency_name=Option::where('key','curency_name')->first()->value;
            $invoice_mail_messages=Option::where('key','invoice_mail_messages')->first()->value;
            if ($order->payment_status == 1) {
                $payment_status='Approved';
            }
            elseif ($order->payment_status == 2) {
               $payment_status='Pending';
            }
            else{
                $payment_status='Declined';
            }

            if ($order->status == 1) {
               $order_status = 'Active';
            }
            elseif($order->status == 2){
                $order_status = 'Pending';
            }
            elseif($order->status == 3){
                $order_status = 'Expired';
            }
            else{
                $order_status = 'Declined';
            }


            $data = [
                'type'           => 'order',
                'invoice_no'     => $order->invoice_no,
                'email'          => $user->email,
                'name'           => $user->name,
                'price'          => $plan->price,
                'plan'           => $plan->name,
                'tax'            => $order->tax,
                'expire_date'    => $order->will_expire->format('d-F-Y'),
                'currency_name'  => $currency_name,
                'status'         => $order_status,
                'payment_status' => $payment_status,
                'message'        => $invoice_mail_messages,
                'created_at'     => $order->created_at,
            ];

            if (env('QUEUE_MAIL') == 'on') {
                dispatch(new SendEmailJob($data));
            } else {
                Mail::to($user->email)->send(new OrderMail($data));
            }
        }
        return response()->json('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(!Auth()->user()->can('order.delete'), 401);
        Order::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Successfully Deleted');
    }
}
