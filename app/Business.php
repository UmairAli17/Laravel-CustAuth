<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'id', 'user_id', 'name', 'description', 'address', 'phone', 'logoFileName'];

    protected $table = 'businesses';



    //a business can have an owner
    public function user()
    {
    	return $this->belongsTo(User::class);
    }


    //a business can have many reviews
    public function review()
    {
    	return $this->hasManyThrough(Posts::class, Residence::class, 'business_id', 'residence_id');
    }

    //this landlord business has many residences
    public function residence()
    {
        return $this->hasMany(Residence::class);
    }

}
