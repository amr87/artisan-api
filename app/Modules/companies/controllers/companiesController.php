<?php

namespace App\Modules\companies\controllers;

use \App\Http\Controllers\Controller as Controller;
use App\Modules\companies\Repositories\CompanyRepository;
use \App\Modules\companies\models\Company as Company;

class companiesController extends Controller {

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return Json Header
     *
     */
    public function _create() {

        $conversation = CompanyRepository::create();

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

        $deleted = CompanyRepository::delete($id);

        return !array_key_exists('errors', $deleted) ?
                \Response::Json($deleted, 200) :
                \Response::Json(['messages' => $deleted['messages']], 404);
    }
    
   
    
    public function _show($id) {

        $conversation = CompanyRepository::show($id);

        return !array_key_exists('errors', $conversation) ?
                \Response::Json($conversation, 200) :
                \Response::Json(['messages' => $conversation['messages']]);
    }
    
    public function _getUserConversations($id) {

        $conversation = CompanyRepository::profile($id);

        return !array_key_exists('errors', $conversation) ?
                \Response::Json($conversation, 200) :
                \Response::Json(['messages' => $conversation['messages']],404);
    }

}
