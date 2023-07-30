<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('company_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->string('primary_phone', 15)->nullable();
            $table->string('secondary_phone', 15)->nullable();
            $table->enum('company_status',['active','deactive'])->nullable();

            $table->string('f_name', 100)->nullable();
            $table->string('m_name', 100)->nullable();
            $table->string('l_name', 100)->nullable();
            $table->enum('gender', ['male', 'female', 'others'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('about_self')->nullable();
            $table->string('profile_pic',100)->nullable();
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
        Schema::dropIfExists('user_profile');
    }
}
