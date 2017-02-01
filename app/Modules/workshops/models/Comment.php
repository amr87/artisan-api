<?php

namespace App\Modules\workshops\models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\users\models\User as User;

class Comment extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'body', 'workshop_id', 'rate'];


    public function user() {

        return $this->belongsTo(User::class);
    }

    public function workshop() {

        return $this->belongsTo(Workshop::class);
        
    }
    


   

}
