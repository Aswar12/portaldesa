<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Kategori;
use App\Models\PostStatus;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    use HasFactory;
    use Sluggable;
    
    protected $guarded = ['id'];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($berita) {
            // Auto-generate year from created_at if year is not provided
            if (!$berita->year && $berita->created_at) {
                $berita->year = $berita->created_at->year;
            }
        });
        
        static::updating(function ($berita) {
            // Auto-generate year from created_at if year is not provided during update
            if (!$berita->year && $berita->created_at) {
                $berita->year = $berita->created_at->year;
            }
        });
    }

    public function sluggable(): array
    {
        return [
            'slug'  => [
                'source'    => 'judul'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(PostStatus::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
