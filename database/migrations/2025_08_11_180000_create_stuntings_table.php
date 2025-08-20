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
        Schema::create('stuntings', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->integer('balita_normal')->default(0);
            $table->integer('balita_stunting')->default(0);
            $table->integer('balita_kurus')->default(0);
            $table->integer('balita_gemuk')->default(0);
            $table->year('tahun');
            $table->text('keterangan')->nullable();
            $table->string('gambar')->nullable();
            $table->boolean('tampil_infografis')->default(false);
            $table->string('warna_chart', 7)->default('#ff6b6b');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stuntings');
    }
};
