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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string("image")->default("https://res.cloudinary.com/doztsevci/image/upload/v1713042445/gdp8jcsixtihlcrubfh0.png");
            $table->string("gender")->nullable();
            $table->string("website")->nullable();
            $table->text("bio")->nullable();
            $table->boolean("is_admin")->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('code')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
