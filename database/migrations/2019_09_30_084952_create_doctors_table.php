<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("fullName");
            $table->boolean("status");
            $table->bigInteger("country_id")->unsigned()->nullable();
            $table->bigInteger("province_id")->unsigned()->nullable();
            $table->bigInteger("district_id")->unsigned()->nullable();
            $table->string("street")->nullable();
            $table->boolean("gender");
            $table->datetime("DateOfBirth")->nullable();
            $table->Text("Bio")->nullable();
            $table->timestamps();

            $table->foreign("country_id")->references("id")->on("countries")->onDelete("set null")->onUpdate("set null");
            $table->foreign("province_id")->references("id")->on("provinces")->onDelete("set null")->onUpdate("set null");
            $table->foreign("district_id")->references("id")->on("districts")->onDelete("set null")->onUpdate("set null");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
}
