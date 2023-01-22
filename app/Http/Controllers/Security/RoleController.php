<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Http\Traits\PermissionTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
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
        return Inertia::render('Security/Role/Index', compact('roles', 'userPermissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userPermissions = PermissionTrait::userPermission();
        return Inertia::render('Security/Role/Create', compact('userPermissions'));
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
            'name' => 'string|required'
        ]);
        Role::create(['name' => $request->name]);
        return redirect()->route('security.roles.index')->with('message', 'Role Created Successfully!');
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
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $userPermissions = PermissionTrait::userPermission();
        return Inertia::render('Security/Role/Edit', compact('role', 'userPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'string|required',
        ]);

        $role->update([
            'name' => $request->name,
        ]);
        return redirect()->route('security.roles.index')->with('message', 'Role Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->with('message', 'Role Deleted Successfully!');
    }
}
