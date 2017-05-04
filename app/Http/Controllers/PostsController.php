<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\AccessPost;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\PostRequest;
use App\Posts;
use Auth;
class PostsController extends Controller
{

    /**
     *  Allow Owner of Post to Edit: Display Form
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
        $post = Posts::find($id);
        if (Gate::allows('owns_post', $post)) {
            return view('posts.edit', compact('post'));
        }
        else{
            flash()->error('Sorry, you do not seem to have access to this post');
            return redirect()->action('PostsController@show', [$post]);
        }
    }

    /**
     *  Allow owner of Post to Update: Process Update Form
     * @param  UpdatePostRequest $request [description]
     * @param  [type]            $id      [description]
     * @return [type]                     [description]
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Posts::findOrFail($id);
        $user = Auth::user()->name;
        $r = $post->residence;
        if (Gate::allows('owns_post', $post)) {
            //tells the query to add the user user's name ot the table
            $post['edited_by'] = $user;
            $post->update($request->all());
            flash()->success('Your Post has been Updated!');
            return redirect()->route('residence.view', [$r->id]); 
        }
        else{
            flash()->warning('You do not have access to editing that resource');
            return redirect()->route('residence.view', [$r->id]);     
        }
        
    }

    /**
     *  Allow Owner of Post to Delete: Delete Model
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function delete(Request $request, $id)
    {
        $post = Posts::findOrFail($id);
        $r = $post->residence;
        if (Gate::allows('owns_post', $post)) {
            $post->delete();
            flash()->success('Your Review has been deleted!');
            return redirect()->route('residence.view', [$r->id]); 
        }
        else{
            flash()->warning('You do not have access to editing that resource');
            return redirect()->route('residence.view', [$r->id]);     
        }
        
    }

    /**
     *  Get All Current User's Posts
     * @return [type] [description]
     */
    public function myPosts()
    {
        //get all the current user's posts
        $posts = Auth::user()->posts()->get();
        return view('posts.user.myPosts', compact('posts'));
    }
    
    /**
     *  Get All Current User's Approved Posts
     * @return [type] [description]
     */
    public function approved()
    {
        $posts = Auth::user()->posts()->status('1')->orderBy('created_at')->get();
        return view('posts.user.myApprovedPosts', compact('posts'));
    }

    /**
     *  Get all current user's rejected posts
     * @return [type] [description]
     */
    public function rejected()
    {
        $posts = Auth::user()->posts()->status('3')->orderBy('created_at')->get();
        return view('posts.user.myRejectedPosts', compact('posts'));
    }
}
