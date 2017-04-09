<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Business;
use App\Residence;
use Auth;
class LandlordPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function landlord_owner(User $user, Residence $residence)
    {
        //if current user that is a landlord 
        if($user->landlordResOwner($residence))
        {
            return true;
        }
    }

    public function can_review(User $user, Residence $residence)
    {
        //if current user that is a landlord - do not allow to review
        if($user->landlordResOwner($residence))
        {
            return false;
        }
        return true;
    }
}
