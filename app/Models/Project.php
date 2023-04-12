<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'github_link',
        'start_date',
        'end_date',
        'status',
        'user_id',
        'is_active',
        'is_pinned',
    ];

    public static function create(array $data): void
    {
        $project = new Project();
        $project->name = $data['name'];
        $project->save();
    }

    public function getProjects(): Collection
    {
        return $this->all();
    }

    public function getFiles(Project $project): bool|array
    {
        if (file_exists(storage_path('app/public/' . $project->id))) {
            $files = scandir(storage_path('app/public/' . $project->id));
            $files = array_diff($files, array('.', '..'));
            $files = array_values($files);
        } else {
            $files = [];
        }
        return $files;
    }
}
