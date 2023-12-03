@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $blog->title }}</h2>
        <p>{{ $blog->content }}</p>

        <h3>Images:</h3>
        @foreach ($blog->images as $image)
            <img src="{{ asset('storage/' . $image->path) }}" alt="Image" style="max-width: 33%; height: auto;">
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

        {{-- Remove the @auth and @if directives --}}
        <div>
            <a href="{{ route('blogs.edit', $blog) }}">Edit</a>
            <form action="{{ route('blogs.destroy', $blog) }}" method="post" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>

        <h3>Add a Comment:</h3>
        <form action="{{ route('comments.store') }}" method="post">
            @csrf
            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
            <textarea name="content" rows="3" required></textarea>
            <button type="submit">Submit Comment</button>
        </form>

        <a href="{{ route('blogs.index') }}">Back to Posts</a>

    </div>
@endsection

