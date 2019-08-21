<?php

namespace psnXT\Modules\Install\Data\Seeders;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * @throws \Exception
     */
    public function run()
    {
        Model::unguard();

        $now        = now();
        $moduleUuid = Uuid::uuid4();

        DB::table('modules')->insert([
            'uuid'         => $moduleUuid,
            'created_at'   => $now,
            'created_uuid' => session('uuid'),
            'updated_at'   => $now,
            'updated_uuid' => session('uuid'),
            'module'       => 'Install',
            'core'         => true
        ]);

        DB::table('settings')->insert([
            [
                'uuid'           => Uuid::uuid4(),
                'created_at'     => $now,
                'created_uuid'   => session('uuid'),
                'updated_at'     => $now,
                'updated_uuid'   => session('uuid'),
                'module_uuid'    => $moduleUuid,
                'setting'        => 'APP_CUSTOMER',
                'setting_value'  => request()->input('APP_CUSTOMER'),
                'setting_values' => null,
                'setting_type'   => 's'
            ],
            [
                'uuid'           => Uuid::uuid4(),
                'created_at'     => $now,
                'created_uuid'   => session('uuid'),
                'updated_at'     => $now,
                'updated_uuid'   => session('uuid'),
                'module_uuid'    => $moduleUuid,
                'setting'        => 'APP_CUSTOMER_BRANDING',
                'setting_value'  => 'branding.jpg',
                'setting_values' => null,
                'setting_type'   => 's'
            ]
        ]);
    }
}
