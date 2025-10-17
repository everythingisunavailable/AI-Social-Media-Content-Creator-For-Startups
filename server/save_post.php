<?php
require './posts.php';

$data = json_decode(file_get_contents('php://input'), true);
session_start();
foreach ($data as $platform => $post) {
    $caption = $post['caption'];
    $image   = $post['image']; // Base64 or URL
    create_post($_SESSION['user_id'], $_SESSION['product_id'], $caption, $platform, "finished", null);
}