<?php

namespace App\Modules\workshops\controllers;

use \App\Http\Controllers\Controller as Controller;
use App\Modules\workshops\Repositories\CategoryRepository;

class categoriesController extends Controller {

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return Json Header
     *
     */
    public function _create() {

        $category = CategoryRepository::create();

        return !array_key_exists('errors', $category) ?
                \Response::Json($category, 201) :
                \Response::Json(['messages' => $category['messages']], 400);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return Json Header
     *
     */
    public function _all() {

        $category = CategoryRepository::all();

        return !array_key_exists('errors', $category) ?
                \Response::Json($category, 200) :
                \Response::Json(['messages' => $category['messages']], 400);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return Json Header
     *
     */
    public function _update($id) {

        $category = CategoryRepository::update($id);

        return !array_key_exists('errors', $category) ?
                \Response::Json($category, 200) :
                \Response::Json(['messages' => $category['messages']], 400);
    }

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     *
     */
    public function _delete($id) {

        $deleted = CategoryRepository::delete($id);

        return !array_key_exists('errors', $deleted) ?
                \Response::Json($deleted, 200) :
                \Response::Json(['messages' => $deleted['messages']], 404);
    }

    public function _show($id) {

        $category = CategoryRepository::show($id);

        return !array_key_exists('errors', $category) ?
                \Response::Json($category, 200) :
                \Response::Json(['messages' => $category['messages']]);
    }

    public function _dataTables() {

        $dataTable = CategoryRepository::DataTable();

        return $dataTable;
    }

}
