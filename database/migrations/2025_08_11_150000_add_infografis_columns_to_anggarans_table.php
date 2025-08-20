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
        Schema::table('anggarans', function (Blueprint $table) {
            $table->string('jenis')->default('belanja')->after('keterangan'); // pendapatan, belanja, pembiayaan
            $table->decimal('jumlah', 15, 2)->default(0)->after('jenis'); // jumlah anggaran
            $table->decimal('realisasi', 15, 2)->default(0)->after('jumlah'); // realisasi anggaran
            $table->year('tahun_anggaran')->default(date('Y'))->after('realisasi'); // tahun anggaran
            $table->string('kategori')->nullable()->after('tahun_anggaran'); // sub kategori
            $table->text('deskripsi')->nullable()->after('kategori'); // deskripsi detail
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anggarans', function (Blueprint $table) {
            $table->dropColumn(['jenis', 'jumlah', 'realisasi', 'tahun_anggaran', 'kategori', 'deskripsi']);
        });
    }
};
