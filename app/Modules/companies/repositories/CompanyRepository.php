<?php

namespace App\Modules\companies\Repositories;

use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Input as Input;
use App\Modules\companies\models\Company as Company;

class CompanyRepository {

    protected static $relations = ['users'];

    public static function DataTable() {


        $companies = Company::with('users');
        return Datatables::of($companies)
                        ->editColumn('updated_at', function ($company) {
                           // return "<a class='btn  bg-green btn-xs' href='companies/" . $company->id . "'><span class='fa fa-user'> Profile</span></a>"
                                    return " <a class='btn  bg-orange btn-xs' href='companies/" . $company->id . "/edit'><span class='fa fa-edit'> Edit</span></a>
                                   &nbsp;&nbsp;&nbsp;<a onclick='return confirm_delete()' class= 'btn  bg-maroon btn-xs' href='companies/" . $company->id . "/delete'><span class='fa fa-ban'> Ban</span></a>
                                ";
                        })
                        ->editColumn('created_at', function ($company) {
                            return "<strong>". $company->users->count()."</strong>";
                        })
                        ->make(true);
    }

    public static function create() {

        $workshop = new Company;

        $workshop->name = Input::get('name');
        $workshop->address = Input::get('address');
        $workshop->phone = Input::get('phone');
        $workshop->email = Input::get('email');
        $workshop->latitude = Input::get('latitude');
        $workshop->longitude = Input::get('longitude');
        $workshop->logo = Input::get('logo');

        $workshop->save();

        return array($workshop);
    }

    public static function update($id) {

        $workshop = Company::find($id);

        $workshop->name = Input::get('name');
        $workshop->address = Input::get('address');
        $workshop->phone = Input::get('phone');
        $workshop->email = Input::get('email');
        $workshop->latitude = Input::get('latitude');
        $workshop->longitude = Input::get('longitude');
        $workshop->logo = Input::get('logo');

        $workshop->save();

        return array($workshop);
    }

    public static function show($id) {
        if (empty(trim($id)))
            return array("errors" => true, "messages" => ['You must provide id']);

        $company = Company::with(self::$relations)->find($id);

        return $company;
    }

    public static function delete($id) {

        if (is_null($id))
            return array("errors" => true, "messages" => ['You must provide your id']);

        $company = Company::with(self::$relations)->find($id);

        if ($company) {

            $deleted = $company->delete();

            if ($deleted) {
                if (count($company->users) > 0 && NULL != $company->users) {
                    foreach ($company->users as $user) {
                        $user->delete();
                    }
                }
                return $company;
            } else {

                return array("errors" => true, "messages" => ['Company could not be deleted']);
            }
        } else {

            return array("errors" => true, "messages" => ['Company could not be found']);
        }
    }

    public static function profile($id) {

        $company = Company::with('users')->find($id);

        if (!$company)
            return array("errors" => true, "messages" => ['Company could not be found']);

        return $company;
    }

    public static function restore($id) {

        if (is_null($id))
            return array("errors" => true, "messages" => ['You must provide your id']);

        $company = Company::with('users')->withTrashed()->find($id);

        if ($company) {
            $restored = $company->restore();
            if ($restored) {
                foreach ($company->users as $user) {
                    $user->restore();
                }
                return $company;
            } else {
                return array("errors" => true, "messages" => ['User could not be deleted']);
            }
        } else {
            return array("errors" => true, "messages" => ['User could not be found']);
        }
    }

}
