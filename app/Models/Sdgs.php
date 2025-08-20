<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sdgs extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'target_1',
        'target_2', 
        'target_3',
        'target_4',
        'target_5',
        'skor_1',
        'skor_2',
        'skor_3',
        'skor_4',
        'skor_5',
        'skor_rata_rata',
        'tahun',
        'keterangan',
        'gambar',
        'tampil_infografis',
        'warna_chart',
        'user_id'
    ];

    protected $casts = [
        'tampil_infografis' => 'boolean',
        'skor_1' => 'decimal:2',
        'skor_2' => 'decimal:2',
        'skor_3' => 'decimal:2',
        'skor_4' => 'decimal:2',
        'skor_5' => 'decimal:2',
        'skor_rata_rata' => 'decimal:2',
        'tahun' => 'integer'
    ];

    /**
     * Get the user that created this SDGS record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get status berdasarkan skor rata-rata
     */
    public function getStatusAttribute()
    {
        if ($this->skor_rata_rata >= 80) {
            return 'Sangat Baik';
        } elseif ($this->skor_rata_rata >= 60) {
            return 'Baik';
        } elseif ($this->skor_rata_rata >= 40) {
            return 'Cukup';
        } else {
            return 'Perlu Perbaikan';
        }
    }

    /**
     * Get status color berdasarkan skor
     */
    public function getStatusColorAttribute()
    {
        if ($this->skor_rata_rata >= 80) {
            return 'success';
        } elseif ($this->skor_rata_rata >= 60) {
            return 'primary';
        } elseif ($this->skor_rata_rata >= 40) {
            return 'warning';
        } else {
            return 'danger';
        }
    }

    /**
     * Get progress percentage
     */
    public function getProgressAttribute()
    {
        return $this->skor_rata_rata;
    }

    /**
     * Scope untuk data infografis
     */
    public function scopeInfografis($query)
    {
        return $query->where('tampil_infografis', true);
    }

    /**
     * Get all targets as array
     */
    public function getTargetsAttribute()
    {
        return array_filter([
            $this->target_1,
            $this->target_2,
            $this->target_3,
            $this->target_4,
            $this->target_5
        ]);
    }

    /**
     * Get all scores as array
     */
    public function getScoresAttribute()
    {
        return array_filter([
            $this->skor_1,
            $this->skor_2,
            $this->skor_3,
            $this->skor_4,
            $this->skor_5
        ]);
    }
}
