<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use View;
use App\Http\Requests\ResiRequest;
use App\Business;
use Auth;
use App\User;
use App\Residence;



class LandlordController extends Controller
{
    public function __construct()
    {

    }

    //Landlord Dashboard
    public function landlord_dash(){
        return view('landlord.dashboard');
    }


    //get all current auth'd landlord's business and all of their relations will be loaded within the template
    public function my_residences(){
        $user = Auth::user();
        $residences = $user->load('business.residence');
        return View::make('landlord.my_residences', compact('residences'));
    }

    //add residence - show form
    public function add_residence()
    {	
    	return view('landlord.add_residence');
    }

    public function store_residence(ResiRequest $request)
    {
    	
       /*get current user -> run user Model business function to find business then through the business model's 
        relation function, save it*/

        /* User_Model:businessFunction->Business_Model->residenceFunction->save(theRequest) */
        $newR = new Residence($request->all());
        $residence = Auth::user()->business->residence()->save($newR);
        //FUTURE REF: DISPLAY CREATED RESIDENCE
        flash()->success('Your Residence has been uploaded and attached to your account.');
        return back();
    }

}
