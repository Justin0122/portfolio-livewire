<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTags extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'framework_id',
        'language_id',
    ];
}
