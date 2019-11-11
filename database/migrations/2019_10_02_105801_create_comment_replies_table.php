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
            $table->longText("content");
            //comment Id
            $table->bigInteger("comment_id")->unsigned();
            // Account table
            $table->bigInteger("account_id")->unsigned();
            $table->timestamps();

            $table->foreign("comment_id")->references("id")->on("comments")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('comment_replies');
    }
}
