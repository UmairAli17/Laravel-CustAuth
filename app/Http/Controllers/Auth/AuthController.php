<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Roles;
use Validator;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

/**
     * Overrides the default post register to redirect the user to the appropriate location
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     
    public function postRegister(Request $request)
    {
         if($user->hasRole('landlord')) {
            $this->postRegister($request);
            return redirect('/landlord/create');
        }
    }*/


    public function authenticated($request, $user)
    {
        if($user->hasRole('landlord')) {
            return redirect('/landlord/');
        }
        else if($user->hasRole('admin')) {
            return redirect('/admin/');
        }
        return redirect()->intended($this->redirectPath());
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        Auth::guard($this->getGuard())->login($this->create($request->all()));

        //Fire the event whether the user is a landlord and create a business onject (for lack of a better word) for them.
        event(new \App\Events\LandlordRegistered(Auth::user()));
        return redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            //'role' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $create = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        //Find the newly created user
        $user = User::find($create->id);
        //then attach the role id to that user
        $user->roles()->attach($data['role']);
        //$user->roles()->attach(2);
        //To Note:         $user->roles()->assignRole($data['role']); can be done   however the dropdown has only integers as values and the "assignRole" function only allows one to assign
        //a role by name
        return $create;

    }
}
