<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExperienceRequest;
use App\Models\Category;
use App\Models\Categorymeta;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!planData('portfolio_builder'),403);
        $experience = Category::with('experience_meta')->where('type', 'experience')->where('user_id', Auth::user()->id)->paginate(10);
        return view('user.experience.index', compact('experience'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!planData('portfolio_builder'),403);
        return view('user.experience.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExperienceRequest $request)
    {
        //using custom request validator form App\Http\Requests\ExperienceRequest;

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
            $experience          = new Category();
            $experience->name    = $request->position;
            $experience->type    = 'experience';
            $experience->user_id = Auth::user()->id;
            $experience->save();

            $experience_meta              = new Categorymeta();
            $experience_meta->category_id = $experience->id;
            $experience_meta->key         = 'experience_meta';
            $data                         = [
                "icon"        => $request->icon,
                "start_date"  => $request->start_date,
                "end_date"    => $request->end_date,
                "company"     => $request->company,
                "description" => $request->description,
            ];
            // put var $data in json format
            $value                  = json_encode($data);
            $experience_meta->value = $value;
            $experience_meta->save();
            

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg['errors']['error'] = "Error Occurred!";
            return response()->json($msg, 401);
        }
        return response()->json('Experience Added Successfully');
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
        $experience = Category::with('experience_meta')->where('user_id', Auth::user()->id)->findOrFail($id);
        abort_if(Auth::id() != $experience->user_id, 401);
        return view('user.experience.edit', compact('experience'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExperienceRequest $request, $id)
    {
        //using custom request validator form App\Http\Requests\ExperienceRequest;
        DB::beginTransaction();
        try {
            //store data in categories table
            $experience       = Category::with('experience_meta')->where('user_id', Auth::user()->id)->findOrFail($id);
            $experience->name = $request->position;
            $experience->save();

            //store data in Categorymeta table
            $experience_meta = Categorymeta::where('key', 'experience_meta')->where('category_id', $id)->first();

            $data = [
                "icon"        => $request->icon,
                "start_date"  => $request->start_date,
                "end_date"    => $request->end_date,
                "description" => $request->description,
                "company"     => $request->company,
            ];
            // put var $data in json format
            $value                  = json_encode($data);
            $experience_meta->value = $value;
            $experience_meta->save();
           

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg['errors']['error'] = "Error Occurred!";
            return response()->json($msg, 401);
        }
        return response()->json('Experience Updated Successfully');
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
        $data->delete();
        

        return redirect()->back()->with('success', 'Experience Successfully Deleted');
    }
}
