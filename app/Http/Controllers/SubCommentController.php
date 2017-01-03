<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
Use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Notifications\CommentPostNotification;

class SubCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Comment $comment, $messages = [])
    {
        $comments = $comment->childComments()->latest('created_at')->paginate(3);
        return view('comment.sub-comment', compact('comment', 'comments', 'messages'))->render();        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Comment $comment, CommentRequest $request)
    {
        $subcomment = $comment->childComments()->create(['text' => request('text'), 'user_id' => $request->user()->id, 'parent_id' => $comment->id, 'deleted_at' => NULL]);
        if($subcomment) {
            /*if($blog->user) {
               //$blog->user->notify(new CommentPostNotification($blog, $comment));
            }*/
            $messages[] = [
            'message' => 'Your comment has been successfully posted.',
            'class' => 'success'
            ];
            return $this->index($comment, $messages);
        } else {
            $messages[] = [
            'message' => 'Something went wrong. Please try again.',
            'class' => 'danger'
            ];
            return $this->index($comment, $messages);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
