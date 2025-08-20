<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

echo "=== ADDING MORE IDM DATA ===\n";

// Tambah data IDM tahun-tahun sebelumnya
$additionalData = [
    [
        'tahun' => 2019,
        'skor_idm' => 0.6545,
        'status_idm' => 'BERKEMBANG',
        'target_status' => 'MAJU',
        'skor_minimal' => 0.7072,
        'penambahan' => 0.0442,
        'skor_iks' => 0.7123,
        'skor_ike' => 0.5567,
        'skor_ikl' => 0.6945,
        'is_active' => false
    ],
    [
        'tahun' => 2018,
        'skor_idm' => 0.6103,
        'status_idm' => 'BERKEMBANG',
        'target_status' => 'MAJU',
        'skor_minimal' => 0.7072,
        'penambahan' => 0.0455,
        'skor_iks' => 0.6889,
        'skor_ike' => 0.5234,
        'skor_ikl' => 0.6186,
        'is_active' => false
    ],
    [
        'tahun' => 2017,
        'skor_idm' => 0.5648,
        'status_idm' => 'TERTINGGAL',
        'target_status' => 'BERKEMBANG',
        'skor_minimal' => 0.5991,
        'penambahan' => 0.0343,
        'skor_iks' => 0.6234,
        'skor_ike' => 0.4789,
        'skor_ikl' => 0.5921,
        'is_active' => false
    ],
];

foreach ($additionalData as $data) {
    // Cek apakah data tahun tersebut sudah ada
    $exists = App\Models\Idm::where('tahun', $data['tahun'])->exists();
    
    if (!$exists) {
        App\Models\Idm::create($data);
        echo "✓ Data IDM tahun {$data['tahun']} berhasil ditambahkan\n";
    } else {
        echo "- Data IDM tahun {$data['tahun']} sudah ada, dilewati\n";
    }
}

echo "\n=== CURRENT IDM DATA ===\n";
App\Models\Idm::orderBy('tahun', 'desc')->get()->each(function($idm) {
    $active = $idm->is_active ? '(AKTIF)' : '';
    echo "- Tahun {$idm->tahun}: Skor {$idm->skor_idm} - Status {$idm->status_idm} {$active}\n";
});

echo "\n=== DATA BERHASIL DITAMBAHKAN ===\n";
