<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->char('uuid', 36);
            $table->dateTime('created_at');
            $table->char('created_uuid', 36);
            $table->dateTime('updated_at');
            $table->char('updated_uuid', 36);
            $table->integer('user_quota')->unsigned()->nullable();
            $table->string('tenant', 255);
            $table->string('street', 120)->nullable();
            $table->string('housenumber', 20)->nullable();;
            $table->string('postalcode', 20)->nullable();;
            $table->string('location', 80)->nullable();;
            $table->string('email', 120);
            $table->string('telephone', 20)->nullable();;
            $table->string('mobile', 20)->nullable();
            $table->string('website', 120)->nullable();


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
        Schema::dropIfExists('tenants');
    }
}
