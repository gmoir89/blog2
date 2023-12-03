<?php

// BlogPolicy.php

namespace App\Policies;

use App\Models\User;
use App\Models\Blog;

class BlogPolicy
{
    public function update(User $user, Blog $blog)
    {
        return true;
    }
    
    public function delete(User $user, Blog $blog)
    {
        return true;
    }
    
}


