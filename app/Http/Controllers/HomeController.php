<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Posts;
use App\Residences;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Displays all of the approved posts.
        $users = User::all()->count();
        $post = Posts::status('1')->orderBy('created_at')->count();
        $residences = Residences::all()->count();
        return view('welcome', compact('users', 'post', 'residences'));
    }
}
