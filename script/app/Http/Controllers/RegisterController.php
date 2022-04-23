<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Session;
use DB;
use App\Models\Plan;
use Illuminate\Support\Str;
use App\Models\Option;
use App\Models\Orderlog;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\Useroption;
use Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth.registerstep2');
    }

    public function step1(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'store_name' => 'required',
            'password' => 'required|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'store_name' => Str::slug($request->store_name),
            'password' => Hash::make($request->password)
        ];

        $tenant = Tenant::where('id',$request->store_name)->first();

        if($tenant)
        {
            return back()->withErrors(['errors'=>['Opps this username already exists.']]);
        }

        Session::put('store_data',$data);

        return redirect()->route('register.step2');
        
    }

    public function store_check(Request $request)
    {
        
        if($request->store_name)
        {
            
            $tenant = Tenant::where('id',$request->store_name)->first();

            if($tenant)
            {
                return response()->json(['error'=>'Oops This username already exists...!!']);
            }else{
                return response()->json('success');
            }
        }else{
            return response()->json('success');
        }
    }

    public function step2(Request $request)
    {
        abort_if(!Session::has('store_data'),403);

        $request->validate([
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'postal_code' => 'required',
            'phone_number' => 'required'
        ]);

        $store_data = Session::get('store_data');

      

        DB::beginTransaction();
        try {
            
           
            $user = new User();
            $user->role_id = 2;
            $user->name = $store_data['name'];
            $user->email = $store_data['email'];
            $user->password = $store_data['password'];
            $user->save();

            $plan        = Plan::where([['status', 1], ['is_trial', 1]])->first();

            $exp_days    = $plan->duration ?? 1;
            $expiry_date = $exp_days ? \Carbon\Carbon::now()->addDays($exp_days)->format('Y-m-d') : '';


            



            $plan_data = [
                'duration'            => $plan->duration ?? 0,
                'storage_size'        => $plan->storage_size ?? 0,
                'name'                => $plan->name ?? 'Free',
                'resume_builder'      => $plan->resume_builder ?? 0,
                'portfolio_builder'   => $plan->portfolio_builder ?? 0,
                'custom_domain'       => $plan->custom_domain ?? 0,
                'sub_domain'          => $plan->sub_domain ?? 0,
               
                'online_businesscard' => $plan->online_businesscard ?? 0,
                'qrcode'              => $plan->qrcode ?? 0,
                'postlimit'           => $plan->postlimit ?? 0,
                'is_featured'         => $plan->is_featured ?? 0,
                'data'                => $plan->data ?? "",
                'theme'               => 'theme/default',
            ];


            $invoice_prefix = Option::where('key','invoice_prefix')->first()->value;
            

            $order = new Order();
            $order->invoice_no = $invoice_prefix.Str::random(5);
            $order->user_id = $user->id;
            $order->plan_id = $plan->id;
            $order->getway_id = 13;
            $order->trx = Str::random(15);
            $order->will_expire = $expiry_date;
            $order->price = $plan->price;
            $order->status = 1;
            $order->tax = 0;
            $order->payment_status = 1;
            $order->save();


            $tenant = new Tenant();
            $tenant->id = $store_data['store_name'];
            $tenant->order_id = $order->id;
            $tenant->user_id = $user->id;
            $tenant->will_expire = $expiry_date;
            $tenant->status = 1;
            $tenant->data = $plan_data;
            $tenant->save();

            $subdomain_status = env('AUTO_SUBDOMAIN_APPROVE') == true ? 1 : 2;

            if (env('REGISTER_WITH_SUBDOMAIN') == true) {
                $domain=strtolower(Str::slug($store_data['store_name'])).'.'.env('APP_PROTOCOLESS_URL');
                $input = trim($domain, '/');
                if (!preg_match('#^http(s)?://#', $input)) {
                   $input = 'http://' . $input;
                }
                $urlParts = parse_url($input);
                $domain = preg_replace('/^www\./', '', $urlParts['host'] ?? $urlParts['path']);

                $tenant->domains()->create(['domain' => $domain, 'status'=> $subdomain_status,'type'=> 1]);
            }
            

        
            $orderlogs = new Orderlog();
            $orderlogs->order_id = $order->id;
            $orderlogs->tenant_id = $tenant->id;
            $orderlogs->save();



           $useroption = new Useroption();
           $useroption->user_id = $user->id;
           $useroption->key = 'vcard';
           $useroption->value = '{"theme":"vcard\/business","color":"#000000","slug":"nnn","name":"Your Name","tagline":"Your Position","description":"Your Description","profile_image_url":"uploads\/3\/profile_image.png","cover_image_url":"uploads\/3\/vcard\/cover_image.jpg","social":[]}';
           $useroption->save();

           $usermeta = new Usermeta();
           $usermeta->user_id = $user->id;
           $usermeta->key = 'cv';
           $usermeta->value = '{"theme":"cv\/theme1","color":null,"mode":null,"cvlanguage":"en","about":null,"address":null,"name":null,"role":null,"skill":["Hello"],"image":"https:\/\/porichoy.test\/uploads\/placeholder-profile.png"}';
           $usermeta->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            return back();
        }

        Session::forget('store_data');

        Auth::login($user,true);
      
        return redirect()->route('login');

    }
}
