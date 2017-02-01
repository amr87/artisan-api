<?php

namespace App\Modules\workshops\Repositories;

use Illuminate\Support\FacadesInput as Input;
use App\Modules\workshops\models\Category as Category;
use Yajra\Datatables\Datatables as DataTables;

class CategoryRepository {

    protected static $relations = ['children', 'parent'];

    public static function create() {
        // validator

        $validator = \Validator::make(Input::all(), [
                    'name' => 'required|min:3|max:128'
        ]);

        if ($validator->fails()) {

            $errors = array_values($validator->errors()->getMessages());
            $errors = array_flatten($errors);

            return array("errors" => true, "messages" => $errors);
        }

        $category = Category::create([
                    "name" => Input::get('name'),
                    "parent_id" => Input::get('parent_id')
        ]);

        if ($category) {

            return $category;
        } else {
            return ["errors" => true, "messages" => ['could not create message']];
        }
    }

    public static function all() {


        $categories = Category::with(self::$relations)->get();

        return $categories;
    }

    public static function show($id) {
        if (empty(trim($id)))
            return array("errors" => true, "messages" => ['You must provide id']);

        $category = Category::with(self::$relations)->find($id);

        return $category;
    }

    public static function update($id) {

        if (empty(trim($id)))
            return array("errors" => true, "messages" => ["You must provide ID"]);
        $validator = \Validator::make(Input::all(), [
                    'name' => 'required|min:3|max:128'
        ]);

        if ($validator->fails()) {

            $errors = array_values($validator->errors()->getMessages());
            $errors = array_flatten($errors);

            return array("errors" => true, "messages" => $errors);
        }

        $category = Category::find($id);

        if ($category) {

            $inputs = [
                "name" => Input::get('name'),
                "parent_id" => Input::get('parent_id'),
            ];


            $updated = $category->update($inputs);

            if ($updated) {

                return $category;
            } else {
                return array("errors" => true, "messages" => ['Could not update Category']);
            }
        } else {
            return array("errors" => true, "messages" => ['Category Not Found']);
        }
    }

    public static function delete($id) {

        if (is_null($id))
            return array("errors" => true, "messages" => ['You must provide your id']);

        $category = Category::find($id);

        if ($category) {
            $deleted = $category->delete();
            if ($deleted) {
                return $category;
            } else {
                return array("errors" => true, "messages" => ['Category could not be deleted']);
            }
        } else {
            return array("errors" => true, "messages" => ['Category could not be found']);
        }
    }

    public static function DataTable() {


        $categories = Category::with(self::$relations)->select('*')->orderBy('name', 'ASC');

        return Datatables::of($categories)
                        ->editColumn('id', function ($category) {
                            return "<a class='btn  bg-orange btn-xs' href='categories/" . $category->id . "/edit'><span class='fa fa-edit'> Edit</span></a>
                                <a onclick='return confirm_delete()' class= 'btn  bg-maroon btn-xs' href='categories/" . $category->id . "/delete'><span class='fa fa-ban'> Delete</span></a>
                                ";
                        })
                        ->editColumn('parent_id', function ($category) {
                            if (!empty($category->children)) {
                                $output = "<ul>";
                                foreach ($category->children as $child) {
                                    $output.="<li>" . $child->name . "</li>";
                                }
                                $output.="</ul>";
                                return $output;
                            }
                            return "";
                        })
                        ->make(true);
    }

}
