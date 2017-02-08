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
    	
        $user = Auth::user();
        //get the landlord's business - only one record is required which is why "first" is used as it returns a single row rather than a collection like what "get" would do
        $land_business = $user->business()->first();
        // get the business id
        $business_id = $land_business->id;
        $resi = $request->all();      
        $resi['business_id'] = $business_id;
        $resi = Residence::create($resi);
        flash()->success('Your Residence has been uploaded and attached to your account.');
        return back();
    }

}
