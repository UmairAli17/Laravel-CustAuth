<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Residences;
use App\Business;


class ResidenceController extends Controller
{	

	//show all residences()
	public function all(){
		$residences = Residences::all();
		return view('residences.all', compact('residences'));
	}


	// view residence
    public function view($id){
    	$residence = Residences::findOrFail($id);
    	return $residence;
    }	
}
