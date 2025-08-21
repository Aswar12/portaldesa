<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($gallery) {
            if (!$gallery->published_at) {
                $gallery->published_at = now()->tz('Asia/Jayapura');
            }
            
            // Auto-generate year from published_at if year is not provided
            if (!$gallery->year) {
                $gallery->year = $gallery->published_at->year;
            }
        });
        
        static::updating(function ($gallery) {
            // Auto-generate year from published_at if year is not provided during update
            if (!$gallery->year && $gallery->published_at) {
                $gallery->year = $gallery->published_at->year;
            }
        });
    }
}
