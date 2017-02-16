<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residences extends Model
{
    protected $table = 'residences';

    public function landlord_business(){
    	return $this->belongsTo(Business::class);
    }

    public function posts()
    {
    	return $this->hasMany(Posts::class, 'residence_id');
    }


}
