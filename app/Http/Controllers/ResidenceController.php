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



     /**Display All Residences - If there is a Request, Perform Search Scope
     * @param  Request $request [description]
     * @return [type]           [description]
     */
	public function all(Request $request){

        $query = $request->q;
            $residences = $query
                ? Residence::search($query)->get()
                : Residence::all();
		return view('residences.all', compact('residences'));
	}

     /**Display Residence
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function view($id){
    	$residence = Residence::with('approved_posts.approved_comments.user', 'approved_posts.user', 'landlord_business.user')->findOrFail($id);
    	return view('residences.show', compact('residence', 'post'));
        
    }

    /**
     *  Display Add Review Form
     * 
     */
    public function add_review($id)
    {
        $post = new Posts;
        $residence = Residence::findOrFail($id);
        return view('residences.add', compact('post', 'residence'));

    }

    /**
     *  Process Add Review Form
     * 
     */
    public function store_residence_review(PostRequest $request, $residence){
    	$r = Residence::findOrFail($residence);
        $post = new Posts($request->all());
        $post['approval'] = 2;
        $post['user_id'] = Auth::user()->id;
        $r->posts()->save($post);
        return redirect()->route('residence.view', ['id' => $r->id]);
    }

    /**
     * [delete residence]
     *     
     */
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

    /**
     *  Upvote Residence
     * 
     */
    public function upRes(Request $request, $id)
    {
        $residence = Residence::findOrFail($id);
        $residence->increment('rating', 1);
        flash()->success('Upvoted!');
        return back();
    }

    /**
     *  Downvote Residences
     * 
     */
    public function downRes(Request $request, $id)
    {
        $residence = Residence::findOrFail($id);
        $residence->decrement('rating', 1);
        flash()->success('Downvoted!');
        return back();
    }

    /**
     *  Upvote Review
     * 
     */
    public function up(Request $request, $post)
    {   
        $id = Posts::findOrFail($post);
        $id->increment('post_rating', 1);
        flash()->success('Upvoted!');
        return back();
    }   

    /**
     *  Downvote Review
     * 
     */
    public function down(Request $request, $post)
    {
        $id = Posts::findOrFail($post);
        $id->decrement('post_rating', 1);
        flash()->success('Downvoted!');
        return back();     
    }
}
 
