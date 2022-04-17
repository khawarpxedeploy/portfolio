<?php
namespace App\Lib;
use Omnipay\Omnipay;
use Session;
use Illuminate\Http\Request;

class Stripe {
    public static function redirect_if_payment_success($request_from)
    {
        return url('user/payment/success');
    }

    public static function redirect_if_payment_faild()
    {
        return url('user/payment/failed');
    }


    public function view(){

        if(Session::has('stripe_credentials')){
            $Info=Session::get('stripe_credentials');
            return view('user.plan.payment.stripe',compact('Info'));
        }
        abort(404);
    }

    public static function make_payment($array)
    {
        $publishable_key=$array['publishable_key'];
        $secret_key=$array['secret_key'];
        $currency=$array['currency'];
        $email=$array['email'];
        $amount=str_replace(',', '', number_format($array['amount'],2));
        $totalAmount=str_replace(',', '', number_format($array['pay_amount'],2));
        $name=$array['name'];
        $billName=$array['billName'];
        $test_mode=$array['test_mode'];
        $data['publishable_key']=$publishable_key;
        $data['secret_key']=$secret_key;
        $data['payment_mode']='stripe';
        $data['amount']=$totalAmount;
        $data['test_mode']=$test_mode;
        $data['request_from'] = $request_from = $array['request_from'];
        $data['charge']=$array['charge'];
        $data['main_amount']=$array['amount'];
        $data['getway_id']=$array['getway_id'];
        $data['is_fallback']=$array['is_fallback'] ?? 0;
        if ($request_from == 'customer' || $request_from == 'api') {
            $data['request_id']=$array['request_id'];
            $data['user_id']=$array['user_id'];
        }
        $data['payment_type']=$array['payment_type'];

        Session::put('stripe_credentials',$data);


        if ($request_from == 'customer' || $request_from == 'api') {
          return redirect()->route('customer.stripe.view', $request_from);
        }elseif ($request_from == 'user') {
          return redirect()->route('stripe.view', $request_from);
        }
    }

    public function status(Request $request)
    {
       
        if (!Session::has('stripe_credentials')) {
            return redirect(Stripe::redirect_if_payment_faild());
        }
        $credentials=Session::get('stripe_credentials');
        
        $stripe = Omnipay::create('Stripe');
        $token = $request->stripeToken;
        $gateway = $credentials['publishable_key'];
        $secret_key = $credentials['secret_key'];
        $main_amount = $credentials['amount']; 
        
        $stripe->setApiKey($secret_key);

        if($token){
            $response = $stripe->purchase([
                'amount' => round($main_amount, 2),
                'currency' => 'USD',
                'token' => $token,
            ])->send();
        }
        $data['request_from'] = $request_from = $credentials['request_from'];

        if ($response->isSuccessful()) {
            $arr_body = $response->getData();
            $data['payment_id'] = $arr_body['id'];
            $data['payment_method'] = "stripe";
            $data['getway_id'] = $credentials['getway_id'];
            $data['payment_type'] = $credentials['payment_type'];
            if ($request_from == 'customer' || $request_from == 'api') {
                $data['request_id'] = $credentials['request_id'];
                $data['user_id']= $credentials['user_id'];
            }
            $data['amount'] = $credentials['main_amount'];
            $data['charge'] = $credentials['charge'];
            $data['status'] = 1;          
            $data['payment_status'] = 1;   
            $data['is_fallback'] = $credentials['is_fallback'];
            Session::put('payment_info',$data);
            Session::forget('stripe_credentials');
            return redirect(Stripe::redirect_if_payment_success($request_from));
        }
        else{
           Session::forget('stripe_credentials');
           return redirect(Stripe::redirect_if_payment_faild($request_from));
        }
    }
    public static function isfraud($creds){
        $payment_id = $creds['payment_id'];
        $secret_key = $creds['secret_key'];

        try {
        $stripe = new \Stripe\StripeClient($secret_key);

        $response = $stripe->charges->retrieve(
            $payment_id,
            [],
        );
        return $response->status === "succeeded" ? 1 : 0;
        } catch (\Throwable $th) {
            return 0;
        }
         
    }

}


?>