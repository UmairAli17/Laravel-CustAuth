<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    /**
     * A role Can Belong to multiple permissions
     * @return [type] [description]
     */
    public function permissions()
    {
    	return $this->belongsToMany(Permissions::class);
    }

    /**
     * Assign a Role
     * @param  [type] $role [description]
     * @return [type]       [description]
     */
    public function assignRole($role)
    {
    	return $this->roles()->save(
    		Roles::whereName($role)->firstOrFail()
    	);
    }

    /**
     * Attach a Permission to Role
     * @param  [type] $permission [description]
     * @return [type]             [description]
     */
    public function givePermissionTo($permission)
    {	
    	return $this->permissions()->save($permission);
    }	
}
