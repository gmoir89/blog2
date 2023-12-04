<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Blog;

class BlogPolicy
{
    public function edit(User $user, Blog $blog)
    {
        // \Log::info('User ID: ' . $user->id);
        // \Log::info('Is Superuser: ' . ($user->is_superuser ? 'true' : 'false'));
        // \Log::info('Blog ID: ' . $blog->id);
    
        return $user->is_superuser;
    }    
    
    public function deleteBlog(User $user, Blog $blog)
    {
        return $user->is_superuser && $user->name === 'admin';
    }    
}