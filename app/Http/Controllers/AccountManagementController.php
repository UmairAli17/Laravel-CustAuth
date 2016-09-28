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

   		$user = Auth::user();
        $hashed_password = Auth::user()->password;
        $current_password = $request->input('current_password');
        $new_password = $request->input('password');
   		if (Hash::check($current_password, $hashed_password)) {
        	$user->fill([
                    'password' => bcrypt($request->password)
                ])->save();
            flash()->success('You have successfully updated your password');
            return back();
    	}
    	else{
            flash()->error('Error: Please ensure you are entering your current password correctly!');
            return back();
    	}
   	}
    	
}
