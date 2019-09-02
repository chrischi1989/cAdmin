<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->char('uuid', 36);
            $table->char('tenant_uuid', 36)->nullable();
            $table->dateTime('created_at');
            $table->char('created_uuid', 36);
            $table->dateTime('updated_at');
            $table->char('updated_uuid', 36);
            $table->dateTime('activated_at')->nullable();
            $table->char('activated_uuid', 36)->nullable();
            $table->dateTime('deactivated_at')->nullable();
            $table->char('deactivated_uuid', 36)->nullable();
            $table->dateTime('lastlogin_at')->nullable();
            $table->string('email_hashed', 255);
            $table->text('email_encrypted');
            $table->string('password', 255);
            $table->string('remember_token', 255)->nullable();
            $table->string('activation_token', 20);
            $table->tinyInteger('failed_logins')->unsigned()->default(0);
            $table->tinyInteger('failed_logins_max')->unsigned()->default(5);
            $table->tinyInteger('password_expires')->unsigned()->default(1);
            $table->tinyInteger('password_expires_days')->unsigned()->default(90);

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
