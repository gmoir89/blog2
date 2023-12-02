<!-- resources/views/blogs/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Edit Blog Post</h1>

    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="title">Title:</label>
        <input type="text" name="title" value="{{ $blog->title }}" required>

        <label for="content">Content:</label>
        <textarea name="content" required>{{ $blog->content }}</textarea>

        <label for="image">Image:</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit">Update Post</button>
    </form>

    <!-- Add a section for comments -->
    <h2>Comments</h2>
    @foreach($blog->comments as $comment)
        <p>{{ $comment->content }}</p>
    @endforeach

    <!-- Add a form for adding new comments -->
    <form action="{{ route('comments.store', $blog->id) }}" method="POST">
        @csrf
        <label for="comment">Add Comment:</label>
        <textarea name="comment" required></textarea>
        <button type="submit">Post Comment</button>
    </form>
@endsection

