<?php
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;

$session = new Session(
    $_ENV['SPOTIFY_CLIENT_ID'],
    $_ENV['SPOTIFY_CLIENT_SECRET'],
    $_ENV['SPOTIFY_REDIRECT_URI']
);

$session->requestAccessToken($_GET['code']);
$accessToken = $session->getAccessToken();

$api = new SpotifyWebAPI();
$api->setAccessToken($accessToken);

$user = $api->me();

echo "<script>window.close();</script>";
