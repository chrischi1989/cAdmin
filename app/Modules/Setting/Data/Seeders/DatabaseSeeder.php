<?php


namespace psnXT\Modules\Setting\Data\Seeders;


use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    private $module     = 'Einstellungen';
    private $moduleIcon = 'fas fa-cogs';

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
            'module'       => 'Settings',
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
            ],
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
            'href'         => route('setting-index'),
            'deleteable'   => false
        ]);
    }
}
