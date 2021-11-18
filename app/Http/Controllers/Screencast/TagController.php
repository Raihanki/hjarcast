<?php

namespace App\Http\Controllers\Screencast;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $title = "List All Tags";
        return view('tags/index', compact('title'));
    }

    public function create()
    {
        $title = "Create New Tag";
        return view('tags/create', compact('title'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
