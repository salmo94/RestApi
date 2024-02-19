<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function view(User $user, Post $post): bool
    {
       return $user->status = User::STATUS_ACTIVE;
    }

    /**
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function update(User $user, Post $post): bool
    {
        return $user->isAdmin() || $user->id === $post->author_id;
    }

    /**
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function delete(User $user, Post $post): bool
    {
        return  $user->isAdmin() || $user->id === $post->author_id;
    }

}
