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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('json_screma',5000)->nullable();
            $table->string('image',500)->nullable();
            $table->string('short_description')->nullable();
            $table->mediumText('long_description')->nullable();
            $table->Integer('view')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('categories');
    }
};
