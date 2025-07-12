<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('video_id');
            $table->foreign("video_id")->references("id")->on("videos")->onDelete("cascade")->onUpdate("cascade");  
            $table->unsignedBigInteger('transcription_id');
            $table->foreign("transcription_id")->references("id")->on("transcriptions")->onDelete("cascade")->onUpdate("cascade");  
            $table->longText('translated_text')->nullable();
            $table->string('language', 10)->nullable(); 
                   $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
