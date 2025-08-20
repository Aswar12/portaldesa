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
            // Add string columns for agama, pekerjaan, jenis_kelamin
            if (!Schema::hasColumn('penduduks', 'agama')) {
                $table->string('agama')->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('penduduks', 'pekerjaan')) {
                $table->string('pekerjaan')->nullable()->after('agama');
            }
            if (!Schema::hasColumn('penduduks', 'jenis_kelamin')) {
                $table->string('jenis_kelamin')->nullable()->after('tempat_lahir');
            }
            
            // Add detail columns for custom entries
            if (!Schema::hasColumn('penduduks', 'pekerjaan_detail')) {
                $table->string('pekerjaan_detail')->nullable()->after('pekerjaan')->comment('Detail jika pekerjaan = Lainnya');
            }
            if (!Schema::hasColumn('penduduks', 'agama_detail')) {
                $table->string('agama_detail')->nullable()->after('agama')->comment('Detail jika agama = Lainnya');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            if (Schema::hasColumn('penduduks', 'agama')) {
                $table->dropColumn('agama');
            }
            if (Schema::hasColumn('penduduks', 'pekerjaan')) {
                $table->dropColumn('pekerjaan');
            }
            if (Schema::hasColumn('penduduks', 'jenis_kelamin')) {
                $table->dropColumn('jenis_kelamin');
            }
            if (Schema::hasColumn('penduduks', 'pekerjaan_detail')) {
                $table->dropColumn('pekerjaan_detail');
            }
            if (Schema::hasColumn('penduduks', 'agama_detail')) {
                $table->dropColumn('agama_detail');
            }
        });
    }
};
