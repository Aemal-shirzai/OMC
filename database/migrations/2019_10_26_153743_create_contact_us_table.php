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
            $table->integer("phoneNumber");
            $table->email("emailAddress");
            // THis company column is for the contact us messages which are fro ads
            $table->string("company")->nullable();

            //  If the sender aleady have an account in our website theis senderUsername column is for
            $table->string("senderUsername")->nullable();

            $table->text("message");
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
        Schema::dropIfExists('contact_us');
    }
}
