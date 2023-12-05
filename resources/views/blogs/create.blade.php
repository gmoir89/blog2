@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form class="bg-white p-4 rounded shadow-md" action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h1 class="text-2xl font-semibold mb-4 text-center">Create a New Blog Post</h1>

                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>

                    <div class="form-group">
                        <label for="content">Content:</label>
                        <textarea class="form-control" name="content" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control-file" name="image" accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Create Post</button>

                    <div class="mt-4 text-gray-500 text-sm">
                        <p class="mb-2">Tips:</p>
                        <ul>
                            <li class="list-disc ml-4">Be creative with your title!</li>
                            <li class="list-disc ml-4">Share a captivating story in your content.</li>
                            <li class="list-disc ml-4">Choose an eye-catching image for your post.</li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection