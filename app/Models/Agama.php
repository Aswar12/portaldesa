<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    use HasFactory;
    
    protected $fillable = ['agama', 'penganut', 'user_id'];
}
