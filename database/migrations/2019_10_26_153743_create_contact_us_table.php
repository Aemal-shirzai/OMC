<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("fullName");
            $table->string("phoneNumber");
            $table->string("emailAddress");

            //  If the sender aleady have an account in our website column is for
            $table->bigInteger("account_id")->unsigned()->nullable();

            $table->text("message");
            $table->timestamps();

            $table->foreign("account_id")->references("id")->on("accounts")->onDelete("set Null")->onUpdate("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_us');
    }
}
