<?php

$name        = $_POST['name'] ?? null;
$description = $_POST['description'] ?? null;
$tone        = $_POST['tone'] ?? null;
$keywords    = $_POST['keywords'] ?? null;

// Handle uploaded image (if any)
$imageName = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imageTmp  = $_FILES['image']['tmp_name'];
    $imageName = $_FILES['image']['name'];
    $destPath  = __DIR__ . "/../assets/uploads/" . $imageName;
} else {
    echo "❌ No valid image uploaded!";
}

require 'product.php';

create_product(4, $name, $description, $tone, $keywords, $destPath);
//TODO : add product id to session, the above function returns the isnterted product id.
header('Location: ../public/post.php');