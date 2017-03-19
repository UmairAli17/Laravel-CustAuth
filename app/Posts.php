<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{

	protected $fillable = ['title', 'body', 'user_id', 'approval', 'created_at', 'residence_id'];

	/* A Post is owned by User*/
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    //Posts can also belong to a residence
    public function residence()
    {
        return $this->belongsTo(Residence::class, 'residence_id');
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
        return $query;
    }

    
}
