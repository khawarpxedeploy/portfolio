<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function lang(Request $request)
    {
        Session::put('locale',$request->lang);
        return response()->json('success');
    }
}
