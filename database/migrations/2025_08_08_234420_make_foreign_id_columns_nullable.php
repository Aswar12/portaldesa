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
            // Hapus foreign key constraint
            $foreignKeys = ['jenis_kelamin_id', 'agama_id', 'pekerjaan_id'];
            
            foreach ($foreignKeys as $column) {
                if (Schema::hasColumn('penduduks', $column)) {
                    // Cek jika foreign key constraint ada dengan nama standar Laravel
                    $constraintName = 'penduduks_' . $column . '_foreign';
                    
                    try {
                        $sm = Schema::getConnection()->getDoctrineSchemaManager();
                        $doctrineTable = $sm->listTableDetails('penduduks');
                        
                        if ($doctrineTable->hasForeignKey($constraintName)) {
                            $table->dropForeign($constraintName);
                        }
                    } catch (\Exception $e) {
                        // Jika ada error, lanjutkan saja
                    }
                    
                    // Buat kolom nullable dengan doctrine/dbal
                    $table->unsignedBigInteger($column)->nullable()->change();
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            // Restore foreign keys
            if (Schema::hasColumn('penduduks', 'jenis_kelamin_id')) {
                $table->unsignedBigInteger('jenis_kelamin_id')->nullable(false)->change();
                $table->foreign('jenis_kelamin_id')->references('id')->on('jenis_kelamins')->onDelete('cascade');
            }
            
            if (Schema::hasColumn('penduduks', 'agama_id')) {
                $table->unsignedBigInteger('agama_id')->nullable(false)->change();
                $table->foreign('agama_id')->references('id')->on('agamas')->onDelete('cascade');
            }
            
            if (Schema::hasColumn('penduduks', 'pekerjaan_id')) {
                $table->unsignedBigInteger('pekerjaan_id')->nullable(false)->change();
                $table->foreign('pekerjaan_id')->references('id')->on('pekerjaans')->onDelete('cascade');
            }
        });
    }
};
