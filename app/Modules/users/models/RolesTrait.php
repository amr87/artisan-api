<?php

namespace App\Modules\users\models;

use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Schema;

trait RolesTrait {

    public function roles() {

        return $this->belongsToMany(Role::class);
    }
    
    public function messages() {

        return $this->hasMany(\App\Modules\chat\models\Message::class,'to_id');
    }
    
    public function conversations() {

        return $this->belongsToMany(\App\Modules\chat\models\Conversation::class);
    }
    
    public function workshops() {

        return $this->hasMany(\App\Modules\workshops\models\Workshop::class);
    }
    
    public function company(){
        return $this->belongsTo(\App\Modules\companies\models\Company::class);
    }

    public function grantRole($role) {
        $sync = [];
        if (!empty($role)) {
            foreach ($role as $role) {
                $sync[] = $role->id;
            }
            return $this->roles()->sync($sync);
        }
    }

    public function hasRole($role) {

        if (is_string($role)) {

            return $this->roles->contains('name', $role);
        }

        return !!$role->intersect($this->roles)->count();
    }

    public function getRoles() {

        $roles = [];
        if ($this->roles != NULL && !empty($this->roles->toArray())) {
            foreach ($this->roles as $role) {
                $roles[] = $role->label;
            }
        }
        return $roles;
    }

    public function ownsRequest(Request $request) {

        $segment = $request->segments()[2];
        if ($segment == "users") {
            if (isset($request->segments()[3])) {
                if ($request->segments()[3] == "update" || $request->segments()[3] == "profile") {
                    $targetUser = isset($request->segments()[4]) ? $request->segments()[4] : NULL;
                    if ($targetUser !== NULL) {
                        if ($request->input('ID') == $targetUser) {
                            return true;
                        }
                    }
                }
                if ($request->segments()[3] == "avatar") {
                    $targetUser = !is_null($request->input('user_id')) ? $request->input('user_id') : NULL;
                    if ($targetUser !== NULL) {
                        if ($request->input('ID') == $targetUser) {
                            return true;
                        }
                    }
                }
            }
        } else {
            if (Schema::hasTable($segment)) {
                $entityID = isset($request->segments()[4]) ? $request->segments()[4] : NULL;
                if ($entityID !== NULL) {
                    $entity = \DB::table($segment)->find($entityID);
                    if ($entity) {
                        if (property_exists($entity, "user_id")) {
                            if ($entity && ($entity->user_id == $this->id)) {
                                return true;
                            }
                        }
                    }
                }
            }
        }

        return false;
    }

}
