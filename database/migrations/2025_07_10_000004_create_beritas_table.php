<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->foreignId('status_id')->constrained('post_statuses')->onDelete('cascade');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('isi');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
