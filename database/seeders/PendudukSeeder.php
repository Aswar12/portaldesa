<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penduduk;
use App\Models\Agama;
use App\Models\JenisKelamin;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class PendudukSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $agamaIds = Agama::pluck('id')->toArray();
        $jenisKelaminIds = JenisKelamin::pluck('id')->toArray();

        for ($i = 0; $i < 100; $i++) {
            Penduduk::create([
                'nik' => $faker->unique()->numerify('##################'),
                'nama' => $faker->name,
                'ttl' => $faker->dateTimeBetween('-70 years', '-1 years')->format('Y-m-d'),
                'jenis_kelamin_id' => $faker->randomElement($jenisKelaminIds),
                'agama_id' => $faker->randomElement($agamaIds),
                'pekerjaan' => $faker->jobTitle,
            ]);
        }
    }
}
