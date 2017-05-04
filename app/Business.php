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



    /**
     * User Can have One Business Only One-to-One Inverse
     * @return [type] [description]
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }


    /**
     * Business Can be Reviewed Many Through through the Posts & residenceRClass
     * @return [type] [description]
     */
    public function review()
    {
    	return $this->hasManyThrough(Posts::class, Residence::class, 'business_id', 'residence_id');
    }

    /**
     * One-to-Many: Business Can have Many Residences
     * @return [type] [description]
     */
    public function residence()
    {
        return $this->hasMany(Residence::class);
    }

}
