<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->bigIncrements('id');
            // Normal Users
            $table->bigInteger("normalUser_id")->unsigned();
            // for post and question
            $table->string("fav_type");
            $table->bigInteger("fav_id")->unsigned();
            $table->timestamps();

            $table->foreign("normalUser_id")->references("id")->on("normal_users")->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}
