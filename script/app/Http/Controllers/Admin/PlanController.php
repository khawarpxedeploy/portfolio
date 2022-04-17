<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(!Auth()->user()->can('plan.index'), 401);
        $all      = Plan::count();
        $active   = Plan::where('status', '1')->count();
        $inactive = Plan::where('status', '0')->count();
        $status   = 'all';
        if ($request->has('active') || $request->has('inactive')) {
            if ($request->has('active')) {
                $status = 'active';
                $data   = Plan::withCount('orders')->withSum('orders', 'price')->withCount('activeorders')->where('status', '1')->paginate(10);
            } else {
                $status = 'inactive';
                $data   = Plan::withCount('orders')->withSum('orders', 'price')->withCount('activeorders')->where('status', '0')->paginate(10);
            }
        } else {
            $data = Plan::withCount('orders')->withSum('orders', 'price')->withCount('activeorders')->paginate(10);
        }
        return view('admin.plan.index', compact('data', 'active', 'inactive', 'all', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth()->user()->can('plan.create'), 401);
        return view('admin.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanRequest $request)
    {
        //using custom request validator form App\Http\Requests\PlanRequest;
        $obj       = new Plan();
      
        $obj->name = $request->name;
        $obj->duration = $request->duration;
        $obj->storage_size = $request->storage_size;
        $obj->price = $request->price;
        $obj->postlimit = $request->postlimit;
        $obj->portfolio_builder = $request->portfolio_builder;
        $obj->custom_domain = $request->custom_domain;
        $obj->sub_domain = $request->sub_domain;
        $obj->analytics = $request->analytics ?? 0;
        $obj->online_businesscard = $request->vcard;
        $obj->qrcode = $request->qrcode;
        $obj->vcard = $request->vcard;
        $obj->online_cv = $request->online_cv;
        $obj->resume_builder = $request->resume_builder;
        $obj->is_featured = $request->is_featured ?? 0;
        
        $obj->status = $request->status;
      
        $obj->save();
        return response()->json('Plan Add Successfully');
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
        abort_if(!Auth()->user()->can('plan.edit'), 401);
        $data = Plan::findOrFail($id);
        return view('admin.plan.edit', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlanRequest $request, $id)
    {
        //using custom request validator form App\Http\Requests\PlanRequest;
        $obj       = Plan::findOrFail($id);
       
        $obj->name = $request->name;
        $obj->duration = $request->duration;
        $obj->storage_size = $request->storage_size;
        $obj->price = $request->price;
        $obj->postlimit = $request->postlimit;
        $obj->portfolio_builder = $request->portfolio_builder;
        $obj->custom_domain = $request->custom_domain;
        $obj->sub_domain = $request->sub_domain;
        $obj->online_businesscard = $request->vcard;
        $obj->qrcode = $request->qrcode;
        $obj->vcard = $request->vcard;
        $obj->online_cv = $request->online_cv;
        $obj->resume_builder = $request->resume_builder;
     
        $obj->status = $request->status;
       
        $obj->save();
        return response()->json('Plan Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(!Auth()->user()->can('plan.delete'), 401);
        $data = Plan::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', 'Plan Deleted Successfully');

    }
}
