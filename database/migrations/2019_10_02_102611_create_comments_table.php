<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            // The reason that this filed is nullable is that the comment may only have photo
            $table->longText("content")->nullable();
            // for user or doctor
            $table->string("owner_type");
            $table->bigInteger("owner_id")->unsigned();
            // for post or question
            $table->string("to_type");
            $table->bigInteger("to_id")->unsigned();
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
        Schema::dropIfExists('comments');
    }
}
