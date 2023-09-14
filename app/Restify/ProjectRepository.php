<?php

namespace App\Restify;

use App\Models\Project;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;

class ProjectRepository extends Repository
{
    public static string $model = Project::class;

        public function fields(RestifyRequest $request): array
    {
        return [
            field('name'),
            field('description'),
            field('github_link'),
            field('start_date'),
            field('end_date'),
            field('status'),
            field('user_id'),
            field('is_active'),
            field('is_pinned'),
        ];
    }
}
