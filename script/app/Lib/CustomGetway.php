<?php
namespace App\Lib;

use App\Models\Order;
use App\Models\Payment;
use Session;
use Illuminate\Http\Request;
use Http;
use Str;
class CustomGetway {
        
    public static function redirect_if_payment_success($request_from)
    {
        
        return url('user/payment/success');
        
    }

    public static function redirect_if_payment_faild($request_from)
    {
        
        return url('user/payment/failed');
        
    }

    

    public static function make_payment($array)
    {
        $currency=$array['currency'];
        $email=$array['email'];
        $amount=$array['pay_amount'];
        $name=$array['name'];
        $billName=$array['billName'];

        $data['payment_mode']='manual';
        $test_mode=$array['test_mode'];
        $data['test_mode']=$test_mode;
        $data['request_from'] = $request_from = $array['request_from'];
        $data['amount']=$amount;
        $data['charge']=$array['charge'];
        $data['phone']=$array['phone'];
        $data['getway_id']=$array['getway_id'];
        $data['main_amount']=$array['amount'];
        $data['payment_type']=$array['payment_type'];
        $data['billName']=$billName;
        $data['name']=$name;
        $data['email']=$email;
        $data['currency']=$currency;
        $data['screenshot']=$array['screenshot'] ?? '';
        $data['is_fallback']=$array['is_fallback'] ?? 0;
        $data['image']=$array['image'];
        $data['comment']=$array['comment'];
        Session::put('manual_credentials',$data);
        return redirect('/manual/payment');
    
    }


    public function status()
    {
        if(!Session::has('manual_credentials')){
            return abort(404);
        }
        $info=Session::get('manual_credentials');
        $data['request_from'] = $request_from = $info['request_from'];
            $data['payment_id'] = $this->generateString();           
            $data['payment_method'] = "manual";
            $data['getway_id'] = $info['getway_id'];
            $data['payment_type'] = $info['payment_type'];
            $data['amount'] = $info['main_amount'];
            $data['charge'] = $info['charge'];
            $data['status'] = 2;   
            $data['payment_status'] = 2;  
            $data['image']=$info['image'];
            $data['comment']=$info['comment'];    
            Session::forget('manual_credentials');
            Session::put('payment_info',$data); 
            return redirect(CustomGetway::redirect_if_payment_success($request_from));
      
    }


    public function generateString()
    {
        $str = Str::random(20);
        $payment = Order::where('trx',$str)->count();
        if ($payment == 0) {
            return $str;
        }
        return $this->generateString();
    }

}


?>
