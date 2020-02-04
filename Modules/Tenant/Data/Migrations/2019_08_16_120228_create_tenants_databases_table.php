<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantsDatabasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants_databases', function (Blueprint $table) {
            $table->increments('id');
            $table->char('uuid', 36);
            $table->char('tenant_uuid', 36);
            $table->dateTime('created_at');
            $table->char('created_uuid', 36);
            $table->dateTime('updated_at');
            $table->char('updated_uuid', 36);
            $table->boolean('schema_created');
            $table->text('connection');
            $table->text('hostname');
            $table->text('username');
            $table->text('password');
            $table->text('database');
            $table->text('port');

            $table->index('uuid', 'uuid');
            $table->index('tenant_uuid', 'tenant_uuid');
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
        Schema::dropIfExists('tenants_databases');
    }
}
