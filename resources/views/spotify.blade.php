<?php

use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;

if (!isset($_GET['code'])) {
    header('Location: /');
    die();
}
$session = new Session(
    $_ENV['SPOTIFY_CLIENT_ID'],
    $_ENV['SPOTIFY_CLIENT_SECRET'],
    $_ENV['SPOTIFY_REDIRECT_URI']
);


$session->requestAccessToken($_GET['code']);
$accessToken = $session->getAccessToken();
$refreshToken = $session->getRefreshToken();

$api = new SpotifyWebAPI();
$api->setAccessToken($accessToken);

$user = $api->me();

echo "<pre>";
print_r($user);
echo "</pre>";

echo "accesstoken: ";
echo $accessToken;
echo "refreshtoken: ";
echo $refreshToken;
