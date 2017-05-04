<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Posts;
use App\Residence;
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
     * Show Homepage
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->count();
        $post = Posts::status('1')->orderBy('created_at')->count();
        $residences = Residence::all()->count();
        return view('welcome', compact('users', 'post', 'residences'));
    }
}
