<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Order;
use App\Models\Option;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertMail;
use App\Jobs\SendEmailJob;
use Carbon\Carbon;
class CronController extends Controller
{
    public function expireOrder()
    {
    	  $tenants=Tenant::where('will_expire','<=' ,Carbon::today())->where('status',1)->with('orderwithplan','user')->get();
         Order::where('will_expire','<=' ,Carbon::today())->where('status',1)->update(array('status' => 3)); //expired
         Tenant::where('will_expire','<=' ,Carbon::today())->where('status',1)->update(array('status' => 0));

         $option = Option::where('key','cron_option')->first();
         $cron_option = json_decode($option->value);

         $trial_tenants=[];
         $expireable_tenants=[];
        foreach($tenants as $row){
            $plan=$row->orderwithplan->plan;
            
            if (!empty($plan)) {
                if($row->orderwithplan->plan->is_trial == 1){
                   $order_info['email']=$row->user->email;
                   $order_info['name']=$row->user->name;
                   $order_info['plan_name']=$plan->name;
                   $order_info['tenant_id']=$row->id;
                   $order_info['will_expire']=$row->will_expire;
                   array_push($trial_tenants, $order_info);
                  
               }
               else{

                   $order_info['email']=$row->user->email;
                   $order_info['name']=$row->user->name;
                   $order_info['plan_name']=$plan->name;
                   $order_info['tenant_id']=$row->id;
                   $order_info['will_expire']=$row->will_expire;
                   $order_info['amount']=$plan->price;
                   $order_info['plan_name']=$plan->name;
                   array_push($expireable_tenants, $order_info);
               }
            }
         }

         $this->expiredTenant($trial_tenants,$cron_option->trial_expired_message);
         $this->expiredTenant($expireable_tenants,$cron_option->expire_message);
         
 
         return "success";
    }

    public function alertBeforeExpire()
    {
    	 //before expired how many days left
         $option = Option::where('key','cron_option')->first();
         $cron_option = json_decode($option->value);

         $date= Carbon::now()->addDays($cron_option->days)->format('Y-m-d');
         
         $tenants=Tenant::where([['status',1],['will_expire','<=',$date],['will_expire','!=',Carbon::now()->format('Y-m-d')]])->with('orderwithplan','user')->get();
         
        
         $expireable_tenants=[];

         foreach($tenants as $row){
            $plan=$row->orderwithplan->plan;
            
            if (!empty($plan)) {
                if($row->orderwithplan->plan->is_trial == 0){
                   $order_info['email']=$row->user->email;
                   $order_info['name']=$row->user->name;
                   $order_info['plan_name']=$plan->name;
                   $order_info['tenant_id']=$row->id;
                   $order_info['will_expire']=$row->will_expire;
                   $order_info['amount']=$plan->price;
                   $order_info['plan_name']=$plan->name;
                   array_push($expireable_tenants, $order_info);
                  
               }
               
            }
         }
         

         $this->expireSoon($expireable_tenants,$cron_option->alert_message);
        
         return "success";
    }






     //send notification for the expired tenant owner
     public function expiredTenant($data,$massege)
     {

         foreach($data ?? []  as $row){
                
                $references['Profile name']=$row['tenant_id']; 
                $references['Plan name']=$row['plan_name'];
                $references['Date of expire']=$row['will_expire'];
                 
                $maildata=[
                    'type'=>'plan_alert',
                    'subject'=>'['.strtoupper(env('APP_NAME')).'] - Subscription Expired For '.$row['tenant_id'],
                    'message'=>$massege,
                    'references'=>json_encode($references),
                    'name'=>$row['name'],
                    'email'=>$row['email'],
                ];

             if (env('QUEUE_MAIL') == 'on') {
                 dispatch(new SendEmailJob($maildata));
             }else{

                 Mail::to($row['email'])->send(new AlertMail($maildata)); 
             } 
        }
     }

      //send notification mail before expire the order
    public function expireSoon($data,$message)
    {
        foreach($data ?? []  as $row){
                
                $references['Profile name']=$row['tenant_id']; 
                $references['Plan name']=$row['plan_name'];
                $references['Last date of due']=$row['will_expire'];
                $references['Total amount']=number_format($row['amount'],2); 
                 
                $maildata=[
                    'type'=>'plan_alert',
                    'subject'=>'['.strtoupper(env('APP_NAME')).'] - Upcoming Subscription Renewal Notice',
                    'message'=>$message,
                    'references'=>json_encode($references),
                    'name'=>$row['name'],
                    'email'=>$row['email'],
                ];

             if (env('QUEUE_MAIL') == 'on') {
                 dispatch(new SendEmailJob($maildata));
             }else{

                 Mail::to($row['email'])->send(new AlertMail($maildata)); 
             } 
        }
    }
 
}
