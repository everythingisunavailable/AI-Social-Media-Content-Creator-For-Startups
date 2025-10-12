<?php
try {
    $pdo = new PDO(
        'mysql:host=127.0.0.1;dbname=myapp;',
        'myuser',
        'StrongPassword123!',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    die('DB Connection failed: ' . $e->getMessage());
}
