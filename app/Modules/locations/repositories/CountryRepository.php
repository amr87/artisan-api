<?php

namespace App\Modules\locations\Repositories;

use Illuminate\Support\Facades\Input as Input;
use App\Modules\locations\models\Country as Country;
use App\Modules\locations\models\State as State;
use Yajra\Datatables\Datatables as DataTables;

class CountryRepository {

    private static $relations = [];//['states.districts'];

    public static function DataTable() {


        $countries = Country::with(self::$relations)->select('*')->orderBy('name', 'ASC');

        return Datatables::of($countries)
                        ->editColumn('updated_at', function ($country) {

                            return " <a class='btn  bg-gray btn-xs' href='country/states/" . $country->id ."'><span class='fa fa-flag'> Show States</span></a> &nbsp;&nbsp;&nbsp;&nbsp;
                                  <a class='btn  bg-orange btn-xs' href='countries/" . $country->id . "/edit'><span class='fa fa-edit'> Edit</span></a> &nbsp;&nbsp;&nbsp;&nbsp;
                                <a onclick='return confirm_delete()' class= 'btn  bg-maroon btn-xs' href='countries/" . $country->id . "/delete'><span class='fa fa-trash'> Delete</span></a>
                                ";
                        })
                        ->editColumn('created_at', function ($country) {
                            return $country->states->count();
                        })
                        ->make(true);
    }

    public static function StatesDataTable($id) {


        $states = State::where('country_id', $id)->select('*')->orderBy('name', 'ASC');

        return Datatables::of($states)
                        ->editColumn('updated_at', function ($state) {

                            return "<a class='btn  bg-gray btn-xs' href='../../states/districts/" . $state->id . "'><span class='fa fa-flag'> Show Districts</span></a> &nbsp;&nbsp;&nbsp;&nbsp;
                                  <a class='btn  bg-orange btn-xs' href='../../states/" . $state->id . "/edit'><span class='fa fa-edit'> Edit</span></a> &nbsp;&nbsp;&nbsp;&nbsp;
                                <a onclick='return confirm_delete()' class= 'btn  bg-maroon btn-xs' href='../../states/" . $state->id . "/delete'><span class='fa fa-trash'> Delete</span></a>
                                ";
                        })
                        ->editColumn('created_at', function ($state) {
                            return $state->districts->count();
                        })
                        ->make(true);
    }

    public static function create() {
        // validator

        $validator = \Validator::make(Input::all(), [
                    'name' => 'required|min:3|max:255'
        ]);

        if ($validator->fails()) {

            $errors = array_values($validator->errors()->getMessages());
            $errors = array_flatten($errors);

            return array("errors" => true, "messages" => $errors);
        }

        $name = Input::get('name');


        $country = Country::create([
                    "name" => $name
        ]);

        if ($country) {
            return $country;
        } else {
            return ["errors" => true, "messages" => ['could not create state']];
        }
    }

    public static function update($id) {

        if (empty(trim($id)))
            return array("errors" => true, "messages" => ["You must provide ID"]);
        $validator = \Validator::make(Input::all(), [
                    'name' => 'required|min:3|max:255'
        ]);

        if ($validator->fails()) {

            $errors = array_values($validator->errors()->getMessages());
            $errors = array_flatten($errors);

            return array("errors" => true, "messages" => $errors);
        }

        $country = Country::find($id);

        if ($country) {

            $inputs = [
                "name" => Input::get('name')
            ];

            $updated = $country->update($inputs);

            if ($updated) {

                return $country;
            } else {
                return array("errors" => true, "messages" => ['Could not update role']);
            }
        } else {
            return array("errors" => true, "messages" => ['Country Not Found']);
        }
    }

    public static function delete($id) {

        if (is_null($id))
            return array("errors" => true, "messages" => ['You must provide your id']);

        $country = Country::find($id);

        if ($country) {

            $deleted = $country->delete();

            if ($deleted) {

                return $country;
            } else {

                return array("errors" => true, "messages" => ['Country could not be deleted']);
            }
        } else {

            return array("errors" => true, "messages" => ['Country could not be found']);
        }
    }

    public static function show($id) {
        if (empty(trim($id)))
            return array("errors" => true, "messages" => ['You must provide id']);

        $country = Country::with(self::$relations)->find($id);

        return $country;
    }

    public static function all() {

        $countries = Country::with(self::$relations)->get();

        return !empty($countries->toArray()) ? $countries : array("errors" => true, "messages" => ['No Countrys Found']);
    }

}
