<?php

namespace psnXT\Modules\User\Data\Seeders;

use DB;
use Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    private $module     = 'Benutzer';
    private $moduleIcon = 'fas fa-users';

    /**
     * @throws \Exception
     */
    public function run() {
        $now        = now();
        $moduleUuid = Uuid::uuid4();

        DB::table('users')->insert([
            'uuid'                  => session('uuid'),
            'created_at'            => $now,
            'created_uuid'          => session('uuid'),
            'updated_at'            => $now,
            'updated_uuid'          => session('uuid'),
            'activated_at'          => $now,
            'activated_uuid'        => session('uuid'),
            'email'                 => request()->input('email'),
            'password'              => Hash::make(session('password')),
            'activation_token'      => Str::random(20),
            'failed_logins_max'     => 5,
            'password_expires_days' => 90
        ]);

        DB::table('users_profiles')->insert([
            'uuid'         => Uuid::uuid4(),
            'user_uuid'    => session('uuid'),
            'created_at'   => $now,
            'created_uuid' => session('uuid'),
            'updated_at'   => $now,
            'updated_uuid' => session('uuid')
        ]);

        DB::table('modules')->insert([
            'uuid'         => $moduleUuid,
            'created_at'   => $now,
            'created_uuid' => !is_null(request()->user()) ? request()->user()->uuid : null,
            'updated_at'   => $now,
            'updated_uuid' => !is_null(request()->user()) ? request()->user()->uuid : null,
            'module'       => 'User',
            'core'         => true
        ]);

        DB::table('settings')->insert([
            [
                'uuid'           => Uuid::uuid4(),
                'created_at'     => $now,
                'updated_at'     => $now,
                'module_uuid'    => $moduleUuid,
                'description'    => 'Ablaufzeit von Passwörtern',
                'setting'        => 'password_expires',
                'setting_value'  => 90,
                'setting_values' => null,
                'setting_type'   => 'nd'
            ],
            [
                'uuid'           => Uuid::uuid4(),
                'created_at'     => $now,
                'updated_at'     => $now,
                'module_uuid'    => $moduleUuid,
                'description'    => 'Anmeldeversuche vor Sperrung',
                'setting'        => 'failed_logins_max',
                'setting_value'  => 5,
                'setting_values' => null,
                'setting_type'   => 'n'
            ],
            [
                'uuid'           => Uuid::uuid4(),
                'created_at'     => $now,
                'updated_at'     => $now,
                'module_uuid'    => $moduleUuid,
                'description'    => 'Gültigkeit des Links zum Passwort zurücksetzen',
                'setting'        => 'password_reset_expires',
                'setting_value'  => 15,
                'setting_values' => null,
                'setting_type'   => 'nm'
            ],
            [
                'uuid'           => Uuid::uuid4(),
                'created_at'     => $now,
                'updated_at'     => $now,
                'module_uuid'    => $moduleUuid,
                'description'    => 'Gültigkeit des Links zum Erstlogin',
                'setting'        => 'first_login_expires',
                'setting_value'  => 7,
                'setting_values' => null,
                'setting_type'   => 'nd'
            ],
            [
                'uuid'           => Uuid::uuid4(),
                'created_at'     => $now,
                'updated_at'     => $now,
                'module_uuid'    => $moduleUuid,
                'setting'        => 'login_delay',
                'description'    => 'Inkrementelle Anmeldeverzögerung',
                'setting_value'  => 3,
                'setting_values' => null,
                'setting_type'   => 'ns'
            ],
            [
                'uuid'           => Uuid::uuid4(),
                'created_at'     => $now,
                'updated_at'     => $now,
                'module_uuid'    => $moduleUuid,
                'setting'        => 'login_errors',
                'description'    => 'Detailgrad der Anmeldefehler',
                'setting_value'  => 1,
                'setting_values' => 'a:2:{i:0;s:13:"Keine Ausgabe";i:1;s:24:"Allgemeine Fehlerausgabe";}',
                'setting_type'   => 'ss'
            ]
        ]);

        DB::table('modules_permissions')->insert([
            [
                'uuid'        => Uuid::uuid4(),
                'module_uuid' => $moduleUuid,
                'created_at'  => $now,
                'updated_at'  => $now,
                'permission'  => 'create'
            ],
            [
                'uuid'        => Uuid::uuid4(),
                'module_uuid' => $moduleUuid,
                'created_at'  => $now,
                'updated_at'  => $now,
                'permission'  => 'read'
            ],
            [
                'uuid'        => Uuid::uuid4(),
                'module_uuid' => $moduleUuid,
                'created_at'  => $now,
                'updated_at'  => $now,
                'permission'  => 'update'
            ],
            [
                'uuid'        => Uuid::uuid4(),
                'module_uuid' => $moduleUuid,
                'created_at'  => $now,
                'updated_at'  => $now,
                'permission'  => 'delete'
            ],
        ]);

        DB::table('navigation')->insert([
            'uuid'        => Uuid::uuid4(),
            'parent_uuid' => null,
            'module_uuid' => $moduleUuid,
            'created_at'  => $now,
            'updated_at'  => $now,
            'position'    => 0,
            'icon'        => $this->moduleIcon,
            'title'       => $this->module,
            'href'        => route('user-index'),
            'deleteable'  => false
        ]);
    }
}
