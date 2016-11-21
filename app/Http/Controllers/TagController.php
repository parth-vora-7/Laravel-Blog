<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function index() 
    {
		return Tag::orderBy('id', 'asc')->get();
    }

    public function show(Tag $tag)
    {
        $tags = Tag::orderBy('id', 'asc')->get();
        $blogs = $tag->blogs()->orderBy('published_on', 'desc')->published()->paginate(3);
        return view('blog.index', compact('blogs', 'tags'));
    }
}
