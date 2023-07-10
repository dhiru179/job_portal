<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personal_details_id');
            $table->foreign('personal_details_id')->references('id')->on('users_personal_details')->onDelete('cascade');
            $table->string('name',100);
            $table->enum('speak',['true','false']);
            $table->enum('read',['true','false']);
            $table->enum('write',['true','false']);
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
        Schema::dropIfExists('language');
    }
}
