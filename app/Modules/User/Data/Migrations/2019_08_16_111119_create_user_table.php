<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->char('uuid', 36);
            $table->char('tenant_uuid', 36);
            $table->dateTime('created_at');
            $table->char('created_uuid', 36);
            $table->dateTime('updated_at');
            $table->char('updated_uuid', 36);
            $table->dateTime('activated_at');
            $table->char('activated_uuid', 36);
            $table->dateTime('deactivated_at');
            $table->char('deactivated_uuid', 36);
            $table->dateTime('lastlogin_at');
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('remember_token', 255);
            $table->string('activation_token', 20);
            $table->tinyInteger('failed_logins')->unsigned();
            $table->tinyInteger('failed_logins_max')->unsigned();
            $table->tinyInteger('password_expires')->unsigned();
            $table->tinyInteger('password_expires_days')->unsigned();

            $table->index('uuid', 'uuid');
            $table->index('tenant_uuid', 'tenant_uuid');
            $table->index('created_uuid', 'created_uuid');
            $table->index('updated_uuid', 'updated_uuid');
            $table->index('activated_uuid', 'activated_uuid');
            $table->index('deactivated_uuid', 'deactivated_uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
