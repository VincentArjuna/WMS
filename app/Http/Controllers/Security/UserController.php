<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Traits\PermissionTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use PermissionTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserResource::collection(User::all());
        $userPermissions = PermissionTrait::userPermission();
        return Inertia::render('Security/User/Index', compact('users', 'userPermissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $userPermissions = PermissionTrait::userPermission();

        return Inertia::render('Security/User/Create', compact('roles', 'userPermissions'));
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
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role_name' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->assignRole($request->role_name);
        return redirect()->route('security.users.index')->with('message', 'User Created Successfully!');
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
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $user = UserResource::make($user);
        $userPermissions = PermissionTrait::userPermission();

        return Inertia::render('Security/User/Edit', compact('user', 'roles', 'userPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'required|min:6',
            'role_name' => 'required',
        ]);

        $message = '';
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if ($request->email != 'admin@admin.com') {
            $user->syncRoles([$request->role_name]);
        } else {
            $message = $message . 'Unable to change Admin Role! ';
        }

        $message = $message . 'User Successfully Updated!';
        return redirect()->route('security.users.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('message', 'User Deleted Successfully!');
    }
}
