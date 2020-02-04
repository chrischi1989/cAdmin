<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->char('uuid', 36);
            $table->dateTime('created_at');
            $table->char('created_uuid', 36)->nullable();
            $table->dateTime('updated_at');
            $table->char('updated_uuid', 36)->nullable();
            $table->char('module_uuid', 36)->nullable();
            $table->string('description', 255)->nullable();
            $table->string('setting', 255);
            $table->string('setting_value', 255)->nullable();
            $table->text('setting_values')->nullable();
            $table->char('setting_type', 2);


            $table->index('uuid');
            $table->index('created_uuid');
            $table->index('updated_uuid');
            $table->index('module_uuid');
            $table->index('setting');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
