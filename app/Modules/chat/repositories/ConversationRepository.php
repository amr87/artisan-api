<?php

namespace App\Modules\chat\Repositories;

use Illuminate\Support\Facades\Input as Input;
use \App\Modules\chat\models\Message as Message;
use \App\Modules\chat\models\Conversation as Conversation;

class ConversationRepository {

    protected static $relations = ['messages', 'users'];

    public static function create() {


        if (NULL == Input::get('group_chat')) {

            $participants = [];

            $participants[] = \App\Modules\users\models\User::find(Input::get('ID'))->username;
            $participants[] = \App\Modules\users\models\User::find(Input::get('to_id'))->username;

            $name1 = implode("-", $participants);
            $name2 = implode("-", array_reverse($participants));

            $Oconversation = Conversation::where('name', $name1)->orWhere('name', $name2)->get();

            if (empty($Oconversation->toArray())) {

                $conversation = Conversation::create([
                            'name' => $name1
                ]);

                if ($conversation) {

                    $conversation->users()->sync([Input::get('ID'), Input::get('to_id')]);

                    return $conversation;
                } else {

                    return ["errors" => true, "messages" => ['could not create message']];
                }
            } else {

                return $Oconversation[0];
            }
        }
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
