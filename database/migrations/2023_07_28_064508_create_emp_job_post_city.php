<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpJobPostCity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_job_post_city', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_post_id');
            $table->foreign('job_post_id')->references('id')->on('emp_job_post')->onDelete('cascade');
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('id')->on('cities')->onDelete('cascade');
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
        Schema::dropIfExists('emp_job_post_city');
    }
}
