<?php
namespace App\Lib;
use Omnipay\Omnipay;
use Session;
use Illuminate\Http\Request;

class Paypal {
        
    public static function redirect_if_payment_success()
    {
        return url('user/payment/success');
    }

    public static function redirect_if_payment_faild()
    {
       return url('user/payment/failed');  
    }

    public static function fallback()
    {
       return url('/payment/paypal'); 
    }


    public static function make_payment($array)
    {      
        $client_id=$array['client_id'];
        $client_secret=$array['client_secret'];
        $currency=$array['currency'];
        $email=$array['email'];
        $amount=round($array['pay_amount']);
        $name=$array['name'];
        $test_mode=$array['test_mode'];
        $billName=$array['billName'];
        $data['client_id']=$client_id;
        $data['client_secret']=$client_secret;
        $data['payment_mode']='paypal';
        $data['request_from'] = $request_from = $array['request_from'];
        $data['amount']=$amount;
        $data['test_mode']=$test_mode;
        $data['charge']=$array['charge'];
        $data['main_amount']=$array['amount'];
        $data['getway_id']=$array['getway_id'];
        $data['payment_type']=$array['payment_type'];
        $final = round($amount/100, 2);
        $data['is_fallback']=$array['is_fallback'] ?? 0;
         

        if($test_mode == 0){
            $data['env']=false;
            $test_mode=false;
        }
        else{
            $data['env']=true;
            $test_mode=true;
        }
       
       

        Session::put('paypal_credentials',$data);
        $gateway = Omnipay::create('PayPal_Rest');
        $gateway->setClientId($client_id);
        $gateway->setSecret($client_secret);
        $gateway->setTestMode($test_mode); 

        
        $response = $gateway->purchase(array(
            'amount' => $final,
            'currency' => strtoupper($currency),
            'returnUrl' => Paypal::fallback($request_from),
            'cancelUrl' => Paypal::redirect_if_payment_faild($request_from),
        ))->send();


        if ($response->isRedirect()) {
            $response->redirect(); // this will automatically forward the customer
        } else {
            // not successful
            return redirect(Paypal::redirect_if_payment_faild($request_from));
        }


    }

    public function status(Request $request)
    {
      
        if (!Session::has('paypal_credentials')) {
            return redirect(Paypal::redirect_if_payment_faild());
        }

        $credentials=Session::get('paypal_credentials');
        $gateway = Omnipay::create('PayPal_Rest');
        $gateway->setClientId($credentials['client_id']);
        $gateway->setSecret($credentials['client_secret']);
        $gateway->setTestMode($credentials['env']); 
        
        $request= $request->all();
        
        $transaction = $gateway->completePurchase(array(
            'payer_id'             => $request['PayerID'],
            'transactionReference' => $request['paymentId'],
        ));

        $data['request_from'] = $request_from = $credentials['request_from'];
        $response = $transaction->send();
        if ($response->isSuccessful()) {
            $arr_body = $response->getData();
            $data['payment_id'] = $arr_body['id'];
            $data['payment_method'] = "paypal";
            $data['getway_id'] = $credentials['getway_id'];
            $data['payment_type'] = $credentials['payment_type'];
            $data['amount'] = $credentials['main_amount'];
            $data['charge'] = $credentials['charge'];
            $data['status'] = 1;    
            $data['payment_status'] = 1;      
            if ($request_from == 'customer' || $request_from == 'api') {
                $data['request_id'] = $credentials['request_id'];
                $data['user_id']= $credentials['user_id'];
            }     
            Session::put('payment_info',$data);
            Session::forget('paypal_credentials');
            // return Session::get('payment_info');
            return redirect(Paypal::redirect_if_payment_success($request_from));
        }
        else{
           Session::forget('paypal_credentials');
           return redirect(Paypal::redirect_if_payment_faild($request_from));
        }
    }


}


?>
