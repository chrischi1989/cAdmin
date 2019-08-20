<?php

namespace psnXT\Modules\Navigation\Data\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    private $module     = 'Navigation';
    private $moduleIcon = 'fas fa-list';
    /**
     * @throws \Exception
     */
    public function run()
    {

        $now        = now();
        $moduleUuid = Uuid::uuid4();

        // Navigations-Modul eintragen
        DB::table('modules')->insert([
            'uuid'         => $moduleUuid,
            'created_at'   => $now,
            'created_uuid' => !is_null(request()->user()) ? request()->user()->uuid : null,
            'updated_at'   => $now,
            'updated_uuid' => !is_null(request()->user()) ? request()->user()->uuid : null,
            'module'       => 'Navigation',
            'core'         => true
        ]);

        // Berechtigungen fuer Navigationsmodul eintragen
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
            ]
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
            'href'        => route('navigation-index'),
            'deleteable'  => false
        ]);
    }
}
