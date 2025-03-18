<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $table = 'films'; 

    protected $fillable = [
        'title', 'description', 'release_year', 'language_id',
        'original_language_id', 'rental_duration', 'rental_rate',
        'length', 'replacement_cost', 'rating', 'last_update'
    ];

    public $timestamps = false;
}
