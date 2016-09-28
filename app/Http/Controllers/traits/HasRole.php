<?php
namespace App\Http\Controllers\traits;

trait HasRoles
{
	 //Creates Many to Many Relationship between Users table (and model) and Roles Table (and model)
    public function roles()
    {
        return $this->belongsToMany(Roles::class);
    }


    //Checks for a specific role
    public function hasRole($role)
    {
        if(is_string($role))
        {
            return $this->roles->contains('name', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }

    //gives the user the role
    public function assignRole($role)
    {
        return $this->roles()->save(
            Roles::whereName($role)->firstOrFail()
        );
    }

    //Checks whether the user has a role with that permission
    public function hasPermission($permission)
    {
        return $this->hasRole($permission->roles);
    }
}

?>