<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Option;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!planData('sub_domain') && !planData('custom_domain'),403); 
        $dns_info               = Option::where('key', 'config_dns')->first();
        $domainInfo=Tenant::with('subdomain','customdomain')->where('user_id',Auth::id())->first();
        $dns=json_decode($dns_info->value ?? '');
        return view('user.settings.index', compact('domainInfo', 'dns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tenant    = Tenant::with('domain')->where('user_id', Auth::id())->first();
        abort_if(Auth::id() != $tenant->user_id, 401);
        $subdomain = $customdomain = '';

        if ($tenant->sub_domain == 1) {
            $request->validate([
                "subdomain" => 'required|unique:domains,domain',
            ]);
            $subdomain = $this->filter_protocol($request->subdomain);
        }
        if ($tenant->custom_domain == 1) {
            $request->validate([
                "customdomain" => 'required|unique:domains,domain',
            ]);
            $customdomain = $this->filter_protocol($request->customdomain);
        }

        if (($subdomain != '' && $customdomain != '') && $subdomain == $customdomain) {
            $msg['errors']['error'] = "Subdomain and Custom domain cannot be same";
            return response()->json($msg, 401);
        }

        if ($subdomain) {
            $sub = Domain::where([['tenant_id', $id], ['type', 1]])->first();
            if ($sub == null) {
                $sub            = new Domain;
                $sub->tenant_id = $id;
            }
            $sub->domain = $subdomain;
            $sub->type   = 1;
            $sub->save();
        }

        if ($customdomain) {
            $custom = Domain::where([['tenant_id', $id], ['type', 2]])->first();
            if ($custom == null) {
                $custom            = new Domain;
                $custom->tenant_id = $id;
            }
            $custom->domain = $customdomain;
            $custom->type   = 2;
            $custom->save();
        }

        return response()->json('Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function filter_protocol($url)
    {
        $domain = strtolower($url);
        $input  = trim($domain, '/');
        if (!preg_match('#^http(s)?://#', $input)) {
            $input = 'http://' . $input;
        }
        $urlParts    = parse_url($input);
        $domain      = preg_replace('/^www\./', '', $urlParts['host']);
        $full_domain = rtrim($domain, '/');

        return $full_domain;
    }
}
