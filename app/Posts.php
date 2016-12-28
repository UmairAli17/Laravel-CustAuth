<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{

	protected $fillable = ['title', 'body', 'user_id', 'approval', 'created_at', 'business_id'];
	/* A Post is owned by User*/

    //this model belongs to a user
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    //This model belongs to a business
    public function businessReview()
    {
        return $this->belongsTo(Businesses::class);
    }


    //this model allows for many comments
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
    
    /*** 
        Allows for dynamic scoping like so:
        $post = Posts::status('1')->orderBy('created_at')->get();
    **/
    
    public function scopeStatus($query, $status)
    {
    	$query->where('approval', '=', $status);
    }
    
    
    public function approvalNote($status)
    {
        $post = Posts::where('approval', '=', $status);
        if($post = 2)
        {
            return "Awaiting Approval";
        }
        elseif($post = 3)
        {  
            return "Post not Approved. Changed may need to be made";
        }
        elseif($post = 1)
        {
            return "Approved";
        }

    }

    
}
