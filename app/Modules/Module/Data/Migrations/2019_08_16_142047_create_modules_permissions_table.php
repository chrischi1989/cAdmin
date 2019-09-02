<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules_permissions', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->char('uuid', 36);
            $table->char('module_uuid', 36);
            $table->datetime('created_at');
            $table->datetime('updated_at');
            $table->string('permission', 255);

            $table->index('uuid');
            $table->index('module_uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules_permissions');
    }
}
