<?php

// Test script for new penduduk structure
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Penduduk;

echo "=== Test Penduduk Structure ===\n";
echo "Valid Agama: " . implode(', ', Penduduk::getValidAgama()) . "\n";
echo "Valid Pekerjaan: " . implode(', ', Penduduk::getValidPekerjaan()) . "\n";
echo "Valid Jenis Kelamin: " . implode(', ', Penduduk::getValidJenisKelamin()) . "\n";

echo "\n=== Test Import Normalization ===\n";
$import = new App\Imports\PendudukImport();

// Test via reflection to access private methods
$reflection = new ReflectionClass($import);

$normalizeJenisKelamin = $reflection->getMethod('normalizeJenisKelamin');
$normalizeJenisKelamin->setAccessible(true);

$normalizeAgama = $reflection->getMethod('normalizeAgama');
$normalizeAgama->setAccessible(true);

$normalizePekerjaan = $reflection->getMethod('normalizePekerjaan');
$normalizePekerjaan->setAccessible(true);

echo "LAKI-LAKI -> " . $normalizeJenisKelamin->invoke($import, 'LAKI-LAKI') . "\n";
echo "PEREMPUAN -> " . $normalizeJenisKelamin->invoke($import, 'PEREMPUAN') . "\n";
echo "KATHOLIK -> " . $normalizeAgama->invoke($import, 'KATHOLIK') . "\n";
echo "WIRASWASTA -> " . $normalizePekerjaan->invoke($import, 'WIRASWASTA') . "\n";
echo "PROGRAMMER -> " . $normalizePekerjaan->invoke($import, 'PROGRAMMER') . "\n";

echo "\nTest completed successfully!\n";
