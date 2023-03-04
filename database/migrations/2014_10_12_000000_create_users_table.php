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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('user_type')->default('Admin');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->default('not-found.webp');
            $table->integer('refer')->nullable();
            $table->integer('otp')->nullable();
            $table->json('language')->nullable();
            $table->ipAddress('ip_address')->default('101.2.160.0');
			$table->tinyInteger('status')->default(0);
            $table->bigInteger('created_by_user_id')->default(1);
            $table->bigInteger('updated_by_user_id')->default(1);
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
