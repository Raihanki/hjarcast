<?php

namespace App\Http\Controllers\Screencast;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $title = "List All Tags";
        if ($request->has('s')) {
            $tags = Tag::where('name', 'like', '%' . $request->s . '%')->paginate(5);
        } else {
            $tags = Tag::latest()->paginate(5);
        }
        return view('tags/index', compact('title', 'tags'));
    }

    public function create()
    {
        $title = "Create New Tag";
        $tag = new Tag();
        return view('tags/create', compact('title', 'tag'));
    }

    public function store(TagRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);
        Tag::create($data);
        session()->flash('message', "Tag successfully created");
        return redirect()->route('tags.index');
    }

    public function edit(Tag $tag)
    {
        $title = "Edit Tag : " . $tag->name;
        return view('tags.edit', compact('tag', 'title'));
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $data = $request->validated();
        $data['slug'] = Str::title($data['name']);
        $tag->update($data);
        session()->flash('message', "Tag successfully deleted");
        return redirect()->route('tags.index');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        session()->flash('message', "Tag successfully deleted");
        return redirect()->route('tags.index');
    }
}
