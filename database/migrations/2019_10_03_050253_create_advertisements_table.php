<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("title");
            $table->text("content");
            $table->date("expire_date");

            // add type
            $table->bigInteger("advertisement_category_id")->unsigned()->nullable();
            $table->foreign("advertisement_category_id")->references("id")->on("advertisement_categories")->onDelete("set null")->onUpdate("cascade");
            // admin 
            $table->bigInteger("normal_user_id")->unsigned()->nullable();
            $table->foreign("normal_user_id")->references("id")->on("normal_users")->onDelete("set null")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
}
