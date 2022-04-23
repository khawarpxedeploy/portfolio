<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Models\Term;
use App\Models\Termmeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!Auth()->user()->can('page.index'), 401);
        $data = Term::with('excerpt')->where('type', 'page')->latest()->paginate(20);
        return view('admin.page.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth()->user()->can('page.create'), 401);
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        //using custom request validator form App\Http\Requests\PageRequest;

        DB::beginTransaction();
        try {
            // Term Data Store
            $pageStore        = new Term();
            $pageStore->title = $request->title;

            //to unique slug
            $now_slug = Str::slug($request->title);
            $count    = Term::where('type', 'page')->where('title', $request->title)->count();
            if ($count > 0) {
                $slug            = "{$now_slug}-" . ($count + 1);
                $pageStore->slug = $slug;
            } else {
                $pageStore->slug = $now_slug;
            }

            $pageStore->type     = 'page';
            $pageStore->status   = $request->status;
            $pageStore->featured = 1;
            $pageStore->save();

            // Term Meta For excerpt
            $blog_excerpt          = new Termmeta();
            $blog_excerpt->term_id = $pageStore->id;
            $blog_excerpt->key     = 'excerpt';
            $blog_excerpt->value   = $request->excerpt;
            $blog_excerpt->save();

            // Term Meta For Description
            $blog_description          = new Termmeta();
            $blog_description->term_id = $pageStore->id;
            $blog_description->key     = 'description';
            $blog_description->value   = $request->description;
            $blog_description->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg['errors']['error'] = "Error Occured!";
            return response()->json($msg, 401);
        }

        return response()->json('Page Added Successfully');
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
        abort_if(!Auth()->user()->can('page.edit'), 401);

        $data = Term::with('excerpt', 'description')->findOrFail($id);
        return view('admin.page.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id)
    {
        //using custom request validator form App\Http\Requests\PageRequest;

        DB::beginTransaction();
        try {
            // Term Data Update
            $page_update = Term::findOrFail($id);

            $page_update->title = $request->title;
            //to unique slug
            $now_slug = Str::slug($request->title);
            $count    = Term::where('type', 'page')->where('title', $request->title)->count();
            if ($count > 0) {
                $slug              = "{$now_slug}-" . ($count + 1);
                $page_update->slug = $slug;
            } else {
                $page_update->slug = $now_slug;
            }
            $page_update->type     = 'page';
            $page_update->status   = $request->status;
            $page_update->featured = 1;
            $page_update->save();

            // Term Meta For excerpt
            $page_meta_excerpt_update        = Termmeta::where('term_id', $id)->where('key', 'excerpt')->first();
            $page_meta_excerpt_update->value = $request->excerpt;
            $page_meta_excerpt_update->save();

            // Term Meta For Description
            $page_meta_description_update        = Termmeta::where('term_id', $id)->where('key', 'description')->first();
            $page_meta_description_update->value = $request->description;
            $page_meta_description_update->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $msg['errors']['error'] = "Error Occured!";
            return response()->json($msg, 401);
        }

        return response()->json('Page Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(!Auth()->user()->can('page.delete'), 401);
        $page_destory = Term::findOrFail($id);
        $excerpt      = Termmeta::where('key', 'excerpt')->where('term_id', $id)->first();
        $description  = Termmeta::where('key', 'description')->where('term_id', $id)->first();
        $excerpt->delete();
        $description->delete();
        $page_destory->delete();
        return redirect()->back()->with('success', 'Successfully Deleted');
    }
}
