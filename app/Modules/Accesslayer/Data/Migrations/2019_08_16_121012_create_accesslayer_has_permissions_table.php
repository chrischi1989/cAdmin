<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccesslayerHasPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesslayer_has_modules_permissions', function(Blueprint $table) {
            $table->increments('id');
            $table->char('uuid', 36);
            $table->char('layer_uuid', 36);
            $table->char('permission_uuid', 36);
            $table->dateTime('created_at');
            $table->char('created_uuid', 36);
            $table->dateTime('updated_at');
            $table->char('updated_uuid', 36);

            $table->index('uuid', 'uuid');
            $table->index('layer_uuid', 'layer_uuid');
            $table->index('permission_uuid', 'permission_uuid');
            $table->index('created_uuid', 'created_uuid');
            $table->index('updated_uuid', 'updated_uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesslayer_has_modules_permissions');
    }
}
