<?php

namespace Modules\Accesslayer\Data\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    private $module     = 'Zugriffsebenen';
    private $moduleIcon = 'fas fa-user-lock';

    /**
     * @throws \Exception
     */
    public function run()
    {
        $now               = now();
        $data              = [];
        $moduleUuid        = Uuid::uuid4();
        $layerUuid         = Uuid::uuid4();
        $modulePermissions = [
            [
                'uuid'        => Uuid::uuid4(),
                'module_uuid' => $moduleUuid,
                'created_at'  => $now,
                'updated_at'  => $now,
                'permission'  => 'show'
            ],
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
                'permission'  => 'edit'
            ],
            [
                'uuid'        => Uuid::uuid4(),
                'module_uuid' => $moduleUuid,
                'created_at'  => $now,
                'updated_at'  => $now,
                'permission'  => 'destroy'
            ]
        ];

        /** Fuege Modul-Rechte hinzu */
        DB::table('modules_permissions')->insert($modulePermissions);

        $allPermissions = DB::table('modules_permissions')->get();
        foreach ($allPermissions as $permission) {
            $data[] = [
                'uuid'            => Uuid::uuid4(),
                'layer_uuid'      => $layerUuid,
                'permission_uuid' => $permission->uuid,
                'created_at'      => $now,
                'created_uuid'    => session('uuid'),
                'updated_at'      => $now,
                'updated_uuid'    => session('uuid')
            ];
        }

        /** Fuege Modul ein */
        DB::table('modules')->insert([
            'uuid'         => $moduleUuid,
            'created_at'   => $now,
            'created_uuid' => session('uuid'),
            'updated_at'   => $now,
            'updated_uuid' => session('uuid'),
            'module'       => 'Accesslayer',
            'core'         => true
        ]);


        /** Fuege Navigationspunkt ein */
        DB::table('navigation')->insert([
            'uuid'         => Uuid::uuid4(),
            'parent_uuid'  => null,
            'module_uuid'  => $moduleUuid,
            'created_at'   => $now,
            'created_uuid' => session('uuid'),
            'updated_at'   => $now,
            'updated_uuid' => session('uuid'),
            'position'     => 0,
            'icon'         => $this->moduleIcon,
            'title'        => $this->module,
            'href'         => route('accesslayer-index'),
            'deleteable'   => false
        ]);

        /** Fuege Admin-Zugriffsebene ein */
        DB::table('accesslayer')->insert([
            'uuid'         => $layerUuid,
            'created_at'   => $now,
            'created_uuid' => session('uuid'),
            'updated_at'   => $now,
            'updated_uuid' => session('uuid'),
            'layer'        => 'Administrator'
        ]);

        /** Weise Admin-Zugriffsebene alle Modul-Rechte zu */
        DB::table('accesslayer_has_modules_permissions')->insert($data);

        /** Weise Admin-Nutzer die Admin-Zugriffsebene zu  */
        DB::table('users_has_accesslayer')->insert([
            'uuid'         => Uuid::uuid4(),
            'user_uuid'    => session('uuid'),
            'layer_uuid'   => $layerUuid,
            'created_at'   => $now,
            'created_uuid' => session('uuid'),
            'updated_at'   => $now,
            'updated_uuid' => session('uuid')
        ]);
    }
}
