<?php

namespace App\Modules\workshops\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model {

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'parent_id'];

    public function children() {

        return $this->hasMany(static::class, 'parent_id');
    }

    public function parent() {

         return $this->belongsTo(static::class, 'parent_id');

    }

    public function workshops() {

        return $this->hasMany(Workshop::class);
        
    }

}
