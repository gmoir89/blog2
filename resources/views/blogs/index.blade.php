<!-- resources/views/blogs/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>All Blog Posts</h1>

    @foreach($blogs as $blog)
        <div>
            <h2>{{ $blog->title }}</h2>
            <p>{{ $blog->content }}</p>
            <a href="{{ route('blogs.edit', $blog->id) }}">Edit</a>
            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
    @endforeach
@endsection
