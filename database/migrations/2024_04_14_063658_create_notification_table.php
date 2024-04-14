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
        Schema::create('notification', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("senderId");
            $table->unsignedBigInteger("reciverId");
            $table->boolean("seen");
            $table->string("message");
            $table->timestamps();
            $table->foreign('senderId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reciverId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification');
    }
};
