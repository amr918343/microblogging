<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserObserver
{
    public function saved(User $user) {
        if(request()->image) {
            $user->image = Storage::disk('public')->putFile('images/users', request()->image);
        }
        $user->saveQuietly();
    }
}
