<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Useroption;
use Faker\Factory;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    public function redirectTo()
    {
        if (Auth::check() && Auth::user()->role_id == 1) {
            return $this->redirectTo = route('admin.dashboard');
        } elseif (Auth::check()) {
            if (Session::has('plan_id')) {
                $plan_id                 = Session::get('plan_id');
                return $this->redirectTo = route('user.plan.gateways', $plan_id);
            } else {
                return $this->redirectTo = route('user.dashboard');
            }
        } else {
            return $this->redirectTo = route('login');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'plan'     => ['string', 'nullable'],
            'tenant'   => ['required', 'string', 'unique:tenants,id'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
       
        
        $plan        = Plan::find($data['plan']) ?? Plan::where([['status', 1], ['is_trial', 1]])->first();
        $exp_days    = $plan->duration ?? '';
        $expiry_date = $exp_days ? \Carbon\Carbon::now()->addDays(($exp_days - 1))->format('Y-m-d') : '';
        $domain      = env('APP_URL_WITH_TENANT') . Str::slug($data['tenant']);

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

       

        DB::beginTransaction();
        try {
             $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            ]);
            $tenant = Tenant::create(['id' => Str::slug($data['tenant']), 'user_id' => $user->id, 'will_expire' => $expiry_date, 'status' => 1, 'data' => $plan_data]);

            // $subdomain_status = env('AUTO_SUBDOMAIN_APPROVE') == true ? 1 : 0;

            // if(env('REGISTER_WITH_SUBDOMAIN') == true)
            //     {

                    
            $tenant->domains()->create(['domain' => $domain]);
            Session::put('register', 1);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
        }
        $plan ? Session::put('plan_id', $plan->id) : '';
        return $user;
    }
}
