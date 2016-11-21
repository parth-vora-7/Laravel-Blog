<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Blog;
use App\Tag;
use App\User;
use App\Events\NewBlogPublished;
use App\Notifications\NewBlogNotification;
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
        $blogs = Blog::orderBy('published_on', 'desc')->published()->paginate(3);
        return view('blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::pluck('name', '_id');
        return view('blog.add', compact('tags'));
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
                'commenting' => ($request->commenting) ? 1 : 0,
                'deleted_at' => NULL
                ]
                );
            $blog->tags()->sync($request->tag_list);

            if($request->new_tags) {
                foreach($request->new_tags as $new_tag) {
                    $tag = Tag::create(['name' => $new_tag]);
                    if($tag) {
                        $blog->tags()->attach($tag->id);
                    }
                }
            }
        }

        if($blog) {
            Auth::User()->notify(new NewBlogNotification($blog));
            event(new NewBlogPublished($blog));
            flash('Your blog has been successfully posted.', 'success')->important();
            return redirect()->route('user.blog', Auth::user());
        } else {
            flash('Something went wrong. Please try again.', 'danger')->important();
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Blog $blog)
    {
        $comments = $blog->comments()->latest('created_at')->paginate(3);
        
        if ($request->ajax()) {
            return view('comment.index', compact('comments'))->render();  
        }
        return view('blog.detail', compact('blog', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Blog $blog)
    {
        $tags = Tag::pluck('name', '_id');
        if ($request->user()->can('update', $blog)) {
            return view('blog.edit', compact('blog', 'tags'));
        } else {
            abort(403);
        }
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
        if ($request->user()->can('update', $blog)) {
            $blogs_org_dir = 'public/blogs/origional';
            Storage::makeDirectory($blogs_org_dir);

            $blog->title = $request->title;
            $blog->text = $request->text;
            $blog->published_on = $request->published_on;
            $blog->commenting = ($request->commenting) ? 1 : 0;

            if($request->blog_image && $blog_img_file = $request->blog_image->store($blogs_org_dir)) // Upload avatar
            {
                $blog_image_source = str_replace ('public', 'storage', $blog_img_file);
                $blog->blog_image = $blog_image_source;
            }
            $blog->tags()->sync($request->tag_list);

            if($request->new_tags) {
                foreach($request->new_tags as $new_tag) {
                    $tag = Tag::create(['name' => $new_tag]);
                    if($tag) {
                        $blog->tags()->attach($tag->id);        
                    }
                }
            }
            
            if($blog->save()) {
                flash('Your blog has been successfully updated.', 'success')->important();
                return redirect()->route('blog.show', $blog->id);
            } else {
                flash('Something went wrong. Please try again.', 'danger')->important();
                return back()->withInput();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Blog $blog)
    {
        if($blog->delete()) {
            flash('Your blog has been successfully deleted.', 'success')->important();
            return redirect()->route('blog.index');
        } else {
            flash('Something went wrong. Please try again.', 'danger')->important();
            return back();
        }
    }

    /**
     * Get the logged in user's blogs.
     *
     * @return \Illuminate\Http\Response
     */
    public function userBlogs(User $user)
    {
        $blogs = $user->blogs()->orderBy('published_on', 'desc')->paginate(3);
        return view('blog.index', compact('blogs'));
    }
}