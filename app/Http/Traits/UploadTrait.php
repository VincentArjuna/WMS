<?php

namespace App\Http\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait UploadTrait
{
    public static function uploadImage($file, $folder_name,)
    {
        $user = User::find(Auth::id());
        // Get image from the request
        $avatar = $file;
        // Generate a new file name
        $fileName = time() . '.' . $avatar->getClientOriginalExtension();
        // Store image in storage/avatars
        $path = $avatar->storeAs('avatars', $fileName, 'public');
        $path = '/storage/' . $path;
        // Update user's avatar path in the database
        $user->avatar = $path;
        $user->save();
    }
}
