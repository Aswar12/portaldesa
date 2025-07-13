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
        $jenisKelaminLabels = $dataAgamaJenisKelaminRaw->pluck('jenis_kelamin_nama')->unique()->values()->all();

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
                $count = $dataAgamaJenisKelaminRaw->firstWhere('agama_nama', $agama)
                    && $dataAgamaJenisKelaminRaw->firstWhere('jenis_kelamin_nama', $jk)
                    ? $dataAgamaJenisKelaminRaw->where('agama_nama', $agama)->where('jenis_kelamin_nama', $jk)->first()->total
                    : 0;
                $dataSet['data'][] = $count;
            }
            $dataAgamaJenisKelamin['datasets'][] = $dataSet;
        }

        // Data for Usia and Jenis Kelamin with specified age groups
        $now = Carbon::now();
        $penduduks = Penduduk::with('jenisKelamin')->get();

        $ageGroups = [
            '0-4' => 0,
            '5-9' => 0,
            '10-14' => 0,
            '15-19' => 0,
            '20-24' => 0,
            '25-29' => 0,
            '30-34' => 0,
            '35-39' => 0,
            '40-44' => 0,
            '45-49' => 0,
            '50-54' => 0,
            '55-59' => 0,
            '60-64' => 0,
            '65-69' => 0,
            '70+' => 0,
        ];

        $dataUsiaJenisKelaminRaw = [];

        foreach ($penduduks as $penduduk) {
            $age = $penduduk->ttl ? $now->diffInYears($penduduk->ttl) : 0;
            $jenisKelamin = $penduduk->jenisKelamin->nama ?? 'Unknown';

            if ($age <= 4) $ageGroup = '0-4';
            elseif ($age <= 9) $ageGroup = '5-9';
            elseif ($age <= 14) $ageGroup = '10-14';
            elseif ($age <= 19) $ageGroup = '15-19';
            elseif ($age <= 24) $ageGroup = '20-24';
            elseif ($age <= 29) $ageGroup = '25-29';
            elseif ($age <= 34) $ageGroup = '30-34';
            elseif ($age <= 39) $ageGroup = '35-39';
            elseif ($age <= 44) $ageGroup = '40-44';
            elseif ($age <= 49) $ageGroup = '45-49';
            elseif ($age <= 54) $ageGroup = '50-54';
            elseif ($age <= 59) $ageGroup = '55-59';
            elseif ($age <= 64) $ageGroup = '60-64';
            elseif ($age <= 69) $ageGroup = '65-69';
            else $ageGroup = '70+';

            $dataUsiaJenisKelaminRaw[] = ['ageGroup' => $ageGroup, 'jenisKelamin' => $jenisKelamin];
        }

        $ageLabels = array_keys($ageGroups);
        $jenisKelaminLabelsUsia = $penduduks->pluck('jenisKelamin.nama')->unique()->values()->all();

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
                $count = collect($dataUsiaJenisKelaminRaw)
                    ->where('ageGroup', $ageGroup)
                    ->where('jenisKelamin', $jk)
                    ->count();
                $dataSet['data'][] = $count;
            }
            $dataUsiaJenisKelamin['datasets'][] = $dataSet;
        }

        // Data for Pekerjaan and Jenis Kelamin
        $dataPekerjaanJenisKelaminRaw = Penduduk::select(
                'pekerjaan',
                'jenis_kelamins.jenis_kelamin as jenis_kelamin_nama',
                DB::raw('count(*) as total')
            )
            ->join('jenis_kelamins', 'penduduks.jenis_kelamin_id', '=', 'jenis_kelamins.id')
            ->groupBy('pekerjaan', 'jenis_kelamins.jenis_kelamin')
            ->get();

        $pekerjaanLabels = $dataPekerjaanJenisKelaminRaw->pluck('pekerjaan')->unique()->values()->all();
        $jenisKelaminLabelsPekerjaan = $dataPekerjaanJenisKelaminRaw->pluck('jenis_kelamin_nama')->unique()->values()->all();

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
                $record = $dataPekerjaanJenisKelaminRaw->where('pekerjaan', $pekerjaan)->where('jenis_kelamin_nama', $jk)->first();
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
