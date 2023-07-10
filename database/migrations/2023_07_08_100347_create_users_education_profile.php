<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersEducationProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_education_profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('qualification_id');
            $table->foreign('qualification_id')->references('id')->on('education_standard')->onDelete('cascade');
            $table->unsignedBigInteger('board_university_id');
            $table->foreign('board_university_id')->references('id')->on('board_university')->onDelete('cascade');
            $table->tinyInteger('start_year')->nullable();
            $table->tinyInteger('end_year')->nullable();
            $table->string('marks_grade',4)->nullable();
            $table->tinyInteger('total_marks')->nullable();
            $table->string('course',100)->nullable();
            $table->string('specialization',100)->nullable();
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
        Schema::dropIfExists('users_education_profile');
    }
}
