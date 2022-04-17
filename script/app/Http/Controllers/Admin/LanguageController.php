<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!Auth()->user()->can('language.index'), 401);
        $languages = Language::where('type','web')->latest()->paginate(10);
        return view('admin.language.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth()->user()->can('language.create'), 401);
        $path     = base_path('resources/lang/langlist.json');
        $langlist = json_decode(file_get_contents($path), true);
        return view('admin.language.create', compact('langlist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $lang_exits = Language::where([
            ['type','web'],
            ['name',$request->name]
        ])->first();

        if($lang_exits)
        {
            $error['errors']['error']="It's already exists!";
            return response()->json($error,401);
        }

        $path     = base_path('resources/lang/langlist.json');
        $langlist = json_decode(file_get_contents($path), true);

        foreach ($langlist as $item) {
            if ($item['code'] == $request->name) {
                $data = [
                    'name'       => $item['code'],
                    'position'   => $request->position,
                    'data'       => $item['name'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        $language = new Language();
        $language->insert($data);

        //read en file
        $existFilePath = base_path('resources/lang/en.json');

        //read exist file data
        $existData = json_decode(file_get_contents($existFilePath), true);

        //write data
        file_put_contents(base_path('resources/lang/' . $request->name . '.json'), json_encode($existData, JSON_PRETTY_PRINT));

        return \response()->json('Language Added Successfully !');

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
        $lang = Language::find($id);

        if (!$lang) {
            return abort(404);
        }

        $lang_file = file_get_contents(resource_path('lang/' . $lang->name . '.json'));
        $langs     = json_decode($lang_file, true);
        $name      = $lang->name;
        return view('admin.language.edit', compact('langs', 'id', 'lang', 'name'));
    }

    public function key_store(Request $request)
    {
        $file  = base_path('resources/lang/' . $request->id . '.json');
        $posts = file_get_contents($file);
        $posts = json_decode($posts);
        foreach ($posts as $key => $row) {
            $data[$key] = $row;
        }
        $data[$request->key] = $request->value;
        \File::put(base_path('resources/lang/' . $request->id . '.json'), json_encode($data, JSON_PRETTY_PRINT));
        return response()->json('Key Added Successfully !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $language     = Language::find($id);
        $languageFile = file_get_contents(resource_path('lang/' . $language->name . '.json'));
        $lang_decode  = json_decode($languageFile, true);

        foreach ($lang_decode as $key => $value) {
            if ($key == $request->key) {
                $lang_decode[$key] = $request->value;
            }
        }

        file_put_contents(resource_path('lang/' . $language->name . '.json'), json_encode($lang_decode, JSON_PRETTY_PRINT));

        return response()->json("Data Updated Successfully !");

    }

    public function lang_set(Request $request)
    {
        $request->validate([
            'status'  => 'required',
            'lang_id' => 'required',
        ], [
            'status.required'  => 'Select Any Action',
            'lang_id.required' => 'Select checkbox',
        ]);
        if ($request->status == '') {
            $msg['errors']['error'] = "Select Any Action!";
            return response()->json($msg, 401);
        }

        if ($request->status) {
            if ($request->lang_id) {
                $lang = language::all();

                foreach ($lang as $data) {
                    $data->status = 0;
                    $data->save();
                }
                foreach ($request->lang_id as $value) {
                    $language         = Language::find($value);
                    $language->status = 1;
                    $language->save();
                }
                return response()->json('Language Successfully Activated');
            } else {
                $msg['errors']['error'] = "Language Field is required";
                return response()->json($msg, 401);
            }
        } else {
            $msg['errors']['error'] = "Active language field is required.";
            return response()->json($msg, 401);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(!Auth()->user()->can('language.delete'), 401);

        $language = Language::findOrFail($id);
        $path     = base_path('resources/lang/' . $language->name . '.json');
        if (File::exists($path)) {
            File::delete($path);
        }
        $language->delete();
        return redirect()->back()->with('success', 'Successfully Deleted');
    }
}
