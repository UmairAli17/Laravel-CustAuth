<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{

	//defines the name of the table that this model must communicate with
    protected $table = 'posts_comments';

    //Allow for mass assignment on these fields.

    protected $fillable = ['title', 'comment', 'user_id', 'post_id', 'parent_id'];


    /**
     * A Post Can Belong to Only ONE Post One-to-Many
     * @return [type] [description]
     */
    public function posts()
    {
    	return $this->belongsTo(Posts::class);
    }

    /**
     * Scope for Status of Posts. 
     * @param  [type] $query  [description]
     * @param  [type] $status [description]
     * @return [type]         [description]
     */
    public function scopeStatus($query, $status)
    {
        $query->where('approval', '=', $status);
        return $query;
    }

    /**
     * A Single Comment May only Belong to a Single User
     * @return [type] [description]
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
