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
        Schema::create('videos', function (Blueprint $table) {
        
         $table->id();
         $table->unsignedBigInteger('user_id');
         $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade"); 
         $table->string('title')->nullable();
         $table->string('original_language', 10)->nullable();
         $table->string('target_language', 10)->nullable();
         $table->string('status')->default('uploaded');
         $table->string('video_path');
         
         $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
