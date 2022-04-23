<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Plan;
use Illuminate\Http\Request;
use Session;

class PricingController extends Controller
{
    public function index()
    {
        $currency_symbol = Option::where('key','currency_symbol')->first()->value;
        $pricings = Plan::where('status',1)->get();
        return view('main.pricing',compact('pricings','currency_symbol'));
    }
}
