<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Session;
use DB;
use Illuminate\Support\Str;
use App\Models\Option;
use App\Models\Order;
use App\Models\Orderlog;
use App\Models\Usermeta;
use App\Models\Useroption;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        if (Auth::check() && Auth::user()->role_id == 1) {
            return $this->redirectTo = route('admin.dashboard');
        } elseif (Auth::check() && Auth::user()->role_id == 2) {
            return $this->redirectTo = route('user.dashboard');
        } else {
            return $this->redirectTo = route('login');
        }
    }

    //Google login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $this->_registerOrLoginUser($user);

        // Return home after login
       return redirect($this->redirectTo());
    }

    //Facebook login
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();


        $this->_registerOrLoginUser($user);

        // Return home after login
       return redirect($this->redirectTo());
    }

    //Github login
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();

    }

    public function handleGithubCallback()
    {
        $user = Socialite::driver('github')->user();

        $this->_registerOrLoginUser($user);

        // Return home after login
       return redirect($this->redirectTo());
    }

    protected function _registerOrLoginUser($data)
    {

        $user = User::where('email', $data->email)->first();
        if (!$user) {
            DB::beginTransaction();
            try {
                $tenantName=$this->uniqueString($data->name);
                
            
                $user = new User();
                $user->role_id = 2;
                $user->name = $data->name;
                $user->email = $data->email;
                $user->save();

                
                $plan        = Plan::where([['status', 1], ['is_trial', 1]])->first();
                $exp_days    = $plan->duration ?? '';
                $expiry_date = $exp_days ? \Carbon\Carbon::now()->addDays(($exp_days - 1))->format('Y-m-d') : '';


                $plan_data = [
                    'duration'            => $plan->duration ?? 0,
                    'storage_size'        => $plan->storage_size ?? 0,
                    'name'                => $plan->name ?? 'Free',
                    'resume_builder'      => $plan->resume_builder ?? 0,
                    'portfolio_builder'   => $plan->portfolio_builder ?? 0,
                    'custom_domain'       => $plan->custom_domain ?? 0,
                    'sub_domain'          => $plan->sub_domain ?? 0,
                    'analytics'           => $plan->analytics ?? 0,
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
                $tenant->id = $tenantName;
                $tenant->order_id = $order->id;
                $tenant->user_id = $user->id;
                $tenant->will_expire = $expiry_date;
                $tenant->status = 1;
                $tenant->data = $plan_data;
                $tenant->save();

                $subdomain_status = env('AUTO_SUBDOMAIN_APPROVE') == true ? 1 : 0;

                if(env('REGISTER_WITH_SUBDOMAIN') == true)
                {
                    $domain=strtolower($tenantName).'.'.env('APP_PROTOCOLESS_URL');
                    $input = trim($domain, '/');
                    if (!preg_match('#^http(s)?://#', $input)) {
                    $input = 'http://' . $input;
                    }
                    $urlParts = parse_url($input);
                    $domain = preg_replace('/^www\./', '', $urlParts['host'] ?? $urlParts['path']);

                    $tenant->domains()->create(['domain' => $domain, 'status'=> $subdomain_status,'type'=> 1,'status'=>$subdomain_status]);
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
        }

        Auth::login($user, true);

    }


    function uniqueString($str){  
        $str=Str::slug($str);
        
        $check = Tenant::where('id', $str)->first();
        if($check == true){
            $rand =rand(200,100000);
            $str = $this->uniqueString($str.$rand);
        }
        return $str;
    }
}
