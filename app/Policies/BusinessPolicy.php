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
     * Allow Access if Current user Owns the Business
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
