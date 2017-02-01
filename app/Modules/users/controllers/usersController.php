<?php

namespace App\Modules\users\controllers;

use \App\Http\Controllers\Controller as Controller;
use App\Modules\users\Repositories\UserRepository;

class usersController extends Controller {

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _users() {

        $users = UserRepository::all();

        return !array_key_exists('errors', $users) ?
                \Response::Json($users, 200) :
                \Response::Json(['messages' => $users['messages']], 404);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _dataTables() {

        $dataTable = UserRepository::DataTable();
        
        return $dataTable;
    }
    
    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _TrasheddataTables() {

        $dataTable = UserRepository::TrashedDataTable();
        
        return $dataTable;
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return Json Header
     *
     */
    public function _register() {

        $user = UserRepository::create();

        return !array_key_exists('errors', $user) ?
                \Response::Json($user, 201) :
                \Response::Json(['messages' => $user['messages']], 400);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _authenticate() {

        $user = UserRepository::login();
        return !array_key_exists('errors', $user) ?
                \Response::Json($user, 200) :
                \Response::Json(['messages' => $user['messages']], 401);
    }
    
    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _authCookie() {

        $user = UserRepository::authCookie();
        return !array_key_exists('errors', $user) ?
                \Response::Json($user, 200) :
                \Response::Json(['messages' => $user['messages']], 401);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _delete($id) {

        $deleted = UserRepository::delete($id);

        return !array_key_exists('errors', $deleted) ?
                \Response::Json($deleted, 200) :
                \Response::Json(['messages' => $deleted['messages']], 400);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _update($id) {

        $user = UserRepository::update($id);

        return !array_key_exists('errors', $user) ?
                \Response::Json($user, 200) :
                \Response::Json(['messages' => $user['messages']], 400);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _profile($id) {

        $user = UserRepository::profile($id);

        return !array_key_exists('errors', $user) ?
                \Response::Json($user, 200) :
                \Response::Json(['messages' => $user['messages']], 400);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _forgetPassword() {

        $forget = UserRepository::forgetPassword();
        return !is_array($forget) ?
                \Response::Json(["Password Reset success"], 200) :
                \Response::Json(['messages' => $forget['messages']], 400);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _resetPassword() {

        $reset = UserRepository::resetPassword();
        return !is_array($reset) ?
                \Response::Json($reset, 200) :
                \Response::Json(['messages' => $reset['messages']], 400);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _facebookConnect() {
        $user = UserRepository::facebookConnect();
        return !array_key_exists('errors', $user) ?
                \Response::Json($user, 200) :
                \Response::Json(['messages' => $user['messages']], 400);
    }
    
    public function _uploadAvatar(){
        
        $upload = UserRepository::uploadAvatar();
         return !array_key_exists('errors', $upload) ?
                \Response::Json($upload, 200) :
                \Response::Json(['messages' => $upload['messages']], 400);
     
    }
    
    
    public function _search(){
        
        $user = UserRepository::search();
         return !array_key_exists('errors', $user) ?
                \Response::Json($user, 200) :
                \Response::Json(['messages' => $user['messages']], 400);
     
    }
    
    public function _restore($id){
        
        $user = UserRepository::restore($id);
         return !array_key_exists('errors', $user) ?
                \Response::Json($user, 200) :
                \Response::Json(['messages' => $user['messages']], 400);
     
    }
    
    public function _forceDelete($id){
        
        $user = UserRepository::forceDelete($id);
         return !array_key_exists('errors', $user) ?
                \Response::Json($user, 200) :
                \Response::Json(['messages' => $user['messages']], 400);
     
    }

}
