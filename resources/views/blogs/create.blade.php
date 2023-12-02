@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <form class="bg-white p-8 rounded shadow-md w-1/2 transition-all duration-500 hover:bg-gradient-to-r from-purple-500 via-pink-500 to-red-500" action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h1 class="text-2xl font-semibold mb-6">Create a New Blog Post</h1>

            <label for="title">Title:</label>
            <input type="text" name="title" class="w-full border p-2 mb-4" required>

            <label for="content">Content:</label>
            <textarea name="content" class="w-full border p-2 mb-4" required></textarea>

            <label for="image">Image:</label>
            <input type="file" name="image" accept="image/*" class="w-full border p-2 mb-4" required>

            <button type="submit" class="bg-blue-500 text-gray-100 px-6 py-3 rounded hover:bg-blue-600 transition">Create Post</button>

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
@endsection