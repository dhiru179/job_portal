<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpJobPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_job_post', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('job_title');
            $table->string('url_location')->nullable();
            $table->tinyInteger('no_of_vacancy');
            $table->decimal('min_salary', 7, 2);
            $table->decimal('max_salary', 8, 2);
            $table->text('job_descriptions');
            $table->unsignedBigInteger('education_standard_id');
            $table->foreign('education_standard_id')->references('id')->on('education_standard')->onDelete('cascade');
            $table->tinyInteger('experience');
            $table->enum('gender', ['male', 'female', 'both']);
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
        Schema::dropIfExists('emp_job_post');
    }
}
