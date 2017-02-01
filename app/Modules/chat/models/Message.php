<?php

namespace App\Modules\chat\models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\users\models\User as User;

class Message extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['from_id', 'to_id', 'text', 'seen', 'sent_at', 'seen_at', 'conversation_id'];

    /*
     * Disable TimeStamps
     * 
     */
    public $timestamps = false;

    public static function findConversation($to_id, $from_id, $skip) {

        $coversation = self::with(['sender', 'receiver'])
                ->whereRaw(' (to_id = ? AND from_id = ?) OR (to_id = ? AND from_id = ?)', [$to_id, $from_id, $from_id, $to_id])
                ->orderBy('sent_at', 'DESC')
                ->skip($skip)
                ->take(10)
                ->get();


        return !empty($coversation->toArray()) ? $coversation : false;
    }

    public function sender() {

        return $this->belongsTo(User::class, 'from_id');
    }

    public function receiver() {

        return $this->belongsTo(User::class, 'to_id');
    }

    public function conversation() {

        return $this->belongsTo(Conversation::class);
    }

    public function scopeLastMessage($query) {
        
         return $query->with(['sender','receiver'])->orderBy('sent_at','DESC')->limit(1);
         
    }

}
