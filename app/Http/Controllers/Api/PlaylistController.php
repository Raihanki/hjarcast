<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlaylistResource;
use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::with('user')
            ->withCount('videos')
            ->latest()
            ->paginate(10);

        return PlaylistResource::collection($playlists);
    }

    public function show(Playlist $playlist)
    {
        return new PlaylistResource($playlist->withCount('videos')->firstOrFail());
    }
}
