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
	public function all(Request $request){

        $data = [];
        $query = $request->q;
            $residences = $query
                ? Residence::search($query)->get()
                : Residence::all();
		return view('residences.all', compact('residences'));
	}

	// view residence
    public function view($id){
    	$residence = Residence::with('posts.comments.user', 'posts.user')->findOrFail($id);
        $postcode = json_encode($residence->postcode);
    	$post = new Posts;
    	return view('residences.show', compact('residence', 'post', 'postcode'));
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

    public function upRes(Request $request, $id)
    {
        $residence = Residence::findOrFail($id);
        $residence->increment('rating', 1);
        flash()->success('Upvoted!');
        return back();
    }

    public function downRes(Request $request, $id)
    {
        $residence = Residence::findOrFail($id);
        $residence->decrement('rating', 1);
        flash()->success('Downvoted!');
        return back();
    }

    public function up(Request $request, $post)
    {   
        $id = Posts::findOrFail($post);
        $id->increment('post_rating', 1);
        flash()->success('Upvoted!');
        return back();
    }   

    public function down(Request $request, $post)
    {
        $id = Posts::findOrFail($post);
        $id->decrement('post_rating', 1);
        flash()->success('Downvoted!');
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
 