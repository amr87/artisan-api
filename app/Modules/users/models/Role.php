<?php

namespace App\Modules\users\models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\users\Contracts\AccessInterface;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model implements AccessInterface {

    use SoftDeletes;

    protected $fillable = ['company_id','name', 'label'];

    public function permissions() {

        return $this->belongsToMany(Permission::class);
    }

    public function user() {

        return $this->belongsToMany(User::class);
    }

    public static function findByName($role) {

        $role = self::where('name', '=', $role)->get();

        return !empty($role->toArray()) ? $role[0] : false;
    }

    public static function findByLabel($role) {

        $role = self::where('label', '=', $role)->get();

        return !empty($role->toArray()) ? $role[0] : false;
    }

    public function grantAccess($permission) {

        $sync = [];
        if (!empty($permission)) {
            foreach ($permission as $item) {
                $sync[] = $item->id;
            }
            return $this->permissions()->sync($sync);
        }
    }

    public function whereTenant() {
        return $this->where('company_id', Session::get('company_id'));
    }

}
