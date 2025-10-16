<?php
require __DIR__ . '/db.inc.php';

function registerUser(array $userData): int {
    global $pdo;

    $stmt = $pdo->prepare("SELECT id FROM user WHERE email = :email");
    $stmt->execute([
        ':email' => $userData['email']
    ]);
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        return (int)$existingUser['id'];
    }

    // Insert new user
    $stmt = $pdo->prepare("
        INSERT INTO user (username, email, avatar_url, created_at)
        VALUES (:name, :email, :picture, NOW())
    ");
    $stmt->execute([
        ':name' => $userData['name'],
        ':email' => $userData['email'],
        ':picture' => $userData['picture']
    ]);

    return (int)$pdo->lastInsertId();
}
