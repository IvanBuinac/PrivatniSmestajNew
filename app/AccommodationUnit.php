<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccommodationUnit extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accommodation_units';

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
    protected $fillable = ['name', 'accommodation_id', 'description', 'space_number', 'species_id'];

    public function accommodation()
	{
		return $this->belongsTo('App\Accommodation');
	}

	public function species()
    {
        return $this->belongsTo('App\Species');
    }
	
}
