<?php

namespace App\Policies;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlaylistPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Playlist $playlist)
    {
        return $user->id === $playlist->user_id;
    }

    public function destroy(User $user, Playlist $playlist)
    {
        return $user->id === $playlist->user_id;
    }
}
