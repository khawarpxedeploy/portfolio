<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Option;
use Illuminate\Http\Request;

class CvlanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!Auth()->user()->can('language.index'), 401);
        $languages = Language::where('type', 'cv')->latest()->paginate(10);
        return view('admin.cvlanguage.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth()->user()->can('language.create'), 401);
        $path = base_path('resources/lang/langlist.json');
        $langlist = json_decode(file_get_contents($path), true);
        return view('admin.cvlanguage.create', compact('langlist'));
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

        $cvlang = Language::where([
            ['type','cv'],
            ['name',$request->name]
        ])->first();


        if($cvlang)
        {
            $error['errors']['error']="It's already exists!";
            return response()->json($error,401);
        }

        $path = base_path('resources/lang/langlist.json');
        $langlist = json_decode(file_get_contents($path), true);

        foreach ($langlist as $item) {
            if ($item['code'] == $request->name) {
                $data = [
                    'name' => $item['code'],
                    'position' => $request->position ?? '',
                    'data' => $item['name'],
                    'type' => 'cv',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        $cvlang = Option::where('key', 'cvlanguage')->firstOrNew();
        $info = json_decode($cvlang->value, true);
        $arr[$request->name] = ["Address"=>"Address",
            "About_Me"=>"About Me",
            "Contact"=>"Contact",
            "Skills"=>"Skills",
            "Language"=>"Language",
            "Custom_Section"=>"Custom Section",
            "Education"=>"Education",
            "Accomplishments"=>"Accomplishments",
            "Experience"=>"Experience",
            "References"=>"References"
        ];
        $merge_data = $info ? array_merge($arr, $info) : $arr;
        $cvlang->value = json_encode($merge_data);
        $cvlang->key = 'cvlanguage';
        $cvlang->save();

        $language = new Language();
        $language->insert($data);

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
        $lang = Language::findOrFail($id);
        $data = Option::where('key', 'cvlanguage')->firstOrFail()->value;
        $name = $lang->name;
        return view('admin.cvlanguage.edit', compact('data', 'id', 'lang', 'name'));
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
        $lang = $request->lang;
        $request->validate([
            $lang.'.Address' => 'required',
            $lang.'.About_Me' => 'required',
            $lang.'.Contact' => 'required',
            $lang.'.Skills' => 'required',
            $lang.'.Language' => 'required',
            $lang.'.Custom_Section' => 'required',
            $lang.'.Education' => 'required',
            $lang.'.Accomplishments' => 'required',
            $lang.'.Experience' => 'required',
            $lang.'.References' => 'required',
        ]);
        $data = (array) $request->except('id', '_token', '_method', 'lang');
        $cvlang = Option::where('key', 'cvlanguage')->first();
        $info = json_decode($cvlang->value, true);

        // $merge_data = $this->array_merge_recursive_distinct($data, $info);
        $merge_data = array_merge($info, $data);
        // dd($merge_data);
        $cvlang->value = json_encode($merge_data);
        $cvlang->save();
        return response()->json('Successfully Updated!');
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
        $language = Language::where('type','cv')->findOrFail($id);
        $cvlang = Option::where('key','cvlanguage')->firstOrFail();
        $data = json_decode($cvlang->value, true);
        if (isset($data[$id])) {
            unset($data[$id]);
            $cvlang->value = json_encode($data);
            $cvlang->save();
        }
        $language->delete();
        return redirect()->back()->with('success', 'Successfully Deleted');
        
    }
}
