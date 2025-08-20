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
        Schema::create('sdgs', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            
            // Target SDGS (5 target utama)
            $table->text('target_1')->nullable()->comment('Target 1: Tanpa Kemiskinan');
            $table->text('target_2')->nullable()->comment('Target 2: Tanpa Kelaparan');
            $table->text('target_3')->nullable()->comment('Target 3: Kehidupan Sehat');
            $table->text('target_4')->nullable()->comment('Target 4: Pendidikan Berkualitas');
            $table->text('target_5')->nullable()->comment('Target 5: Kesetaraan Gender');
            
            // Skor untuk masing-masing target (0-100)
            $table->decimal('skor_1', 5, 2)->nullable()->default(0);
            $table->decimal('skor_2', 5, 2)->nullable()->default(0);
            $table->decimal('skor_3', 5, 2)->nullable()->default(0);
            $table->decimal('skor_4', 5, 2)->nullable()->default(0);
            $table->decimal('skor_5', 5, 2)->nullable()->default(0);
            
            // Skor rata-rata
            $table->decimal('skor_rata_rata', 5, 2)->default(0);
            
            $table->year('tahun');
            $table->text('keterangan')->nullable();
            $table->string('gambar')->nullable();
            $table->boolean('tampil_infografis')->default(false);
            $table->string('warna_chart', 7)->default('#ff6b35');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sdgs');
    }
};
