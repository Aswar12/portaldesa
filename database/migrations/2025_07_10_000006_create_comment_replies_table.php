<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comment_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comment_id')->constrained('comments')->onDelete('cascade');
            $table->string('nama');
            $table->string('email');
            $table->text('isi');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('comment_replies');
    }
};
