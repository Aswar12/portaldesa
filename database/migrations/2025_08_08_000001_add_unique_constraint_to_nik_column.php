<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueConstraintToNikColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penduduks', function (Blueprint $table) {
            // Check if unique constraint exists before adding
            if (!$this->hasIndex('penduduks', 'penduduks_nik_unique')) {
                $table->unique('nik', 'penduduks_nik_unique');
            }
        });
    }
    
    /**
     * Check if an index exists on a table
     *
     * @param string $table
     * @param string $index
     * @return bool
     */
    protected function hasIndex($table, $index)
    {
        $conn = Schema::getConnection();
        $dbSchemaManager = $conn->getDoctrineSchemaManager();
        $doctrineIndexes = $dbSchemaManager->listTableIndexes($table);
        
        return array_key_exists($index, $doctrineIndexes);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penduduks', function (Blueprint $table) {
            $table->dropUnique('penduduks_nik_unique');
        });
    }
}
