<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Distance extends Model
{
    use SoftDeletes;
    use HasTranslations;

    public $translatable = ['name'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'distances';

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
    protected $fillable = ['name',"distance"];

    public function accommodations()
    {
        return $this->belongsToMany('App\Accommodation',"accommodation_distances")->withPivot("distance")->withTimestamps();
    }
}
