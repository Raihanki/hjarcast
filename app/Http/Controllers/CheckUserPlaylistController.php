<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;

class CheckUserPlaylistController extends Controller
{
    public function index(Request $request, Playlist $playlist)
    {
        return response()->json([
            "data" => $request->user()->hasBuy($playlist)
        ]);
    }
}
