<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\User;
use Hash;
use Input;

use App\Http\Requests\UserSecurityFormRequest;

class AccountManagementController extends Controller
{
    public function __construct()
    {
    	//Anything for whole controller or for exceptions
    }

    public function index()
    {
    	return view('auth.account.account');
    }

    public function security()
    {
        // get current user details and allow them to be accessed by the view (which will be the two forms)
    	$user = Auth::user();
    	return view('auth.account.security', compact('user'));
    }

    public function updateName(Request $request)
    {
        $input = $request->input('name');
        $id = Auth::user()->id;
        $user = User::where('id', $id)->update(['name' => $input]);
        flash()->success('You have updated your Username');
    	return back();
    }

    public function updatePassword(UserSecurityFormRequest $request)
    {
        //Grab current authentication user then get their current password. 
        //Check if whether the current password is equal to what the input of "current_password" and 
        //if it is then chaneg the password as long as the "UserSecurityFormRequest" Request rules are met
        $user = Auth::user();
        // get the user's current password
        $hashed_password = Auth::user()->password;
        // get the password fromt he current_password input textbox
        $current_password = $request->input('current_password');
        //get the new password from the password input textbox
        $new_password = $request->input('password');
            // if what the user entered into the text input matches the current user's password from the db then allow the following 
            if (Hash::check($current_password, $hashed_password)) {
        	$user->fill([
                    'password' => bcrypt($new_password)
                ])->save();
                flash()->overlay('You have successfully updated your password');
                return back();
            }
            // otherwise, tell them that they made a
            else{
                flash()->error('Error: Please ensure you are entering your current password correctly!');
                return back();
            }
   	}
    	
}
