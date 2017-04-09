<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

	protected $table = 'profiles';
	protected $fillable = ['occupation', 'gender', 'education', 'location', 'image'];
	/**
	 * [profile belongs to a user]
	 * @return [type] [description]
	 */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }



}
