<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCustomerRequest;
use App\Http\Requests\AdminCustomerUpdateRequest;
use App\Jobs\SendEmailJob;
use App\Mail\CustomerViewMail;
use App\Models\Getway;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Post;
use App\Models\Option;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Useroption;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Auth;
use Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(!Auth()->user()->can('customer.index'), 401);
        $all      = User::where('role_id', 2)->count();
        $active   = User::where('role_id', 2)->where('status', '1')->count();
        $inactive = User::where('role_id', 2)->where('status', '0')->count();
        $users    = User::with('tenant')->where('role_id', 2);
        $st       = '';
        if (isset($request->type)) {
            $str = $request->q;
            if ($request->type == 'email') {
                $users = $users->where('email', 'LIKE', "%$str%");
            } elseif ($request->type == 'name') {
                $users = $users->where('name', 'LIKE', "%$str%");
            } elseif ($request->type == 'tenant') {
                $users = $users->whereHas('tenant', function ($q) use ($str) {
                    return $q->where('id', 'LIKE', "%$str%");
                });
            }
        } elseif ($request->has('1') || $request->has('0')) {
            if ($request->has('1')) {
                $st    = '1';
                $users = $users->where('status', '1');
            } else {
                $st    = '0';
                $users = $users->where('status', '0');
            }
        } 

        $users = $users->withCount('orders')->withSum('orders','price')->latest()->paginate(20);
        return view('admin.customer.index', compact('users', 'all', 'active', 'inactive', 'st'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth()->user()->can('customer.create'), 401);
        $plans   = Plan::where('status', 1)->get();
        $getways = Getway::all();
        return view('admin.customer.create', compact('plans', 'getways'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminCustomerRequest $request)
    {
        //using custom request validator form App\Http\Requests\AdminCustomerRequest;

        $plan_data   = [];
        $tenant_name = Str::slug($request->tenant);

        $plan   = Plan::where('id', $request->plan_id)->first();
        $getway = Getway::where('id', $request->getway_id)->first();
        DB::beginTransaction();
        try {
        $user           = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->status   = $request->status;
        $user->is_trial = $plan->is_trial;
        $user->save();

        $faker = Factory::create();

        $seo_data = [
            'seo_home'=> [
                'site_name' => $faker->name,
                'metatag' => $faker->word,
                'metadescription' => $faker->text,
                'twitter_site_title' => $faker->word,
            ],
            'seo_blog'=> [
                'site_name' => $faker->name,
                'metatag' => $faker->word,
                'metadescription' => $faker->text,
                'twitter_site_title' => $faker->word,
            ]
        ];

        Useroption::create(['user_id'=>$user->id, 'key'=>'seo', 'value'=> json_encode($seo_data)]);

        $domain = Str::slug($request->tenant);

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
        ];
            $max_order=Order::count();
            $max_order=$max_order++;

            $tax = Option::where('key','tax')->first();
            $tax_amount= ($plan->price / 100) * $tax->value;

            $invoice_prefix=Option::where('key','invoice_prefix')->first()->value;
            $invoice_no=$invoice_prefix.$max_order;
            $exp_days    = $plan->duration;
            $expiry_date = \Carbon\Carbon::now()->addDays($exp_days)->format('Y-m-d');
            $order              = new Order;
            $order->invoice_no  =$invoice_no;
            $order->plan_id     = $request->plan_id;
            $order->user_id     = $user->id;
            $order->getway_id   = $request->getway_id;
            $order->trx         = $request->trx;
            $order->price       = $plan->price;
            $order->tax         = $tax_amount;
            $order->status      = 1;
            $order->will_expire = Carbon::now()->addDays($plan->duration);
            $order->save();
        
            $tenant = Tenant::create(['id' => $tenant_name, 'order_id'=>$order->id,'user_id' => $user->id, 'will_expire' => $expiry_date, 'status' => 1, 'data' => $plan_data]);
         
            $order->Orderlog()->create(['tenant_id'=>$tenant_name]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg['errors']['error'] = "Error Occured!";
            return response()->json($msg, 401);
        }
        
        return response()->json('Customer Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(!Auth()->user()->can('customer.show'), 401);

        $plans        = Plan::where('status', 1)->get();
        $user         = User::with('tenant')->findOrFail($id);
        $getways      = Getway::all();
        $orders       = Order::where('user_id', $id)->with('plan', 'getway')->paginate(25);
        $orders_count = Order::where('user_id', $id)->count();
        $all_blogs    = Post::where('type', 'blog')->where('user_id', $id)->count();

        //check folder store folder_Size

        $folder      = "uploads/" . $id;
        $folder_size = folderSize($folder);

        return view('admin.customer.view', compact('plans', 'getways', 'user', 'orders', 'all_blogs', 'orders_count', 'folder_size'));
    }

    public function viewMail(Request $request)
    {
        $request->validate([
            'mail_to' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $sendTo = $request->mail_to;
        $sender = env('MAIL_FROM_ADDRESS');
        $data   = [
            'sendTo'  => $sendTo,
            'sender'  => $sender,
            'subject' => $request->subject,
            'message' => $request->message,
            'type'    => 'customer_view_page_mail',
        ];
        // this part check that if the Queue mail is on in env then send mail is using Queue or go to else part
        if (env('QUEUE_MAIL') == 'on') {
            dispatch(new SendEmailJob($data));
        } else {
            Mail::to($sendTo)->send(new CustomerViewMail($data));
        }
        return response()->json('Email Sent Successfully !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(!Auth()->user()->can('customer.edit'), 401);
        $plans   = Plan::where('status', 1)->get();
        $user    = User::with('tenant')->findOrFail($id);
        $getways = Getway::all();
        return view('admin.customer.edit', compact('plans', 'getways', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminCustomerUpdateRequest $request, $id)
    {
        //using custom request validator form App\Http\Requests\AdminCustomerUpdateRequest;

        $user = User::findOrFail($id);
        if ($user->password) {
            $user->password = Hash::make($request->password);
        }

        $user->name   = $request->name;
        $user->email  = $request->email;
        $user->status = $request->status;
        $user->save();
        $user->tenant()->update(['id'=> Str::slug($request->user_name)]);

        return response()->json('Customer Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(!Auth()->user()->can('customer.delete'), 401);
        Tenant::where('user_id',$id)->delete();
        $folder            = "uploads/" . $id;
        \File::deleteDirectory($folder);
        User::where('id', $id)->where('role_id',2)->delete();
        return redirect()->back()->with('success', 'Successfully Deleted');

    }

    public function status(Request $request)
    {
        if ($request->ids && count($request->ids) > 0 && $request->status != null) {
            if ($request->status == 5) {
                User::whereIn('id', $request->ids)->delete();
            } else {
                User::whereIn('id', $request->ids)->update(['status' => $request->status]);
            }
            return back();
        }
        return back()->with('alert', 'Nothing selected!');
    }

    public function login($id)
    {
        abort_if(!Auth()->user()->can('customer.show'), 401);
        User::where('role_id',2)->findOrFail($id);
        Auth::logout();
        Auth::loginUsingId($id);
        return redirect('/user/dashboard');
    }
}
