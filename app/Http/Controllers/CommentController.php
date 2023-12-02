<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    // CommentController.php
public function store(Request $request)
{
    $request->validate([
        'blog_id' => 'required|exists:blogs,id',
        'content' => 'required',
    ]);

    auth()->user()->comments()->create([
        'blog_id' => $request->blog_id,
        'content' => $request->content,
    ]);

    return back()->with('success', 'Comment added successfully!');
}

}
