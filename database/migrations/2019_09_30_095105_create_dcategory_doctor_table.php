<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDcategoryDoctorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dcategory_doctor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("doctor_id")->unsigned();
            $table->bigInteger("dcategory_id")->unsigned();
            $table->timestamps();

            $table->foreign("doctor_id")->references("id")->on("doctors")->onDelete("cascade");
            $table->foreign("dcategory_id")->references("id")->on("dcategories")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dcategory_doctor');
    }
}
