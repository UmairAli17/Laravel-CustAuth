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

        $query = $request->q;
            $residences = $query
                ? Residence::search($query)->get()
                : Residence::all();
		return view('residences.all', compact('residences'));
	}

	// view residence
    public function view($id){
    	$residence = Residence::with('approved_posts.approved_comments.user', 'approved_posts.user', 'landlord_business.user')->findOrFail($id);
        $postcode = json_encode($residence->postcode);
    	$post = new Posts;
    	return view('residences.show', compact('residence', 'post', 'postcode'));
        
    }

    //store residence_review()
    public function store_residence_review(PostRequest $request, $residence){
    	$residence_id = Residence::findOrFail($residence);
        if(Gate::allows('can_review', $residence_id))
        {
            $post = new Posts($request->all());
            $post['approval'] = 2;
            $post['residence_id'] = $residence_id->id;
            $posts = Auth::user()->posts()->save($post);
            return back();
        }
        else
        {
            flash()->error('As a Landlord, you are not allowed to review your own residence');
            return back();
        }
    	
    }

    //store residence_review()
    public function delete(Request $request, $residence){
        $residence_id = Residence::findOrFail($residence);
        if (Gate::allows('landlord_owner', $residence_id))
        {
            $residence_id->delete();
            return redirect()->route('landlord.my_residences');
        }
        else
        {
            flash()->success('Your Review has been deleted!');
            return back();
        }
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
 