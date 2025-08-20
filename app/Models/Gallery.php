<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $dates = ['published_at'];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($gallery) {
            if (!$gallery->published_at) {
                $gallery->published_at = now()->tz('Asia/Jayapura');
            }
        });
    }
}
