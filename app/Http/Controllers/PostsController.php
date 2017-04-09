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

    public function index()
    {
        $post = Posts::status('1')->orderBy('created_at')->get();
        return view('home', compact('post'));
    }

    //Show the Post
    public function show($id)
    {
    	$post = Posts::findOrFail($id);
    	return view('posts.show', compact('post'));
    }

    //Show Edit Post Form
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

    //Function that handles the update post data
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

    //Function that handles the update post data
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

    public function myPosts()
    {
        //get all the current user's posts
        $posts = Auth::user()->posts()->get();
        return view('posts.user.myPosts', compact('posts'));
    }
    
    public function approved()
    {
        //get all the current user's approved posts
        $posts = Auth::user()->posts()->status('1')->orderBy('created_at')->get();
        return view('posts.user.myApprovedPosts', compact('posts'));
    }

    public function rejected()
    {
        //get all the current user's approved posts
        $posts = Auth::user()->posts()->status('3')->orderBy('created_at')->get();
        return view('posts.user.myRejectedPosts', compact('posts'));
    }
}
