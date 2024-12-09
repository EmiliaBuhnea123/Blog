<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }

    public function update(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }

    public function delete(User $user, Article $article)
    {
        return $user->hasRole('admin') || $user->id === $article->user_id;
    }
}
