<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ResiRequest;
use App\Businesses;
use Auth;
use App\User;
use App\Residence;



class LandlordController extends Controller
{
    public function __construct()
    {

    }

    public function show_all(){
        $businesses = Businesses::all();
        return view('posts.all', compact('businesses'));
    }

    //add residence - show form
    public function add_residence()
    {	
    	return view('landlord.add_residence');
    }

    public function store_residence(ResiRequest $request)
    {
    	
        $user = Auth::user();
        //get the landlord's business
        $land_business = $user->business()->first();
        // get the business id
        $business_id = $land_business->id;
        $resi = $request->all();      
        $resi['business_id'] = $business_id;
        $resi = Residence::create($resi);
        return $resi;
        // flash()->success('Your Residence has been uploaded and attached to your account.');
        // return back();
    }

}
