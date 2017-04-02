<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{

	protected $fillable = ['name', 'street', 'city', 'postcode', 'residence_id'];
    protected $table = 'residences';
	public $timestamps = false;


	//connect the residence to a business
    public function landlord_business(){
    	return $this->belongsTo(Business::class);
    }

    public function posts(){
        return $this->hasMany(Posts::class);
    }

    public function scopeSearch($query, $searchTerm)
    {
        $query->where('name', 'LIKE', "%$searchTerm%")
        	->orWhere('street', 'LIKE', "%$searchTerm%")
        	->orWhere('city', 'LIKE', "%$searchTerm%")
        	->orWhere('postcode', 'LIKE', "%$searchTerm%");
    }

    
}