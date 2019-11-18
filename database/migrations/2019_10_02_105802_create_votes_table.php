<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->bigIncrements('id');
              // for user or doctor (ACCOUNT)
            $table->bigInteger("account_id")->unsigned();
              // for  post , question , comments and replies
            $table->string("to_type");
            $table->bigInteger("to_id")->unsigned();
            $table->boolean("type"); // 1 for vote up and 0 for vote down
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
        Schema::dropIfExists('votes');
    }
}
