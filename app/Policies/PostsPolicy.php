<?php

namespace App\Policies;

use App\User;
use App\Posts;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostsPolicy
{
    use HandlesAuthorization;

    /**
     * Allow Access if User Owns a Post
     * 
     * @return void
     */

    public function owns_post(User $user, Posts $post)
    {
        if ($user->isAdmin() || $user->owns($post)) {
            return true;
        } 
    }
}
