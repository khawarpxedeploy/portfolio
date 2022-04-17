<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Term;
use Illuminate\Http\Request;

class TemplateImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!Auth()->user()->can('template-image.index'), 401);
        $data = Term::where('type', 'portfolio_template')->orWhere('type','resume_template')->orWhere('type','vcard_template')->latest()->get();
        return view('admin.template_image.index', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth()->user()->can('template-image.create'), 401);
        return view('admin.template_image.create');
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
            'image' => 'required|image|max:5120',
        ],
            [
                'name.required' => 'The image field is Required',
                'name.image'    => 'The image field must be image like (png, jpg , jpeg etc)',
                'name.max'      => 'The image max size is 5 mb',
            ]);
        $data      = new Term();
        
        // image uploads
        if ($request->hasFile('image')) {
            $thum_image      = $request->file('image');
            $thum_image_name = hexdec(uniqid()) . '.' . $thum_image->getClientOriginalExtension();
            $thum_image_path = 'uploads/template/' . date('y/m/');
            $thum_image->move($thum_image_path, $thum_image_name);
            $img = $thum_image_path . $thum_image_name;
        }
       
        $data->title=$img;
        $data->slug=$request->link;
        $data->type=$request->type;
        $data->featured=$request->featured;
        $data->save();
        return response()->json('Template Added Successfully');
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
        abort_if(!Auth()->user()->can('template-image.edit'), 401);
        $info      =  Term::findOrFail($id);
        return view('admin.template_image.edit', compact('info'));

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
            'image' => 'image|max:1000',
        ],
            [
                'name.image' => 'The image field must be image like (png, jpg , jpeg etc)',
                'name.size'  => 'The image max size is 5 mb',
            ]);
      
        
        $data      =  Term::findOrFail($id);
        // image uploads
        if ($request->hasFile('image')) {
            if (file_exists($data->title)) {
                unlink($data->title);
            }
            $thum_image      = $request->file('image');
            $thum_image_name = hexdec(uniqid()) . '.' . $thum_image->getClientOriginalExtension();
            $thum_image_path = 'uploads/template/' . date('y/m/');
            $thum_image->move($thum_image_path, $thum_image_name);
            $img = $thum_image_path . $thum_image_name;
        } 
       
        $data->title=$img ?? $data->title;
        $data->slug=$request->link;
        $data->type=$request->type;
        $data->featured=$request->featured;
        $data->save();

        $data->save();
        return response()->json('Template Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(!Auth()->user()->can('template-image.delete'), 401);
        $data  = Term::findOrFail($id);
      
        if (file_exists($data->title)) {
            unlink($data->title);
        }

        $data->delete();
        return redirect()->back()->with('success', 'Successfully Deleted');
    }
}
