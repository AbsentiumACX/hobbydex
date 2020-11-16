<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'generation',
        'user_id'
    ];


    public function user ()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function pokedex ()
    {
        return $this->hasOne('App\Models\Pokedex');
    }
}
