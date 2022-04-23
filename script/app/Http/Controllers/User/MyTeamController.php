<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\MyTeamRequest;
use App\Http\Requests\MyTeamUpdateRequest;
use App\Models\Category;
use App\Models\Categorymeta;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!planData('portfolio_builder'),403);
        $my_team = Category::with('my_team_meta')->where('type', 'my_team')->where('user_id', Auth::user()->id)->paginate(10);
        return view('user.team.index', compact('my_team'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!planData('portfolio_builder'),403);
        return view('user.team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MyTeamRequest $request)
    {
        //using custom request validator form App\Http\Requests\MyTeamRequest;

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
        //to check storage limit
        $folder            = "uploads/" . $user_id;
        $folder_size       = folderSize($folder);
        $plan_storage_size = userPlanLimit('storage_size', $user_id);
        if ($folder_size >= $plan_storage_size) {
            $msg['errors']['error'] = "maximum storage limit exceeded";
            return response()->json($msg, 401);
        }

        DB::beginTransaction();
        try {
            $my_team          = new Category();
            $my_team->name    = 'my_team';
            $my_team->type    = 'my_team';
            $my_team->user_id = $user_id;
            $my_team->save();

            $my_team_meta              = new Categorymeta();
            $my_team_meta->category_id = $my_team->id;
            $my_team_meta->key         = 'my_team_meta';
            // to upload avatar file
            if ($request->hasFile('avatar')) {
                $thum_image      = $request->file('avatar');
                $thum_image_name = hexdec(uniqid()) . '.' . $thum_image->getClientOriginalExtension();
                $thum_image_path = 'uploads/' . Auth::id() . '/myteam/1/' . date('y/m/');
                $thum_image->move($thum_image_path, $thum_image_name);
            }
            $data = [
                "avatar"   => $thum_image_path . $thum_image_name,
                "position" => $request->position,
                "name"     => $request->name,
            ];
            // put var $data in json format
            $value               = json_encode($data);
            $my_team_meta->value = $value;
            $my_team_meta->save();
            if (cache()->has(Auth::id() . '_myteam')) {
                cache()->forget(Auth::id() . '_myteam');
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg['errors']['error'] = "Error Occurred!";
            return response()->json($msg, 401);
        }
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
        abort_if(!planData('portfolio_builder'),403);
        $my_team = Category::with('my_team_meta')->where('type', 'my_team')->where('user_id', Auth::user()->id)->findOrFail($id);
        abort_if(Auth::id() != $my_team->user_id, 401);
        return view('user.team.edit', compact('my_team'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MyTeamUpdateRequest $request, $id)
    {
        //using custom request validator form App\Http\Requests\MyTeamUpdateRequest;
        //to check storage limit
        $user_id           = Auth::user()->id;
        $folder            = "uploads/" . $user_id;
        $folder_size       = folderSize($folder);
        $plan_storage_size = userPlanLimit('storage_size', $user_id);
        if ($folder_size >= $plan_storage_size) {
            $msg['errors']['error'] = "maximum storage limit exceeded";
            return response()->json($msg, 401);
        }

        $obj         = Categorymeta::where('key', 'my_team_meta')->where('category_id', $id)->first();
        $decode_data = json_decode($obj->value);
        // to upload avatar file
        if ($request->hasFile('avatar')) {
            if (file_exists($decode_data->avatar)) {
                unlink($decode_data->avatar);
            }
            $thum_image      = $request->file('avatar');
            $thum_image_name = hexdec(uniqid()) . '.' . $thum_image->getClientOriginalExtension();
            $thum_image_path = 'uploads/' . Auth::id() . '/my_team/1/' . date('y/m/');
            $thum_image->move($thum_image_path, $thum_image_name);
            $data = [
                "avatar"   => $thum_image_path . $thum_image_name,
                "position" => $request->position,
                "name"     => $request->name,
            ];
        } else {
            $data = [
                "avatar"   => $decode_data->avatar,
                "position" => $request->position,
                "name"     => $request->name,
            ];
        }
        $obj->value = json_encode($data);
        $obj->save();
        if (cache()->has(Auth::id() . '_myteam')) {
            cache()->forget(Auth::id() . '_myteam');
        }

        return response()->json('Data Successfully Updated !');

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
        $data = Category::with('my_team_meta')->where('type', 'my_team')->where('user_id', Auth::user()->id)->findOrFail($id);
        abort_if(Auth::id() != $data->user_id, 401);
        $decode_data = json_decode($data->my_team_meta->value);
        if (file_exists($decode_data->avatar)) {
            unlink($decode_data->avatar);
        }
        $data->delete();
        if (cache()->has(Auth::id() . '_myteam')) {
            cache()->forget(Auth::id() . '_myteam');
        }
        return redirect()->back()->with('success', 'Data Successfully Deleted');
    }
}
