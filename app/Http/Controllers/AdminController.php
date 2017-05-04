<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Posts;
use App\User;
use App\Comments;
use Illuminate\Support\Facades\Input;
class AdminController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Show Latest Posts
     * @return [type] [description]
     */
    public function index()
    {	
    	$post = Posts::limit(5)->latest()->get();
    	$user = User::limit(5)->latest()->get();
    	return view('admin.adminDash', compact('post', 'user'));
    }


    /**
     * Show the Review Moderation Page
     * @return
     */
    public function showPostMod()
    {
        $post = Posts::latest()->get();
        $comment = Comments::latest()->get();
        return view('admin.adminPostMod', compact('post', 'comment'));
    }

    /**
     * Process Moderation of Review
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function postStatus(Request $request, $id)
    {
        $input = $request->input('approval');
        $post = Posts::findOrFail($id);
        $post = Posts::where('id', $id)->update(['approval' => $input]);
        return back();
    }

    /**
     * Process Moderation of Comments
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function commentStatus(Request $request, $id)
    {
        $input = $request->input('approval');
        $comment = Comments::findOrFail($id);
        $comment = Comments::where('id', $id)->update(['approval' => $input]);
        return back();
    }

}
