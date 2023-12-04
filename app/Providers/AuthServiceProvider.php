<?php

namespace App\Providers;

use App\Models\Blog;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Blog::class => BlogPolicy::class, // Remove this line
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-blog', function ($user, $blog) {
            return $user->is_superuser;
        });

        Gate::define('delete-blog', function ($user, $blog) {
            return $user->is_superuser;
        });

        // Other policies...
    }
}