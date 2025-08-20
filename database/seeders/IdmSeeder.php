<?php

namespace Database\Seeders;

use App\Models\Idm;
use Illuminate\Database\Seeder;

class IdmSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'tahun' => 2024,
                'skor_idm' => 0.8152,
                'status_idm' => 'MAJU',
                'target_status' => 'MANDIRI',
                'skor_minimal' => 0.8156,
                'penambahan' => 0.0004,
                'skor_iks' => 0.8457,
                'skor_ike' => 0.6667,
                'skor_ikl' => 0.9333,
                'is_active' => true
            ],
            [
                'tahun' => 2023,
                'skor_idm' => 0.7890,
                'status_idm' => 'MAJU',
                'target_status' => 'MAJU',
                'skor_minimal' => 0.7500,
                'penambahan' => 0.0000,
                'skor_iks' => 0.8200,
                'skor_ike' => 0.6400,
                'skor_ikl' => 0.9070,
                'is_active' => false
            ],
            [
                'tahun' => 2022,
                'skor_idm' => 0.7654,
                'status_idm' => 'MAJU',
                'target_status' => 'MAJU',
                'skor_minimal' => 0.7500,
                'penambahan' => 0.0000,
                'skor_iks' => 0.8100,
                'skor_ike' => 0.6234,
                'skor_ikl' => 0.8630,
                'is_active' => false
            ],
            [
                'tahun' => 2021,
                'skor_idm' => 0.7321,
                'status_idm' => 'BERKEMBANG',
                'target_status' => 'MAJU',
                'skor_minimal' => 0.7500,
                'penambahan' => 0.0179,
                'skor_iks' => 0.7890,
                'skor_ike' => 0.6123,
                'skor_ikl' => 0.7950,
                'is_active' => false
            ],
            [
                'tahun' => 2020,
                'skor_idm' => 0.6987,
                'status_idm' => 'BERKEMBANG',
                'target_status' => 'MAJU',
                'skor_minimal' => 0.7500,
                'penambahan' => 0.0513,
                'skor_iks' => 0.7560,
                'skor_ike' => 0.5890,
                'skor_ikl' => 0.7510,
                'is_active' => false
            ]
        ];

        foreach ($data as $item) {
            Idm::create($item);
        }
    }
}
