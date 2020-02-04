<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->char('uuid', 36);
            $table->char('parent_uuid', 36)->nullable();
            $table->datetime('created_at');
            $table->char('created_uuid', 36)->nullable();
            $table->datetime('updated_at');
            $table->char('updated_uuid', 36)->nullable();
            $table->string('module', 50);
            $table->string('public_name', 50)->nullable();
            $table->integer('position')->unsigned()->default(0);
            $table->boolean('core')->default(0);

            $table->index('uuid');
            $table->index('parent_uuid');
            $table->index('created_uuid');
            $table->index('updated_uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
