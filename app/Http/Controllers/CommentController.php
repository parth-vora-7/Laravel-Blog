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
    public function index(Blog $blog, $messages = [])
    {
        $comments = $blog->comments()->latest('created_at')->paginate(3);
        return view('comment.comment', compact('blog', 'comments', 'messages'));
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
               //$blog->user->notify(new CommentPostNotification($blog, $comment));
            }
            $messages[] = [
            'message' => 'Your comment has been successfully posted.',
            'class' => 'success'
            ];
            return $this->index($blog, $messages);
        } else {
            $messages[] = [
            'message' => 'Something went wrong. Please try again.',
            'class' => 'danger'
            ];
            return $this->index($blog, $messages);
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
            $messages[] = [
            'message' => 'Your comment has been successfully updated.',
            'class' => 'success'
            ];
            return $this->index($blog, $messages);
        } else {
            $messages[] = [
            'message' => 'Something went wrong. Please try again.',
            'class' => 'danger'
            ];
            return $this->index($blog, $messages);
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
            $messages[] = [
            'message' => 'Your comment has been successfully deleted.',
            'class' => 'success'
            ];
            return $this->index($blog);
        } else {
            $messages[] = [
            'message' => 'Something went wrong. Please try again.',
            'class' => 'danger'
            ];
            return $this->index($blog);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSubComments(Comment $comment)
    {
        $comments = $comments->comments()->latest('created_at')->paginate(3);

        dd($comments);
        
        if ($request->ajax()) {
            return view('comment.comment', compact('comments'))->render();
        }
    }
}