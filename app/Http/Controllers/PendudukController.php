<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PendudukController extends Controller
{
    public function dashboard()
    {
        // Data for Agama and Jenis Kelamin
        $dataAgamaJenisKelaminRaw = Penduduk::select(
                'agamas.agama as agama_nama',
                'jenis_kelamins.jenis_kelamin as jenis_kelamin_nama',
                DB::raw('count(*) as total')
            )
            ->join('agamas', 'penduduks.agama_id', '=', 'agamas.id')
            ->join('jenis_kelamins', 'penduduks.jenis_kelamin_id', '=', 'jenis_kelamins.id')
            ->groupBy('agamas.agama', 'jenis_kelamins.jenis_kelamin')
            ->get();

        $agamaLabels = $dataAgamaJenisKelaminRaw->pluck('agama_nama')->unique()->values()->all();
        $jenisKelaminLabels = ['Laki-laki', 'Perempuan']; // fixed gender labels for consistency

        $dataAgamaJenisKelamin = [
            'labels' => $agamaLabels,
            'datasets' => []
        ];

        foreach ($jenisKelaminLabels as $jk) {
            $dataSet = [
                'label' => $jk,
                'data' => [],
                'backgroundColor' => $jk === 'Laki-laki' ? 'rgba(54, 162, 235, 0.7)' : 'rgba(255, 99, 132, 0.7)',
            ];
            foreach ($agamaLabels as $agama) {
                $count = $dataAgamaJenisKelaminRaw->where('agama_nama', $agama)->where('jenis_kelamin_nama', $jk)->first();
                $countValue = $count ? $count->total : 0;
                $dataSet['data'][] = $countValue;
            }
            $dataAgamaJenisKelamin['datasets'][] = $dataSet;
        }

        // Data for Usia and Jenis Kelamin
        $dataUsiaJenisKelaminRaw = Penduduk::select(
            DB::raw("CASE
                WHEN TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 0 AND 4 THEN '0-4'
                WHEN TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 5 AND 9 THEN '5-9'
                WHEN TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 10 AND 14 THEN '10-14'
                WHEN TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 15 AND 19 THEN '15-19'
                WHEN TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 20 AND 24 THEN '20-24'
                WHEN TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 25 AND 29 THEN '25-29'
                WHEN TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 30 AND 34 THEN '30-34'
                WHEN TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 35 AND 39 THEN '35-39'
                WHEN TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 40 AND 44 THEN '40-44'
                WHEN TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 45 AND 49 THEN '45-49'
                WHEN TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 50 AND 54 THEN '50-54'
                WHEN TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 55 AND 59 THEN '55-59'
                WHEN TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 60 AND 64 THEN '60-64'
                WHEN TIMESTAMPDIFF(YEAR, ttl, CURDATE()) BETWEEN 65 AND 69 THEN '65-69'
                ELSE '70+'
            END as age_group"),
            'jenis_kelamins.jenis_kelamin as jenis_kelamin_nama',
            DB::raw('count(*) as total')
        )
        ->join('jenis_kelamins', 'penduduks.jenis_kelamin_id', '=', 'jenis_kelamins.id')
        ->groupBy('age_group', 'jenis_kelamins.jenis_kelamin')
        ->orderBy('age_group')
        ->get();

        $ageLabels = ['0-4', '5-9', '10-14', '15-19', '20-24', '25-29', '30-34', '35-39', '40-44', '45-49', '50-54', '55-59', '60-64', '65-69', '70+'];
        $jenisKelaminLabelsUsia = ['Laki-laki', 'Perempuan'];

        $dataUsiaJenisKelamin = [
            'labels' => $ageLabels,
            'datasets' => []
        ];

        foreach ($jenisKelaminLabelsUsia as $jk) {
            $dataSet = [
                'label' => $jk,
                'data' => [],
                'backgroundColor' => $jk === 'Laki-laki' ? 'rgba(54, 162, 235, 0.7)' : 'rgba(255, 99, 132, 0.7)',
            ];
            foreach ($ageLabels as $ageGroup) {
                $record = $dataUsiaJenisKelaminRaw->where('age_group', $ageGroup)->where('jenis_kelamin_nama', $jk)->first();
                $dataSet['data'][] = $record ? $record->total : 0;
            }
            $dataUsiaJenisKelamin['datasets'][] = $dataSet;
        }

        // Data for Pekerjaan and Jenis Kelamin
        $dataPekerjaanJenisKelaminRaw = Penduduk::select(
            DB::raw('COALESCE(pekerjaans.pekerjaan, \'Pekerjaan Tidak Diketahui\') as pekerjaan_nama'),
            'jenis_kelamins.jenis_kelamin as jenis_kelamin_nama',
            DB::raw('count(penduduks.id) as total')
        )
        ->leftJoin('pekerjaans', 'penduduks.pekerjaan_id', '=', 'pekerjaans.id')
        ->join('jenis_kelamins', 'penduduks.jenis_kelamin_id', '=', 'jenis_kelamins.id')
        ->groupBy('pekerjaan_nama', 'jenis_kelamins.jenis_kelamin')
        ->get();

        $pekerjaanLabels = $dataPekerjaanJenisKelaminRaw->pluck('pekerjaan_nama')->unique()->values()->all();
        $jenisKelaminLabelsPekerjaan = ['Laki-laki', 'Perempuan']; // fixed gender labels for consistency

        $dataPekerjaanJenisKelamin = [
            'labels' => $pekerjaanLabels,
            'datasets' => []
        ];

        foreach ($jenisKelaminLabelsPekerjaan as $jk) {
            $dataSet = [
                'label' => $jk,
                'data' => [],
                'backgroundColor' => $jk === 'Laki-laki' ? 'rgba(54, 162, 235, 0.7)' : 'rgba(255, 99, 132, 0.7)',
            ];
            foreach ($pekerjaanLabels as $pekerjaan) {
                $record = $dataPekerjaanJenisKelaminRaw->where('pekerjaan_nama', $pekerjaan)->where('jenis_kelamin_nama', $jk)->first();
                $count = $record ? $record->total : 0;
                $dataSet['data'][] = $count;
            }
            $dataPekerjaanJenisKelamin['datasets'][] = $dataSet;
        }

        return view('penduduk.dashboard', compact(
            'dataAgamaJenisKelamin',
            'dataUsiaJenisKelamin',
            'dataPekerjaanJenisKelamin'
        ));
    }
}
