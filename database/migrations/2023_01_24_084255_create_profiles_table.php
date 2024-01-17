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
            $table->string('date_of_birth')->nullable();
            $table->enum('gender',['Male','Female','Other'])->default('Male');
             $table->string('country')->default('Bangladesh');
            $table->enum('blood_group',['A+','A-','B+','B-','O+','O-','AB+','AB-'])->default('O+');
            $table->string('weight',50)->default(18);
            $table->string('division',50)->nullable();
            $table->string('district',60)->nullable();
            $table->string('upazila',100)->nullable();
            $table->string('union',100)->nullable();
            $table->string('address',400)->nullable();
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
