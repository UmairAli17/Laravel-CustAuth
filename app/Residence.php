<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{

	protected $fillable = ['name', 'street', 'city', 'postcode', 'business_id'];

	public $timestamps = false;


	//connect the residence to a business
    public function business(){
    	return $this->belongsTo(Business::class);
    }

    public function scopeSearch($query, $searchTerm)
    {
        $query->where('name', 'LIKE', "%{$searchTerm}%")
        	orWhere('street', 'LIKE', "%{$searchTerm}%")
        	orWhere('city', 'LIKE', "%{$searchTerm}%");
        	orWhere('postcode', 'LIKE', "%{$searchTerm}%");
    }

    
}