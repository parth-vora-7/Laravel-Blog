<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Notifications\CommentPostNotification;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Blog $blog)
    {
        $comments = $blog->comments()->latest('created_at')->paginate(3);
        return view('comment.index', compact('blog', 'comments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Blog $blog, CommentRequest $request)
    {
        $comment = $blog->comments()->create(['text' => request('text'), 'user_id' => $request->user()->id, 'deleted_at' => NULL]);
        if($comment) {
            if($blog->user) {
               $blog->user->notify(new CommentPostNotification($blog, $comment));
            }
            flash('Your comment has been successfully posted.', 'success')->important();
            return $this->index($blog);
        } else {
            flash('Something went wrong. Please try again.', 'danger')->important();
            return $this->index($blog);
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Blog $blog, Comment $comment, CommentRequest $request)
    {
        $comment->text = $request->text;
        if($comment->save()) {
            flash('Your comment has been successfully updated.', 'success')->important();
            return $this->index($blog);
        } else {
            flash('Something went wrong. Please try again.', 'danger')->important();
            return $this->index($blog);
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog, Comment $comment)
    {
        if($comment->delete()) {
            flash('Your comment has been successfully deleted.', 'success')->important();
            return $this->index($blog);
        } else {
            flash('Something went wrong. Please try again.', 'danger')->important();
            return $this->index($blog);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function subCommentStore(Comment $comment, CommentRequest $request)
    {
        
    }
}