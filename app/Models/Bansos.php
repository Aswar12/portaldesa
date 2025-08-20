<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bansos extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'jenis_bansos',
        'jumlah_penerima',
        'jumlah_dana',
        'periode_mulai',
        'periode_selesai',
        'tahun',
        'keterangan',
        'gambar',
        'tampil_infografis',
        'warna_chart',
        'user_id'
    ];

    protected $casts = [
        'tampil_infografis' => 'boolean',
        'jumlah_penerima' => 'integer',
        'jumlah_dana' => 'decimal:2',
        'tahun' => 'integer',
        'periode_mulai' => 'date',
        'periode_selesai' => 'date'
    ];

    /**
     * Get the user that created this bansos record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get formatted dana amount
     */
    public function getDanaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->jumlah_dana, 0, ',', '.');
    }

    /**
     * Get rata-rata dana per penerima
     */
    public function getDanaPerPenerimaAttribute()
    {
        return $this->jumlah_penerima > 0 ? $this->jumlah_dana / $this->jumlah_penerima : 0;
    }

    /**
     * Get formatted dana per penerima
     */
    public function getDanaPerPenerimaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->dana_per_penerima, 0, ',', '.');
    }

    /**
     * Get status berdasarkan periode
     */
    public function getStatusAttribute()
    {
        $now = now();
        
        if ($this->periode_selesai && $now->greaterThan($this->periode_selesai)) {
            return 'Selesai';
        } elseif ($now->greaterThanOrEqualTo($this->periode_mulai)) {
            return 'Berjalan';
        } else {
            return 'Belum Dimulai';
        }
    }

    /**
     * Get status color
     */
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'Selesai' => 'secondary',
            'Berjalan' => 'success',
            'Belum Dimulai' => 'warning',
            default => 'primary'
        };
    }

    /**
     * Get jenis bansos full name
     */
    public function getJenisFullNameAttribute()
    {
        return match($this->jenis_bansos) {
            'PKH' => 'Program Keluarga Harapan (PKH)',
            'BPNT' => 'Bantuan Pangan Non Tunai (BPNT)',
            'BST' => 'Bantuan Sosial Tunai (BST)',
            'PBI' => 'Penerima Bantuan Iuran (PBI)',
            'Sembako' => 'Bantuan Sembako',
            'BLT' => 'Bantuan Langsung Tunai (BLT)',
            default => $this->jenis_bansos
        };
    }

    /**
     * Scope untuk data infografis
     */
    public function scopeInfografis($query)
    {
        return $query->where('tampil_infografis', true);
    }

    /**
     * Scope untuk bansos aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('periode_mulai', '<=', now())
                    ->where(function($q) {
                        $q->whereNull('periode_selesai')
                          ->orWhere('periode_selesai', '>=', now());
                    });
    }
}
