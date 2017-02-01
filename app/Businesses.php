<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Businesses extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'id', 'user_id', 'name', 'description', 'logoFileName', 'logoFilePath' ];

    
    //a business can have an owner
    public function user()
    {
    	return $this->belongsTo(User::class);
    }


    //a business can have many reviews
    public function reviews()
    {
    	return $this->hasMany(Posts::class);
    }

    //this landlord business has many residences
    public function residence()
    {
        return $this->hasMany(Residence::class);
    }
}
