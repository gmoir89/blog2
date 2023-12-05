@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="text-center"><u><strong>{{ $blog->title }}</strong></u></h2>
        <p>{{ $blog->content }}</p>

        <h3>Images:</h3>
        <div class="row justify-content-center">
            @foreach ($blog->images as $image)
                <div class="col-md-4 mb-3 text-center">
                    <img src="{{ asset('storage/' . $image->path) }}" alt="Image" class="img-fluid">
                </div>
            @endforeach
        </div>

        <h3>Comments:</h3>
        @forelse ($comments as $comment)
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text">
                        <strong>{{ $comment->user->name }}:</strong>
                        {{ $comment->content }}
                    </p>
                    <small class="text-muted">Commented on: {{ $comment->created_at->format('F j, Y \a\t h:i A') }}</small>
                </div>
            </div>
        @empty
            <p>No comments available.</p>
        @endforelse

        {{-- Remove the @auth and @if directives --}}
        <div class="mt-3">
            @auth
                <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('blogs.destroy', $blog) }}" method="post" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            @endauth
        </div>

        @auth
            <h3 class="mt-3">Add a Comment:</h3>
            <form action="{{ route('comments.store') }}" method="post" class="mb-3">
                @csrf
                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                <textarea name="content" class="form-control" rows="3" required></textarea>
                <button type="submit" class="btn btn-primary mt-2">Submit Comment</button>
            </form>
        @else
            <p>Login to leave a comment.</p>
        @endauth

        <a href="{{ route('blogs.index') }}" class="btn btn-secondary mt-3">Back to Posts</a>
    </div>
@endsection