<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Postmeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!planData('portfolio_builder'),403);
        $projects = Post::with('link')->where('type', 'project')->where('user_id', Auth::user()->id)->paginate(10);
        return view('user.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!planData('portfolio_builder'),403);
        $catagories = Category::where('type', 'service_category')->where('user_id', Auth::user()->id)->get();
        $select     = '';
        return view('user.project.create', compact('catagories', 'select'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        //using custom request validator form App\Http\Requests\ProjectRequest;

        // to check post limit
        $user_id          = Auth::user()->id;
        $category_count   = Category::where('user_id', $user_id)->count();
        $post_count       = Post::where('user_id', $user_id)->count();
        $count_sum        = $category_count + $post_count;
        $plan_posts_limit = userPlanLimit('postlimit', $user_id);
        if ($count_sum >= $plan_posts_limit) {
            $msg['errors']['error'] = "maximum post limit exceeded";
            return response()->json($msg, 401);
        }

        //check folder storage limit
        $folder            = "uploads/" . $user_id;
        $folder_size       = folderSize($folder);
        $plan_storage_size = userPlanLimit('storage_size', $user_id);
        if ($folder_size >= $plan_storage_size) {
            $msg['errors']['error'] = "maximum storage limit exceeded";
            return response()->json($msg, 401);
        }
        DB::beginTransaction();
        try {
            // Post Data Store
            $project_store        = new Post();
            $project_store->title = $request->title;
            //to unique slug
            $now_slug = Str::slug($request->title);
            $project_store->slug = $now_slug;
            $project_store->type    = 'project';
            $project_store->user_id = Auth::user()->id;
            $project_store->save();

            // Thum Image Check
            if ($request->hasFile('image')) {
                $thum_image      = $request->file('image');
                $thum_image_name = hexdec(uniqid()) . '.' . $thum_image->getClientOriginalExtension();
                $thum_image_path = 'uploads/' . Auth::id() . '/project/' . date('y/m/');
                $thum_image->move($thum_image_path, $thum_image_name);

                // Term Meta For Image
                $project_image          = new Postmeta();
                $project_image->post_id = $project_store->id;
                $project_image->key     = 'thum_image';
                $project_image->value   = $thum_image_path . $thum_image_name;
                $project_image->save();
            }
            // Post Meta For link
            $project_link          = new Postmeta();
            $project_link->post_id = $project_store->id;
            $project_link->key     = 'link';
            $project_link->value   = $request->link;
            $project_link->save();

            
            DB::commit();
            if (cache()->has(Auth::id() . '_projects')) {
                cache()->forget(Auth::id() . '_projects');
            }

        } catch (\Throwable $th) {
            DB::rollBack();
            $msg['errors']['error'] = "Error Occured!";
            return response()->json($msg, 401);
        }
        return response()->json('Project Added Successfully');
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
        abort_if(!planData('portfolio_builder'),403);
        $catagories = Category::where('type', 'service_category')->where('user_id', Auth::user()->id)->get();
        $data       = Post::with('link', 'thum_image')->where('user_id', Auth::user()->id)->findOrFail($id);
        abort_if(Auth::id() != $data->user_id, 401);
        
        $select = $data->categories;
        return view('user.project.edit', compact('catagories', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectUpdateRequest $request, $id)
    {
        //using custom request validator form App\Http\Requests\ProjectUpdateRequest;
        //check folder storage limit
        $user_id           = Auth::user()->id;
        $folder            = "uploads/" . $user_id;
        $folder_size       = folderSize($folder);
        $plan_storage_size = userPlanLimit('storage_size', $user_id);
        if ($folder_size >= $plan_storage_size) {
            $msg['errors']['error'] = "maximum storage limit exceeded";
            return response()->json($msg, 401);
        }
        DB::beginTransaction();
        try {
            // Post Data update
            $project_update        = Post::where('user_id', Auth::user()->id)->findOrFail($id);
            $project_update->title = $request->title;
            //to unique slug
            $now_slug = Str::slug($request->title);
            
            $project_update->save();

            $info_thuimg = $project_update->thum_image->value;

            // Thum Image Check
            if ($request->hasFile('image')) {
                if (file_exists($info_thuimg)) {
                    unlink($info_thuimg);
                }

                $thum_image      = $request->file('image');
                $thum_image_name = hexdec(uniqid()) . '.' . $thum_image->getClientOriginalExtension();
                $thum_image_path = 'uploads/' . Auth::id() . '/project/' . date('y/m/');
                $thum_image->move($thum_image_path, $thum_image_name);
                $preview = $thum_image_path . $thum_image_name;
            } else {
                $preview = $info_thuimg;
            }
            // Post Meta For Image
            $project_thumimg_update        = Postmeta::where('post_id', $id)->where('key', 'thum_image')->first();
            $project_thumimg_update->value = $preview;
            $project_thumimg_update->save();

            // Post Meta For link
            $post_link_update        = Postmeta::where('post_id', $id)->where('key', 'link')->first();
            $post_link_update->value = $request->link;
            $post_link_update->save();

            DB::commit();
            if (cache()->has(Auth::id() . '_projects')) {
                cache()->forget(Auth::id() . '_projects');
            }

        } catch (\Throwable $th) {
            DB::rollBack();
            $msg['errors']['error'] = "Error Occurred!";
            return response()->json($msg, 401);
        }
        return response()->json('Project Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(!planData('portfolio_builder'),403);
        $data = Post::where('user_id', Auth::user()->id)->findOrFail($id);
        abort_if(Auth::id() != $data->user_id, 401);
        $thum_image = Postmeta::where('key', 'thum_image')->where('post_id', $id)->first();
        if (file_exists($thum_image->value)) {
            unlink($thum_image->value);
        }
        $data->delete();
        if (cache()->has(Auth::id() . '_projects')) {
            cache()->forget(Auth::id() . '_projects');
        }

        return redirect()->back()->with('success', 'Project Successfully Deleted');
    }
}
