<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_profiles', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->char('uuid', 36);
            $table->char('user_uuid', 36);
            $table->dateTime('created_at');
            $table->char('created_uuid', 36);
            $table->dateTime('updated_at');
            $table->char('updated_uuid', 36);
            $table->string('salutation', 20)->nullable();
            $table->string('title', 60)->nullable();
            $table->string('firstname', 120)->nullable();
            $table->string('lastname', 120)->nullable();
            $table->string('street', 200)->nullable();
            $table->string('housenumber', 20)->nullable();
            $table->string('postalcode', 10)->nullable();
            $table->string('location', 200)->nullable();
            $table->string('telephone', 50)->nullable();
            $table->string('cellphone', 50)->nullable();

            $table->index('uuid');
            $table->index('user_uuid');
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
        Schema::dropIfExists('users_profiles');
    }
}
