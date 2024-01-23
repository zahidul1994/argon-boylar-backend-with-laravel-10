<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blood_searches', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('blood_group',['A+','A-','B+','B-','O+','O-','AB+','AB-'])->default('O+');
            $table->integer('amount_bag')->default(1);
            $table->string('division',50)->nullable();
            $table->string('district',60)->nullable();
            $table->string('upazila',100)->nullable();
            $table->string('union',100)->nullable();
            $table->bigInteger('created_by_user_id')->default(1);
            $table->bigInteger('updated_by_user_id')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_searches');
    }
};
