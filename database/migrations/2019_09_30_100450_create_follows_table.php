<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("normal_user_id")->unsigned();
            $table->bigInteger("doctor_id")->unsigned();
            $table->timestamps();

            $table->foreign("normal_user_id")->references("id")->on("normal_users")->onDelete("cascade");
            $table->foreign("doctor_id")->references("id")->on("doctors")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
