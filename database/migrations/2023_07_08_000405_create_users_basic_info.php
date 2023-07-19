<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersBasicInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_basic_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('f_name', 100)->nullable();
            $table->string('m_name', 100)->nullable();
            $table->string('l_name', 100)->nullable();
            $table->enum('gender', ['male', 'female', 'others'])->nullable();
            $table->string('email')->nullable();
            $table->string('phone_1', 15)->nullable();
            $table->string('phone_2', 15)->nullable();
            $table->enum('marital_status', ['married', 'single', 'widowed', 'seperated', 'divorced'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('about_self')->nullable();
            $table->string('nationality', 100)->nullable();


            // $table->json('language_skills')->nullable();
            // $table->text('resume_objective')->nullable();
            // $table->json('project')->nullable();
            // $table->json('interest')->nullable();
            // $table->json('activity')->nullable();
            // $table->json('achivement')->nullable();
            $table->enum('has_experience', ['yes', 'no'])->nullable();
            $table->decimal('last_salary', 8, 2)->nullable();
            $table->enum('salary_in', ['yearly', 'monthly'])->nullable();
            $table->enum('access_info', ['public', 'private']);
            $table->enum('published',['yes','no'])->default('no');
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
        Schema::dropIfExists('users_basic_info');
    }
}
