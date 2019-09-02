<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->char('uuid', 36);
            $table->char('parent_uuid', 36)->nullable();
            $table->char('module_uuid', 36)->nullable();
            $table->dateTime('created_at');
            $table->char('created_uuid', 36)->nullable();
            $table->dateTime('updated_at');
            $table->char('updated_uuid', 36)->nullable();
            $table->dateTime('disabled_at')->nullable();
            $table->char('disabled_uuid', 36)->nullable();
            $table->integer('position')->unsigned();
            $table->string('icon', 60)->nullable();
            $table->string('title', 40);
            $table->string('href', 255)->nullable();
            $table->boolean('deleteable');

            $table->index('uuid');
            $table->index('module_uuid');
            $table->index('created_uuid');
            $table->index('updated_uuid');
            $table->index('disabled_uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('navigation');
    }
}
