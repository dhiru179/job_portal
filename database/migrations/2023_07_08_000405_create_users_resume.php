<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersResume extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_resume', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('f_name',100)->nullable();
            $table->string('m_name',100)->nullable();
            $table->string('l_name',100)->nullable();
            $table->enum('gender',['male','female','others'])->nullable();
            $table->string('email')->nullable();
            $table->string('phone_1',15)->nullable();
            $table->string('phone_2',15)->nullable();
            $table->enum('marital _status',['married','single','widowed','seperated','divorced'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('about_self')->nullable();
            $table->string('nationality',100)->nullable();
            $table->string('profile_img',100)->nullable();
            $table->json('social_url')->nullable();
            $table->json('language_skills')->nullable();
            $table->text('resume_objective')->nullable();
            $table->string('state',100)->nullable();
            $table->string('city',100)->nullable();
            $table->string('pincode',8)->nullable();
            $table->json('project')->nullable();
            $table->json('interest')->nullable();
            $table->json('activity')->nullable();
            $table->json('achivement')->nullable();
            $table->decimal('last_salary',8,2)->nullable();
            $table->string('resume_files',100)->nullable();
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
        Schema::dropIfExists('users_resume');
    }
}
