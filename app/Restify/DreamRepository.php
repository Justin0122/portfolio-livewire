<?php

namespace App\Restify;

use App\Models\Dream;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;

class DreamRepository extends Repository
{
    public static string $model = Dream::class;

    public function fields(RestifyRequest $request): array
    {
        return [
            id(),
        ];
    }
}
