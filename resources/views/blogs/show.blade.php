<!-- resources/views/blogs/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $blog->title }}</h2>
        <p>{{ $blog->content }}</p>

        <h3>Images:</h3>
        @foreach ($blog->images as $image)
            <img src="{{ asset('storage/app/images/' . $image->path) }}" alt="Image">
        @endforeach

        <h3>Comments:</h3>
        @forelse ($blog->comments as $comment)
            <p>{{ $comment->content }}</p>
        @empty
            <p>No comments available.</p>
        @endforelse
    </div>
@endsection


