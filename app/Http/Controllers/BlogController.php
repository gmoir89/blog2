<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Image;
use App\Models\Comment;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('images')->latest()->get();
        return view('welcome', compact('blogs'));
    }


    public function show(Blog $blog)
    {
        // Load associated images and comments
        $blog->load('images', 'comments');

        return view('blogs.show', compact('blog'));
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function test(){
        return view('welcome');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $blog = Blog::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        // Handle Image Upload
        $imagePath = $request->file('image')->store('images');
        $blog->images()->create(['path' => $imagePath]);

        return redirect()->route('blogs.index');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.edit', ['blog' => $blog]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('blogs.index');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blogs.index');
    }

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
}



