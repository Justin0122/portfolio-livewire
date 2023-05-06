<?php

namespace App\Http\Controllers;

use SpotifyWebAPI\Session;

class SpotifyController
{
    public function index()
    {
        if (!isset($_GET['code'])) {
            header('Location: /');
            die();
        }
        $session = new Session(
            $_ENV['SPOTIFY_CLIENT_ID'],
            $_ENV['SPOTIFY_CLIENT_SECRET'],
            $_ENV['SPOTIFY_REDIRECT_URI']
        );

        $discord_userID = $_GET['state'];

        try {
            $session->requestAccessToken($_GET['code']);
        } catch (\SpotifyWebAPI\SpotifyWebAPIException $e) {
            if ($e->getMessage() == 'Invalid refresh token') {
                $session->refreshAccessToken($_GET['code']);
            }
        }

        $accessToken = $session->getAccessToken();
        $refreshToken = $session->getRefreshToken();

        $discord = \App\Models\Discord::where('discord_id', $discord_userID)->first();

        if($discord == null){
            $discord = new \App\Models\Discord();
            $discord->discord_id = $discord_userID;
        }

        if($discord->spotify_access_token != null && $discord->spotify_access_token != $accessToken){
            $discord->spotify_access_token = null;
        }

        $discord->spotify_access_token = $accessToken;
        $discord->spotify_refresh_token = $refreshToken;
        $discord->save();

        //go to the view
        return view('spotify');

    }

}
