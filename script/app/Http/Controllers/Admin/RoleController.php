<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!Auth()->user()->can('role.list'), 401);

        $roles = Role::where('id', '!=', 1)->get();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth()->user()->can('role.create'), 401);
        $permisions        = Permission::all();
        $permission_groups = User::getPermissionGroup();
        return view('admin.role.create', compact('permisions', 'permission_groups'));
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
            'name' => 'required|unique:roles|max:100',
        ]);
        $role        = Role::create(['name' => $request->name]);
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {

            $role->syncPermissions($permissions);
        }

        return response()->json(['Role created successfully']);
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
        abort_if(!Auth()->user()->can('role.edit'), 401);
        $role              = Role::findById($id);
        $all_permissions   = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('admin.role.edit', compact('role', 'all_permissions', 'permission_groups'));
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
        // Validation Data
        $request->validate([
            'name' => 'required|max:100|unique:roles,name,' . $id,
        ], [
            'name.required' => 'Please give a role name',
        ]);

        $role        = Role::findById($id);
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        return response()->json(['Role has been updated !!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        abort_if(!Auth()->user()->can('role.delete'), 401);
        $request->validate([
            'status' => 'required',
            'ids'    => 'required',
        ], [
            'status.required' => 'Select Any Action!',
            'ids.required'    => 'Select checkbox!',
        ]);
        if ($request->status == '') {
            $msg['errors']['error'] = "Select Any Action!";
            return response()->json($msg, 401);
        }

        if ($request->status == 'delete') {
            if ($request->ids) {
                foreach ($request->ids as $id) {
                    Role::destroy($id);
                }
            }
            return response()->json('Role Removed');
        }

    }
}
