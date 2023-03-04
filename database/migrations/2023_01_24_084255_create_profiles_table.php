<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('position')->nullable();
            $table->enum('gender',['Male','Female','Other'])->default('Male');
            $table->string('fax')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('company_name',350)->nullable();
            $table->string('company_address',500)->nullable();
            $table->string('google_location_link',400)->nullable();
            $table->string('facebook_link',400)->nullable();
            $table->string('twitter_link',400)->nullable();
            $table->string('linkedin_link',400)->nullable();
            $table->string('facts',400)->nullable();
            $table->string('company_logo',400)->nullable();
            $table->mediumText('description')->nullable();
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
        Schema::dropIfExists('profiles');
    }
};
