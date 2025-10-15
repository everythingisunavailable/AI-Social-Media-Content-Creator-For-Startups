<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../env.php';
require __DIR__ . '/user.php';
session_start();

$client = new Google_Client();
$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRET);
$client->setRedirectUri('http://localhost/Social-Media-Content-Generator-For-Startups/server/callback.php');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    
    if (isset($token['error'])) {
    echo "<pre>";
    print_r($token);
    echo "</pre>";
    exit;
}

    if (!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);
        
        // Get user info
        $oauth = new Google_Service_Oauth2($client);
        $userInfo = $oauth->userinfo->get();
        
        $userData = [
            'name'      => $userInfo->name,
            'email'     => $userInfo->email,
            'picture'   => $userInfo->picture
        ];

        $_SESSION['user_id'] = registerUser($userData);

        header("Location: ../public/index.php");
        exit;
    } else {
        echo "Error fetching access token.";
    }
} else {
    echo "No code returned from Google.";
}
