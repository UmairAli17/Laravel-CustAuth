<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    public function permissions()
    {
    	return $this->belongsToMany(Permissions::class);
    }

    public function assignRole($role)
    {
    	return $this->roles()->save(
    		Roles::whereName($role)->firstOrFail()
    	);
    }

    public function givePermissionTo($permission)
    {	
    	return $this->permissions()->save($permission);
    }	
}
