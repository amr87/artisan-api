<?php

namespace App\Modules\companies\controllers;

use \App\Http\Controllers\Controller as Controller;
use App\Modules\companies\Repositories\CompanyRepository;
use \App\Modules\companies\models\Company as Company;

class companiesController extends Controller {

    public function _dataTables() {

        $dataTable = CompanyRepository::DataTable();

        return $dataTable;
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return Json Header
     *
     */
    public function _create() {

        $company = CompanyRepository::create();

        return !array_key_exists('errors', $company) ?
                \Response::Json($company, 201) :
                \Response::Json(['messages' => $company['messages']], 400);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _update($id) {

        $deleted = CompanyRepository::update($id);

        return !array_key_exists('errors', $deleted) ?
                \Response::Json($deleted, 200) :
                \Response::Json(['messages' => $deleted['messages']], 404);
    }
    public function _delete($id) {

        $deleted = CompanyRepository::delete($id);

        return !array_key_exists('errors', $deleted) ?
                \Response::Json($deleted, 200) :
                \Response::Json(['messages' => $deleted['messages']], 404);
    }

    public function _show($id) {

        $company = CompanyRepository::show($id);

        return !array_key_exists('errors', $company) ?
                \Response::Json($company, 200) :
                \Response::Json(['messages' => $company['messages']]);
    }

    public function _restore($id) {

        $company = CompanyRepository::restore($id);

        return !array_key_exists('errors', $company) ?
                \Response::Json($company, 200) :
                \Response::Json(['messages' => $company['messages']]);
    }


}
