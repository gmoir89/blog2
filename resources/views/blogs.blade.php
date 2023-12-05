
<div class="container">
    <h2>All Blog Posts</h2>
    @forelse ($blogs as $blog)
        <div>
            <h3>{{ $blog->title }}</h3>
            <p>{{ Str::limit($blog->content, 150) }}</p>
            <a href="{{ route('blogs.show', $blog) }}">Read More</a>
        </div>
        <hr>
    @empty
        <p>No blog posts available.</p>
    @endforelse
</div>
