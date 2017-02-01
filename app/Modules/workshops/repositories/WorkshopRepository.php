<?php

namespace App\Modules\chat\Repositories;

use Illuminate\Support\Facades\Input as Input;
use \App\Modules\workshops\models\Workshop as Workshop;


class WorkshopRepository {

    protected static $relations = ['messages', 'users'];

    public static function create($user) {
            
        $workshop = new Workshop;
        
        $workshop->name        = $user->username;
        $workshop->user_id     = $user->id;
        $workshop->type        = Input::get('type');
        $workshop->district_id = Input::get('district_id');
        $workshop->category_id = Input::get('category_id');
        
        
          
    }

    public static function show($id) {
        if (empty(trim($id)))
            return array("errors" => true, "messages" => ['You must provide id']);

        $conversation = Conversation::with(self::$relations)->find($id);

        return $conversation;
    }

    public static function delete($id) {

        if (is_null($id))
            return array("errors" => true, "messages" => ['You must provide your id']);

        $conversation = Conversation::find($id);

        if ($conversation) {

            $deleted = $conversation->delete();

            if ($deleted) {

                return $conversation;
            } else {

                return array("errors" => true, "messages" => ['Conversation could not be deleted']);
            }
        } else {

            return array("errors" => true, "messages" => ['Conversation could not be found']);
        }
    }

    public static function getUserConversations($id) {

        $user = \App\Modules\users\models\User::find($id);

        if (!$user)
            return array("errors" => true, "messages" => ['User could not be found']);

        $conversations = $user->conversations()->Recent()->get();

        if (empty($conversations) || NULL == $conversations)
            return array("errors" => true, "messages" => ['User has no conversations']);

        foreach ($conversations as $conversation) {

            $conversation->messages = $conversation->messages()->LastMessage()->get();
        }

        return $conversations;
    }

}
