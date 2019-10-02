<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostAndQuestionCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_and_question_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            // category id
            $table->bigInteger("disease_category_id")->unsigned();
            
            // post or question
            $table->string("owner_type");
            $table->bigInteger("owner_id")->unsigned();
            $table->timestamps();

            $table->foreign("disease_category_id")->references("id")->on("disease_categories")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_and_question_category');
    }
}
