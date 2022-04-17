<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Option;
use App\Models\Theme;
use App\Models\User;
use App\Models\Usermeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;

class CvController extends Controller
{
    public function index()
    {
        abort_if(!planData('resume_builder'),403);
        $languages = Language::where('type', 'cv')->get();
        $themes = Theme::where('type', 'cv')->get();
        return view('user.cv.builder', compact('languages', 'themes'));
    }


    public function fetch()
    {
        $cv          = Usermeta::where([['user_id', Auth::id()], ['key', 'cv']])->first();
        $language = Option::where('key', 'cvlanguage')->first();
        $data['language'] = json_decode($language->value ?? '');
        $data['cv'] = json_decode($cv->value ?? '');
        $obj =  json_decode($cv->value ?? '');
        $data['image'] = asset($obj->image ?? '');
        return $data;
    }

    public function language(Request $request)
    {
        $language = $request->language;
        
        $option = Option::where('key', 'cvlanguage')->first();
        $data = json_decode($option->value, true);

        foreach ($data as $key => $lang) {
            if ($key == $language) {
                return $lang;
            }
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            "role.*"      => "required",
            "name.*"      => "required",
            "skill"     => "required",
            "education.*" => "required",
            "language.*"  => "required",
            "address.*"   => "required",
            "contact.*"   => "required",
            "image"       => "nullable|mimes:jpg,bmp,png,jpeg|max:3000"
        ]);

        $data = $request->except('_token','image');
       // dd($request->all());
        if ($data) {
            $cv         = Usermeta::where([['user_id', Auth::id()], ['key', 'cv']])->first();
            $cvdata = $cv != null ? json_decode($cv->value) : '';
            if ($cv == null) {
                $cv = new Usermeta;
            }
            $preview = '';
            if ($request->hasFile('image')) {
                if (isset($cvdata->image) && file_exists($cvdata->image)) {
                    unlink($cvdata->image);
                }
                $thum_image      = $request->file('image');
                $thum_image_name = 'profile.' . $thum_image->getClientOriginalExtension();
                $thum_image_path = 'uploads/' . Auth::id() .'/';
                $thum_image->move($thum_image_path, $thum_image_name);
                $preview = $thum_image_path . $thum_image_name;
            } else {
                $preview = isset($cvdata->image) && $cvdata->image ? $cvdata->image : asset('uploads/placeholder-profile.png');
            }
            $data['image'] = $preview;
            $cv->user_id = Auth::id();
            $cv->key     = 'cv';
            $cv->value   = json_encode($data);
            $cv->save();
        }

        return response()->json('Data Successfully Saved!');
    }

    public function ajaxstore(Request $request)
    {
        $request->validate([
            "role.*"      => "required",
            "name.*"      => "required",
            "skill"     => "required",
            "education.*" => "required",
            "language.*"  => "required",
            "address.*"   => "required",
            "contact.*"   => "required",
            "image"       => "nullable|mimes:jpg,bmp,png,jpeg|max:3000"
        ]);

        $data = $request->except('_token','image');
        if ($data) {
            $cv          = Usermeta::where([['user_id', Auth::id()], ['key', 'cv']])->first();
            $cvdata = $cv != null ? json_decode($cv->value) : '';
            if ($cv == null) {
                $cv = new Usermeta;
            }
            $preview = '';
            if ($request->hasFile('image')) {
                if (isset($cvdata->image) && file_exists($cvdata->image)) {
                    unlink($cvdata->image);
                }
                $thum_image      = $request->file('image');
                $thum_image_name = 'profile.' . $thum_image->getClientOriginalExtension();
                $thum_image_path = 'uploads/' . Auth::id() .'/';
                $thum_image->move($thum_image_path, $thum_image_name);
                $preview = $thum_image_path . $thum_image_name;
            } else {
                $preview = isset($cvdata->image) && $cvdata->image ? $cvdata->image : '';
            }
            $data['image'] = $preview;
            $cv->user_id = Auth::id();
            $cv->key     = 'cv';
            $cv->value   = json_encode($data);
            $cv->save();
            return json_encode('success');
        }
    }

    public function download()
    {
        $user = User::with('cv')->whereHas('cv')->findOrFail(tenant('user_id'));
        $data = json_decode($user->cv->value) ?? '';
        $theme = $data->theme;
        $color =  $data->color;
        $mode =  $data->mode;
        $language =  $data->cvlanguage;
        $view = str_replace("/",".", $theme).'.index';
        return view($view, compact('mode', 'color', 'user', 'data'));
    }

    public function formtheme(Request $request)
    {
        $view = str_replace("/",".", $request->theme).'.form';
        if(!$request->theme){
            $view = 'cv.theme1.form';
        }
        return view($view);
    }

    public function reset()
    {
        $data        = Usermeta::where([['user_id', Auth::id()], ['key', 'cv']])->first();
        $data->value = '';
        $data->save();
    }
}
