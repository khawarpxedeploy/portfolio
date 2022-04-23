<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillRequest;
use App\Models\Category;
use App\Models\Categorymeta;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!planData('portfolio_builder'),403);
        $skill = Category::with('skill_meta')->where('type', 'skill')->where('user_id', Auth::user()->id)->paginate(10);
        return view('user.skill.index', compact('skill'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!planData('portfolio_builder'),403);
        return view('user.skill.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkillRequest $request)
    {
        //using custom request validator form App\Http\Requests\SkillRequest;
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

        DB::beginTransaction();
        try {
            $skill          = new Category();
            $skill->name    = $request->name;
            $skill->type    = 'skill';
            $skill->user_id = $user_id;
            $skill->save();

            $skill_meta              = new Categorymeta();
            $skill_meta->category_id = $skill->id;
            $skill_meta->key         = 'skill_meta';
            $data                    = [
                "level" => $request->level,
                "color" => $request->color,
            ];
            // put var $data in json format
            $value             = json_encode($data);
            $skill_meta->value = $value;
            $skill_meta->save();
            if (cache()->has(Auth::id() . '_skill')) {
                cache()->forget(Auth::id() . '_skill');
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg['errors']['error'] = "Error Occurred!";
            return response()->json($msg, 401);
        }
        return response()->json('Skill Added Successfully');
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
        $skill = Category::with('skill_meta')->where('type', 'skill')->where('user_id', Auth::user()->id)->findOrFail($id);
        abort_if(Auth::id() != $skill->user_id, 401);
        return view('user.skill.edit', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SkillRequest $request, $id)
    {
        //using custom request validator form App\Http\Requests\SkillRequest;

        DB::beginTransaction();
        try {
            //store data in categories table
            $skill       = Category::with('skill_meta')->where('user_id', Auth::user()->id)->findOrFail($id);
            $skill->name = $request->name;
            $skill->save();

            //store data in Categorymeta table
            $skill_meta = Categorymeta::where('key', 'skill_meta')->where('category_id', $id)->first();

            $data = [
                "level" => $request->level,
                "color" => $request->color,
            ];
            // put var $data in json format
            $value             = json_encode($data);
            $skill_meta->value = $value;
            $skill_meta->save();
            if (cache()->has(Auth::id() . '_skill')) {
                cache()->forget(Auth::id() . '_skill');
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg['errors']['error'] = "Error Occurred!";
            return response()->json($msg, 401);
        }
        return response()->json('Skill Updated Successfully');
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
        $data = Category::where('user_id', Auth::user()->id)->findOrFail($id);
        abort_if(Auth::id() != $data->user_id, 401);
        $data->delete();
        if (cache()->has(Auth::id() . '_skill')) {
            cache()->forget(Auth::id() . '_skill');
        }

        return redirect()->back()->with('success', 'Skill Successfully Deleted');
    }
}
