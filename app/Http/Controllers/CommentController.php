<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with(['user', 'replies.user'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json($comments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'error' => 'You must be logged in to post a comment.',
                'redirect' => route('login')
            ], 401);
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name
        ]);

        $comment->load('user');

        return response()->json([
            'message' => 'Comment added successfully',
            'comment' => $comment
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment = Comment::with(['user', 'replies.user'])->findOrFail($id);
        return response()->json($comment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $comment = Comment::findOrFail($id);
        
        if (Auth::id() !== $comment->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update([
            'content' => $request->content
        ]);

        return response()->json([
            'message' => 'Comment updated successfully',
            'comment' => $comment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);
        
        if (Auth::id() !== $comment->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }
    
    /**
     * Store a newly created reply in storage.
     */
    public function storeReply(Request $request, $commentId)
    {
        if (!Auth::check()) {
            return response()->json([
                'error' => 'You must be logged in to post a reply.',
                'redirect' => route('login')
            ], 401);
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $reply = Reply::create([
            'content' => $request->content,
            'comment_id' => $commentId,
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name
        ]);

        $reply->load('user');

        return response()->json([
            'message' => 'Reply added successfully',
            'reply' => $reply
        ], 201);
    }
}
