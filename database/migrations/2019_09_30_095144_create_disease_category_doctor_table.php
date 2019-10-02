<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseaseCategoryDoctorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // this is pivot table between tags and doctors
        Schema::create('disease_category_doctor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("doctor_id")->unsigned();
            $table->bigInteger("disease_category_id")->unsigned();
            $table->timestamps();

            $table->foreign("doctor_id")->references("id")->on("doctors")->onDelete("cascade");
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
        Schema::dropIfExists('disease_category_doctor');
    }
}
