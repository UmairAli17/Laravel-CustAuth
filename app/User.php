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

    /**
     * Get All of User's Approved Posts
     * @return [type] [description]
     */
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

    /**
     * User Can have many Roles
     * @return [type] [description]
     */
    public function roles()
    {
        return $this->belongsToMany(Roles::class);
    }
    
    /**
     * User has Only One Business
     * @return [type] [description]
     */
    public function business()
    {
        return $this->hasOne(Business::class);
    }

    /**
     * User can have Many Comments
     * @return [type] [description]
     */
    public function comments()
    {
        return $this->hasMany(Comments::class, 'user_id');
    }
    

    /**
     * Check If User Has Role by Passed Parameter
     * @param  [type]  $role Role - String
     * @return boolean       
     */
    public function hasRole($role)
    {
        if(is_string($role))
        {
            return $this->roles->contains('name', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }

    /**
     * Assign a Role to User
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
     * Allows One to Check Whether User Owns a Passed Model.
     * @param  [type] $related [description]
     * @return [type]          [description]
     */
    public function owns($related)
    {
        return $this->id === $related->user_id;
    }

    /**
     * Check if User is Admin
     * @return boolean [description]
     */
    public function isAdmin() 
    {
       return in_array(1, $this->roles()->pluck('roles_id')->all());
    }
    
    /**
     * Check if User is Landlord
     * @return boolean [description]
     */
    public function isLandlord() 
    {
       return in_array(2, $this->roles()->pluck('roles_id')->all());
    }

    /**
     * Check if the User is a Landlord and whether they own the residence
     * @param  [type] $related [description]
     * @return [type]          [description]
     */
    public function landlordResOwner($related){
        if($this->hasRole('landlord'))
        {
            return $this->residences()->where('residences.id', $related->id)->first();
        }
    }

}
