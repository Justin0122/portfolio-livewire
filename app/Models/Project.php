<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function getProjects($amount = 10, $offset = 0): Collection
    {
        return Project::where('is_active', 1)->orderBy('is_pinned', 'desc')->orderBy('created_at', 'desc')->skip($offset)->take($amount)->get();
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

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'project_tags');
    }

    public function frameworks(): BelongsToMany
    {
        return $this->belongsToMany(Framework::class, 'project_tags');
    }
}
