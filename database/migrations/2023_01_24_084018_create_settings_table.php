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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name',100)->nullable();
            $table->string('title',300)->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address',300)->nullable();
            $table->longText('description',500)->nullable();
            $table->string('favicon',300)->default('default.png');
            $table->string('logo',500)->default('default.png');
            $table->string('footer_logo',500)->default('default.png');
            $table->string('admin_logo',500)->default('default.png');
            $table->string('facebook',300)->nullable();
            $table->string('youtube',300)->nullable();
            $table->string('twitter',300)->nullable();
            $table->string('instagram',300)->nullable();
            $table->text('meta_title',300)->nullable();
            $table->longText('meta_description',500)->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('settings');
    }
};
