<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

echo "=== CHECKING IDM DATA ===\n";

$idmCount = App\Models\Idm::count();
echo "Jumlah data IDM: $idmCount\n\n";

if ($idmCount > 0) {
    echo "Data IDM yang ada:\n";
    App\Models\Idm::orderBy('tahun', 'desc')->get()->each(function($idm) {
        echo "- Tahun {$idm->tahun}: Skor {$idm->skor_idm} - Status {$idm->status_idm}\n";
    });
} else {
    echo "Tidak ada data IDM di database. Membuat data sample...\n";
    
    // Buat data sample IDM
    $sampleData = [
        [
            'tahun' => 2020,
            'skor_idm' => 0.6987,
            'status_idm' => 'BERKEMBANG',
            'target_status' => 'MAJU',
            'skor_minimal' => 0.7072,
            'penambahan' => 0.0198,
            'skor_iks' => 0.7560,
            'skor_ike' => 0.5890,
            'skor_ikl' => 0.7510,
            'is_active' => false
        ],
        [
            'tahun' => 2021,
            'skor_idm' => 0.7321,
            'status_idm' => 'MAJU',
            'target_status' => 'MANDIRI',
            'skor_minimal' => 0.8155,
            'penambahan' => 0.0334,
            'skor_iks' => 0.7890,
            'skor_ike' => 0.6123,
            'skor_ikl' => 0.7950,
            'is_active' => false
        ],
        [
            'tahun' => 2022,
            'skor_idm' => 0.7654,
            'status_idm' => 'MAJU',
            'target_status' => 'MANDIRI',
            'skor_minimal' => 0.8155,
            'penambahan' => 0.0333,
            'skor_iks' => 0.8100,
            'skor_ike' => 0.6234,
            'skor_ikl' => 0.8630,
            'is_active' => false
        ],
        [
            'tahun' => 2023,
            'skor_idm' => 0.7890,
            'status_idm' => 'MAJU',
            'target_status' => 'MANDIRI',
            'skor_minimal' => 0.8155,
            'penambahan' => 0.0236,
            'skor_iks' => 0.8200,
            'skor_ike' => 0.6400,
            'skor_ikl' => 0.9070,
            'is_active' => false
        ],
        [
            'tahun' => 2024,
            'skor_idm' => 0.8152,
            'status_idm' => 'MAJU',
            'target_status' => 'MANDIRI',
            'skor_minimal' => 0.8155,
            'penambahan' => 0.0262,
            'skor_iks' => 0.8457,
            'skor_ike' => 0.6667,
            'skor_ikl' => 0.9333,
            'is_active' => true
        ]
    ];
    
    foreach ($sampleData as $data) {
        App\Models\Idm::create($data);
        echo "✓ Data IDM tahun {$data['tahun']} berhasil dibuat\n";
    }
    
    echo "\nData IDM sample berhasil dibuat!\n";
}

echo "\n=== CHECKING SELESAI ===\n";
