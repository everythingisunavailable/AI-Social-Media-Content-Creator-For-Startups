<?php
// display_captions.php

// Start the session
session_start();

// Check if captions exist in the session
if (!isset($_SESSION['captions']) || empty($_SESSION['captions'])) {
    echo "<p>No captions available in the session.</p>";
    exit;
}

$captions = $_SESSION['captions'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generated Captions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        .caption-container {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        .platform {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        .caption-text {
            font-size: 1rem;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Generated Captions</h1>

    <?php foreach ($captions as $platform => $captionText): ?>
        <div class="caption-container">
            <div class="platform"><?= htmlspecialchars($platform) ?></div>
            <div class="caption-text"><?= nl2br(htmlspecialchars($captionText)) ?></div>
        </div>
    <?php endforeach; ?>
</body>
</html>
