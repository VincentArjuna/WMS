<?php

namespace App\Http\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait PermissionTrait
{
    public static function userPermission()
    {
        $user = User::find(Auth::id());
        $permissions = $user->getPermissionsViaRoles()->pluck('name');
        return $permissions;
    }
}
