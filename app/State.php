<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class State extends Model
{
    use SoftDeletes;
    use HasTranslations;

    public $translatable = ['name','path'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'states';

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
    protected $fillable = ['name', 'path', 'latitude', 'longitude', 'zoom', 'status'];

    public function city()
    {
        return $this->belongsToMany('App\City', "states_id");
    }

    public function cities()
    {
        return $this->hasMany('App\City',"states_id");
    }
}
