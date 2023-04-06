<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
    ];

    public static function fetchAll()
    {
        return Tags::all();
    }

    public static function create(array $data)
    {
        $tag = new Tags();
        $tag->name = $data['name'];
        $tag->save();
    }


}
