<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionsResource;
use App\Http\Resources\RoleResource;
use App\Http\Traits\PermissionTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{

    use PermissionTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = RoleResource::collection(Role::all());
        $userPermissions = PermissionTrait::userPermission();
        return Inertia::render('Security/Permission/Index', compact('roles', 'userPermissions'));
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
        //
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
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all()->pluck('name');
        $rolePermissions = $role->permissions->pluck('name');
        $userPermissions = PermissionTrait::userPermission();
        return Inertia::render('Security/Permission/Edit', compact('permissions', 'role', 'rolePermissions', 'userPermissions'));
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
        $role = Role::find($id);
        $role->syncPermissions($request->permissions);
        return redirect()->route('security.permissions.index')->with('message', 'Permission Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
