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
     * Create a new policy instance.
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
