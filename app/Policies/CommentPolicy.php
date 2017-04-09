<?php

namespace App\Policies;
use Auth;
use App\User;
use App\Comments;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

    public function can_reply(User $user, Comments $comments)
    {
        if ($user->isAdmin() || $user->owns($comments)) {
            return true;
        } 
    }

    public function can_delete(User $user, Comments $comments)
    {
        if ($user->isAdmin() || $user->owns($comments)) {
            return true;
        } 
    }
}
