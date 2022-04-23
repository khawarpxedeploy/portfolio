<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use File;
use Illuminate\Http\Request;
use ZipArchive;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $theme = Theme::where('type', 'theme')->latest()->paginate(20);
        return view('admin.template.index', compact('theme'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'file' => 'required|mimes:zip',
        ]);

        ini_set('max_execution_time', '0');

        if ($request->hasFile('file')) {
            $file = $request->file('file')->getClientOriginalName();
            $ext  = $request->file('file')->getClientOriginalExtension();
            $name = basename($file, '.' . $ext);
        }

        $zip = new ZipArchive;
        $res = $zip->open($request->file);
        if ($res === true) {
            $zip->extractTo('uploads/tmp');
            $zip->close();
            $this->extract = true;
        } else {
            $this->extract = false;
        }

        if (file_exists('uploads/tmp/' . $name . '/function.php')) {
            include 'uploads/tmp/' . $name . '/function.php';

            if (function_exists('theme_info')) {
                $info = theme_info();
                if (file_exists('uploads/tmp/' . $name . '/function.php')) {
                    $theme_assets_root = $info['theme_assets_root'];
                    $theme_src_root    = $info['theme_src_root'];
                    $theme_name        = $info['theme_name'];

                    $assets_link_path = $info['assets_link_path'];
                    $theme_view_path  = $info['theme_view_path'];

                    File::copyDirectory('uploads/tmp/' . $name . '/' . $theme_assets_root, 'theme');
                    File::copyDirectory('uploads/tmp/' . $name . '/' . $theme_src_root, base_path('resources/views/theme/'));
                    File::deleteDirectory('uploads/tmp/' . $name);

                    $template             = new Theme;
                    $template->name       = $theme_name;
                    $template->view_path  = $theme_view_path;
                    $template->asset_path = $assets_link_path;
                    $template->type       = 'theme';
                    $template->save();

                    return response()->json(['Theme Uploaded Successfully']);
                }
            } else {
                File::deleteDirectory('uploads/tmp/' . $name);
            }
        } else {
            if (file_exists('uploads/tmp/' . $name)) {
                File::deleteDirectory('uploads/tmp/' . $name);
            }
        }
        $msg['errors']['error'] = "Something Missing With This Theme";
        return response()->json($msg, 401);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(!Auth()->user()->can('template.delete'), 401);

        $template = Theme::findorFail($id);
        if (file_exists($template->asset_path)) {
            File::deleteDirectory($template->asset_path);
        }

        if (file_exists(base_path('resources/views/' . $template->view_path))) {

            File::deleteDirectory(base_path('resources/views/' . $template->view_path));
        }
        $template->delete();

        return redirect()->back()->with('success', 'Successfully Deleted');
    }
}
