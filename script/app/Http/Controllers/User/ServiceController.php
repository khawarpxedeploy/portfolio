<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Postmeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!planData('portfolio_builder'),403);
        $data = Post::with('icon')->where('type', 'service')->where('user_id', Auth::user()->id)->paginate(10);
        return view('user.service.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!planData('portfolio_builder'),403);
        return view('user.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        //using custom request validator form App\Http\Requests\ServiceRequest;

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
            $service_store        = new Post();
            $service_store->title = $request->title;
            $service_store->type  = 'service';

            //to unique slug
            $now_slug = Str::slug($request->title);
            $count    = Post::where('type', 'service')->where('title', $request->title)->count();
             $service_store->slug = $now_slug;

            $service_store->user_id = Auth::user()->id;
            $service_store->save();

            // Post Meta For excerpt
            $service_excerpt          = new Postmeta();
            $service_excerpt->post_id = $service_store->id;
            $service_excerpt->key     = 'excerpt';
            $service_excerpt->value   = $request->excerpt;
            $service_excerpt->save();

            // Thum Image Check
            if ($request->hasFile('logo')) {
                $thum_image      = $request->file('logo');
                $thum_image_name = hexdec(uniqid()) . '.' . $thum_image->getClientOriginalExtension();
                $thum_image_path = 'uploads/' . Auth::id() . '/user-service-logo/1/' . date('y/m/');
                $thum_image->move($thum_image_path, $thum_image_name);

               $img= $thum_image_path . $thum_image_name;
               
            }
            else{
                $img='';
            }

            $service_image          = new Postmeta();
            $service_image->post_id = $service_store->id;
            $service_image->key     = 'thum_image';
            $service_image->value   = $img;
            $service_image->save();

            // Post Meta For icon
            $service_excerpt          = new Postmeta();
            $service_excerpt->post_id = $service_store->id;
            $service_excerpt->key     = 'icon';
            $service_excerpt->value   = $request->icon;
            $service_excerpt->save();

          
            if (cache()->has(Auth::id() . '_service')) {
                cache()->forget(Auth::id() . '_service');
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg['errors']['error'] = "Error Occurred!";
            return response()->json($msg, 401);
        }
        return response()->json('Service Added Successfully');
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
        $data = Post::with('description', 'thum_image', 'excerpt', 'icon')->where('user_id', Auth::user()->id)->findOrFail($id);
        abort_if(Auth::id() != $data->user_id, 401);
        return view('user.service.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceUpdateRequest $request, $id)
    {

        //using custom request validator form App\Http\Requests\ServiceUpdateRequest;
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
            // Post Data Update
            $service_update = Post::where('user_id', Auth::user()->id)->findOrFail($id);
            $info_thuimg    = $service_update->thum_image->value ?? '';

            // Thum Image Check
            if ($request->hasFile('logo')) {
                if (file_exists($info_thuimg)) {
                    unlink($info_thuimg);
                }
                $thum_image      = $request->file('logo');
                $thum_image_name = hexdec(uniqid()) . '.' . $thum_image->getClientOriginalExtension();
                $thum_image_path = 'uploads/' . Auth::id() . '/user-service-logo/1/' . date('y/m/');
                $thum_image->move($thum_image_path, $thum_image_name);
                $preview = $thum_image_path . $thum_image_name;
            } else {
                $preview = $info_thuimg;
            }

            $service_update->title = $request->title;
            $service_update->type  = 'service';

            //to unique slug
            $now_slug = Str::slug($request->title);
            
                $service_update->slug = $now_slug;
            

            $service_update->save();

            // Post Meta For excerpt
            $service_meta_excerpt_update        = Postmeta::where('post_id', $id)->where('key', 'excerpt')->first();
            $service_meta_excerpt_update->value = $request->excerpt;
            $service_meta_excerpt_update->save();

            // Post Meta For Image
            $service_meta_thumimg_update        = Postmeta::where('post_id', $id)->where('key', 'thum_image')->first();
            $service_meta_thumimg_update->value = $preview;
            $service_meta_thumimg_update->save();

            

            // Post Meta For Description
            $service_meta_icon_update        = Postmeta::where('post_id', $id)->where('key', 'icon')->first();
            $service_meta_icon_update->value = $request->icon;
            $service_meta_icon_update->save();
            if (cache()->has(Auth::id() . '_service')) {
                cache()->forget(Auth::id() . '_service');
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg['errors']['error'] = "Error Occurred!";
            return response()->json($msg, 401);
        }
        return response()->json('Service Updated Successfully');
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
        if (file_exists($thum_image)) {
            unlink($thum_image);
        }
        $data->delete();
        if (cache()->has(Auth::id() . '_service')) {
            cache()->forget(Auth::id() . '_service');
        }

        return redirect()->back()->with('success', 'Successfully Deleted');
    }
}
