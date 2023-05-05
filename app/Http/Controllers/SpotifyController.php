<?php

use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;

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

$session->requestAccessToken($_GET['code']);
$accessToken = $session->getAccessToken();
$refreshToken = $session->getRefreshToken();

// Create an array with the tokens
$tokens = [
    'access_token' => $accessToken,
    'refresh_token' => $refreshToken,
];

$jsonTokens = json_encode([$discord_userID => $tokens]);

$webhookUrl = $_ENV['DISCORD_WEBHOOK_URL'];

$data = [
    'content' => $jsonTokens,
];
$options = [
    'http' => [
        'header'  => 'Content-type: application/json',
        'method'  => 'POST',
        'content' => json_encode($data),
    ],
];
$context  = stream_context_create($options);

$result = file_get_contents($webhookUrl, false, $context);

// Check if the message was successfully sent
if ($result === false) {
    echo 'Failed to send message to Discord webhook.';
} else {
    echo 'Access and refresh tokens sent to Discord webhook.';
}
    }

}
