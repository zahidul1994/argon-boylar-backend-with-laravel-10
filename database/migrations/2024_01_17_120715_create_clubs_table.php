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
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('club_name');
            $table->string('contact_person')->nullable();
            $table->string('email')->nullable();
            $table->json('phones')->nullable();
            $table->string('division',50)->nullable();
            $table->string('district',60)->nullable();
            $table->string('upazila',100)->nullable();
            $table->string('union',100)->nullable();
            $table->string('address',400)->nullable();
            $table->string('image')->default('not-found.webp');
            $table->tinyInteger('status')->default(0);
            $table->bigInteger('created_by_user_id')->default(1);
            $table->bigInteger('updated_by_user_id')->default(1);
            $table->softDeletes();
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clubs');
    }
};
