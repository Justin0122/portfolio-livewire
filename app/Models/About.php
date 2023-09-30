<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{

    public function getFiles()
    {
        $files = glob(public_path('storage/about/*'));
        $files = array_map('basename', $files);
        sort($files);
        return $files;
    }
}
