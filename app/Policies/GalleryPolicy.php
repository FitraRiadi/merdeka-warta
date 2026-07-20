<?php

namespace App\Policies;

use App\Models\Gallery;
use App\Models\Setting;
use App\Models\User;

class GalleryPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function view(User $user, Gallery $gallery): bool
    {
        return $user->isSuperAdmin() || $gallery->user_id === $user->id;
    }

    public function update(User $user, Gallery $gallery): bool
    {
        return $user->isSuperAdmin() || $gallery->user_id === $user->id;
    }

    public function delete(User $user, Gallery $gallery): bool
    {
        return $user->isSuperAdmin() || $gallery->user_id === $user->id;
    }
}
