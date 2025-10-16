<?php
require __DIR__ . "/session.inc.php";
$name        = $_POST['name'] ?? null;
$description = $_POST['description'] ?? null;
$tone        = $_POST['tone'] ?? null;
$keywords    = $_POST['keywords'] ?? null;

$imageName = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imageTmp  = $_FILES['image']['tmp_name'];
    $imageName = $_FILES['image']['name'];
    $destPath  = __DIR__ . "/../assets/uploads/" . $imageName;
} else {
    echo "❌ No valid image uploaded!";
}

require 'product.php';
startSession();
$product_id = create_product($_SESSION['user_id'], $name, $description, $tone, $keywords, $destPath);
setSession("product_id", $product_id);
header('Location: ../public/post.php');