<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Models\Term;
use App\Models\Termmeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!Auth()->user()->can('blog.index'), 401);
        $all_blogs = Term::where('type', 'blog')->paginate(20);
        return view('admin.blog.index', compact('all_blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth()->user()->can('blog.create'), 401);
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        //using custom request validator form App\Http\Requests\BlogRequest;

        DB::beginTransaction();
        try {

            // Term Data Store
            $blog_store        = new Term();
            $blog_store->title = $request->name;
            $blog_store->type  = 'blog';
            //to unique slug
            $now_slug = Str::slug($request->name);
            $count    = Term::where('type', 'blog')->where('title', $request->name)->count();
            if ($count > 0) {
                $slug             = "{$now_slug}-" . ($count + 1);
                $blog_store->slug = $slug;
            } else {
                $blog_store->slug = $now_slug;
            }

            $blog_store->status   = $request->status;
            $blog_store->featured = 1;
            $blog_store->save();

            // Term Meta For excerpt
            $blog_excerpt          = new Termmeta();
            $blog_excerpt->term_id = $blog_store->id;
            $blog_excerpt->key     = 'excerpt';
            $blog_excerpt->value   = $request->excerpt;
            $blog_excerpt->save();

            // Thum Image Check
            if ($request->hasFile('image')) {
                $thum_image      = $request->file('image');
                $thum_image_name = hexdec(uniqid()) . '.' . $thum_image->getClientOriginalExtension();
                $thum_image_path = 'uploads/blog/' . date('y/m/');
                $thum_image->move($thum_image_path, $thum_image_name);

                // Term Meta For Image
                $blog_image          = new Termmeta();
                $blog_image->term_id = $blog_store->id;
                $blog_image->key     = 'thum_image';
                $blog_image->value   = $thum_image_path . $thum_image_name;
                $blog_image->save();
            }

            // Term Meta For Description
            $blog_description          = new Termmeta();
            $blog_description->term_id = $blog_store->id;
            $blog_description->key     = 'description';
            $blog_description->value   = $request->description;
            $blog_description->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg['errors']['error'] = "Error Occurred!";
            return response()->json($msg, 401);
        }
        return response()->json('Blog Added Successfully');
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
        abort_if(!Auth()->user()->can('blog.edit'), 401);
        $data = Term::with('description', 'thum_image', 'excerpt')->findOrFail($id);
        return view('admin.blog.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogUpdateRequest $request, $id)
    {

        //using custom request validator form App\Http\Requests\BlogUpdateRequest;

        DB::beginTransaction();
        try {
            // Term Data Update
            $blog_update = Term::findOrFail($id);
            $info_thuimg = $blog_update->thum_image->value;

            // Thum Image Check
            if ($request->hasFile('image')) {
                if (file_exists($info_thuimg)) {
                    unlink($info_thuimg);
                }

                $thum_image      = $request->file('image');
                $thum_image_name = hexdec(uniqid()) . '.' . $thum_image->getClientOriginalExtension();
                $thum_image_path = 'uploads/blog/' . date('y/m/');
                $thum_image->move($thum_image_path, $thum_image_name);

                $preview = $thum_image_path . $thum_image_name;
            } else {
                $preview = $info_thuimg;
            }

            $blog_update->title = $request->name;

            //to unique slug
            $now_slug = Str::slug($request->name);
            $count    = Term::where('type', 'blog')->where('title', $request->name)->count();
            if ($count > 0) {
                $slug              = "{$now_slug}-" . ($count + 1);
                $blog_update->slug = $slug;
            } else {
                $blog_update->slug = $now_slug;
            }
            $blog_update->type     = 'blog';
            $blog_update->status   = $request->status;
            $blog_update->featured = 1;
            $blog_update->save();

            // Term Meta For excerpt
            $blog_meta_excerpt_update        = Termmeta::where('term_id', $id)->where('key', 'excerpt')->first();
            $blog_meta_excerpt_update->value = $request->excerpt;
            $blog_meta_excerpt_update->save();

            // Term Meta For Image
            $blog_meta_thumimg_update        = Termmeta::where('term_id', $id)->where('key', 'thum_image')->first();
            $blog_meta_thumimg_update->value = $preview;
            $blog_meta_thumimg_update->save();

            // Term Meta For Description
            $blog_meta_description_update        = Termmeta::where('term_id', $id)->where('key', 'description')->first();
            $blog_meta_description_update->value = $request->description;
            $blog_meta_description_update->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg['errors']['error'] = "Error Occurred!";
            return response()->json($msg, 401);
        }
        return response()->json('Blog Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(!Auth()->user()->can('blog.delete'), 401);

        $data       = Term::findOrFail($id);
        $thum_image = Termmeta::where('key', 'thum_image')->where('term_id', $id)->first();
        if (file_exists($thum_image)) {
            unlink($thum_image);
        }
        $data->delete();
        return redirect()->back()->with('success', 'Successfully Deleted');

    }
}
