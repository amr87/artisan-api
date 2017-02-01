<?php

namespace App\Modules\users\Repositories;

use Illuminate\Support\Facades\Input as Input;
use \App\Modules\users\models\User as User;
use \App\Modules\users\models\Role as Role;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Mail as Mail;
use App\Modules\Helpers\AbstractRepository;
use Yajra\Datatables\Datatables;


class UserRepository extends AbstractRepository {

    private static $relations = ['roles.permissions'];//,'conversations.messages'];
    private static $AVATARS_DIR = "/media/users-avatars/";
    private static $IMG_WIDTH = 780; /* @todo Convert it to an option */
    private static $PAGINATOR = 20;   /* @todo Convert it to an option */
    private static $FIT = 160;   /* @todo Convert it to an option */

    public static function all() {

        $users = User::with(self::$relations)->paginate(self::$PAGINATOR);

        return !empty($users->toArray()) ? $users : array("errors" => true, "messages" => ['No Users Found']);
    }

    public static function DataTable() {

        $role = Input::get('role');

        if ($role !== Null && $role != 0) {

            $users = User
                    ::leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
                    ->whereRaw('role_user.role_id = ?', [$role])
                    ->select('*')
                    ->orderBy('users.id', 'ASC');
        } else {

            $users = User::select('*')->orderBy('id', 'ASC');
        }

        return Datatables::of($users)
                        ->editColumn('created_at', function ($user) {
                            return $user->created_at ? with(new \Carbon\Carbon($user->created_at))->diffForHumans() : '';
                        })
                        ->editColumn('updated_at', function ($user) {
                            return "<a class='btn  bg-green btn-xs' href='users/" . $user->id . "'><span class='fa fa-user'> Profile</span></a>"
                                    . "&nbsp;&nbsp;&nbsp; <a class='btn  bg-orange btn-xs' href='users/" . $user->id . "/edit'><span class='fa fa-edit'> Edit</span></a>
                                   
                                   &nbsp;&nbsp;&nbsp;<a onclick='return confirm_delete()' class= 'btn  bg-maroon btn-xs' href='users/" . $user->id . "/delete'><span class='fa fa-ban'> Ban</span></a>
                                ";
                        })
                        ->editColumn('avatar', function ($user) {
                            $avatar = "";
                            if ($user->social == "0") {
                                $avatar = !empty($user->avatar) ? url(str_replace(".jpg", "-" . self::$FIT . ".jpg", $user->avatar)) : "/images/avatar-placeholder.png";
                            } elseif ($user->social == "1") {
                                $avatar = !empty($user->avatar) ? $user->avatar : "/images/avatar-placeholder.png";
                            }
                            return "<img style='width:40px;height:40px' class='img-circle'  src='" . $avatar . "' />";
                        })
                        ->editColumn('bio', function ($user) {
                            $roles = $user->getRoles();
                            if (!empty($roles)) {
                                if ($user->social == '1') {
                                    return "<span class='text-blue  fa fa-facebook-square'></span> " . implode(" , ", $roles);
                                } else {
                                    return "<span class=' fa fa-user'></span> " . implode(" , ", $roles);
                                }
                            } else {
                                return "";
                            }
                        })
                        ->make(true);
    }

    public static function TrashedDataTable() {

        $role = Input::get('role');

        if ($role !== Null && $role != 0) {

            $users = User::onlyTrashed()
                    ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
                    ->whereRaw('role_user.role_id = ?', [$role])
                    ->whereNotNull('deleted_at')
                    ->select('*')
                    ->orderBy('users.id', 'ASC');
        } else {

            $users = User::onlyTrashed()->select('*')->orderBy('id', 'ASC');
        }

        return Datatables::of($users)
                        ->editColumn('created_at', function ($user) {
                            return $user->created_at ? with(new \Carbon\Carbon($user->created_at))->diffForHumans() : '';
                        })
                        ->editColumn('updated_at', function ($user) {
                            return "<a class='btn  bg-green btn-xs' href='/admin/users/" . $user->id . "/restore'><span class='fa fa-edit'> Restore</span></a>
                                <a onclick='return confirm_delete()' class= 'btn  bg-red btn-xs' href='/admin/users/" . $user->id . "/force-delete'><span class='fa fa-trash'> Delete Permenantly</span></a>
                                ";
                        })
                        ->editColumn('avatar', function ($user) {
                            $avatar = "";
                            if ($user->social == "0") {
                                $avatar = !empty($user->avatar) ? url(str_replace(".jpg", "-" . self::$FIT . ".jpg", $user->avatar)) : "/images/avatar-placeholder.png";
                            } elseif ($user->social == "1") {
                                $avatar = !empty($user->avatar) ? $user->avatar : "/images/avatar-placeholder.png";
                            }
                            return "<img style='width:40px;height:40px' class='img-circle'  src='" . $avatar . "' />";
                        })
                        ->editColumn('bio', function ($user) {

                            $roles = $user->getRoles();

                            return !empty($roles) ? "<span class='fa fa-user'></span> " . implode(" , ", $roles) : "";
                        })
                        ->make(true);
    }

    public static function search() {

        $keyword = Input::get('keyword');

        $users = User::where('username', 'like', "%$keyword%")->whereNull('deleted_at')->where('id', '<>', '1')->select(['id', 'username'])->get();
        $count = User::where('username', 'like', "%$keyword%")->whereNull('deleted_at')->where('id', '<>', '1')->count();

        return !empty($users->toArray()) ? [
            'items' => $users,
            'total_count' => $count,
            "incomplete_results" => false
                ] : array("errors" => true, "messages" => ['No Users Found']);
    }

    public static function create() {
        // validator

        $validator = \Validator::make(Input::all(), [
                    'first_name' => 'required|min:3|max:255',
                    'last_name' => 'required|min:3|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'username' => 'required|min:3|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {

            $errors = array_values($validator->errors()->getMessages());
            $errors = array_flatten($errors);

            return array("errors" => true, "messages" => $errors);
        }

        $token = \Hash::make(\Illuminate\Support\Str::random(60));

        $role = Input::get('role');

        $user = User::create([
                    "username" => Input::get('username'),
                    "email" => Input::get('email'),
                    "password" => bcrypt(Input::get('password')),
                    'bio' => Input::get('bio'),
                    'token' => $token,
                    'display_name' => Input::get('first_name') . " " . Input::get('last_name')
        ]);

        if ($user) {

            if (!is_null($role)) {

                $role = self::isJson($role) ? json_decode($role, true) : $role;


                $grantedRoles = [];
                foreach ($role as $role) {
                    $access = Role::find($role);
                    if (!$access || (int) $role == 1) // skip invalid roles id && admin role
                        continue;
                    $grantedRoles[] = $access;
                }

                $user->grantRole($grantedRoles);
            } else {
                /**
                 * Give User A default permission of guest
                 */
                $role = Role::where('label', '=', 'guest')->select('id')->get();

                if (empty($role->toArray())) {
                    // givern role is not pre-defined then create new one
                    $role = Role::create(['name' => 'Guest', 'label' => 'guest']);
                    $user->grantRole([$role]);
                } else {
                    // grant user access to the predfined role
                    $user->grantRole($role);
                }
            }
            
            /* create workshop 
             
             *  call workshopController@create($user)
             */
            
            
            return $user;
        } else {
            return ["errors" => true, "messages" => ['could not create user']];
        }
    }

    public static function update($id) {

        if (empty(trim($id)))
            return array("errors" => true, "messages" => ["You must provide ID"]);

        if (!is_null(Input::get('username'))) {
            $validator = \Validator::make(Input::all(), [
                        'email' => 'email|max:255|unique:users',
                        'username' => 'min:3|max:255|unique:users',
                        'password' => 'min:6',
            ]);

            if ($validator->fails()) {

                $errors = array_values($validator->errors()->getMessages());
                $errors = array_flatten($errors);

                return array("errors" => true, "messages" => $errors);
            }
        }
        if (!is_null(Input::get('password'))) {
            $validator = \Validator::make(Input::all(), [

                        'password' => 'min:6',
            ]);

            if ($validator->fails()) {

                $errors = array_values($validator->errors()->getMessages());
                $errors = array_flatten($errors);

                return array("errors" => true, "messages" => $errors);
            }
        }
        if (!is_null(Input::get('email'))) {
            $validator = \Validator::make(Input::all(), [

                        'email' => 'email|min:6|max:255',
            ]);

            if ($validator->fails()) {

                $errors = array_values($validator->errors()->getMessages());
                $errors = array_flatten($errors);

                return array("errors" => true, "messages" => $errors);
            }
        }

        $user = User::with(self::$relations)->find($id);

        if ($user) {

            //check if password will be updated

            if (!is_null(Input::get('password'))) {
                //check for old password
                if (!is_null(Input::get('old_password'))) {

                    if (!\Hash::check(Input::get('old_password'), $user->password)) {
                        return array("errors" => true, "messages" => ['please enter your old password correctly']);
                    }
                } else {
                    return array("errors" => true, "messages" => ['You must provide your old password']);
                }
            }
            /**
             * @todo Enable Token Update On Production
             * $token = \Hash::make(\Illuminate\Support\Str::random(60));
             */
            $username = !is_null(Input::get('username')) ? Input::get('username') : $user->username;

            $inputs = Input::all();

            foreach ($inputs as $key => $value) {
                if ($key == "password") {
                    $inputs["password"] = bcrypt($inputs["password"]);
                }
                if ($key == "first_name" || $key == "last_name") {
                    $inputs["display_name"] = @$inputs["first_name"] . " " . @$inputs["last_name"];
                }

                if ($key == "token")
                    continue;
            }
            /**
             * @todo Enable Token Update On Production
             *  $inputs["token"] = $token;
             */
            $updated = $user->update($inputs);

            $role = Input::get('role');

            if ($updated) {
                /*
                 * UPDATE ROLES
                 */
                if (!is_null($role)) {

                    $role = self::isJson($role) ? json_decode($role, true) : $role;


                    $grantedRoles = [];
                    foreach ($role as $role) {
                        $access = Role::find($role);
                        if (!$access || (int) $role == 1) // skip invalid roles id && admin role
                            continue;
                        $grantedRoles[] = $access;
                    }

                    $user->grantRole($grantedRoles);
                } elseif (empty($user->roles->toArray()) || $user->roles === NULL) {
                    /**
                     * Give User A default permission of guest
                     */
                    $role = 'guest';
                    $access = Role::where('label', '=', 'guest')->select('id')->get();

                    if (empty($access->toArray())) {
                        // givern role is not pre-defined then create new one
                        $access = Role::create(['name' => 'Guest', 'label' => 'guest']);
                        $user->grantRole([$access]);
                    } else {
                        // grant user access to the predfined role
                        $user->grantRole($access);
                    }
                }

                return $user;
            } else {
                return array("errors" => true, "messages" => ['Could not update user']);
            }
        } else {
            return array("errors" => true, "messages" => ['User Not Found']);
        }
    }

    public static function delete($id) {

        if (is_null($id))
            return array("errors" => true, "messages" => ['You must provide your id']);

        $user = User::find($id);

        if ($user) {
            $deleted = $user->delete();
            if ($deleted) {
                return $user;
            } else {
                return array("errors" => true, "messages" => ['User could not be deleted']);
            }
        } else {
            return array("errors" => true, "messages" => ['User could not be found']);
        }
    }

    public static function profile($id) {
        if (empty(trim($id)))
            return array("errors" => true, "messages" => ['You must provide id']);

        $user = User::with(['roles.permissions'])->find($id);

        return $user;
    }

    public static function login() {
        $validator = \Validator::make(Input::all(), [

                    'username' => 'required|min:3|max:255',
                    'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {

            $errors = array_values($validator->errors()->getMessages());
            $errors = array_flatten($errors);

            return array("errors" => true, "messages" => $errors);
        }

        $username = Input::get('username');
        $password = Input::get('password');
        $user = User::with(self::$relations)->where('username', $username)->first();
        if ($user) {
            if (\Hash::check($password, $user->password)) {
                return $user;
            } else {
                return array("errors" => true, "messages" => ['invalid password']);
            }
        } else {
            $user = User::withTrashed()->where('username', $username)->first();
            if ($user) {
                return array("errors" => true, "messages" => ['sorry , but this user has been banned']);
            } else {
                return array("errors" => true, "messages" => ['invalid username']);
            }
        }
    }

    public static function authCookie() {


        $cookie = Input::get('cookie');
        if (strpos($cookie, "|") == FALSE)
            return array("errors" => true, "messages" => ['invalid cookie']);

        $parts = explode("|", $cookie);

        $user = User::with(self::$relations)
                ->where('remember_token', $parts[0])
                ->where('id', $parts[1])
                ->first();
        if ($user) {

            return $user;
        } else {
            return array("errors" => true, "messages" => ['invalid auth details']);
        }
    }

    public static function forgetPassword() {

        $validator = \Validator::make(Input::all(), [
                    'email' => 'required|email|max:255'
        ]);

        if ($validator->fails()) {
            $errors = array_values($validator->errors()->getMessages());
            $errors = array_flatten($errors);

            return array("errors" => true, "messages" => $errors);
        }

        $email = Input::get('email');

        $user = User::findByEmail($email);

        if (!$user)
            return array("errors" => true, "messages" => ["Invalid email"]);

        // Insert to password_resets
        $token = str_random(30);

        $passwordReset = DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => \Carbon\Carbon::now(new \DateTimeZone('Africa/Cairo'))
        ]);

        if ($passwordReset) {
            // send email
            $sent = Mail::send('emails.reset-password', [
                        'name' => $user->username,
                        'token' => $token,
                        'email' => $user->email]
                            , function ($m) use ($user) {

                        $m->from('support@artisan.com', 'Artisan Application');
                        $m->to($user->email, $user->username)->subject('Reset Your Password ');
                    });

            if ($sent) {

                return true;
            } else {

                return array("errors" => true, "messages" => ["could not send the email , please try again"]);
            }
        } else {

            return array("errors" => true, "messages" => ["could not reset your password , please try again"]);
        }
    }

    public static function resetPassword() {

        $validator = \Validator::make(Input::all(), [
                    'email' => 'required|email|max:255',
                    'password' => 'required|min:6|max:255|confirmed',
        ]);

        if ($validator->fails()) {
            $errors = array_values($validator->errors()->getMessages());
            $errors = array_flatten($errors);

            return array("errors" => true, "messages" => $errors);
        }

        $email = Input::get('email');
        $token = Input::get('token');
        $password = Input::get('password');


        $entry = DB::table('password_resets')->whereRaw('email = ? AND token = ?', [$email, $token])->get();

        if (!empty($entry)) {

            if (\Carbon\Carbon::createFromTimestamp(strtotime($entry[0]->created_at))->isToday()) {

                $user = User::findByEmail($email);

                $user->password = \Hash::make($password);

                if ($user->save()) {

                    DB::table('password_resets')->whereRaw('email = ? AND token = ?', [$email, $token])->delete();

                    return $user;
                } else {
                    return array("errors" => true, "messages" => ["Error Reseting Your Password"]);
                }
            } else {
                return array("errors" => true, "messages" => ["Your request to reset password is older than expected , please submit new request"]);
            }
        }
        return array("errors" => true, "messages" => ["Invalid Email And Secret Token Combination"]);
    }

    public static function facebookConnect() {

        $email = Input::get('email');

        $user = User::findSocialByEmail($email);
        if (is_array($user) && $user[0] == "banned") {
            return array("errors" => true, "messages" => ["Sorry , This user has been banned"]);
        }

        if ($user) {
            return $user;
        } else {

            $validator = \Validator::make(Input::all(), [
                        'email' => 'required|email|max:255|unique:users'
            ]);

            if ($validator->fails()) {

                $errors = array_values($validator->errors()->getMessages());
                $errors = array_flatten($errors);

                return array("errors" => true, "messages" => $errors);
            }

            // create new user

            $user = User::create([
                        'username' => Input::get('email'),
                        'email' => Input::get('email'),
                        'password' => \Hash::make(\Illuminate\Support\Str::random(20)),
                        'token' => \Hash::make(\Illuminate\Support\Str::random(60)),
                        'display_name' => Input::get('display_name'),
                        'bio' => Null,
                        'phone' => NULL,
                        'avatar' => Input::get('avatar'),
                        'social' => '1'
            ]);
            $role = Role::where('name', '=', 'guest')->get();
            $user->grantRole([$role[0]]);

            $user = User::with(self::$relations)->find($user->id);

            return $user ? $user :
                    ['messages' => ['Could not create user'], 'errors' => true];
        }
    }

    public static function uploadAvatar() {

        if (!is_null(Input::file('avatar'))) {

            $avatar = Input::file('avatar');


            $user_id = Input::get('user_id');

            if ($user_id == NULL)
                return array("errors" => true, "messages" => ["Invalid user id"]);

            $user = User::find($user_id);

            $im_url = $user->username . "-avatar.jpg";

            $thumb_url = $user->username . "-avatar-" . self::$FIT . ".jpg";

            $path = public_path() . self::$AVATARS_DIR . $im_url;
            $Thumbpath = public_path() . self::$AVATARS_DIR . $thumb_url;

            $im = \Image::make($avatar)->resize(self::$IMG_WIDTH, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save($path);

            $thumb = \Image::make($avatar)->fit(self::$FIT, self::$FIT, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save($Thumbpath);

            if (!$im)
                return ['errors' => true, 'messages' => ['could not save image']];

            $path = self::$AVATARS_DIR . $im_url;


            $user->avatar = $path;

            $user->save();

            return $user;
        }
        return array("errors" => true, "messages" => ["file not sent"]);
    }

    public static function forceDelete($id) {

        if (is_null($id))
            return array("errors" => true, "messages" => ['You must provide your id']);

        $user = User::withTrashed()->find($id);

        if ($user) {

            $user->forceDelete();

            return $user;
        } else {
            return array("errors" => true, "messages" => ['User could not be found']);
        }
    }

    public static function restore($id) {

        if (is_null($id))
            return array("errors" => true, "messages" => ['You must provide your id']);

        $user = User::withTrashed()->find($id);

        if ($user) {
            $restored = $user->restore();
            if ($restored) {
                return $user;
            } else {
                return array("errors" => true, "messages" => ['User could not be deleted']);
            }
        } else {
            return array("errors" => true, "messages" => ['User could not be found']);
        }
    }

}
