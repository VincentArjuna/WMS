<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserActionResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Traits\PermissionTrait;
use App\Models\UserAction;

class PageController extends Controller
{
    use PermissionTrait;

    public function dashboard()
    {
        $userPermissions = PermissionTrait::userPermission();
        return Inertia::render('Dashboard', compact('userPermissions'));
    }

    public function history()
    {
        $userPermissions = PermissionTrait::userPermission();
        $histories = UserActionResource::collection(UserAction::latest()->get());

        return Inertia::render('History/UserAction/Index', compact('userPermissions', 'histories'));
    }
}
