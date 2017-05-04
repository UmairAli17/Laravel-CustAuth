<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
	protected $fillable = ['title', 'body', 'user_id', 'approval', 'created_at', 'residence_id', 'rating'];


    /**
     * A Post can only belong to a Single Residence
     * @return [type] [description]
     */
    public function residence()
    {
        return $this->belongsTo(Residence::class);
    }

	/**
     * Post Belongs to a User
     * @return [type] [description]
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    

    //this model allows for many comments
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    /**
     *  Get all Approved Comments and Display by Latest
     * @return [type] [description]
     */
    public function approved_comments()
    {
        return $this->comments()->status('1')->orderBy('created_at');

    }

    /**
     * A Review May Have Many Ratings
     * @return [type] [description]
     */
    public function ratings()
    {
        return $this->hasMany(Ratings::class);
    }

    /**
     * Get Post Status
     * @param  [type] $query  [description]
     * @param  [type] $status [description]
     * @return [type]         [description]
     */
    public function scopeStatus($query, $status)
    {
    	$query->where('approval', '=', $status);
        return $query;
    }

    
}
