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
        return $this->belongsTo(Business::class);
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

    
}
