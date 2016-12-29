<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\BusinessesRequest;
use App\Businesses;
use Auth;



class LandlordController extends Controller
{
    public function __construct()
    {

    }

    public function show_all(){
        $businesses = Businesses::all();
        return view('posts.all', compact('businesses'));
    }

    //create business form
    public function business()
    {	
    	$business = new Businesses;
    	return view('business.create', compact('business'));
    }

    public function store(BusinessesRequest $request)
    {
    	$business = $request->all();
    	$business['user_id'] = Auth::user()->id;
        $business = Businesses::create($business);
        flash()->success('Your Business has been Created.');
        return back();
    }

}
