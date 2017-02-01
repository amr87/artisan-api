<?php

namespace App\Http\Middleware;
use Closure;
use App\Modules\users\models\User as User;

class ACL {

    /**
     * @author Amr Gamal <amr.gamal878@gmail.com>
     * @since 1.0
     * @param null
     * @return void
     * @todo Add User Can Capablity to check for request permission if User::can($request->path())
     * 
     */
    public function handle($request, Closure $next) {

        $id = $request->input('ID');
        if(NULL === $id)
            return \Response::Json(['messages' => ['You Must Provide ID']],400);
        
        $user = User::with('roles.permissions')->find($id);

        if (!$user) {

            return \Response::Json(['messages' => ['Invalid User ID']],400);
        }

        if($user->hasRole('super_admin')){
            /**
             * @todo Add Addition Checks to Make sure indeed this request is sent by admin
             * 
             */
             return $next($request);
        }
        
        if($user->ownsRequest($request)){
            
            return $next($request);
        }
        
        $action = !empty(\Route::currentRouteName()) ? \Route::currentRouteName() : "perform this action";
        
        $sanitizedAction = strtolower(str_replace(" ", "_", $action));
  
       // dd($user);
        if($user->can($sanitizedAction)) { 
            
          return $next($request);
          
        } else {
            
            return \Response::json(array("messages" => ["You do not have sufficient permissions to $action"]), 401);
            
        }
    }

}
