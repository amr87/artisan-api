<?php

namespace App\Modules\chat\models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\users\models\User as User;

class Conversation extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'conversations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function messages() {

        return $this->hasMany(Message::class);
    }

    public function users() {

        return $this->belongsToMany(User::class);
    }

    public function scopeRecent($query) {

        return $query->orderBy('updated_at', 'DESC');
    }

}
