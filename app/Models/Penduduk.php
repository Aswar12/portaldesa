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
        'tempat_lahir',
        'jenis_kelamin_id', // Keep for backward compatibility
        'jenis_kelamin',    // New string field
        'alamat',
        'agama_id',         // Keep for backward compatibility  
        'agama',            // New string field
        'agama_detail',
        'pekerjaan_id',     // Keep for backward compatibility
        'pekerjaan',        // New string field
        'pekerjaan_detail',
        'status_perkawinan',
        'kewarganegaraan',
        'status_dlm_keluarga',
    ];

    /**
     * Get the age attribute based on birth date
     */
    public function getUmurAttribute()
    {
        if (!$this->ttl) {
            return null;
        }
        
        return \Carbon\Carbon::parse($this->ttl)->age;
    }

    /**
     * Valid agama options
     */
    public static function getValidAgama()
    {
        return [
            'Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya'
        ];
    }

    /**
     * Valid pekerjaan options
     */
    public static function getValidPekerjaan()
    {
        return [
            'Petani', 'Wiraswasta', 'PNS', 'Swasta', 'Pedagang', 
            'Pelajar', 'Mahasiswa', 'IRT', 'Pensiunan', 'Belum Bekerja',
            'Polri', 'TNI', 'Karyawan Swasta', 'Lainnya'
        ];
    }

    /**
     * Valid jenis kelamin options
     */
    public static function getValidJenisKelamin()
    {
        return ['Laki-laki', 'Perempuan'];
    }

    /**
     * Get agama display name (prioritize string field)
     */
    public function getAgamaDisplayAttribute()
    {
        if ($this->agama) {
            return $this->agama === 'Lainnya' && $this->agama_detail 
                ? $this->agama_detail 
                : $this->agama;
        }
        
        // Fallback to relation
        return $this->agama_relation ? $this->agama_relation->agama : '-';
    }

    /**
     * Get pekerjaan display name (prioritize string field)
     */
    public function getPerkerjaanDisplayAttribute()
    {
        if ($this->pekerjaan) {
            return $this->pekerjaan === 'Lainnya' && $this->pekerjaan_detail 
                ? $this->pekerjaan_detail 
                : $this->pekerjaan;
        }
        
        // Fallback to relation
        return $this->pekerjaan_relation ? $this->pekerjaan_relation->pekerjaan : '-';
    }

    /**
     * Get jenis kelamin display name (prioritize string field)
     */
    public function getJenisKelaminDisplayAttribute()
    {
        if ($this->jenis_kelamin) {
            return $this->jenis_kelamin;
        }
        
        // Fallback to relation
        return $this->jenisKelamin ? $this->jenisKelamin->jenis_kelamin : '-';
    }

    // Backward compatibility relations
    public function agama_relation()
    {
        return $this->belongsTo(Agama::class, 'agama_id');
    }

    public function jenisKelamin()
    {
        return $this->belongsTo(JenisKelamin::class, 'jenis_kelamin_id');
    }

    public function pekerjaan_relation()
    {
        return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id');
    }

    // Keep old relation names for compatibility
    public function agama()
    {
        return $this->agama_relation();
    }

    public function pekerjaan()
    {
        return $this->pekerjaan_relation();
    }
}
