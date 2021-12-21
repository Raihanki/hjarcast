<?php

namespace App\Http\Controllers\Screencast;

use App\Models\Video;
use App\Models\Playlist;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\VideoRequest;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function index(Playlist $playlist)
    {
        $this->authorize('update', $playlist);
        $title = "List Videos In " . $playlist->name . "  Playlist";
        $videos = $playlist->videos()->orderBy('episode')->paginate(10);
        return view('videos.index', compact('title', 'videos', 'playlist'));
    }
    public function create(Playlist $playlist)
    {
        $this->authorize('update', $playlist);
        $title = "Create New Video On : " . $playlist->name;
        $video = new Video();
        return view('videos.create', compact('title', 'playlist', 'video'));
    }

    public function store(VideoRequest $request, Playlist $playlist)
    {
        $this->authorize('update', $playlist);
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title'] . '-' . Str::random(6));
        if ($request->post('is_intro')) {
            $data['is_intro'] = true;
        } else {
            $data['is_intro'] = false;
        }
        $playlist->videos()->create($data);
        session()->flash('message', "Videos successfully created");
        return redirect()->route('videos.index', $playlist);
    }

    public function edit(Playlist $playlist, Video $video)
    {
        $this->authorize('update', $playlist);
        $title = "Edit Video : " . $video->title;
        return view('videos.edit', compact('playlist', 'video', 'title'));
    }

    public function update(VideoRequest $request, Playlist $playlist, Video $video)
    {
        $this->authorize('update', $playlist);
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title'] . '-' . Str::random(6));
        if ($request->post('is_intro')) {
            $data['is_intro'] = true;
        } else {
            $data['is_intro'] = false;
        }
        $video->update($data);
        session()->flash('message', "Videos successfully updated");
        return redirect()->route('videos.index', compact('playlist'));
    }

    public function destroy(Playlist $playlist, Video $video)
    {
        $video->delete();
        session()->flash('message', "Videos successfully deleted");
        return redirect()->route('videos.index', compact('playlist'));
    }
}
