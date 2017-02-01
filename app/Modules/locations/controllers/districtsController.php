<?php

namespace App\Modules\locations\controllers;

use \App\Http\Controllers\Controller as Controller;
use App\Modules\locations\Repositories\DistrictRepository;

class districtsController extends Controller {

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return Json Header
     *
     */
    public function _create() {

        $district = DistrictRepository::create();

        return !array_key_exists('errors', $district) ? 
                \Response::Json($district, 201) :
                \Response::Json(['messages' => $district['messages']], 400);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _districts() {

        $districts = DistrictRepository::all();

        return !array_key_exists('errors', $districts) ?
                \Response::Json($districts, 200) :
                \Response::Json(['messages' => $districts['messages']], 404);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _delete($id) {

        $deleted = DistrictRepository::delete($id);

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

        $district = DistrictRepository::update($id);

        return !array_key_exists('errors', $district) ? 
                \Response::Json($district, 200) :
                \Response::Json(['messages' => $district['messages']], 400);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _show($id) {

        $district = DistrictRepository::show($id);

        return !array_key_exists('errors', $district) ?
                \Response::Json($district, 200) :
                \Response::Json(['messages' => $district['messages']], 400);
    }
    
        public function _dataTables() {

        $dataTable = DistrictRepository::DataTable();
        
        return $dataTable;
    }

}
