<?php
require_once __DIR__ . '/../vendor/autoload.php';
require '../env.php';

//test user
session_start();
$_SESSION['user_id'] = 2;
header("Location: ../public/index.php");
exit();

// Create Google Client
$client = new Google_Client();
$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRET);
$client->setRedirectUri('http://localhost/Social-Media-Content-Generator-For-Startups/server/callback.php');
$client->addScope('email');
$client->addScope('profile');

// Generate login URL
$loginUrl = $client->createAuthUrl();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login with Google</title>
</head>
<body>
    <h1>Login with Google</h1>
    <a href="<?= htmlspecialchars($loginUrl) ?>">Sign in with Google</a>
</body>
</html>
