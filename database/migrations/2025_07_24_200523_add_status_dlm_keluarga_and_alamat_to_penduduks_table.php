<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            if (!Schema::hasColumn('penduduks', 'status_dlm_keluarga')) {
                $table->string('status_dlm_keluarga')->nullable()->after('pekerjaan_id');
            }
            if (!Schema::hasColumn('penduduks', 'alamat')) {
                $table->text('alamat')->nullable()->after('status_dlm_keluarga');
            }
        });
    }

    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            if (Schema::hasColumn('penduduks', 'status_dlm_keluarga')) {
                $table->dropColumn('status_dlm_keluarga');
            }
            if (Schema::hasColumn('penduduks', 'alamat')) {
                $table->dropColumn('alamat');
            }
        });
    }
};
