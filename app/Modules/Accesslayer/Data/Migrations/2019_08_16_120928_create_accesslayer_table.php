<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccesslayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesslayer', function(Blueprint $table) {
            $table->increments('id');
            $table->char('uuid', 36);
            $table->dateTime('created_at');
            $table->char('created_uuid', 36);
            $table->dateTime('updated_at');
            $table->char('updated_uuid', 36);
            $table->string('layer', 255);
            $table->integer('priority')->unsigned()->default(100);

            $table->index('uuid', 'uuid');
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
        Schema::dropIfExists('accesslayer');
    }
}
