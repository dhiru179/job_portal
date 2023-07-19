<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersOthersEducationStandard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_others_education_standard', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('education_profile_id');
            $table->foreign('education_profile_id')->references('id')->on('users_education_profile')->onDelete('cascade');
            $table->string('others_educations',100);
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
        Schema::dropIfExists('users_others_education_standard');
    }
}
