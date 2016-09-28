<?php

namespace App;
use Carbon\Carbon;

    
use Illuminate\Foundation\Auth\User as Authenticatable;
//use App\Http\Controllers\traits\HasRoles;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //If register dont work or passwords arent being recognised then remove the following:

    /* public function setPasswordAttribute($password) 
    { 
        return $this->attributes['password'] = bcrypt($password); 
    }*/

    //turns dates to carbon
    protected $dates = ['created_at'];
    
    // A user can have multiple posts
    public function posts() {
        return $this->hasMany(Posts::class);
    }
    

    //Creates Many to Many Relationship between Users table (and model) and Roles Table (and model)
    public function roles()
    {
        return $this->belongsToMany(Roles::class);
    }

    //Checks for a specific role
    public function hasRole($role)
    {
        //if the result is out putted as a string then each result(s) (which will be from the name column) be equal to the $role parameter. I.e. 
        //it will check whether "admin" is part of the string result
        if(is_string($role))
        {
            return $this->roles->contains('name', $role);
        }
        //This will check whether the role is part of an array;

        //This is done so that the function actively looks for a result that matches whatever has been passed through the parameter.
        //One example is that if paramater asks for "admins" but the user has roles of "admin", "author" and "student"; it'll only get the "admin" from there. It essentially 
        //chooses what to get from the result.
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

    public function owns($related)
    {
        return $this->id === $related->user_id;
    }

    //Check if user is an Admin.
    public function isAdmin() 
    {
       return in_array(1, $this->roles()->pluck('roles_id')->all());
    }
    
    
}
