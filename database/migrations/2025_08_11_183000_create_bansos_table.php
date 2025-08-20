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
        Schema::create('bansos', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('jenis_bansos', 50)->comment('PKH, BPNT, BST, PBI, Sembako, BLT');
            $table->integer('jumlah_penerima')->default(0);
            $table->decimal('jumlah_dana', 15, 2)->default(0);
            $table->date('periode_mulai');
            $table->date('periode_selesai')->nullable();
            $table->year('tahun');
            $table->text('keterangan')->nullable();
            $table->string('gambar')->nullable();
            $table->boolean('tampil_infografis')->default(false);
            $table->string('warna_chart', 7)->default('#28a745');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bansos');
    }
};
