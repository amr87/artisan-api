<?php

namespace App\Modules\users\Repositories;

use Illuminate\Support\Facades\Input as Input;
use \App\Modules\users\models\Role as Role;
use Yajra\Datatables\Datatables as DataTables;

class RoleRepository {

    private static $relations = ['permissions','user'];

    public static function DataTable() {


        $roles = Role::with(self::$relations)->where('id', '<>', 1)->select('*')->orderBy('id', 'ASC');

        return Datatables::of($roles)
                        ->editColumn('created_at', function ($role) {
                            return $role->created_at ? with(new \Carbon\Carbon($role->created_at))->diffForHumans() : '';
                        })
                        ->editColumn('updated_at', function ($role) {
                            return "<a class='btn  bg-orange btn-xs' href='roles/" . $role->id . "/edit'><span class='fa fa-edit'> Edit</span></a>
                                <a onclick='return confirm_delete()' class= 'btn  bg-maroon btn-xs' href='roles/" . $role->id . "/delete'><span class='fa fa-trash'> Delete</span></a>
                                ";
                        })
                        ->editColumn('name', function ($role) {
                            $ar = [];
                            $permissions = $role->permissions;
                            if (!empty($permissions)) {
                                foreach ($permissions as $per) {
                                    $ar[] = $per->label;
                                }
                            }
                            return !empty($ar) ? implode(" , ", $ar) : "";
                        })
                        ->make(true);
    }

    public static function create() {
        // validator

        $validator = \Validator::make(Input::all(), [
                    'name' => 'required|min:3|max:255|unique:roles',
        ]);

        if ($validator->fails()) {

            $errors = array_values($validator->errors()->getMessages());
            $errors = array_flatten($errors);

            return array("errors" => true, "messages" => $errors);
        }

        $permissions = Input::get('permissions');
        $users = Input::get('users');
        $roleLabel = strtolower(str_replace(" ", "_", Input::get('name')));

        $role = Role::create([
                    "name" => $roleLabel,
                    "label" => Input::get('name')
        ]);

        if ($role) {
            if (!is_null($permissions)) {
                $role->permissions()->sync($permissions);
            }
            if (!is_null($users)) {
                $role->user()->sync($users);
            }
            return $role;
        } else {
            return ["errors" => true, "messages" => ['could not create role']];
        }
    }

    public static function update($id) {

        if (empty(trim($id)))
            return array("errors" => true, "messages" => ["You must provide ID"]);
        $validator = \Validator::make(Input::all(), [
                    'name' => 'required|min:3|max:255',
        ]);

        if ($validator->fails()) {

            $errors = array_values($validator->errors()->getMessages());
            $errors = array_flatten($errors);

            return array("errors" => true, "messages" => $errors);
        }

        $role = Role::find($id);

        if ($role) {

            $roleLabel = strtolower(str_replace(" ", "_", Input::get('name')));

            $inputs = [
                "name" => $roleLabel,
                "label" => Input::get('name')
            ];

            $updated = $role->update($inputs);

            if ($updated) {

                $permissions = Input::get('permissions');
                $users = Input::get('users');
                
                if (!is_null($permissions)) {
                    $role->permissions()->sync($permissions);
                }
                if (!is_null($users)) {
                    $role->user()->sync($users);
                }

                return $role;
            } else {
                return array("errors" => true, "messages" => ['Could not update role']);
            }
        } else {
            return array("errors" => true, "messages" => ['Role Not Found']);
        }
    }

    public static function delete($id) {

        if (is_null($id))
            return array("errors" => true, "messages" => ['You must provide your id']);

        $role = Role::find($id);

        if ($role) {
            $deleted = $role->delete();
            if ($deleted) {
                return $role;
            } else {
                return array("errors" => true, "messages" => ['Role could not be deleted']);
            }
        } else {
            return array("errors" => true, "messages" => ['Role could not be found']);
        }
    }

    public static function show($id) {
        if (empty(trim($id)))
            return array("errors" => true, "messages" => ['You must provide id']);

        $role = Role::with(self::$relations)->find($id);

        return $role;
    }

    public static function all() {

        $noAdmin = Input::get('noAdmin');

        $roles = ($noAdmin != NULL && $noAdmin == true) ?
                Role::with(self::$relations)->where('id', '<>', 1)->get() :
                Role::with(self::$relations)->get();


        return !empty($roles->toArray()) ? $roles : array("errors" => true, "messages" => ['No Roles Found']);
    }

}
