<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call(UserTableSeeder::class);
        $this->call(CreateLocationSeeder::class);
    }

}

Class UserTableSeeder extends Seeder {

    public function run() {
        $company = App\Modules\companies\models\Company::create([
                    'name' => 'Red Eyes',
                    'address' => '123 example street',
                    'phone' => '+201122334455',
                    'email' => 'info@red-eyes.com.eg',
                    'logo' => '',
                    'latitude' => '31.25333',
                    'longitude' => '30.00122'
        ]);

        $roleAdmin = App\Modules\users\models\Role::create([
                    'label' => 'Super Administrator',
                    'name' => 'super_admin'
        ]);

        $roleGuest = App\Modules\users\models\Role::create([
                    'label' => 'Guest',
                    'name' => 'guest'
        ]);

        $userAdmin = App\Modules\users\models\User::create([
              
                    'username' => 'amr',
                    'email' => 'amr.gamal878@gmail.com',
                    'password' => \Hash::make('12345678'),
                    'token' => \Hash::make(\Illuminate\Support\Str::random(60)),
                    'display_name' => 'Amr Gamal',
                    'bio' => 'Web Developer',
        ]);

        $userGuest = App\Modules\users\models\User::create([
                    'username' => 'guest',
                    'email' => 'guest@test.com',
                    'password' => \Hash::make('12345678'),
                    'token' => \Hash::make(\Illuminate\Support\Str::random(60)),
                    'display_name' => 'Guest User',
                    'bio' => 'Just A Stalker',
                   
        ]);

        $permission = \App\Modules\users\models\Permission::create([
                    'name' => 'manage_users',
                    'label' => 'Manage Users'
        ]);

        $permission = \App\Modules\users\models\Permission::create([
                    'name' => 'manage_news',
                    'label' => 'Manage News'
        ]);

        $userAdmin->grantRole([$roleAdmin]);
        $roleAdmin->grantAccess([$permission]);
        $userGuest->grantRole([$roleGuest]);
    }

}
