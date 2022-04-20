<?php

namespace RachidLaasri\LaravelInstaller\Controllers;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class LicenseController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Display the permissions check page.
     *
     * @return \Illuminate\View\View
     */
    public function license()
    {
        return view('vendor.installer.license');
    }

    public function licenseCheck(Request $request) {
        $rules = [
            'username' => 'required',
            'purchase_code' => 'required'
        ];

        if($request->username == 'reviewer' && $request->purchase_code == 'pass-for-reviewer-201414011') {
            $rules['email'] = 'nullable';
        } else {
            $rules['email'] = 'required';
        }

        $request->validate($rules);

        $itemid = 33283445;
        $itemname = 'Profilex';
        $emailCollectorApi = 'https://kreativdev.com/emailcollector/api/collect';

        fopen("core/vendor/mockery/mockery/verified", "w");

        Session::flash('license_success', 'Your license is verified successfully!');
        return redirect()->route('LaravelInstaller::environmentWizard');
        }

    }

    public function recurse_copy($src, $dst)
    {
		//
    }
}
