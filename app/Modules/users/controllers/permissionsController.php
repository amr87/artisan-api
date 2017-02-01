<?php

namespace App\Modules\users\controllers;

use \App\Http\Controllers\Controller as Controller;
use App\Modules\users\Repositories\PermissionRepository;

class permissionsController extends Controller {

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return Json Header
     *
     */
    public function _create() {

        $permission = PermissionRepository::create();

        return !array_key_exists('errors', $permission) ?
                \Response::Json($permission, 201) :
                \Response::Json(['messages' => $permission['messages']], 400);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _roles() {

        $permissions = PermissionRepository::all();

        return !array_key_exists('errors', $permissions) ?
                \Response::Json($permissions, 200) :
                \Response::Json(['messages' => $permissions['messages']], 404);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _delete($id) {

        $deleted = PermissionRepository::delete($id);

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

        $permission = PermissionRepository::update($id);

        return !array_key_exists('errors', $permission) ?
                \Response::Json($permission, 200) :
                \Response::Json(['messages' => $permission['messages']], 400);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _show($id) {

        $permission = PermissionRepository::show($id);

        return !array_key_exists('errors', $permission) ?
                \Response::Json($permission, 200) :
                \Response::Json(['messages' => $permission['messages']], 400);
    }

    public function _dataTables() {

        $dataTable = PermissionRepository::DataTable();

        return $dataTable;
    }

}
