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
        Schema::table('penduduks', function (Blueprint $table) {
            if (!Schema::hasColumn('penduduks', 'kk')) {
                $table->string('kk')->nullable()->after('nik');
            }
            if (!Schema::hasColumn('penduduks', 'tempat_lahir')) {
                $table->string('tempat_lahir')->nullable()->after('nama');
            }
            if (!Schema::hasColumn('penduduks', 'status_perkawinan')) {
                $table->string('status_perkawinan')->nullable()->after('pekerjaan_id');
            }
            if (!Schema::hasColumn('penduduks', 'kewarganegaraan')) {
                $table->string('kewarganegaraan')->nullable()->after('status_perkawinan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            if (Schema::hasColumn('penduduks', 'kk')) {
                $table->dropColumn('kk');
            }
            if (Schema::hasColumn('penduduks', 'tempat_lahir')) {
                $table->dropColumn('tempat_lahir');
            }
            if (Schema::hasColumn('penduduks', 'status_perkawinan')) {
                $table->dropColumn('status_perkawinan');
            }
            if (Schema::hasColumn('penduduks', 'kewarganegaraan')) {
                $table->dropColumn('kewarganegaraan');
            }
        });
    }
};
