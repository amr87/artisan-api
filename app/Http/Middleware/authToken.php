<?php

namespace App\Http\Middleware;
use Closure;
use App\Modules\users\models\User as User;

class authToken {

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     * @todo Add User Can Capablity to check for request permission if User::can($request->path())
     * 
     */
    public function handle($request, Closure $next) {

        $headers = apache_request_headers();

        if (!isset($headers["Authorization"])) {

            return \Response::json(array("You must send a token"), 401);
        }

        $token = stripslashes($headers["Authorization"]);

        $id = $request->input("ID");

        if (is_null($id)) {

            return \Response::json(array("messages" => ["You must send a user id"]), 401);
        }

        $user = User::with('roles.permissions')->whereRaw('id = ? AND token = ? ', array($id, $token))->select(["id","company_id"])->get();

        if (empty($user->toArray())) {

            return \Response::json(array("messages" => ["Invalid token"]), 401);
        } 
   
        // tenant assign
        if($user[0]->company_id != NULL) 
           \Session::put('company_id',$user[0]->company_id);
   
        return $next($request);

        
    }

}
