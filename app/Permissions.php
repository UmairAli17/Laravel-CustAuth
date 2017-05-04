<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
	/**
	 * A Permission Can belong to Many Roles
	 * @return [type] [description]
	 */
 	public function roles()
 	{
 		return $this->belongsToMany(Roles::class);
 	}
}
