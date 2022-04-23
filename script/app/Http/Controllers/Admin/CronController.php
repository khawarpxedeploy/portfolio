<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
class CronController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!Auth()->user()->can('cron'), 401);
        $auto_enroll_after_payment=Option::where('key','auto_enroll_after_payment')->first();
        $cron_option=Option::where('key','cron_option')->first();
        $cron_option=json_decode($cron_option->value);
        $cron=$cron_option;
        return view('admin.cron.cron',compact('auto_enroll_after_payment','cron_option','cron'));
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auto_enroll_after_payment=Option::where('key','auto_enroll_after_payment')->first();
        $auto_enroll_after_payment->value = $request->auto_enroll_after_payment;
        $auto_enroll_after_payment->save();

        $data['days']=$request->days;
        $data['alert_message']=$request->alert_message;
        $data['expire_message']=$request->expire_message;
        $data['trial_expired_message']=$request->trial_expired_message;

        $cron_option=Option::where('key','cron_option')->first();
        $cron_option->value = json_encode($data);
        $cron_option->save();

        return response()->json('Update Success');
    }

}
