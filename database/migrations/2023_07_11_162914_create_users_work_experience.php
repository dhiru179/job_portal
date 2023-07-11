<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersWorkExperience extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_work_experience', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_resume_id');
            $table->foreign('users_resume_id')->references('id')->on('users_resume')->onDelete('cascade');
            $table->enum('is_current_working',['yes','no'])->nullable();
            $table->enum('work_type',['full','part'])->nullable();
            $table->string('company_name',100)->nullable();
            $table->string('desigination',100)->nullable();
            $table->string('job_city',100)->nullable();
            $table->date('joining_data')->nullable();
            $table->date('quit_date')->nullable();
            $table->json('job_skills')->nullable();
            $table->text('profile_desc')->nullable();
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
        Schema::dropIfExists('users_work_experience');
    }
}
