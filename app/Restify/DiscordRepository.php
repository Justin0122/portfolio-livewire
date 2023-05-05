<?php

namespace App\Restify;

use App\Models\Discord;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;

class DiscordRepository extends Repository
{
    public static string $model = Discord::class;

    public function fields(RestifyRequest $request): array
    {
        return [
            id(),
        ];
    }
}
