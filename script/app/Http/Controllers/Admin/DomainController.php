<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
        abort_if(!Auth()->user()->can('domain.index'), 401);
        $status=$request->status ?? null;
        if (isset($request->type)) {
            $domains = Domain::with('tenant')->where($request->type,'LIKE',"%".$request->src."%");
        }
        else{
           
            $domains = Domain::with('tenant');
        }

        if ($request->status) {
            if ($request->status == 'trash') {
                $status=0;
            }
            else{
                $status=$request->status;
            }
           $domains=$domains->where('status',$request->status);
        }
        
        $domains = $domains->where('type','!=',0)->latest()->paginate(20);

        $all=Domain::where('type','!=',0)->count();
        $active=Domain::where('status',1)->where('type','!=',0)->count();
        $pending=Domain::where('status',2)->where('type','!=',0)->count();
        $inactive=Domain::where('status',0)->where('type','!=',0)->count();

        return view('admin.domain.index', compact('domains','status','request','all','active','pending','inactive'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth()->user()->can('domain.create'), 401);
        return view('admin.domain.create');

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
        abort_if(!Auth()->user()->can('domain.edit'), 401);
        return view('admin.domain.edit');
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
        $check= Domain::where('domain',$request->domain)->where('id','!=',$id)->first();
        if (!empty($check)) {
            $error['errors']['domain']='Oops domain name already taken....!!';
            return response()->json($error,422);
        }

         $domain= Domain::findorFail($id);
         $domain->domain= $request->domain;
         $domain->status=$request->status;
         $domain->tenant_id=$request->tenant_id;
         $domain->save();

         return response()->json('Domain Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->method == 'delete' && count($request->ids ?? []) > 0) {
           $data = Domain::whereIn('id',$request->ids)->delete();
        }
        return redirect()->back()->with('success', 'Domain Deleted Successfully');

    }
}
