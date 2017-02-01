<?php

namespace App\Modules\workshops\models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\users\models\User as User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workshop extends Model {
    
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'workshops';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'address', 'longitude', 'latitude', 'views' ,'district_id', 'category_id'];

    /*
     * Disable TimeStamps
     * 
     */
 

    public static function findCommercial() {

        $workshops = self::with(['user', 'reviews'])
                ->where('type','1')
                ->get();
        return !empty($workshops->toArray()) ? $workshops : false;
    }
    
    public static function findPrivate() {

        $workshops = self::with(['user', 'reviews'])
                ->where('type','0')
                ->get();
        return !empty($workshops->toArray()) ? $workshops : false;
    }

    public function user() {

        return $this->belongsTo(User::class);
    }

    public function reviews() {

        return $this->belongsTo(Comments::class);
        
    }
    
    public function zone() {

        return $this->belongsTo(\App\Modules\locations\models\District::class);
        
    }
    
    public function category() {

        return $this->belongsTo(Category::class);
        
    }
    
    public function items() {

        return $this->hasMany(Item::class);
        
    }

   

}
