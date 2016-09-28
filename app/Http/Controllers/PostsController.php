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

	public function __construct()
	{  
        //
	}

    //Show the Post
    public function show($id)
    {
    	$post = Posts::findOrFail($id);
    	return view('posts.show', compact('post'));
    }

    //Show Upload Post Form
    public function create()
    {
        $post = new Posts;
        return view('posts.create', compact('post'));
    }

    public function store(PostRequest $request)
    {
        $post = $request->all();
        $post['user_id'] = Auth::user()->id;
        //2 is the approval status of where the post is waiting for approval
        $post['approval'] = 2;
        $posts = Posts::create($post);
        return redirect()->action('PostsController@show', [$posts]);
        flash()->success('Your Post has been Submitted.');
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
        if (Gate::allows('owns_post', $post)) {
            $post->update($request->all());
            flash()->success('Your Post has been Updated!');
            return redirect()->action('PostsController@show', [$posts]);
        }
        else{
            flash()->warning('You do not have access to editing that resource');
            return redirect()->action('PostsController@show', [$posts]);      
        }
        
    }

    public function myPosts()
    {
        $myPosts = Auth::user();
        $posts = $myPosts->posts()->get();
        return view('posts.user.myPosts', compact('posts'));
    }
    
    public function approvedPosts()
    {
        $approvedPosts = Auth::user();
        $posts = $approvedPosts->posts()->approved()->orderBy('created_at')->get();
        return view('posts.user.myApprovedPosts', compact('posts'));
    }
}
