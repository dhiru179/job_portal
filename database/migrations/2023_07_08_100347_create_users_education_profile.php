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
            $table->unsignedBigInteger('education_standard_id');
            $table->foreign('education_standard_id')->references('id')->on('education_standard')->onDelete('cascade');
            $table->string('board_university',100)->nullable();
            $table->string('institute_name',100)->nullable();
            $table->string('start_year',4)->nullable();
            $table->string('passing_year',4)->nullable();
            $table->string('marks_grade',4)->nullable();
            $table->string('total_marks',4)->nullable();
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
