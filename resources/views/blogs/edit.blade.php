@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center">Edit Blog Post</h1>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" name="title" value="{{ $blog->title }}" required>
                    </div>

                    <div class="form-group">
                        <label for="content">Content:</label>
                        <textarea class="form-control" name="content" required>{{ $blog->content }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control-file" name="image" accept="image/*">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Post</button>
                </form>

                <!-- Add a section for comments -->
                <h2 class="mt-4">Comments</h2>
                @foreach($blog->comments as $comment)
                    <p>{{ $comment->content }}</p>
                @endforeach

                <!-- Add a form for adding new comments -->
                <form action="{{ route('comments.store', $blog->id) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="form-group">
                        <label for="comment">Add Comment:</label>
                        <textarea class="form-control" name="comment" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Post Comment</button>
                </form>
            </div>
        </div>
    </div>
@endsection