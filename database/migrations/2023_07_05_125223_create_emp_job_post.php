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
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')->references('id')->on('employers')->onDelete('cascade');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('india_city')->onDelete('cascade');
            $table->string('job_title');
            $table->string('url_location')->nullable();
            $table->decimal('min_salary', 7, 2);
            $table->decimal('max_salary', 8, 2);
            $table->text('job_descriptions');
            $table->string('qualification',50);
            $table->string('experience',20);
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
