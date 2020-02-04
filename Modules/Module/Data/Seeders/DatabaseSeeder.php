<?php

namespace Modules\Module\Data\Seeders;

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
            'created_uuid' => !is_null(request()->user()) ? request()->user()->uuid : session('uuid'),
            'updated_at'   => $now,
            'updated_uuid' => !is_null(request()->user()) ? request()->user()->uuid : session('uuid'),
            'module'       => 'Module',
            'core'         => true
        ]);

        DB::table('modules_permissions')->insert([
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
        ]);

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
            'href'         => route('module-index'),
            'deleteable'   => false
        ]);
    }
}
