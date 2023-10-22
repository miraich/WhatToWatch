<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('comment-delete', function (User $user, Comment $comment) {
            if ($user->isModerator()) {
                return true;
            }
            return $user->id === $comment->user_id && $comment->comments->isEmpty();
        });

        Gate::define('comment-edit', function (User $user, Comment $comment) {
            if ($user->isModerator()) {
                return true;
            }
            return $user->id === $comment->user_id;
        });

        Gate::define('film-create', function (User $user) {
            if ($user->isModerator()) {
                return true;
            }
        });

        Gate::define('film-edit', function (User $user) {
            if ($user->isModerator()) {
                return true;
            }
        });

    }
}
