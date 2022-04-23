<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminTenantUpdateRequest;
use App\Models\Domain;
use App\Models\Tenant;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(!Auth()->user()->can('tenant.index'), 401);

        $all      = Tenant::count();
        $active   = Tenant::where('status', '1')->count();
        $inactive = Tenant::where('status', '0')->count();
        $pending  = Tenant::where('status', '2')->count();
        $st       = '';
       $tenants  = Tenant::with('user','orderwithplan');

        if (isset($request->type)) {
            $str = $request->q;
            if ($request->type == 'user') {
                $tenants = $tenants->whereHas('user', function ($q) use ($str) {
                    return $q->where('email', 'LIKE', "%$str%")->orWhere('name', 'LIKE', "%$str%");
                });
            } elseif ($request->type == 'tenant') {
                $tenants = $tenants->where('id', 'LIKE', "%$str%");
            }
        } elseif ($request->has('1') || $request->has('0') || $request->has('2')) {
            if ($request->has('1')) {
                $st      = '1';
                $tenants = $tenants->where('status', '1');
            } elseif ($request->has('2')) {
                $st      = '2';
                $tenants = $tenants->where('status', '2');
            } else {
                $st      = '0';
                $tenants = $tenants->where('status', '0');
            }
        } else {
            $tenants = $tenants;
        }

       $tenants = $tenants->latest('created_at')->paginate(30);

        return view('admin.tenant.index', compact('tenants', 'all', 'active', 'inactive', 'pending', 'st','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    public function config($id)
    {
        abort_if(!Auth()->user()->can('tenant.view'), 401);
         $info=Tenant::with('subdomain','customdomain')->findorFail($id);
        return view('admin.tenant.config', compact('info'));
    }


    public function domainCreate(Request $request){
        $request->validate([
            "domain" => 'required|unique:domains,domain',
        ]);       

        $domain     = new Domain;
        $domain->domain    = $this->filter_protocol($request->domain);
        $domain->tenant_id    = $request->tenant;
        $domain->type    = $request->type;
        $domain->save();

        return response()->json('Successfully Created');
    }

    public function domainUpdate(Request $request, $id)
    {
        $request->validate([
            "domain" => 'required|unique:domains,domain,' . $id,
        ]);       

        $domain     = Domain::findOrFail($id);
        $domain->domain    = $this->filter_protocol($request->domain);
        $domain->type    = $request->type;
        $domain->save();

        return response()->json('Successfully updated');
    }


    public function domainDelete($id){

    }

    public function configUpdate(Request $request, $id)
    {
        $request->validate([
            "tenant" => 'required|unique:tenants,id,' . $id,
        ]);       
        $tenant       = Str::slug($request->tenant);
        $tenantUpdate     = Tenant::findOrFail($id);
        $tenantUpdate->id = $tenant;
        $tenantUpdate->save();
        return redirect()->route('admin.tenant.config', $tenantUpdate->id)->with('message', 'Successfully Configured!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       if ($request->subdomain) {
           $validatedData = $request->validate([
            'subdomain' => 'required|string|max:50',
           ]);

           $domain=strtolower($request->subdomain).'.'.env('APP_PROTOCOLESS_URL');
           $check= Domain::where('domain',$domain)->first();
            if (!empty($check)) {
                    $error['errors']['domain']='Oops domain name already taken....!!';
                    return response()->json($error,422);
            }

            $subdomain= new Domain;
            $subdomain->domain= $domain;
            $subdomain->tenant_id= $request->tenant_id;
            $subdomain->status=env('AUTO_SUBDOMAIN_APPROVE') == true ? 1 : 2;
            $subdomain->type=1;
            $subdomain->save();

            return response()->json('Domain Created Successfully...!!');
       }

        if ($request->domain) {
            $validatedData = $request->validate([
            'domain' => 'required|string|max:50|',
            ]);
           
            $urlParts = parse_url($request->domain);

            $filter_url = preg_replace('/^www\./', '', $urlParts['host'] ?? $urlParts['path']);

            $check=Domain::where('domain',$filter_url)->first();

            if (!empty($check)) {
                $error['errors']['domain']='Oops domain name already taken....!!';
                return response()->json($error,422);
            }

            $domain= new Domain;
            $domain->domain= $filter_url;
            $domain->tenant_id= $request->tenant_id;
            $domain->status=2;
            $domain->type=2;
            $domain->save();

            return response()->json('Custom Domain Created Successfully...!!');
        }      
       ;
         
    }

    public function subdomainUpdate(Request $request,$id)
    {   
        $request->validate([
            'subdomain' => 'required|string|max:50',
        ]);

        $subdomain= Domain::findOrfail($id);
        $subdomain->status= $request->status;
        $subdomain->save();

        return response()->json('Subdomain Updated Successfully...!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(!Auth()->user()->can('tenant.edit'), 401);

        $tenant = Tenant::findOrFail($id);
        return view('admin.tenant.edit_tenant', compact('tenant'));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(!Auth()->user()->can('tenant.edit'), 401);

        $tenant = Tenant::findOrFail($id);
        return view('admin.tenant.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminTenantUpdateRequest $request, $id)
    {
        //using custom request validator form App\Http\Requests\AdminCustomerRequest;
        $data = [
            "duration"            => $request->duration,
            "storage_size"        => $request->storage_size ?? null,
            "resume_builder"      => $request->resume_builder,
            "postlimit"           => $request->postlimit,
            "portfolio_builder"   => $request->portfolio_builder,
            "custom_domain"       => $request->custom_domain,
            "sub_domain"          => $request->sub_domain,
            "analytics"           => $request->analytics,
            "online_businesscard" => $request->online_businesscard,
            "qrcode"              => $request->qrcode,
            "postlimit"           => $request->postlimit,
        ];

        Tenant::where('id', $id)->update(['data' => $data]);


        return response()->json('Plan Updated Successfully');
    }

    public function updateProfile(Request $request,$id)
    {
         $request->validate([            
            'id' => 'required|max:100|unique:tenants,id,' . $id,                     
        ]);


        $row=DB::table('tenants')
        ->where('id', $id)
        ->update([
        'id' => Str::slug($request->id),
        'status' => $request->status,
        'will_expire' => $request->will_expire
        ]);
        return response()->json('Profile Updated Successfully');

    }

    

    public function status(Request $request)
    {
        if ($request->ids && count($request->ids) > 0 && $request->status != null) {
            if ($request->status == 5) {
                Tenant::whereIn('id', $request->ids)->delete();
            } else {
                Tenant::whereIn('id', $request->ids)->update(['status' => $request->status]);
            }
            return back();
        }
        return back()->with('alert', 'Nothing selected!');
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
