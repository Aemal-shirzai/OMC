<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            //comment Id
            $table->bigInteger("comment_id")->unsigned();
            // user or doctor
            $table->string("owner_type");
            $table->bigInteger("owner_id")->unsigned();
            $table->timestamps();

            $table->foreign("comment_id")->references("id")->on("comments")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_replies');
    }
}
