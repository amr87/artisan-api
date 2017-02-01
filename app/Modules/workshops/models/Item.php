<?php

namespace App\Modules\workshops\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model {
    
use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['workshop_id', 'name', 'views', 'description','price'];


    public function workshop() {

        return $this->belongsTo(Workshop::class);
        
    }
    


   

}
