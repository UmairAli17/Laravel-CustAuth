<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{

	protected $fillable = ['title', 'body', 'user_id', 'approval'];
	/* A Post is owned by User*/

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function scopeApproved($query)
    {
    	$query->where('approval', '=', 1);
    }
    
    public function scopeRefused($query)
    {
    	$query->where('approval', '=', 3);
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
