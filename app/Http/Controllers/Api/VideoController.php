<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VideoResource;
use App\Models\Playlist;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index(Playlist $playlist)
    {
        $videos = $playlist->videos()->orderBy('episode')->get();
        return VideoResource::collection($videos)->additional(compact('playlist'));
    }

    public function show(Playlist $playlist, Video $video)
    {
        if (Auth::user()->purchased_playlists()->find($playlist) || $video->is_intro == true) {
            return new VideoResource($video);
        }
        return response()->json(["message" => "Please Buy Playlist To Watch"]);
    }
}
