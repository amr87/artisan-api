<?php

namespace App\Modules\users\models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\users\Contracts\AccessInterface;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model implements AccessInterface {
    
    use SoftDeletes;

    protected $fillable = ['name', 'label'];

    public function role() {
        
        return $this->belongsToMany(Role::class);
        
    }

    public static function findByLabel($permission) {

        $permission = self::where('label', '=', $permission)->get();

        return !empty($permission->toArray()) ? $permission[0] : false;
    }

    public static function findByName($permission) {

        $permission = self::where('name', '=', $permission)->get();

        return !empty($permission->toArray()) ? $permission[0] : false;
    }

}
