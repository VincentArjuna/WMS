<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //

    public function index()
    {
        $roles = RoleResource::collection(Role::all());
        return Inertia::render('Security/RoleManagement/Index', compact('roles'));
    }

    public function create()
    {
        return Inertia::render('Security/RoleManagement/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string'
        ]);
        Role::create(['name' => $request->name]);
        return redirect()->route('security.roles.index')->with('message', 'Role Created Successfully!');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->with('message', 'Role Deleted Successfully!');
    }
}
