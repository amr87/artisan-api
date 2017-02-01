<?php

namespace App\Modules\locations\Repositories;

use Illuminate\Support\Facades\Input as Input;
use \App\Modules\locations\models\State as State;
use App\Modules\locations\models\District as District;
use Yajra\Datatables\Datatables as DataTables;

class StateRepository {

    private static $relations = ['country', 'districts'];

    public static function DataTable() {


        $states = State::with(self::$relations)->select('*')->orderBy('name', 'ASC');

        return Datatables::of($states)
                        ->editColumn('updated_at', function ($state) {
                            return "<a class='btn  bg-green btn-xs' href='districts/create/" . $state->id . "'><span class='fa fa-plus'> Add Distrcit</span></a>
                            <a class='btn  bg-orange btn-xs' href='states/" . $state->id . "/edit'><span class='fa fa-edit'> Edit</span></a>
                                <a onclick='return confirm_delete()' class= 'btn  bg-maroon btn-xs' href='states/" . $state->id . "/delete'><span class='fa fa-trash'> Delete</span></a>
                                ";
                        })
                        ->editColumn('created_at', function ($state) {
                            return $state->districts->count();
                        })
                        ->make(true);
    }

    public static function DistrictsDataTable($id) {


        $districts = District::where('state_id', $id)->select('*')->orderBy('name', 'ASC');

        return Datatables::of($districts)
                        ->editColumn('updated_at', function ($district) {


                            return "<a class='btn  bg-orange btn-xs' href='../../districts/" . $district->id . "/edit'><span class='fa fa-edit'> Edit</span></a> &nbsp;&nbsp;&nbsp;&nbsp;
                                <a onclick='return confirm_delete()' class= 'btn  bg-maroon btn-xs' href='../../districts/" . $district->id . "/delete'><span class='fa fa-trash'> Delete</span></a>
                                ";
                        })
                        ->make(true);
    }

    public static function create() {
        // validator

        $validator = \Validator::make(Input::all(), [
                    'name' => 'required|min:3|max:255',
                    'country_id' => 'required|integer'
        ]);

        if ($validator->fails()) {

            $errors = array_values($validator->errors()->getMessages());
            $errors = array_flatten($errors);

            return array("errors" => true, "messages" => $errors);
        }

        $country = Input::get('country_id');
        $name = Input::get('name');


        $state = State::create([
                    "name" => $name,
                    "country_id" => $country
        ]);

        if ($state) {
            return $state;
        } else {
            return ["errors" => true, "messages" => ['could not create state']];
        }
    }

    public static function update($id) {

        if (empty(trim($id)))
            return array("errors" => true, "messages" => ["You must provide ID"]);
        $validator = \Validator::make(Input::all(), [
                    'name' => 'required|min:3|max:255',
                    'country_id' => 'required|integer'
        ]);

        if ($validator->fails()) {

            $errors = array_values($validator->errors()->getMessages());
            $errors = array_flatten($errors);

            return array("errors" => true, "messages" => $errors);
        }

        $state = State::find($id);

        if ($state) {

            $inputs = [
                "name" => Input::get('name'),
                "country_id" => Input::get('country_id')
            ];

            $updated = $state->update($inputs);

            if ($updated) {

                return $state;
            } else {
                return array("errors" => true, "messages" => ['Could not update role']);
            }
        } else {
            return array("errors" => true, "messages" => ['State Not Found']);
        }
    }

    public static function delete($id) {

        if (is_null($id))
            return array("errors" => true, "messages" => ['You must provide your id']);

        $state = State::find($id);

        if ($state) {

            $deleted = $state->delete();

            if ($deleted) {

                return $state;
            } else {

                return array("errors" => true, "messages" => ['State could not be deleted']);
            }
        } else {

            return array("errors" => true, "messages" => ['State could not be found']);
        }
    }

    public static function show($id) {
        if (empty(trim($id)))
            return array("errors" => true, "messages" => ['You must provide id']);

        $state = State::with(self::$relations)->find($id);

        return $state;
    }

    public static function all() {

        $states = State::with(self::$relations)->get();

        return !empty($states->toArray()) ? $states : array("errors" => true, "messages" => ['No States Found']);
    }

}
