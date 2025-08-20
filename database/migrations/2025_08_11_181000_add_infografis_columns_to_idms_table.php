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
        Schema::table('idms', function (Blueprint $table) {
            $table->boolean('tampil_infografis')->default(false)->after('is_active');
            $table->string('warna_chart', 7)->default('#17a2b8')->after('tampil_infografis');
            $table->string('gambar')->nullable()->after('warna_chart');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->after('gambar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('idms', function (Blueprint $table) {
            $table->dropColumn(['tampil_infografis', 'warna_chart', 'gambar', 'user_id']);
        });
    }
};
