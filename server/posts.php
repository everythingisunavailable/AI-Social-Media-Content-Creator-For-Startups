<?php
include './dp.inc.php';

function get_posts($user_id){
    global $pdo;

    try {
        $stmt = $pdo->prepare('SELECT * FROM post WHERE user_id = :user_id');
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}

function create_post($user_id, $product_id, $caption = null, $platform, $status, $schedule_time = null)
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("
            INSERT INTO post (user_id, product_id, caption, platform, status, schedule_time)
            VALUES (:user_id, :product_id, :caption, :platform, :status, :schedule_time)
        ");

        $stmt->execute([
            ':user_id'       => $user_id,
            ':product_id'    => $product_id,
            ':caption'       => $caption,
            ':platform'      => $platform,
            ':status'        => $status,
            ':schedule_time' => $schedule_time
        ]);

        // Return the ID of the created post or the inserted row
        return $pdo->lastInsertId();

    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}
