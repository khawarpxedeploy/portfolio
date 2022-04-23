<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkProcessRequest;
use App\Models\Category;
use App\Models\Categorymeta;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!planData('portfolio_builder'),403);
        $work_process = Category::with('work_process_meta')->where('type', 'work_process')->where('user_id', Auth::user()->id)->paginate(10);
        return view('user.workprocess.index', compact('work_process'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!planData('portfolio_builder'),403);
        return view('user.workprocess.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkProcessRequest $request)
    {
        //using custom request validator form App\Http\Requests\WorkProcessRequest;
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
            $work_process          = new Category();
            $work_process->name    = 'work_process';
            $work_process->type    = 'work_process';
            $work_process->user_id = $user_id;
            $work_process->save();

            $work_process_meta              = new Categorymeta();
            $work_process_meta->category_id = $work_process->id;
            $work_process_meta->key         = 'work_process_meta';
            $data                           = [
                "title" => $request->title,
                "icon"  => $request->icon,
                "des"   => $request->des,
            ];
            // put var $data in json format
            $value                    = json_encode($data);
            $work_process_meta->value = $value;
            $work_process_meta->save();
            if (cache()->has(Auth::id() . '_workprocess')) {
                cache()->forget(Auth::id() . '_workprocess');
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
        $work_process = Category::with('work_process_meta')->where('type', 'work_process')->where('user_id', Auth::user()->id)->findOrFail($id);
        abort_if(Auth::id() != $work_process->user_id, 401);
        return view('user.workprocess.edit', compact('work_process'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WorkProcessRequest $request, $id)
    {
        //using custom request validator form App\Http\Requests\WorkProcessRequest;

        $work_process_meta = Categorymeta::where('key', 'work_process_meta')->where('category_id', $id)->first();
        $data              = [
            "title" => $request->title,
            "icon"  => $request->icon,
            "des"   => $request->des,
        ];
        // put var $data in json format
        $value                    = json_encode($data);
        $work_process_meta->value = $value;
        $work_process_meta->save();
        if (cache()->has(Auth::id() . '_workprocess')) {
            cache()->forget(Auth::id() . '_workprocess');
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
        $data = Category::where('user_id', Auth::user()->id)->findOrFail($id);
        abort_if(Auth::id() != $data->user_id, 401);
        $data->delete();
        if (cache()->has(Auth::id() . '_workprocess')) {
            cache()->forget(Auth::id() . '_workprocess');
        }

        return redirect()->back()->with('success', 'Data Successfully Deleted');
    }
}
