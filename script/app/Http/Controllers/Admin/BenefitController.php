<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminBenefitRequest;
use App\Http\Requests\UpdateAdminBenefitRequest;
use App\Models\Option;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!Auth()->user()->can('benefit.index'), 401);
        $data = Option::where('key', 'benefit')->get();
        return view('admin.benefit.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth()->user()->can('benefit.create'), 401);
        return view('admin.benefit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminBenefitRequest $request)
    {
        //using custom request validator form App\Http\Requests\AdminBenefitRequest;

        $data      = new Option();
        $data->key = 'benefit';
        // image uploads
        if ($request->hasFile('image')) {
            $thum_image      = $request->file('image');
            $thum_image_name = hexdec(uniqid()) . '.' . $thum_image->getClientOriginalExtension();
            $thum_image_path = 'uploads/benefit/1/' . date('y/m/');
            $thum_image->move($thum_image_path, $thum_image_name);
            $img = $thum_image_path . $thum_image_name;
        }
        $value = [
            'title'   => $request->title,
            'image'   => $img,
            'excerpt' => $request->excerpt,
        ];
        $data->value = json_encode($value);
        $data->save();
        return response()->json('Data Added Successfully');

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
        abort_if(!Auth()->user()->can('benefit.edit'), 401);
        $data = Option::where([['key', 'benefit'], ['id', $id]])->first();
        return view('admin.benefit.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminBenefitRequest $request, $id)
    {
        $data  = Option::where([['key', 'benefit'], ['id', $id]])->first();
        $value = json_decode($data->value);
        // image uploads
        if ($request->hasFile('image')) {
            if (file_exists($value->image)) {
                unlink($value->image);
            }
            $thum_image      = $request->file('image');
            $thum_image_name = hexdec(uniqid()) . '.' . $thum_image->getClientOriginalExtension();
            $thum_image_path = 'uploads/benefit/1/' . date('y/m/');
            $thum_image->move($thum_image_path, $thum_image_name);
            $img = $thum_image_path . $thum_image_name;
        } else {
            $img = $value->image;
        }
        $value = [
            'title'   => $request->title,
            'image'   => $img,
            'excerpt' => $request->excerpt,
        ];
        $data->value = json_encode($value);
        $data->save();
        return response()->json('Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(!Auth()->user()->can('benefit.delete'), 401);
        $data  = Option::findOrFail($id);
        $value = json_decode($data->value);
        if (file_exists($value->image)) {
            unlink($value->image);
        }
        $data->delete();
        return redirect()->back()->with('success', 'Successfully Deleted');

    }
}
