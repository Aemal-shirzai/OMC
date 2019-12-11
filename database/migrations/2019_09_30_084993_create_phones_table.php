<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("phone");
            // we have two types of numbers personal and office (1 is for personal and 2 is for office)
            $table->tinyInteger("type");
            // Account table foreign key
            $table->bigInteger("account_id")->unsigned();
            $table->timestamps();

            $table->foreign("account_id")->references("id")->on("accounts")->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phones');
    }
}
