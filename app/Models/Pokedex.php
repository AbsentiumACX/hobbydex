<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokedex extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'generations',
        'caught_pokemon',
        'character_id'
    ];
    protected $casts = [
        'generations' => 'array',
        'caught_pokemon' => 'array'
    ];

    public function character ()
    {
        return $this->belongsTo('App\Models\Character');
    }
}
