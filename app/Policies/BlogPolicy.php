<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Blog;

class BlogPolicy
{
    public function edit(User $user, Blog $blog)
    {
    
        return $user->is_superuser;
    }    
    
    public function delete(User $user, Blog $blog)
    {
        return $user->is_superuser && $user->name === 'admin';
    }      
}