<?php

namespace psnXT\Modules\Module\Data\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    private $module     = 'Module';
    private $moduleIcon = 'fas fa-project-diagram';

    /**
     * @throws \Exception
     */
    public function run()
    {
        $now        = now();
        $moduleUuid = Uuid::uuid4();

        DB::table('modules')->insert([
            'uuid'         => $moduleUuid,
            'created_at'   => $now,
            'created_uuid' => !is_null(request()->user()) ? request()->user()->uuid : null,
            'updated_at'   => $now,
            'updated_uuid' => !is_null(request()->user()) ? request()->user()->uuid : null,
            'module'       => 'Modules',
            'core'         => true
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
            'href'        => route('module-index'),
            'deleteable'  => false
        ]);
    }
}
