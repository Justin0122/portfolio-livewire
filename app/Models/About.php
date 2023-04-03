<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    public function getFiles()
    {
        $files = glob(public_path('about/*'));
        $files = array_map('basename', $files);
        sort($files);
        return $files;
    }
}