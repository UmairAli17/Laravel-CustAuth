<?php

namespace App\Listeners;

use App\Events\LandlordRegistered;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Businesses;

class AssignBusinesstoLandlord
{

    $protected $request;
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
       $user = User::find($event->userId);
       if($user->hasRole('landlords'))
       {
        $business['user_id'] = $user;
        $business = Businesses::create($business);
       }
    )
}
