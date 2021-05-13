<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Accommodation extends Model
{
    use SoftDeletes;
    use HasTranslations;


    public $translatable = ['name','description'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accommodation';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'city_id', 'user_id', 'category_id', 'type_id', 'description', 'capacity', 'deposit', 'longitude', 'latitude', 'website', 'address', 'youtube_link', 'priority', 'premium', 'status'];

    public function user()
	{
		return $this->belongsTo('App\User');
	}
	public function city()
	{
		return $this->belongsTo('App\City');
	}
	public function type()
	{
		return $this->belongsTo('App\Type');
	}
	public function category()
	{
		return $this->belongsTo('App\Category');
	}
    public function rentings()
    {
        return $this->belongsToMany('App\Renting',"accommodation_rentings")->withTimestamps();
    }
	public function periods()
	{
		return $this->belongsToMany('App\Period')->withTimestamps();
	}

	public function characteristics()
	{
		return $this->belongsToMany('App\Characteristic', "accommodation_characteristic")->withTimestamps();
	}

	public function distances()
    {
        return $this->belongsToMany('App\Distance',"accommodation_distances")->withPivot("distance")->withTimestamps();
    }

    public function accommodation_units()
    {
        return $this->hasMany("App\AccommodationUnit");
    }
	
}
