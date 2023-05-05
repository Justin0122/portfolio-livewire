<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discord extends Model
{
    use HasFactory;

    //make discord_id the primary key
    protected $primaryKey = 'discord_id';
    public $incrementing = false;
    protected $fillable = [
        'discord_id',
        'spotify_access_token',
        'spotify_refresh_token',
    ];
    protected $casts = [
        'spotify_access_token' => 'encrypted',
        'spotify_refresh_token' => 'encrypted',
    ];

}
