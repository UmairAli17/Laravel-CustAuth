<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{

	//defines the name of the table that this model must communicate with
    protected $table = 'posts_comments';

    //Allow for mass assignment on these fields.

    protected $fillable = ['title', 'comment', 'user_id', 'post_id', 'parent_id'];


    //ensures that this model belongs to a single Post
    public function posts()
    {
    	return $this->belongsTo(Posts::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
