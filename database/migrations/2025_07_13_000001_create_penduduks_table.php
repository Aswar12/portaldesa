<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('nama');
            $table->date('ttl'); // tanggal lahir
            $table->unsignedBigInteger('jenis_kelamin_id');
            $table->unsignedBigInteger('agama_id');
            $table->string('pekerjaan');
            $table->timestamps();

            $table->foreign('jenis_kelamin_id')->references('id')->on('jenis_kelamins')->onDelete('cascade');
            $table->foreign('agama_id')->references('id')->on('agamas')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};
