<?php

namespace App\Restify;

use App\Models\Discord;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;

class DiscordRepository extends Repository
{
    public static string $model = Discord::class;

    public function fields(RestifyRequest $request): array
    {
        //if the argument with the secure token is not the same as the one in the .env file, return an empty array
        if($request->get('secure_token') != $_ENV['SECURE_TOKEN']){
            return [];
        }

        //if the spotify_access_token and spotify_refresh_token are set, update the tokens in the database
        if($request->get('spotify_access_token') != null && $request->get('spotify_refresh_token') != null){
            $discord = Discord::where('discord_id', $request->get('discord_id'))->first();

            if($discord == null){
                $discord = new Discord();
                $discord->discord_id = $request->get('discord_id');
            }

            if($discord->spotify_access_token != null && $discord->spotify_access_token != $request->get('spotify_access_token')){
                $discord->spotify_access_token = null;
            }

            $discord->spotify_access_token = $request->get('spotify_access_token');
            $discord->spotify_refresh_token = $request->get('spotify_refresh_token');
            $discord->save();
        }

        return [
            field('discord_id'),
            field('spotify_access_token'),
            field('spotify_refresh_token'),
        ];
    }
}
