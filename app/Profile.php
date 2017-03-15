<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	/**
	 * [profile belongs to a user]
	 * @return [type] [description]
	 */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
