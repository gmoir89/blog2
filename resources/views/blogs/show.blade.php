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
        @forelse ($comments as $comment)
            <p>
                <strong>{{ $comment->user->name }}:</strong>
                {{ $comment->content }}
                <br>
                <small>Commented on: {{ $comment->created_at->format('F j, Y \a\t h:i A') }}</small>
            </p>
        @empty
            <p>No comments available.</p>
        @endforelse

        @auth
            @if(auth()->user()->id === $blog->user_id)
                <div>
                    {{-- Add these dd() statements --}}
                    {{ dd(auth()->user()->id, $blog->user_id) }}
                    
                    <a href="{{ route('blogs.edit', $blog) }}">Edit</a>
                    <form action="{{ route('blogs.destroy', $blog) }}" method="post" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </div>
            @endif

            <h3>Add a Comment:</h3>
            <form action="{{ route('comments.store') }}" method="post">
                @csrf
                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                <textarea name="content" rows="3" required></textarea>
                <button type="submit">Submit Comment</button>
            </form>
        @else
            <p>Please <a href="{{ route('login') }}">log in</a> to leave a comment.</p>
        @endauth
    </div>
@endsection
