<?php

namespace App\Modules\companies\models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\users\models\User as User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model {
    
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'address', 'longitude', 'latitude', 'phone' ,'address', 'email'];



    public function users() {

        return $this->hasMany(User::class);
    }

  
}
