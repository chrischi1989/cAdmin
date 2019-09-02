<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersPasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_password_resets', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->char('uuid', 36);
            $table->char('user_uuid', 36);
            $table->dateTime('created_at');
            $table->char('created_uuid', 36);
            $table->dateTime('updated_at');
            $table->char('updated_uuid', 36);
            $table->string('token', 20);
            $table->dateTime('token_until');

            $table->index('uuid');
            $table->index('created_uuid');
            $table->index('updated_uuid');
            $table->index('token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_password_resets');
    }
}
