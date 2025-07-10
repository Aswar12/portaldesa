<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->string('produk');
            $table->string('slug')->unique();
            $table->string('pemilik');
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->string('kontak')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
