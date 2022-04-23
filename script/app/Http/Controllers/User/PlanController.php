<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Mail\PlanMail;
use App\Models\Getway;
use App\Models\Option;
use App\Models\Category;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Post;
use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use PDF;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans  = Plan::where([
            ['status', 1], 
            ['is_default', 0],
            ['is_trial', 0],
        ])->get();

        $orders = Order::where('user_id', Auth::id())->with('plan', 'getway')->latest()->paginate(25);
        return view('user.plan.index', compact('plans', 'orders'));
    }

    public function gateways($planid)
    {
        $posts = Post::where('user_id', Auth::id())->count();
        $Category   = Category::where('user_id', Auth::id())->count();
        $posts=$Category+$posts;
        $storage = folderSize('uploads/'.Auth::id());
        $plan     = Plan::where([
            ['status', 1], 
            ['is_default', 0],
            ['is_trial', 0],
        ])->findOrFail($planid);
        if($plan->postlimit < $posts || $plan->storage_size < $storage) 
        return redirect()->back()->with('message','Sorry you are not allowed to enroll in this plan!!')->with('type','danger');
        $tax = Option::where('key', 'tax')->first();
        $gateways = Getway::where('name', '!=', 'free')->where('status', 1)->get();
        if ($plan->is_trial == 1) {
            $order = Order::where([['plan_id', $planid], ['user_id', Auth::id()]])->first();
            if ($order == null) {
                $data['getway_id']      = Getway::where('name', 'free')->pluck('id')->first() ?? 8;
                $data['payment_id']     = $this->uniquetrx();
                $data['plan']           = $planid;
                $data['payment_status'] = 1;
                Session::put('plan', $planid);
                Session::put('payment_info', $data);
                return redirect()->route('user.payment.success');
            } else {
                return redirect()->route('user.plan.index')->with('message', 'Already enrolled in Trial Plan! Select Other Plan')->with('type', 'danger');
            }
        }
        $curency_name = Option::where('key', 'curency_name')->first();
        return view('user.plan.gateways', compact('gateways', 'plan', 'tax','curency_name'));
    }

    public function deposit(Request $request)
    {
        $gateway                      = Getway::where('status',1)->where('id','!=',13)->findOrFail($request->id);
        if ($gateway->phone_required == 1) {
            $validated = $request->validate([
                        'phone' => 'required|max:15',
                        
            ]);
        }

        if ($gateway->image_accept == 1) {
            $validated = $request->validate([
                    'attachment' => 'required|image|max:2000',
                    'comment' => 'required|max:100',
                        
            ]);
        }

        $gateway_info                 = json_decode($gateway->data); //for creds
        $plan                         = Plan::where([
                                            ['status', 1], 
                                            ['is_default', 0],
                                            ['is_trial', 0],
                                        ])->findOrFail($request->plan_id);
        $tax                          = Option::where('key', 'tax')->first();
        $payment_data['currency']     = $gateway->currency_name ?? 'USD';
        $payment_data['email']        = Auth::user()->email;
        $payment_data['name']         = Auth::user()->name;
        $payment_data['phone']        = $request->phone;
        $payment_data['billName']     = $plan->name;
        $payment_data['amount']       = $plan->price;
        $payment_data['test_mode']    = $gateway->test_mode;
        $payment_data['charge']       = $gateway->charge ?? 0;
        $payment_data['pay_amount']   = (($plan->price + ($plan->price / 100) * $tax->value) * $gateway->rate)  + $gateway->charge ?? 0;
        $payment_data['getway_id']    = $gateway->id;
        $payment_data['payment_type'] = 1;
        $payment_data['request']      = $request->except('_token');
        $payment_data['request_from'] = 'user';
        if ($request->hasFile('attachment')) {
                $thum_image      = $request->file('attachment');
                $thum_image_name = hexdec(uniqid()) . '.' . $thum_image->getClientOriginalExtension();
                $thum_image_path = 'uploads/' . Auth::id();
                $payment_data['image'] = $thum_image_path.'/'.$thum_image_name;
                $thum_image->move($thum_image_path, $thum_image_name);

                $payment_data['comment'] = $request->comment;

        }
        Session::put('plan', $request->plan_id);

        if (!empty($gateway_info)) {
            foreach ($gateway_info as $key => $info) {
                $payment_data[$key] = $info;
            };
        }
        
        return $gateway->namespace::make_payment($payment_data);
    }

    public function success(Request $request)
    {

        if (!session()->has('payment_info')) {
            abort(403);
        }
        $tax = Option::where('key', 'tax')->first();
        $max_order=Order::count();
        $max_order=$max_order++;
        $invoice_prefix=Option::where('key','invoice_prefix')->first()->value;
        $invoice_no=$invoice_prefix.$max_order;
        //if transaction successfull
        $plan_id         = $request->session()->get('plan') ?? $request->session()->get('plan_id');
        $plan            = Plan::findOrFail($plan_id);
        $getway_id       = $request->session()->get('payment_info')['getway_id'];
        $gateway         = Getway::findOrFail($getway_id);
        $payment_id      = $request->session()->get('payment_info')['payment_id'];
        $payment_status  = $request->session()->get('payment_info')['payment_status'];
        $order_status    = $request->session()->get('payment_info')['status'];
        $totalAmount     = $plan->price * $gateway->rate;
        $auto_enrollment = Option::where('key', 'auto_enroll_after_payment')->pluck('value')->first();

        $register = Session::get('register') ?? 0;
        $admin = User::where('role_id', 1)->first();
        DB::beginTransaction();
        try {
           
            $tax_amount= ($plan->price / 100) * $tax->value;
            // Insert transaction data into order table
            $order              = new Order;
            $order->user_id     = Auth::id();
            $order->invoice_no  =$invoice_no;
            $order->plan_id     = $plan_id;
            $order->getway_id   = $gateway->id;
            $order->trx         =  $payment_id;
            $order->tax         =  $tax->value;
            $order->will_expire = Carbon::now()->addDays($plan->duration);
            $order->price       = $plan->price;
            $order->status      =  $order_status; 
            $order->payment_status   = $payment_status; 
            $order->tax             = $tax_amount;
            $order->save();
            if (isset($request->session()->get('payment_info')['image'])) {
                $manualdata['attachment']=$request->session()->get('payment_info')['image'];
                $manualdata['comment']=$request->session()->get('payment_info')['comment'];
                $order->ordermeta()->create(['value'=>json_encode($manualdata),'key'=>'orderinfo']);
            }

             $tenantupdate        = Tenant::where('user_id', Auth::id())->first();
             if ($auto_enrollment == 'on' && $gateway->is_auto == 1 && session()->get('payment_info')['payment_status'] == 1 && $order_status == 1) {
               
                $tenantupdate->storage_size  = $plan->storage_size;
                $tenantupdate->resume_builder  = $plan->resume_builder;
                $tenantupdate->portfolio_builder  = $plan->portfolio_builder;
                $tenantupdate->custom_domain  = $plan->custom_domain;
                $tenantupdate->sub_domain  = $plan->sub_domain;
                $tenantupdate->vcard  = $plan->vcard;
                $tenantupdate->online_cv  = $plan->online_cv;
                $tenantupdate->analytics  = $plan->analytics;
                $tenantupdate->qrcode  = $plan->qrcode;
                $tenantupdate->postlimit  = $plan->postlimit;
                $tenantupdate->will_expire = Carbon::now()->addDays($plan->duration);
                $tenantupdate->order_id    = $order->id;
                $tenantupdate->status  = 1;
                $tenantupdate->save();
            }

            $order->Orderlog()->create(['tenant_id'=> $tenantupdate->id]);

            $user = User::findOrFail(Auth::id());
            $user->is_trial = $plan->is_trial;
            $user->save();
            
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            Session::flash('message', 'Opps something wrong please contact with support team..!');
            Session::flash('type', 'danger');
            Session::forget('payment_info');
            Session::forget('register');
            Session::forget('plan_id');
            return redirect()->route('user.plan.index');
        }

        

        Session::flash('message', 'Transaction Successfully Complete!');
        Session::flash('type', 'success');
        Session::forget('payment_info');
        Session::forget('register');
        Session::forget('plan_id');

        $data = [
            'type'    => 'plan',
            'email'   => $admin->email,
            'name'    => Auth::user()->name,
            'message' => "Successfully Paid " . round($totalAmount, 2) . " (charge included) for " . $plan->name . " plan",
        ];

        if (env('QUEUE_MAIL') == 'on') {
            dispatch(new SendEmailJob($data));
        } else {
            Mail::to($admin->email)->send(new PlanMail($data));
        }
        return redirect()->route('user.plan.index');
    }

    public function failed()
    {
        Session::flash('message', 'Transaction Error Occured!!');
        Session::flash('type', 'danger');
        Session::forget('payment_info');
        Session::forget('plan_id');
        return redirect()->route('user.plan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('plan', 'getway', 'user')->findOrFail($id);
        return view('user.plan.show', compact('order'));
    }

    public function invoicePdf($id)
    {
        $data = Order::with('plan', 'getway', 'user')->findOrFail($id);
        $pdf  = PDF::loadView('user.plan.invoice-pdf', compact('data'));
        return $pdf->download('order-invoice.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('user.plan.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uniquetrx()
    {
        $str   = Str::random(16);
        $check = Order::where('trx', $str)->first();
        if ($check == true) {
            $str = $this->uniquetrx();
        }
        return $str;
    }
}
