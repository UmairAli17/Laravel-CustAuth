<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
	protected $fillable = ['title', 'body', 'user_id', 'approval', 'created_at', 'residence_id', 'rating'];


     //Posts can also belong to a residence
    public function residence()
    {
        return $this->belongsTo(Residence::class);
    }

	/* A Post is owned by User*/
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    

    //this model allows for many comments
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    //this model allows for many comments
    public function approved_comments()
    {
        return $this->comments()->status('1')->orderBy('created_at');

    }

    public function ratings()
    {
        return $this->hasMany(Ratings::class);
    }


    public function scopeStatus($query, $status)
    {
    	$query->where('approval', '=', $status);
        return $query;
    }

    
}
