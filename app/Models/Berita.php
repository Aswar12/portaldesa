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
        
        // Removed references to year column as it doesn't exist in the database
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
