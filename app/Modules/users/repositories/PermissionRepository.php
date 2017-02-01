<?php

namespace App\Modules\users\Repositories;

use Illuminate\Support\Facades\Input as Input;
use Yajra\Datatables\Datatables as DataTables;
use \App\Modules\users\models\Permission as Permission;

class PermissionRepository {

    private static $relations = ['role.user'];

    public static function DataTable() {

        $permissions = Permission::where('id', '<>', 1)->select('*')->orderBy('id', 'ASC');

        return Datatables::of($permissions)
                        ->editColumn('created_at', function ($permission) {
                            return $permission->created_at ? with(new \Carbon\Carbon($permission->created_at))->diffForHumans() : '';
                        })
                        ->editColumn('updated_at', function ($permission) {
                            return "<a class='btn  bg-orange btn-xs' href='permissions/" . $permission->id . "/edit'><span class='fa fa-edit'> Edit</span></a>
                                <a onclick='return confirm_delete()' class= 'btn  bg-maroon btn-xs' href='permissions/" . $permission->id . "/delete'><span class='fa fa-trash'> Delete</span></a>
                                ";
                        })
                        ->make(true);
    }

    public static function create() {
        // validator

        $validator = \Validator::make(Input::all(), [
                    'name' => 'required|min:3|max:255|unique:permissions',
        ]);

        if ($validator->fails()) {

            $errors = array_values($validator->errors()->getMessages());
            $errors = array_flatten($errors);

            return array("errors" => true, "messages" => $errors);
        }


        $permissionLabel = strtolower(str_replace(" ", "_", Input::get('name')));

        $permission = Permission::create([
                    "name" => $permissionLabel,
                    "label" => Input::get('name')
        ]);

        $roles = Input::get('roles');

        if ($permission) {

            if (!empty($roles)) {

                $permission->role()->sync($roles);
            }

            return $permission;
        } else {
            return ["errors" => true, "messages" => ['could not create permission']];
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

        $permission = Permission::find($id);

        if ($permission) {

            $permissionLabel = strtolower(str_replace(" ", "_", Input::get('name')));

            $inputs = [
                "name" => $permissionLabel,
                "label" => Input::get('name')
            ];

            $updated = $permission->update($inputs);

            if ($updated) {

                $roles = Input::get('roles');

                if (!empty($roles)) {

                    $permission->role()->sync($roles);
                }

                return $permission;
            } else {
                return array("errors" => true, "messages" => ['Could not update permission']);
            }
        } else {
            return array("errors" => true, "messages" => ['Permission Not Found']);
        }
    }

    public static function delete($id) {

        if (is_null($id))
            return array("errors" => true, "messages" => ['You must provide your id']);

        $permission = Permission::find($id);

        if ($permission) {
            $deleted = $permission->delete();
            if ($deleted) {
                return $permission;
            } else {
                return array("errors" => true, "messages" => ['Permission could not be deleted']);
            }
        } else {
            return array("errors" => true, "messages" => ['Permission could not be found']);
        }
    }

    public static function show($id) {
        if (empty(trim($id)))
            return array("errors" => true, "messages" => ['You must provide id']);

        $permission = Permission::with(self::$relations)->find($id);

        return $permission;
    }

    public static function all() {

        $noAdmin = Input::get('noAdmin');

        $permissions = ($noAdmin != NULL && $noAdmin == true) ?
                Permission::where('name', '<>', 'manage_users')->get() :
                Permission::all();

        return !empty($permissions->toArray()) ? $permissions : array("errors" => true, "messages" => ['No Permissions Found']);
    }

}
