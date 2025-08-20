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
        Schema::create('idms', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->decimal('skor_idm', 8, 4);
            $table->string('status_idm');
            $table->string('target_status');
            $table->decimal('skor_minimal', 8, 4);
            $table->decimal('penambahan', 8, 4);
            $table->decimal('skor_iks', 8, 4); // Indeks Ketahanan Sosial
            $table->decimal('skor_ike', 8, 4); // Indeks Ketahanan Ekonomi
            $table->decimal('skor_ikl', 8, 4); // Indeks Ketahanan Lingkungan
            $table->text('deskripsi')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('idms');
    }
};
