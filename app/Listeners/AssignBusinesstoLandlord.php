<?php

namespace App\Listeners;

use App\Events\LandlordRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Business;

class AssignBusinesstoLandlord
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  LandlordRegistered  $event
     * 
     */
    public function handle(LandlordRegistered $event)
    {
        //wrap auth'd user to a variable and bind it to the $event->userID parameter
       $user = Auth::user($event->userID);
       //check if the user that has been binded to that even has a role
       if($user->hasRole('landlord'))
       {
            $user->business()->save(new Business);
       }
    }
}
