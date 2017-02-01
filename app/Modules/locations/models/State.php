<?php

namespace App\Modules\locations\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class State extends Model  {

        use SoftDeletes;
     

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'states';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','country_id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    public function country(){
        
        return $this->belongsTo(Country::class);
    }
    
    public function districts(){
        
        return $this->hasMany(District::class);
    }

}
