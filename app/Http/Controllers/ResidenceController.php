<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\PostRequest;
use App\Residence;
use Gate;
use View;
use Auth;
use App\Posts;
class ResidenceController extends Controller
{	

	//show all residences()
	public function all(){
		$residences = Residence::all();
		return view('residences.all', compact('residences'));
	}

	// view residence
    public function view($id){
    	$residence = Residence::with('posts')->findOrFail($id);
    	$post = new Posts;
    	return view('residences.show', compact('residence', 'post'));
    }

    //store residence_review()
    public function store_residence_review(PostRequest $request, $residence){
    	$residence_id = Residence::findOrFail($residence);
    	$post = new Posts($request->all());
        $post['approval'] = 2;
        $post['residence_id'] = $residence_id->id;
        $posts = Auth::user()->posts()->save($post);
        return back();
    }

    public function test($id)
    {
        // $residence = Residence::with('posts')->findOrFail($id);
        // return $residence;
        $residence = Residence::findOrFail($id);
        $r = $residence->posts;
        return $r;
    }   
}
 