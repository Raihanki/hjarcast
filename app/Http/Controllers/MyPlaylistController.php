<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PlaylistResource;

class MyPlaylistController extends Controller
{
    public function index()
    {
        return PlaylistResource::collection(Auth::user()->purchased_playlists()->with('user')->paginate(5));
    }
}
