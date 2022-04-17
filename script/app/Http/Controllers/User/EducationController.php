<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\EducationRequest;
use App\Models\Category;
use App\Models\Categorymeta;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!planData('portfolio_builder'),403);
        $education = Category::with('education_meta')->where('type', 'education')->where('user_id', Auth::user()->id)->paginate(10);
        return view('user.education.index', compact('education'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!planData('portfolio_builder'),403);
        return view('user.education.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EducationRequest $request)
    {
        //using custom request validator form App\Http\Requests\EducationRequest;

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
            $education          = new Category();
            $education->name    = 'education';
            $education->type    = 'education';
            $education->user_id = $user_id;
            $education->save();

            $education_meta              = new Categorymeta();
            $education_meta->category_id = $education->id;
            $education_meta->key         = 'education_meta';
            $data                        = [
                'starting_date' => $request->starting_date,
                'ending_date'   => $request->ending_date ?? '',
                'subject'       => $request->subject,
                'university'    => $request->university,
                'short_content' => $request->short_content
            ];
            // put var $data in json format
            $value                 = json_encode($data);
            $education_meta->value = $value;
            $education_meta->save();
            if (cache()->has(Auth::id() . '_education')) {
                cache()->forget(Auth::id() . '_education');
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg['errors']['error'] = "Error Occurred!";
            return response()->json($msg, 401);
        }
        return response()->json('Education Added Successfully');
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
        $data = Category::with('education_meta')->where('type', 'education')->where('user_id', Auth::user()->id)->findOrFail($id);
        abort_if(Auth::id() != $data->user_id, 401);
        return view('user.education.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EducationRequest $request, $id)
    {
        //using custom request validator form App\Http\Requests\EducationRequest;
        //store data in Categorymeta table
        $education_meta = Categorymeta::where('key', 'education_meta')->where('category_id', $id)->first();
        $data           = [
            'starting_date' => $request->starting_date,
            'ending_date'   => $request->ending_date ?? '',
            'subject'       => $request->subject,
            'university'    => $request->university,
            'short_content' => $request->short_content
        ];
        // put var $data in json format
        $value                 = json_encode($data);
        $education_meta->value = $value;
        $education_meta->save();
        if (cache()->has(Auth::id() . '_education')) {
            cache()->forget(Auth::id() . '_education');
        }

        return response()->json('Education Updated Successfully');
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
        if (cache()->has(Auth::id() . '_education')) {
            cache()->forget(Auth::id() . '_education');
        }

        return redirect()->back()->with('success', 'Data Successfully Deleted');
    }
}
