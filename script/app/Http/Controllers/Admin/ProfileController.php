<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        return view('admin.profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('admin.profile.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProfileRequest $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {

        $request->validate([
            'name'  => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            
        ]);
        $id  = Auth()->user()->id;
        $obj = User::findOrFail($id);
        //to upload file
        if ($request->hasFile('image')) {
            if (!empty($obj->image) && file_exists($obj->image)) {
                unlink($obj->image);
            }
            $logo      = $request->file('image');
            $logo_name = hexdec(uniqid()) . '.' . $logo->getClientOriginalExtension();
            $logo_path = 'uploads/' . Auth::id();
            $logo->move($logo_path, $logo_name);
            $obj->image = $logo_path . $logo_name;
        }
        // first check the input file then check old data for this field ,last update the data
        $obj->password      = isset($request->password) ? Hash::make($request->password) : $obj->password;
        $obj->name          = isset($request->name) ? $request->name : $obj->name;
        $obj->email         = isset($request->email) ? $request->email : $obj->email;
       
        $success            = $obj->save();
        if ($success) {
            return response()->json('Profile Updated Successfully');
        } else {
            return response()->json('System Error');
        }
    }

}
