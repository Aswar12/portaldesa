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
            $table->boolean('tampil_infografis')->default(false)->after('user_id');
            $table->string('warna_chart', 7)->default('#17a2b8')->after('tampil_infografis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anggarans', function (Blueprint $table) {
            $table->dropColumn(['tampil_infografis', 'warna_chart']);
        });
    }
};
