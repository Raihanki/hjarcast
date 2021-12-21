<?php

namespace App\Http\Controllers\Api;

use App\Models\Playlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PlaylistResource;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::with('user', 'tags')
            ->withCount('videos')
            ->latest()
            ->paginate(9);

        return PlaylistResource::collection($playlists);
    }

    public function show(Playlist $playlist)
    {
        return new PlaylistResource($playlist);
    }

    public function buyPlaylist(Playlist $playlist)
    {
        Auth::user()->buyPlaylist($playlist);
        return response()->json([
            "message" => "Playlist Successfully Bought"
        ]);
    }
}
