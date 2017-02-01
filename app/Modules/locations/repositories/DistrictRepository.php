<?php

namespace App\Modules\locations\Repositories;

use Illuminate\Support\Facades\Input as Input;
use App\Modules\locations\models\District as District;
use Yajra\Datatables\Datatables as DataTables;

class DistrictRepository {

    private static $relations = [];//['state.country'];

    public static function DataTable() {


        $districts = District::with(self::$relations)->select('*')->orderBy('name', 'ASC');

        return Datatables::of($districts)
                        ->editColumn('updated_at', function ($district) {
                            return "<a class='btn  bg-orange btn-xs' href='districts/" . $district->id . "/edit'><span class='fa fa-edit'> Edit</span></a>
                                <a onclick='return confirm_delete()' class= 'btn  bg-maroon btn-xs' href='districts/" . $district->id . "/delete'><span class='fa fa-trash'> Delete</span></a>
                                ";
                        })
                        ->editColumn('created_at', function ($district) {

                            return $district->state->count();
                        })
                        ->make(true);
    }

    public static function create() {
        // validator

        $validator = \Validator::make(Input::all(), [
                    'name' => 'required|min:3|max:255',
                    'state_id' => 'required|integer'
        ]);

        if ($validator->fails()) {

            $errors = array_values($validator->errors()->getMessages());
            $errors = array_flatten($errors);

            return array("errors" => true, "messages" => $errors);
        }

        $district = Input::get('state_id');
        $name = Input::get('name');


        $district = District::create([
                    "name" => $name,
                    "state_id" => $district
        ]);

        if ($district) {
            return $district;
        } else {
            return ["errors" => true, "messages" => ['could not create state']];
        }
    }

    public static function update($id) {

        if (empty(trim($id)))
            return array("errors" => true, "messages" => ["You must provide ID"]);
        $validator = \Validator::make(Input::all(), [
                    'name' => 'required|min:3|max:255',
                    'state_id' => 'required|integer'
        ]);

        if ($validator->fails()) {

            $errors = array_values($validator->errors()->getMessages());
            $errors = array_flatten($errors);

            return array("errors" => true, "messages" => $errors);
        }

        $district = District::find($id);

        if ($district) {

            $inputs = [
                "name" => Input::get('name'),
                "state_id" => Input::get('state_id')
            ];

            $updated = $district->update($inputs);

            if ($updated) {

                return $district;
            } else {
                return array("errors" => true, "messages" => ['Could not update role']);
            }
        } else {
            return array("errors" => true, "messages" => ['District Not Found']);
        }
    }

    public static function delete($id) {

        if (is_null($id))
            return array("errors" => true, "messages" => ['You must provide your id']);

        $district = District::find($id);

        if ($district) {

            $deleted = $district->delete();

            if ($deleted) {

                return $district;
            } else {

                return array("errors" => true, "messages" => ['District could not be deleted']);
            }
        } else {

            return array("errors" => true, "messages" => ['District could not be found']);
        }
    }

    public static function show($id) {
        if (empty(trim($id)))
            return array("errors" => true, "messages" => ['You must provide id']);

        $district = District::with(self::$relations)->find($id);

        return $district;
    }

    public static function all() {

        $districts = District::with(self::$relations)->get();

        return !empty($districts->toArray()) ? $districts : array("errors" => true, "messages" => ['No Districts Found']);
    }

}
