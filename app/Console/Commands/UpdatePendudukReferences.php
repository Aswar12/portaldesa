<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Penduduk;
use App\Models\JenisKelamin;
use App\Models\Agama;
use App\Models\Pekerjaan;
use Illuminate\Support\Facades\Log;

class UpdatePendudukReferences extends Command
{
    protected $signature = 'penduduk:update-references';
    protected $description = 'Update jenis_kelamin_id, agama_id, and pekerjaan_id values for existing penduduk records';

    public function handle()
    {
        $this->info('Starting to update penduduk reference IDs...');
        $count = 0;

        $penduduk = Penduduk::all();
        $this->info('Found ' . count($penduduk) . ' penduduk records.');

        foreach ($penduduk as $p) {
            $updated = false;

            // Update jenis_kelamin_id if jenis_kelamin is set but ID is null
            if ($p->jenis_kelamin && !$p->jenis_kelamin_id) {
                $jenisKelamin = JenisKelamin::where('jenis_kelamin', $p->jenis_kelamin)->first();
                if (!$jenisKelamin) {
                    $jenisKelamin = JenisKelamin::create([
                        'jenis_kelamin' => $p->jenis_kelamin,
                        'jumlah' => 0, // Default value
                        'user_id' => 1  // Default admin user ID
                    ]);
                    $this->info("Created new jenis kelamin: {$p->jenis_kelamin}");
                }
                $p->jenis_kelamin_id = $jenisKelamin->id;
                $updated = true;
                $this->info("Updated jenis_kelamin_id for {$p->nama} (NIK: {$p->nik})");
            }

            // Update agama_id if agama is set but ID is null
            if ($p->agama && !$p->agama_id) {
                $agama = Agama::where('agama', $p->agama)->first();
                if (!$agama) {
                    $agama = Agama::create([
                        'agama' => $p->agama,
                        'penganut' => 0, // Default value
                        'user_id' => 1   // Default admin user ID
                    ]);
                    $this->info("Created new agama: {$p->agama}");
                }
                $p->agama_id = $agama->id;
                $updated = true;
                $this->info("Updated agama_id for {$p->nama} (NIK: {$p->nik})");
            }

            // Update pekerjaan_id if pekerjaan is set but ID is null
            if ($p->pekerjaan && !$p->pekerjaan_id) {
                $pekerjaan = Pekerjaan::where('pekerjaan', $p->pekerjaan)->first();
                if (!$pekerjaan) {
                    $pekerjaan = Pekerjaan::create([
                        'pekerjaan' => $p->pekerjaan,
                        'jumlah' => 0, // Default value
                        'user_id' => 1  // Default admin user ID
                    ]);
                    $this->info("Created new pekerjaan: {$p->pekerjaan}");
                }
                $p->pekerjaan_id = $pekerjaan->id;
                $updated = true;
                $this->info("Updated pekerjaan_id for {$p->nama} (NIK: {$p->nik})");
            }

            // Save if anything was updated
            if ($updated) {
                $p->save();
                $count++;
            }
        }

        $this->info("Completed! Updated $count penduduk records.");
        return 0;
    }
}
