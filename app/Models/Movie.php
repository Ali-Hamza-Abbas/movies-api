<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'casts', 'release_date', 'director', 'imdb_rating', 'rotten_tomatoes_rating'];

    protected $casts = [
        'casts' => 'json',
        'release_date' => 'date',
    ];
}

