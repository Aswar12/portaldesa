<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function agama()
    {
        return $this->belongsTo(Agama::class);
    }

    public function jenisKelamin()
    {
        return $this->belongsTo(JenisKelamin::class);
    }
}
