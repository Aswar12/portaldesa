<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Pekerjaan;
use App\Models\Penduduk;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penduduks', function (Blueprint $table) {
            $table->unsignedBigInteger('pekerjaan_id')->nullable()->after('agama_id');
        });

        $pekerjaanMapping = Pekerjaan::all()->pluck('id', 'pekerjaan')->toArray();

        Penduduk::chunkById(100, function ($penduduks) use ($pekerjaanMapping) {
            foreach ($penduduks as $penduduk) {
                $pekerjaanNama = trim($penduduk->pekerjaan);
                if (isset($pekerjaanMapping[$pekerjaanNama])) {
                    $penduduk->pekerjaan_id = $pekerjaanMapping[$pekerjaanNama];
                    $penduduk->save();
                }
            }
        });

        Schema::table('penduduks', function (Blueprint $table) {
            $table->dropColumn('pekerjaan');
            $table->foreign('pekerjaan_id')->references('id')->on('pekerjaans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penduduks', function (Blueprint $table) {
            $table->string('pekerjaan')->nullable()->after('agama_id');
            $table->dropForeign(['pekerjaan_id']);
        });

        $pekerjaanMapping = Pekerjaan::all()->pluck('pekerjaan', 'id')->toArray();

        Penduduk::chunkById(100, function ($penduduks) use ($pekerjaanMapping) {
            foreach ($penduduks as $penduduk) {
                if (isset($pekerjaanMapping[$penduduk->pekerjaan_id])) {
                    $penduduk->pekerjaan = $pekerjaanMapping[$penduduk->pekerjaan_id];
                    $penduduk->save();
                }
            }
        });

        Schema::table('penduduks', function (Blueprint $table) {
            $table->dropColumn('pekerjaan_id');
        });
    }
};