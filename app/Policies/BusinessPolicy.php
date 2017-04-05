<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;
use App\User;
use App\Business;
class BusinessPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function business_owner(User $user, Business $business)
    {
        if ($user->owns($business)) {
            return true;
        } 
    }
}
