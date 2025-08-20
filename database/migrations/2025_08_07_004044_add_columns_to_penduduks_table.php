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
            if (!Schema::hasColumn('penduduks', 'tempat_lahir')) {
                $table->string('tempat_lahir')->nullable()->after('ttl');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            if (Schema::hasColumn('penduduks', 'tempat_lahir')) {
                $table->dropColumn('tempat_lahir');
            }
        });
    }
};
