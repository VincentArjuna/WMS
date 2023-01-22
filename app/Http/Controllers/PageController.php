<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Traits\PermissionTrait;

class PageController extends Controller
{
    use PermissionTrait;

    public function dashboard()
    {
        $userPermissions = PermissionTrait::userPermission();
        return Inertia::render('Dashboard', compact('userPermissions'));
    }
}
