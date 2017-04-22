<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{

	protected $fillable = ['name', 'street', 'city', 'postcode', 'residence_id'];
    protected $table = 'residences';


	//connect the residence to a business
    public function landlord_business(){
    	return $this->belongsTo(Business::class, 'business_id');
    }

    public function posts(){
        return $this->hasMany(Posts::class);
    }

    public function approved_posts()
    {
        return $this->hasMany(Posts::class)->status('1')->orderBy('post_rating','DESC')->orderBy('created_at');
    }

    public function scopeSearch($query, $searchTerm)
    {
        //Search through residence table
        $query->where('name', 'LIKE', "%$searchTerm%")
        	->orWhere('street', 'LIKE', "%$searchTerm%")
        	->orWhere('city', 'LIKE', "%$searchTerm%")
        	->orWhere('postcode', 'LIKE', "%$searchTerm%")
                //then if not found to look into the relation and look for a business name
                ->orWhereHas('landlord_business', function($query) use ($searchTerm) {
                        $query->where('name', 'LIKE', "%$searchTerm%")
                            // or then look into the actual name for that landlord rather than business name
                            ->orWhereHas('user', function($query) use ($searchTerm) {
                                $query->where('name', 'LIKE', "%$searchTerm%");
                            });
                });
    }

    
}