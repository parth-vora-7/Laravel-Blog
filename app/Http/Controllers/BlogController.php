<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Blog;
use Auth;
use Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::paginate(10);
        return view('blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $blogs_org_dir = 'public/blogs/origional';
        Storage::makeDirectory($blogs_org_dir);

        if($blog_file = $request->blog_image->store($blogs_org_dir)) // Upload avatar
        {
            $org_blog_source = str_replace ('public', 'storage', $blog_file);
            $blog = Auth::User()->blogs()->create(
                [
                'title' => $request->title,
                'text' => $request->text,
                'published_on' => $request->published_on,
                'blog_image' => $org_blog_source,
                'deleted_at' => NULL
                ]
                );
        }

        if($blog) {
            return redirect()->route('blog.index', ['message' => 'Your blog has been successfully posted.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('blog.add', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $blogs_org_dir = 'public/blogs/origional';
        Storage::makeDirectory($blogs_org_dir);

        $blog->title = $request->title;
        $blog->text = $request->text;
        $blog->published_on = $request->published_on;
        
        if($request->blog_image && $blog_img_file = $request->blog_image->store($blogs_org_dir)) // Upload avatar
        {
            $blog_image_source = str_replace ('public', 'storage', $blog_img_file);
            $blog->blog_image = $blog_image_source;
        }
        $blog->save();

        return redirect()->route('blog.edit', $blog->id)->with(['message' => 'Your blog has been successfully updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get the logged in user's blogs.
     *
     * @return \Illuminate\Http\Response
     */
    public function myBlogs()
    {
        //
    }
}