<?php

namespace App\Modules\chat\Repositories;

use Illuminate\Support\Facades\Input as Input;
use \App\Modules\chat\models\Message as Message;
use \App\Modules\chat\models\Conversation as Conversation;

class MessageRepository {

    protected static $relations = ['sender', 'receiver'];

    public static function create() {
        // validator

        $validator = \Validator::make(Input::all(), [
                    'text' => 'required',
                    'to_id' => 'required',
        ]);

        if ($validator->fails()) {

            $errors = array_values($validator->errors()->getMessages());
            $errors = array_flatten($errors);

            return array("errors" => true, "messages" => $errors);
        }

        $conversation = ConversationRepository::create();

        $conversation_id = is_object($conversation) ? $conversation->id : 0;

        $message = Message::create([
                    "from_id" => Input::get('ID'),
                    "to_id" => Input::get('to_id'),
                    "conversation_id" => $conversation_id,
                    "text" => Input::get('text'),
                    "seen" => '0',
                    "sent_at" => \Carbon\Carbon::now(),
        ]);

        if ($message) {

            if ($message->conversation != NULL && !empty($message->conversation)) {
                
                $message->conversation->updated_at = \Carbon\Carbon::now();
                $message->conversation->save();
                
            }

            return $message;
            
        } else {
            return ["errors" => true, "messages" => ['could not create message']];
        }
    }

    public static function show($id) {
        if (empty(trim($id)))
            return array("errors" => true, "messages" => ['You must provide id']);

        $message = Message::with(self::$relations)->find($id);

        return $message;
    }

    public static function seen($ids) {
        if (empty($ids))
            return array("errors" => true, "messages" => ['You must provide id']);
        $response = [];
        foreach ($ids as $id) {

            $message = Message::find($id);
            $message->seen = "1";
            $message->seen_at = \Carbon\Carbon::now();
            $message->save();

            $response[] = $message;
        }

        return $response;
    }

    public static function delete($id) {

        if (is_null($id))
            return array("errors" => true, "messages" => ['You must provide your id']);

        $message = Message::find($id);

        if ($message) {
            $deleted = $message->delete();
            if ($deleted) {
                return $message;
            } else {
                return array("errors" => true, "messages" => ['Message could not be deleted']);
            }
        } else {
            return array("errors" => true, "messages" => ['Message could not be found']);
        }
    }

}
