<?php

namespace App\Http\Controllers\Screencast;

use App\Models\User;
use App\Models\Playlist;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PlaylistRequest;
use Illuminate\Support\Facades\Storage;

class PlaylistController extends Controller
{
    public function index()
    {
        $title = "Your Playlists";
        $playlists = Playlist::paginate(10);
        return view('playlists/index', compact('title', 'playlists'));
    }

    public function create()
    {
        $title = "Create New Playlist";
        $playlist = new Playlist();
        return view('playlists/create', compact('title', 'playlist'));
    }

    public function store(PlaylistRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name'] . '-' . Str::random(6));
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $data['thumbnail']->store('images/playlists');
        }
        Auth::user()->playlists()->create($data);
        session()->flash('message', 'Successfully created playlist');
        return redirect()->route('playlists.index');
    }

    public function edit(Playlist $playlist)
    {
        $title = "Edit Playlist : " . $playlist->name;
        return view('playlists.edit', compact('playlist', 'title'));
    }

    public function update(PlaylistRequest $request, Playlist $playlist)
    {
        $data = $request->validated();
        if ($request->hasFile('thumbnail')) {
            Storage::delete($request->thumbnail);
            $data['thumbnail'] = $data['thumbnail']->store('images/playlists');
        }
        $data['slug'] = Str::slug($data['name'] . '-' . Str::random(6));

        $playlist->update($data);
        session()->flash('message', "Playlist successfully updated");
        return redirect()->route('playlists.index');
    }

    public function destroy(Playlist $playlist)
    {
        Storage::delete($playlist->thumbnail);
        $playlist->delete();
        session()->flash('message', "Playlist successfully deleted");
        return redirect()->route('playlists.index');
    }
}
