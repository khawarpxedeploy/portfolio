<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserBlogRequest;
use App\Http\Requests\UserBlogUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Postmeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        abort_if(!planData('portfolio_builder'),403);
        $all_blogs = Post::where('type', 'blog')->where('user_id', Auth::user()->id)->latest()->paginate(10);
        return view('user.blog.index', compact('all_blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!planData('portfolio_builder'),403);
       
        return view('user.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserBlogRequest $request)
    {
        //using custom request validator form App\Http\Requests\UserBlogRequest;

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
            $blog_store        = new Post();
            $blog_store->title = $request->name;
            $blog_store->slug = Str::slug($request->name);
            $blog_store->type    = 'blog';
            $blog_store->user_id = Auth::user()->id;
            $blog_store->save();

            // Post Meta For excerpt
            $blog_excerpt          = new Postmeta();
            $blog_excerpt->post_id = $blog_store->id;
            $blog_excerpt->key     = 'excerpt';
            $blog_excerpt->value   = $request->excerpt;
            $blog_excerpt->save();

            // Thum Image Check
            if ($request->hasFile('image')) {
                $thum_image      = $request->file('image');
                $thum_image_name = hexdec(uniqid()) . '.' . $thum_image->getClientOriginalExtension();
                $thum_image_path = 'uploads/' . Auth::id() . '/blog/1/' . date('y/m/');
                $thum_image->move($thum_image_path, $thum_image_name);

                // Term Meta For Image
                $blog_image          = new Postmeta();
                $blog_image->post_id = $blog_store->id;
                $blog_image->key     = 'thum_image';
                $blog_image->value   = $thum_image_path . $thum_image_name;
                $blog_image->save();
            }
            // Post Meta For Description
            $blog_description          = new Postmeta();
            $blog_description->post_id = $blog_store->id;
            $blog_description->key     = 'description';
            $blog_description->value   = $request->description;
            $blog_description->save();

           
            if (count($request->cat_id ?? []) > 0) {
                $blog_store->categories()->attach($request->cat_id);
            }
            
            

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
        abort_if(!planData('portfolio_builder'),403);
        
        $data = Post::with('description', 'thum_image', 'excerpt')->where('user_id', Auth::user()->id)->findOrFail($id);
        abort_if(Auth::id() != $data->user_id, 401);
        
        return view('user.blog.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserBlogUpdateRequest $request, $id)
    {
        //using custom request validator form App\Http\Requests\UserBlogUpdateRequest;
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
            $blog_update = Post::where('user_id', Auth::user()->id)->findOrFail($id);
            abort_if(Auth::id() != $blog_update->user_id, 401);
            $info_thuimg = $blog_update->thum_image->value;

            // Thum Image Check
            if ($request->hasFile('image')) {
                if (file_exists($info_thuimg)) {
                    unlink($info_thuimg);
                }
                $thum_image      = $request->file('image');
                $thum_image_name = hexdec(uniqid()) . '.' . $thum_image->getClientOriginalExtension();
                $thum_image_path = 'uploads/' . Auth::id() . '/blog/1/' . date('y/m/');
                $thum_image->move($thum_image_path, $thum_image_name);
                $preview = $thum_image_path . $thum_image_name;
            } else {
                $preview = $info_thuimg;
            }

            $blog_update->title = $request->name;
            //to unique slug
            $now_slug = Str::slug($request->name);
            $blog_update->slug = $now_slug;
            $blog_update->type = 'blog';
            $blog_update->save();

            // Post Meta For excerpt
            $blog_meta_excerpt_update        = Postmeta::where('post_id', $id)->where('key', 'excerpt')->first();
            $blog_meta_excerpt_update->value = $request->excerpt;
            $blog_meta_excerpt_update->save();

            // Post Meta For Image
            $blog_meta_thumimg_update        = Postmeta::where('post_id', $id)->where('key', 'thum_image')->first();
            $blog_meta_thumimg_update->value = $preview;
            $blog_meta_thumimg_update->save();

            // Post Meta For Description
            $blog_meta_description_update        = Postmeta::where('post_id', $id)->where('key', 'description')->first();
            $blog_meta_description_update->value = $request->description;
            $blog_meta_description_update->save();

            //store data in postcategory table
            $blog_update->categories()->sync($request->cat_id);
            

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
        $data = Post::with('thum_image')->where('user_id', Auth::user()->id)->findOrFail($id);
        if (!empty($data->thum_image)) {
          if (file_exists($data->thum_image->value)) {
            unlink($data->thum_image->value);
          }
        }
        
        $data->delete();
        
        return redirect()->back()->with('success', 'Blog Successfully Deleted');
    }
}
