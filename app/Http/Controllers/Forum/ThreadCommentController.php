<?php

namespace App\Http\Controllers\Forum;

use App\Events\CommentMade;
use App\Events\CommentReplied;
use App\Http\Controllers\Controller;
use App\Models\Forum\Thread;
use App\Models\Forum\ThreadComment;
use Illuminate\Http\Request;

class ThreadCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function store(string $slug, Request $request)
    {
        $thread = Thread::where('slug', $slug)->first();

        if ($thread === null) {
            return response(['error' => 'Thread does not exist']);
        }

        $request->validate([
            'body' => ['required', 'string', 'max:1024'],
            'parent_id' => ['nullable', ],
        ]);

        $parentId = $request->input('parent_id');

        if ($parentId !== null
            && ThreadComment::firstOrFail('id', $parentId) === null
        ) {
            return response(['error' => 'Parent comment does not exist']);
        }

        $comment = ThreadComment::create([
            'user_id' => auth()->id(),
            'parent_id' => $parentId,
            'thread_id' => $thread->id,
            'body' => $request->input('body')
        ]);

        event(new CommentMade($comment));

        if ($parentId !== null) {
            event(new CommentReplied($comment));
        }

        return response([
            'id' => $comment->id,
            'body' => $comment->body,
            'user' => [
                'name' => $comment->user->name,
                'id' => $comment->user->id,
            ],
            'parent' => [
                'id' => $comment->parent_id ?? null,
                'user_name' => $comment->parent ? $comment->parent->user->name : null
            ]

        ]);
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
