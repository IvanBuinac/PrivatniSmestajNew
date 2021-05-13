<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use SoftDeletes;
    use HasTranslations;

    public $translatable = ['name','path'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'City';

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
    protected $fillable = ['name','path','zoom','state_id',"longitude","latitude","status"];

    public function state()
    {
        return $this->belongsToMany('App\State', "states_id");
    }

    public function states()
    {
        return $this->belongsTo('App\State',"states_id");
    }
}
