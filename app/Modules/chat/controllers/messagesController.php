<?php

namespace App\Modules\chat\controllers;

use Illuminate\Support\Facades\Input as Input;
use \App\Http\Controllers\Controller as Controller;
use App\Modules\chat\Repositories\MessageRepository;
use \App\Modules\chat\models\Message as Message;

class messagesController extends Controller {

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return Json Header
     *
     */
    public function _create() {

        $message = MessageRepository::create();

        return !array_key_exists('errors', $message) ?
                \Response::Json($message, 201) :
                \Response::Json(['messages' => $message['messages']], 400);
    }

   
    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _delete($id) {

        $deleted = MessageRepository::delete($id);

        return !array_key_exists('errors', $deleted) ?
                \Response::Json($deleted, 200) :
                \Response::Json(['messages' => $deleted['messages']], 404);
    }
    
    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _getConversation($from,$to) {
        
        $skip = Input::get('limit');
        
        $limit = $skip != NULL ? $skip : 0 ;

        $conversation = Message::findConversation($to, $from,$limit);

        return $conversation ?
                \Response::Json($conversation, 200) :
                \Response::Json(['messages' => 'invalid conversation'], 404);
    }
    
    
    public function _show($id) {

        $message = MessageRepository::show($id);

        return !array_key_exists('errors', $message) ?
                \Response::Json($message, 200) :
                \Response::Json(['messages' => $message['messages']]);

   
}

    public function _seen() {

        $ids = Input::get('id');
        
        $message = MessageRepository::seen($ids);

        return !array_key_exists('errors', $message) ?
                \Response::Json($message, 200) :
                \Response::Json(['messages' => $message['messages']]);

   
}

}
