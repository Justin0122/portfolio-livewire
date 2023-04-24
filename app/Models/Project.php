<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

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

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'project_tags');
    }

    public function frameworks(): BelongsToMany
    {
        return $this->belongsToMany(Framework::class, 'project_tags');
    }
}
