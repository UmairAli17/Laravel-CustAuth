<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions_roles', function(Blueprint $table)
        {  
            $table->integer('permissions_id')->unsigned();
            $table->integer('roles_id')->unsigned();


            $table->foreign('permissions_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');

            $table->foreign('roles_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('permissions_roles');
    }
}
