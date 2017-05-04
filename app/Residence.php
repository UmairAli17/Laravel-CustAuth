<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{

	protected $fillable = ['name', 'street', 'city', 'postcode', 'residence_id', 'image'];
    protected $table = 'residences';


	/**
     * A Residence Can Belong only to One Business
     * @return [type] [description]
     */
    public function landlord_business(){
    	return $this->belongsTo(Business::class, 'business_id');
    }

    /**
     * A Residnece can have Many Reviews
     * @return [type] [description]
     */
    public function posts(){
        return $this->hasMany(Posts::class);
    }

    /**
     * Get All Approved Posts
     * @return [type] [description]
     */
    public function approved_posts()
    {
        return $this->hasMany(Posts::class)->status('1')->orderBy('post_rating','ASC')->orderBy('created_at', 'ASC');
    }

    /**
     * Dynamic Scope: Search and Filter Model Accoridng ot Parameter Passed. Display a Residence Where:
     Parameter meets any of its current table values or any of the below relations
     * @param  [type] $query      [description]
     * @param  [type] $searchTerm [description]
     * @return [type]             [description]
     */
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