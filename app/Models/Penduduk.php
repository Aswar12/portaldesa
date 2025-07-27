<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nik',
        'kk',
        'ttl',
        'jenis_kelamin_id',
        'alamat',
        'agama_id',
        'pekerjaan_id',
        'status_perkawinan',
        'kewarganegaraan',
        'status_dlm_keluarga',
    ];

    public function agama()
    {
        return $this->belongsTo(Agama::class);
    }

    public function jenisKelamin()
    {
        return $this->belongsTo(JenisKelamin::class);
    }

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class);
    }
}
