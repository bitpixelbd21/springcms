<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use BitPixel\SpringCms\Constants;
use Illuminate\Support\Facades\Auth;
use BitPixel\SpringCms\Models\Blog;
use BitPixel\SpringCms\Models\Comment;
use BitPixel\SpringCms\Models\Customer;


use BitPixel\SpringCms\Models\BlogCategory;


class CommentController
{

    public function index()
    {
        $comments = Comment::with('river_customers')->paginate(20);

        $data = [
            'title' => 'Comments',
            'comments' => $comments,
        ];

       // dd($data);


        return view('river::admin.comments.index', $data);
    }



    public function edit($id)
    {

        // Fetch the comment by ID
        $comment = Comment::with('river_customers')->find($id);
        $data = [
            'title' => 'Comments',
            'comment' => $comment,
        ];
      //  dd($data);

        // if ($comment) {
        //     return view('river::admin.comments.edit', compact('comment'));
        // }
            return view('river::admin.comments.edit', $data);


        // return redirect()->route('comments.index')->with('error', 'Comment not found.');

    }

    // Store a new comment
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id', // Ensure parent comment exists
        ]);

        $post = Post::findOrFail($postId);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
            'parent_id' => $request->input('parent_id'), // Null for main comments
        ]);

        return back()->with('success', 'Comment added successfully.');
    }

    public function update(Request $request, $id)
    {
      //  dd($request->all());
        // Validate the incoming request
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        // Find the comment by ID
        $comment = Comment::findOrFail($id);

        $comment->update($request->all());

        return redirect()->route('river.comments.index')->with('success', 'Comment updated successfully.');
    }



    // Optional: Delete a comment
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // if ($comment->customer_id !== auth()->id()) {
        //     return back()->with('error', 'You are not authorized to delete this comment.');
        // }

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }



    public function approveComment(Request $request, $id)
    {
        $comment = Comment::find($id);

        if ($comment) {
            $comment->is_active = $request->input('is_active');
            $comment->save();

            return response()->json(['success' => true, 'message' => 'Comment approved successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'Comment not found.'], 404);
    }

}
