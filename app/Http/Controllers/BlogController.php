<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\BlogPolicy;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('images')->latest()->get();
        return view('welcome', compact('blogs'));
    }


    public function show(Blog $blog)
    {
        // Load associated images, comments, and the user relationship
        $blog->load('images', 'comments', 'user');
    
        // Check if the user is authenticated
        $authenticatedUserId = auth()->user() ? auth()->user()->id : null;
    
        // Use the "comments" relationship directly without calling the "get" method
        $comments = $blog->comments;
    
        return view('blogs.show', compact('blog', 'comments', 'authenticatedUserId'));
    }
    
          

    public function create()
    {
        return view('blogs.create');
    }

    public function test()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $blog = Blog::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => auth()->user()->id, // Associate the user with the blog post
        ]);
    
        // Handle Image Upload
        $imagePath = $request->file('image')->store('images');
        $blog->images()->create(['path' => $imagePath]);
    
        return redirect()->route('blogs.index');
    }

    public function edit(Blog $blog)
    {
        // Check if the user is authenticated and is a superuser
        if (auth()->check() && auth()->user()->is_superuser) {
            return view('blogs.edit', compact('blog'));
        }
    
        // If not a superuser, deny access
        abort(403, 'Unauthorized action.');
    }    
    
    public function update(Request $request, $id)
    {
        // Fetch the blog using the $id parameter
        $blog = Blog::findOrFail($id);
    
        // Authorize the user to update the blog
        $this->authorize('editBlog', $blog);
    
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
    
        // Update the blog
        $blog->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);
    
        // Redirect with success message
        return redirect()->route('blogs.show', $blog)->with('success', 'Blog updated successfully!');
    }            
    
    public function destroy(Blog $blog)
    {
        // Authorize the user to delete the blog
        if (Gate::denies('delete-blog', $blog)) {
            abort(403); // User is not authorized
        }
        // Authorize the user to delete the blog
        $this->authorize('delete', $blog);

        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully!');
    }

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

}
class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Blog::class => BlogPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-blog', [BlogPolicy::class, 'edit']);
        Gate::define('delete-blog', [BlogPolicy::class, 'delete']);
    }
}