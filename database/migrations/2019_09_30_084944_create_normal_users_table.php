<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNormalUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('normal_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("firstName");
            $table->string("lastName");
            $table->bigInteger("role_id")->unsigned()->nullable();
            $table->boolean("status");
            $table->string("province");
            $table->string("district");
            $table->string("street");
            $table->boolean("gender");
            $table->date("DateOfBirth");
            $table->timestamps();

            $table->foreign("role_id")->references("id")->on("roles")->onDelete("set null")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('normal_users');
    }
}
