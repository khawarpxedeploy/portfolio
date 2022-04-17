<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!Auth()->user()->can('company.index'), 401);
        $data = Option::where('key', 'company')->get();
        return view('admin.company.index', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth()->user()->can('company.create'), 401);
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'link'  => 'required|url',
            'name'  => 'required',
            'image' => 'required|image|max:5120',
        ],
            [
                'name.image' => 'The image field must be image like (png, jpg , jpeg etc)',
                'name.max'   => 'The image max size is 5 mb',
            ]);
        $data      = new Option();
        $data->key = 'company';
        // image uploads
        if ($request->hasFile('image')) {
            $thum_image      = $request->file('image');
            $thum_image_name = hexdec(uniqid()) . '.' . $thum_image->getClientOriginalExtension();
            $thum_image_path = 'uploads/template-image/1/' . date('y/m/');
            $thum_image->move($thum_image_path, $thum_image_name);
            $img = $thum_image_path . $thum_image_name;
        }
        $value = [
            'link'  => $request->link,
            'name'  => $request->name,
            'image' => $img,
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
        abort_if(!Auth()->user()->can('company.edit'), 401);
        $data  = Option::findOrFail($id);
        $value = json_decode($data->value);
        return view('admin.company.edit', compact('data', 'value'));

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
        $request->validate([
            'link'  => 'required|url',
            'name'  => 'required',
            'image' => 'image|max:1000',
        ],
            [
                'name.image' => 'The image field must be image like (png, jpg , jpeg etc)',
                'name.size'  => 'The image max size is 5 mb',
            ]);
        $data  = Option::where([['key', 'company'], ['id', $id]])->first();
        $value = json_decode($data->value);
        // image uploads
        if ($request->hasFile('image')) {
            if (file_exists($value->image)) {
                unlink($value->image);
            }
            $thum_image      = $request->file('image');
            $thum_image_name = hexdec(uniqid()) . '.' . $thum_image->getClientOriginalExtension();
            $thum_image_path = 'uploads/template-image/1/' . date('y/m/');
            $thum_image->move($thum_image_path, $thum_image_name);
            $img = $thum_image_path . $thum_image_name;
        } else {
            $img = $value->image;
        }
        $value = [
            'link'  => $request->link,
            'name'  => $request->name,
            'image' => $img,
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
        abort_if(!Auth()->user()->can('company.delete'), 401);
        $data  = Option::findOrFail($id);
        $value = json_decode($data->value);
        if (file_exists($value->image)) {
            unlink($value->image);
        }

        $data->delete();
        return redirect()->back()->with('success', 'Successfully Deleted');
    }
}
