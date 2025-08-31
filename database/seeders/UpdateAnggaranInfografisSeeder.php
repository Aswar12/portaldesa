<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Anggaran;

class UpdateAnggaranInfografisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update existing anggaran records to show in infografis
        Anggaran::query()->update(['tampil_infografis' => true]);
        
        $this->command->info('Updated all anggaran records to show in infografis.');
    }
}
