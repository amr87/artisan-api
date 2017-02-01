<?php

namespace App\Modules\locations\controllers;

use \App\Http\Controllers\Controller as Controller;
use App\Modules\locations\Repositories\StateRepository;

class statesController extends Controller {

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _states() {

        $states = StateRepository::all();

        return !array_key_exists('errors', $states) ?
                \Response::Json($states, 200) :
                \Response::Json(['messages' => $states['messages']], 404);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return Json Header
     *
     */
    
    public function _create() {

        $state = StateRepository::create();

        return !array_key_exists('errors', $state) ?
                \Response::Json($state, 201) :
                \Response::Json(['messages' => $state['messages']], 400);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _dataTables() {

        $dataTable = StateRepository::DataTable();

        return $dataTable;
    }

    public function _delete($id) {

        $deleted = StateRepository::delete($id);

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

        $state = StateRepository::update($id);

        return !array_key_exists('errors', $state) ?
                \Response::Json($state, 200) :
                \Response::Json(['messages' => $state['messages']], 400);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _show($id) {

        $state = StateRepository::show($id);

        return !array_key_exists('errors', $state) ?
                \Response::Json($state, 200) :
                \Response::Json(['messages' => $state['messages']], 400);
    }
    
        public function _DistrictsdataTables($id) {

        $dataTable = StateRepository::DistrictsDataTable($id);

        return $dataTable;
    }

}
