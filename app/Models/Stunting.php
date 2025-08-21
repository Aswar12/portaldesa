<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stunting extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'balita_normal',
        'balita_stunting',
        'balita_kurus', 
        'balita_gemuk',
        'tahun',
        'keterangan',
        'gambar',
        'tampil_infografis',
        'warna_chart',
        'user_id',
        'published_at'
    ];

    protected $casts = [
        'tampil_infografis' => 'boolean',
        'balita_normal' => 'integer',
        'balita_stunting' => 'integer',
        'balita_kurus' => 'integer',
        'balita_gemuk' => 'integer',
        'tahun' => 'integer',
        'published_at' => 'datetime'
    ];

    /**
     * Get the user that created this stunting record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get total balita
     */
    public function getTotalBalitaAttribute()
    {
        return $this->balita_normal + $this->balita_stunting + $this->balita_kurus + $this->balita_gemuk;
    }

    /**
     * Get persentase stunting
     */
    public function getPersentaseStuntingAttribute()
    {
        $total = $this->total_balita;
        return $total > 0 ? round(($this->balita_stunting / $total) * 100, 2) : 0;
    }

    /**
     * Get persentase normal
     */
    public function getPersentaseNormalAttribute()
    {
        $total = $this->total_balita;
        return $total > 0 ? round(($this->balita_normal / $total) * 100, 2) : 0;
    }

    /**
     * Get persentase kurus
     */
    public function getPersentaseKurusAttribute()
    {
        $total = $this->total_balita;
        return $total > 0 ? round(($this->balita_kurus / $total) * 100, 2) : 0;
    }

    /**
     * Get persentase gemuk
     */
    public function getPersentaseGemukAttribute()
    {
        $total = $this->total_balita;
        return $total > 0 ? round(($this->balita_gemuk / $total) * 100, 2) : 0;
    }

    /**
     * Scope untuk data infografis
     */
    public function scopeInfografis($query)
    {
        return $query->where('tampil_infografis', true);
    }
}
