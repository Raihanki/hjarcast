<?php

namespace App\Http\Controllers\Screencast;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function index()
    {
        $title = "Your Playlists";
        return view('playlists/index', compact('title'));
    }

    public function create()
    {
        $title = "Create New Playlist";
        return view('playlists/create', compact('title'));
    }
}
