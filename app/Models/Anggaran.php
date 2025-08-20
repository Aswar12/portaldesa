<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    
    protected $fillable = [
        'judul',
        'slug', 
        'keterangan',
        'gambar',
        'jenis',
        'jumlah',
        'realisasi',
        'tahun_anggaran',
        'kategori',
        'deskripsi',
        'user_id'
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'realisasi' => 'decimal:2',
        'tahun_anggaran' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope untuk filter berdasarkan jenis anggaran
    public function scopePendapatan($query)
    {
        return $query->where('jenis', 'pendapatan');
    }

    public function scopeBelanja($query)
    {
        return $query->where('jenis', 'belanja');
    }

    public function scopePembiayaan($query)
    {
        return $query->where('jenis', 'pembiayaan');
    }

    // Scope untuk filter berdasarkan tahun
    public function scopeTahun($query, $tahun)
    {
        return $query->where('tahun_anggaran', $tahun);
    }

    // Accessor untuk format rupiah
    public function getJumlahFormattedAttribute()
    {
        return 'Rp ' . number_format($this->jumlah, 0, ',', '.');
    }

    public function getRealisasiFormattedAttribute()
    {
        return 'Rp ' . number_format($this->realisasi, 0, ',', '.');
    }

    // Accessor untuk persentase realisasi
    public function getPersentaseRealisasiAttribute()
    {
        return $this->jumlah > 0 ? round(($this->realisasi / $this->jumlah) * 100, 2) : 0;
    }
}
