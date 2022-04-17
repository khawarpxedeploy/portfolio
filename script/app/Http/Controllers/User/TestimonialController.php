<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialRequest;
use App\Http\Requests\TestimonialUpdateRequest;
use App\Models\Category;
use App\Models\Categorymeta;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Str;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!planData('portfolio_builder'),403);
        $testimonial = Category::with('testimonial_meta')->where('type', 'testimonial')->where('user_id', Auth::user()->id)->paginate(10);
        return view('user.testimonial.index', compact('testimonial'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!planData('portfolio_builder'),403);
        return view('user.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestimonialRequest $request)
    {
        //using custom request validator form App\Http\Requests\TestimonialRequest;

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
            $testimonial       = new Category();
            $testimonial->name = $request->client_name;
            //to unique slug
            $now_slug = Str::slug($request->name);
            $count    = Category::where('type', 'testimonial')->where('name', $request->name)->count();
            if ($count > 0) {
                $slug              = "{$now_slug}-" . ($count + 1);
                $testimonial->slug = $slug;
            } else {
                $testimonial->slug = $now_slug;
            }
            $testimonial->type    = 'testimonial';
            $testimonial->user_id = $user_id;
            $testimonial->save();

            $testimonial_meta              = new Categorymeta();
            $testimonial_meta->category_id = $testimonial->id;
            $testimonial_meta->key         = 'testimonial_meta';

            // Thum Image Check

            if ($request->hasFile('avatar')) {
                $thum_image      = $request->file('avatar');
                $thum_image_name = hexdec(uniqid()) . '.' . $thum_image->getClientOriginalExtension();
                $thum_image_path = 'uploads/' . Auth::id() . '/testimonial/1/' . date('y/m/');

                $thum_image->move($thum_image_path, $thum_image_name);
                $data = [
                    "avatar"   => $thum_image_path . $thum_image_name,
                    "position" => $request->position,
                    "review"   => $request->review,
                ];
            } else {
                $data = [
                    "avatar"   => null,
                    "position" => $request->position,
                    "review"   => $request->review,
                ];
            }
            // put var $data in json format
            $value                   = json_encode($data);
            $testimonial_meta->value = $value;
            $testimonial_meta->save();
            if (cache()->has(Auth::id() . '_testimonials')) {
                cache()->forget(Auth::id() . '_testimonials');
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg['errors']['error'] = "Error Occurred!";
            return response()->json($msg, 401);
        }
        return response()->json('Testimonial Added Successfully');
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
        $testimonial = Category::with('testimonial_meta')->where('user_id', Auth::user()->id)->findOrFail($id);
        abort_if(Auth::id() != $testimonial->user_id, 401);
        return view('user.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestimonialUpdateRequest $request, $id)
    {
        //using custom request validator form App\Http\Requests\TestimonialUpdateRequest;
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
            //store data in categories table
            $testimonial       = Category::with('testimonial_meta')->where('user_id', Auth::user()->id)->findOrFail($id);
            $testimonial->name = $request->client_name;
            //to unique slug
            $now_slug = Str::slug($request->name);
            $count    = Category::where('type', 'testimonial')->where('name', $request->name)->count();
            if ($count > 0) {
                $slug              = "{$now_slug}-" . ($count + 1);
                $testimonial->slug = $slug;
            } else {
                $testimonial->slug = $now_slug;
            }
            $testimonial->save();
            //store data in Categorymeta table
            $testimonial_meta = Categorymeta::where('key', 'testimonial_meta')->where('category_id', $id)->first();

            $info_thuimg = json_decode($testimonial->testimonial_meta->value);
            $image       = $info_thuimg->avatar;

            // Thum Image Check
            if ($request->hasFile('avatar')) {
                if (file_exists($image)) {
                    unlink($image);
                }

                $thum_image      = $request->file('avatar');
                $thum_image_name = hexdec(uniqid()) . '.' . $thum_image->getClientOriginalExtension();
                $thum_image_path = 'uploads/' . Auth::id() . '/testimonial/1/' . date('y/m/');
                $thum_image->move($thum_image_path, $thum_image_name);
                $data = [
                    "avatar"   => $thum_image_path . $thum_image_name,
                    "position" => $request->position,
                    "review"   => $request->review,
                ];
            } else {
                $data = [
                    "avatar"   => $image,
                    "position" => $request->position,
                    "review"   => $request->review,
                ];
            }
            // put var $data in json format
            $value                   = json_encode($data);
            $testimonial_meta->value = $value;
            $testimonial_meta->save();
            if (cache()->has(Auth::id() . '_testimonials')) {
                cache()->forget(Auth::id() . '_testimonials');
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg['errors']['error'] = "Error Occurred!";
            return response()->json($msg, 401);
        }
        return response()->json('Testimonial Updated Successfully');
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
        $testimonial = Category::with('testimonial_meta')->where('user_id', Auth::user()->id)->findOrFail($id);
        abort_if(Auth::id() != $testimonial->user_id, 401);
        $info_thuimg = json_decode($testimonial->testimonial_meta->value);
        if (file_exists($info_thuimg->avatar)) {
            unlink($info_thuimg->avatar);
        }
        $testimonial->delete();
        if (cache()->has(Auth::id() . '_testimonials')) {
            cache()->forget(Auth::id() . '_testimonials');
        }
        return redirect()->back()->with('success', 'Testimonial Successfully Deleted');
    }
}
