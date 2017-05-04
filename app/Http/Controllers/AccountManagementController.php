<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Profile;
use Hash;
use Input;
use Gate;
use App\Http\Requests\UserSecurityFormRequest;

class AccountManagementController extends Controller
{
    public function __construct()
    {
    	//Anything for whole controller or for exceptions
    }

    /**
     * Display Account Dashboard
     * @return [type] [description]
     */
    public function index()
    {
    	return view('auth.account.account');
    }

    /**
     * Display Forms to Change Password & Username
     * @return [type] [description]
     */
    public function security()
    {
    	$user = Auth::user();
    	return view('auth.account.security', compact('user'));
    }


    /**
     * Process Change Username Form
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateName(Request $request)
    {
        $input = $request->input('name');
        $id = Auth::user()->id;
        $user = User::where('id', $id)->update(['name' => $input]);
        flash()->success('You have updated your Username');
    	return back();
    }

    /**
     * Process Change Password Form
     * 
     * @return
     */
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

    /**
     * [profile Get User Profile View]
     * @return [type] [description]
     */
    public function profile($id)
    {
        $profile = User::with('profile', 'posts', 'approvedUserPosts')->findorFail($id);
        $total = $profile->posts()->count();
        $approved = $profile->posts()->status('1')->count();
        $rejected = $profile->posts()->status('3')->count();
        return view('users.profile', compact('profile', 'total', 'approved', 'rejected'));
    }

    /**
     * Process Edit User Profile Form
     * @param  Request $request Profile ID
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function editProfile(Request $request, $id){

        $profile = Profile::findorFail($id);
        if(Gate::allows('access_profile', $profile))
        {   
           return view('users.edit-prof', compact('profile'));
        }
        else{
            flash()->error('You do not have sufficient access!');
            return back();
        }
    
    }
    

    public function updateProfile(Request $request, $id){
        $profile = Profile::findorFail($id);
        // $name = "no-image.png";
        if(Gate::allows('access_profile', $profile))
        {   
           if($file = $request->hasFile('image'))
            {

                $file = $request->file('image');
                $name = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path().'/uploads/user', $name);
                $profile->update(
                [
                    'image' => $name,
                    'gender' => $request->gender,
                    'occupation' => $request->occupation,
                    'education' => $request->education,
                    'location' => $request->location,
                ]);
            }
            else
            {
                $profile->update($request->all());
            }
           return redirect()->route('user.profile', [$profile->user_id]);
        }
        else{
            flash()->error('You do not have sufficient access!');
            return back();
        }
    }	
}
