<?php

namespace App\Modules\users\controllers;

use \App\Http\Controllers\Controller as Controller;
use App\Modules\users\Repositories\RoleRepository;

class rolesController extends Controller {

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return Json Header
     *
     */
    public function _create() {

        $role = RoleRepository::create();

        return !array_key_exists('errors', $role) ? 
                \Response::Json($role, 201) :
                \Response::Json(['messages' => $role['messages']], 400);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _roles() {

        $roles = RoleRepository::all();

        return !array_key_exists('errors', $roles) ?
                \Response::Json($roles, 200) :
                \Response::Json(['messages' => $roles['messages']], 404);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _delete($id) {

        $deleted = RoleRepository::delete($id);

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
    public function _update($id) {

        $role = RoleRepository::update($id);

        return !array_key_exists('errors', $role) ? 
                \Response::Json($role, 200) :
                \Response::Json(['messages' => $role['messages']], 400);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _show($id) {

        $role = RoleRepository::show($id);

        return !array_key_exists('errors', $role) ?
                \Response::Json($role, 200) :
                \Response::Json(['messages' => $role['messages']], 400);
    }
    
        public function _dataTables() {

        $dataTable = RoleRepository::DataTable();
        
        return $dataTable;
    }

}
