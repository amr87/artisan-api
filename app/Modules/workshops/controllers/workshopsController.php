<?php

namespace App\Modules\workshops\controllers;

use \App\Http\Controllers\Controller as Controller;
use App\Modules\workshops\Repositories\WorkshopRepository;
use \App\Modules\workshops\models\Workshop as Workshop;

class workshopsController extends Controller {

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return Json Header
     *
     */
    public function _create() {

        $conversation = ConversationRepository::create();

        return !array_key_exists('errors', $conversation) ?
                \Response::Json($conversation, 201) :
                \Response::Json(['messages' => $conversation['messages']], 400);
    }

   
    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _delete($id) {

        $deleted = ConversationRepository::delete($id);

        return !array_key_exists('errors', $deleted) ?
                \Response::Json($deleted, 200) :
                \Response::Json(['messages' => $deleted['messages']], 404);
    }
    
   
    
    public function _show($id) {

        $conversation = ConversationRepository::show($id);

        return !array_key_exists('errors', $conversation) ?
                \Response::Json($conversation, 200) :
                \Response::Json(['messages' => $conversation['messages']]);
    }
    
    public function _getUserConversations($id) {

        $conversation = ConversationRepository::getUserConversations($id);

        return !array_key_exists('errors', $conversation) ?
                \Response::Json($conversation, 200) :
                \Response::Json(['messages' => $conversation['messages']],404);
    }

}
