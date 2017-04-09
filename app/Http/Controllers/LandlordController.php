<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use View;
use Gate;
use App\Http\Requests\ResiRequest;
use App\Http\Requests\BusinessRequest;
use App\Business;
use Auth;
use App\User;
use App\Residence;
use App\Posts;
use App\Comments;
use Input;
use Carbon;


class LandlordController extends Controller
{
    public function __construct() 
    {

    }

    //Landlord Dashboard
    public function landlord_dash(){
        return view('landlord.dashboard');
    }

    public function edit(Request $request, $id)
    {

        $business = Business::findorFail($id);
        if(Gate::allows('business_owner', $business))
        {   
           return view('business.edit', compact('business'));
        }
        else{
            flash()->error('You do not have sufficient access!');
            return back();
        }
    }

    public function update(BusinessRequest $request, $id)
    {

        $business = Business::findorFail($id);
        if(Gate::allows('business_owner', $business))
        {   
            if($file = $request->hasFile('logoFileName'))
            {

                $file = $request->file('logoFileName');
                $name = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path().'/uploads/logos', $name);
                $business = Business::where('id', $id)->update(
                [
                    'logoFileName' => $name,
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
            }
            else
            {
                $business->update($request->all());
            }
           
            return back();
            flash()->success('Your Business has been Updated!');
        }
        else{
            flash()->error('You cannot make changes to a business that is not yours!!');
            return back();
        }
    }


    //get all current auth'd landlord's business and all of their relations will be loaded within the template
    public function my_residences(){
        $user = Auth::user();
        $residences = $user->load('business.residence');
        return View::make('landlord.my_residences', compact('residences'));
    }

    //add residence - show form
    public function add_residence()
    {	
    	return view('landlord.add_residence');
    }

    public function store_residence(ResiRequest $request)
    {
        $newR = new Residence($request->all());
        // $name = "no-image.png";
        if($file = $request->hasFile('image'))
        {

            $file = $request->file('image');
            $name = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path().'/uploads/', $name);
            $newR['image'] = $name;
        }
        $residence = Auth::user()->business->residence()->save($newR);
        //FUTURE REF: DISPLAY CREATED RESIDENCE
        flash()->success('Your Residence has been uploaded and attached to your account.');
        return back();
    }

    /**
     * [Show Edit Form]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function edit_residence($id)
    {
        $residence = Residence::findorFail($id);
        if(Gate::allows('landlord_owner', $residence))
        {   
            return view('residences.edit', compact('residence'));
        }
        else{
            flash()->error('You are not the landlord owner');
            return back();
        }
    }
    /**
     * [Update Residence]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update_residence(Request $request, $id)
    {
        $residence = Residence::findorFail($id);
        if(Gate::allows('landlord_owner', $residence))
        {   
            $residence->update($request->all());
            return redirect()->action('ResidenceController@view', [$residence]);
            flash()->success('Your Residence has been Updated!');
        }
        else{
            flash()->error('You are not the landlord owner');
            return back();
        }
    }

    /**
     * [reply_comment {POST METHOD}]
     * @param  Request $request [description]
     * @param  [type]  $post    [description]
     * @return [type]           [description]
     */
    public function reply_comment(Request $request, $post)
    {
        $post_id = Posts::findOrFail($post);
        $reply = new Comments($request->all());
        $user = Auth::user();
        // This works
        $reply['user_id'] = Auth::user()->id;
        $reply['posts_id'] = $post_id->id;
        $reply->save();
        // $replies = $user->posts()->comments()->save($reply);
        return back();
    }


    /**
     * [edit_comment show the edit reply to comment form]
     * @param  [type] $comment [description]
     * @return [type]          [description]
     */
    public function edit_comment($comment)
    {
        $c = Comments::findOrFail($comment);
        if(Gate::allows('can_reply', $c))
        {   
            return view('residences.comments.edit', compact('c'));
        }
        else{
            flash()->error('You are not the landlord owner');
            return back();
        }
    }

    public function update_comment(Request $request, $comment)
    {
        $c = Comments::findOrFail($comment);
        $r = $c->posts->residence;
        if(Gate::allows('can_reply', $c))
        {   
            $c->update($request->all());
            return redirect()->route('residence.view', [$r->id]); 
            flash()->success('Your Comment has been updated');
        }
        else{
            flash()->error('You are not the owner of this reply!!');
            return back();
        }
    }

    public function delete_comment(Request $request, $comment)
    {
        $c = Comments::findOrFail($comment);
        $r = $c->posts->residence;
        if(Gate::allows('can_delete', $c))
        {   
            $c->delete();
            return redirect()->route('residence.view', [$r->id]); 
            flash()->success('Your Comment has been Deleted');
        }
        else{
            flash()->error('You are not the owner of this reply!!');
            return back();
        }
    }



}
