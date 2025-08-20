<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idm extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    
    protected $casts = [
        'tahun' => 'integer',
        'skor_idm' => 'decimal:4',
        'skor_minimal' => 'decimal:4',
        'penambahan' => 'decimal:4',
        'skor_iks' => 'decimal:4',
        'skor_ike' => 'decimal:4',
        'skor_ikl' => 'decimal:4',
        'is_active' => 'boolean',
        'tampil_infografis' => 'boolean'
    ];
    
    public function getStatusColorAttribute()
    {
        return match(strtoupper($this->status_idm)) {
            'MANDIRI' => 'success',
            'MAJU' => 'primary',
            'BERKEMBANG' => 'warning',
            'TERTINGGAL' => 'danger',
            default => 'secondary'
        };
    }
    
    public function getStatusDescriptionAttribute()
    {
        return match(strtoupper($this->status_idm)) {
            'MANDIRI' => 'Desa dengan kemampuan melaksanakan pembangunan untuk peningkatan kualitas hidup dan kehidupan',
            'MAJU' => 'Desa yang memiliki potensi sumber daya sosial, ekonomi dan ekologi, serta kemampuan mengelolanya',
            'BERKEMBANG' => 'Desa yang memiliki potensi sumber daya sosial, ekonomi, dan ekologi tetapi belum mengelola secara optimal',
            'TERTINGGAL' => 'Desa yang memiliki potensi sumber daya tetapi belum, atau kurang mengelolanya',
            default => ''
        };
    }

    /**
     * Get the user that created this IDM record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope untuk data infografis
     */
    public function scopeInfografis($query)
    {
        return $query->where('tampil_infografis', true);
    }
}
