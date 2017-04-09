<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Profile;
class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function access_profile(User $user, Profile $profile)
    {
        if ($user->owns($profile)) {
            return true;
        } 
    }
}
