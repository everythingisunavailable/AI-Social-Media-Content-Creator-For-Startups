<?php
include 'db.inc.php';

function create_product($user_id, $name, $description, $tone = null, $keywords = null)
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("
            INSERT INTO product (user_id, name, description, tone, keywords)
            VALUES (:user_id, :name, :description, :tone, :keywords)
        ");

        $stmt->execute([
            ':user_id'     => $user_id,
            ':name'        => $name,
            ':description' => $description,
            ':tone'        => $tone,
            ':keywords'    => $keywords
        ]);

        return $pdo->lastInsertId(); // return new product ID

    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}


function get_products($user_id)
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("
            SELECT * FROM product
            WHERE user_id = :user_id
            ORDER BY created_at DESC
        ");

        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}

function get_product($product_id)
{
    global $pdo;

    try {
        $stmt = $pdo->prepare("SELECT * FROM product WHERE id = :id");
        $stmt->execute([':id' => $product_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}

