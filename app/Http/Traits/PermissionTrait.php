<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;

trait PermissionTrait
{
    public static function userPermission()
    {
        $user = Auth::user();
        $permissions = $user->getPermissionsViaRoles()->pluck('name');
        return $permissions;
    }
}
