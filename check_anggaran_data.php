<?php
// Cek data anggaran
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Anggaran;

echo "=== CECK DATA ANGGARAN ===" . PHP_EOL;
echo "Total records: " . Anggaran::count() . PHP_EOL;
echo "Current year data: " . Anggaran::where('tahun_anggaran', date('Y'))->count() . PHP_EOL;
echo PHP_EOL;

echo "=== SAMPLE DATA ===" . PHP_EOL;
$data = Anggaran::take(5)->get(['id', 'judul', 'jenis', 'jumlah', 'realisasi', 'tahun_anggaran']);
foreach($data as $item) {
    echo "ID: {$item->id} | {$item->judul} | {$item->jenis} | Rp " . number_format($item->jumlah) . " | Realisasi: Rp " . number_format($item->realisasi) . " | Tahun: {$item->tahun_anggaran}" . PHP_EOL;
}

echo PHP_EOL;
echo "=== SUMMARY BY JENIS ===" . PHP_EOL;
$currentYear = date('Y');
$pendapatan = Anggaran::where('tahun_anggaran', $currentYear)->where('jenis', 'pendapatan')->sum('jumlah');
$belanja = Anggaran::where('tahun_anggaran', $currentYear)->where('jenis', 'belanja')->sum('jumlah');
$pembiayaan = Anggaran::where('tahun_anggaran', $currentYear)->where('jenis', 'pembiayaan')->sum('jumlah');

echo "Pendapatan {$currentYear}: Rp " . number_format($pendapatan) . PHP_EOL;
echo "Belanja {$currentYear}: Rp " . number_format($belanja) . PHP_EOL;
echo "Pembiayaan {$currentYear}: Rp " . number_format($pembiayaan) . PHP_EOL;
echo "Total {$currentYear}: Rp " . number_format($pendapatan + $belanja + $pembiayaan) . PHP_EOL;
