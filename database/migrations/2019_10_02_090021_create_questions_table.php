<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("title");
            $table->Text("content");
            $table->bigInteger("normal_user_id")->unsigned();

            $table->integer("UpVotes")->nullable();
            $table->integer("DownVotes")->nullable();
            $table->integer("follower")->nullable();
            $table->timestamps();

            $table->foreign("normal_user_id")->references("id")->on("normal_users")->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
