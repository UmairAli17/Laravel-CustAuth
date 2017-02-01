<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{

	protected $fillable = ['name', 'street', 'city', 'postcode', 'business_id'];

	public $timestamps = false;


	//connect the residence to a business
    public function business(){
    	return $this->belongsTo(Businesses::class);
    }
}
