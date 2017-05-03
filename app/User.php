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

    //turns dates to carbon
    protected $dates = ['created_at'];
    
    /**
     * [user has many posts]
     * @return [type] [description]
     */
    
    public function posts() {
        return $this->hasMany(Posts::class);
    }

    public function approvedUserPosts() {
        return $this->hasMany(Posts::class)->status('1');
    }


    /**
     * [user has many posts]
     * @return [type] [description]
     */
    public function residences() {
         return $this->hasManyThrough(Residence::class,  Business::class, 'user_id', 'business_id', 'id');
    }
    
    /**
     * [user has one profile]
     * @return [type] [description]
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    //Creates Many to Many Relationship between Users table (and model) and Roles Table (and model)
    public function roles()
    {
        return $this->belongsToMany(Roles::class);
    }
    
    //USER has only one business
    public function business()
    {
        return $this->hasOne(Business::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'user_id');
    }
    

    //Checks for a specific role
    public function hasRole($role)
    {
        //if i pass a string into hasRole anywhere in the app, then get it as a single result
        //it will check whether "admin" is part of the string result
        if(is_string($role))
        {
            return $this->roles->contains('name', $role);
        }
        //This will check whether the role is part of an array;

        //the following will check for a specific value that's equal to the parameter that I've passed into hasRole should I end up returning a collection.
        //format is: return !! $parameter->intersect($this->relationship)->count
        //                                                                 count makes sure it goes through the whole collection
        return !! $role->intersect($this->roles)->count();

        //I could have also done this:
        //It says run the function and get each role that equals to my parameter and return true or if it there's nothing, return false
        /*foreach ($role as $r) {
            if($this->hasRole($r->name))
                {
                    return true;
                }
            return false;
        }*/
    }

    //gives the user the role
    public function assignRole($role)
    {
        return $this->roles()->save(
            Roles::whereName($role)->firstOrFail()
        );
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
    
    //Check if user is a Landlord.
    public function isLandlord() 
    {
       return in_array(2, $this->roles()->pluck('roles_id')->all());
    }

    public function landlordResOwner($related){
        //this works
        if($this->hasRole('landlord'))
        {
            return $this->residences()->where('residences.id', $related->id)->first();
        }

        // return $this->residences()->where('residences.id', $related->id)->first();
                    // return $this->residences()->where('id', $related->id)->first();

        // return $this->load('business.residence')->where('id', $related->id)->get();
    }

}
