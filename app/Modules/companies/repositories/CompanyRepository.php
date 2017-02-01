<?php

namespace App\Modules\companies\Repositories;

use Illuminate\Support\Facades\Input as Input;
use App\Modules\companies\models\Company as Company;


class CompanyRepository {

    protected static $relations = [ 'user'];

    public static function create() {
            
        $workshop = new Company;
        
        $workshop->name        = Input::get('name');
        $workshop->address     = Input::get('address');
        $workshop->phone        = Input::get('phone');
        $workshop->email = Input::get('email');
        $workshop->latitude = Input::get('latitude');
        $workshop->longitude = Input::get('longitude');
        $workshop->avatar = Input::get('avatar');
        
        $workshop->save();
        
        return array($workshop);
          
    }

    public static function show($id) {
        if (empty(trim($id)))
            return array("errors" => true, "messages" => ['You must provide id']);

        $conversation = Company::with(self::$relations)->find($id);

        return $conversation;
    }

    public static function delete($id) {

        if (is_null($id))
            return array("errors" => true, "messages" => ['You must provide your id']);

        $conversation = Company::find($id);

        if ($conversation) {

            $deleted = $conversation->delete();

            if ($deleted) {

                return $conversation;
            } else {

                return array("errors" => true, "messages" => ['Company could not be deleted']);
            }
        } else {

            return array("errors" => true, "messages" => ['Company could not be found']);
        }
    }

    public static function profile($id) {

        $user = Company::find($id);

        if (!$user)
            return array("errors" => true, "messages" => ['Company could not be found']);

        return $user;
    }

}
