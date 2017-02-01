<?php

namespace App\Modules\locations\controllers;

use \App\Http\Controllers\Controller as Controller;
use App\Modules\locations\Repositories\CountryRepository;

class countriesController extends Controller {

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return Json Header
     *
     */
    public function _create() {

        $country = CountryRepository::create();

        return !array_key_exists('errors', $country) ?
                \Response::Json($country, 201) :
                \Response::Json(['messages' => $country['messages']], 400);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _countries() {

        $countries = CountryRepository::all();

        return !array_key_exists('errors', $countries) ?
                \Response::Json($countries, 200) :
                \Response::Json(['messages' => $countries['messages']], 404);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _delete($id) {

        $deleted = CountryRepository::delete($id);

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

        $country = CountryRepository::update($id);

        return !array_key_exists('errors', $country) ?
                \Response::Json($country, 200) :
                \Response::Json(['messages' => $country['messages']], 400);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _show($id) {

        $country = CountryRepository::show($id);

        return !array_key_exists('errors', $country) ?
                \Response::Json($country, 200) :
                \Response::Json(['messages' => $country['messages']], 400);
    }

    public function _dataTables() {

        $dataTable = CountryRepository::DataTable();

        return $dataTable;
    }
    
    
    public function _StatesdataTables($id) {

        $dataTable = CountryRepository::StatesDataTable($id);

        return $dataTable;
    }

}
