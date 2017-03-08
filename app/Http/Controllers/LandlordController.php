<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use View;
use Gate;
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
        $newR = new Residence($request->all());
        $residence = Auth::user()->business->residence()->save($newR);
        //FUTURE REF: DISPLAY CREATED RESIDENCE
        flash()->success('Your Residence has been uploaded and attached to your account.');
        return back();
    }

    /**
     * [Show Edit Form]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function edit_residence($id)
    {
        $residence = Residence::findorFail($id);
        if(Gate::allows('edit_residence', $residence))
        {   
            return view('residences.edit', compact('residence'));
        }
        else{
            flash()->error('You are not the landlord owner');
            return back();
        }
    }
    /**
     * [Update Residence]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update_residence(Request $request, $id)
    {
        $residence = Residence::findorFail($id);
        if(Gate::allows('edit_residence', $residence))
        {   
            $residence->update($request->all());
            return redirect()->action('ResidenceController@view', [$residence]);
            flash()->success('Your Residence has been Updated!');
        }
        else{
            flash()->error('You are not the landlord owner');
            return back();
        }
    }



}
