<?php

namespace App\Modules\users\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\users\models\RolesTrait as RolesTrait;

class User extends Model {

    use RolesTrait,
        SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password', 'bio', 'token', 'avatar', 'display_name', 'phone', 'social', 'remember_token'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public static function findByEmail($email) {

        $user = self::with('roles.permissions')->where('email', '=', $email)->get();
        return !empty($user->toArray()) ? $user[0] : false;
    }

    public static function findSocialByEmail($email) {

        $user = self::with('roles.permissions')->whereRaw('email = ? AND social = ?', [$email, '1'])->get();
        if (empty($user->toArray())) {
            // check if its banned
            $user = self::with('roles.permissions')->withTrashed()->whereRaw('email = ? AND social = ?', [$email, '1'])->get();
            return !empty($user->toArray()) ? ["banned"] : false;
        }
        return !empty($user->toArray()) ? $user[0] : false;
    }

    public function can($ability) {
        if (!empty($this->roles)) {
            foreach ($this->roles as $role) {
                if ($role->permissions->contains('name', $ability))
                    return true;
            }
        }
        return false;
    }

}
