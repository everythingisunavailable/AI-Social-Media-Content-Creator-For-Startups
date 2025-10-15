<?php
require '../server/product.php';
require '../server/session.inc.php';
startSession();
$data = get_products($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="./products.css">
    <link rel="stylesheet" href="./dashboard.css">

</head>

<body>

    <nav class="nav">

        <div class="nav-wrap">
            <div class="nav-left">
                <h1 class="logo">shAIr</h1>
            </div>


            <div class="nav-right">
                <div class="links">
                    <a href="./index.php" class="link active">Home</a>
                    <a href="./index.php" class="link">Dashboard</a>
                </div>

                <div class="avatar" id="avatar">
                    <img src="" alt="User Avatar" id="avatarImg">
                </div>
            </div>


        </div>
    </nav>

    <main class="main">
        <div class="wrap">
            <h2 class="title">PRODUCTS</h2>

            <div class="grid" id="grid">

                <a href="./add_product.php" class="card">
                    <div class="icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </div>
                </a>




                <!-- do shtohen ketu katro9ret e tjere -->
                <?php 
                foreach ($data as $key => $value) {
                    echo '
                        <a href="#" class="card">
                            <div class="products">
                                <p class="prod-name">'. $data[$key]['name'] .'</p>
                                <p class="prod-desc">'. $data[$key]['description'] .'</p>
                                <p class="prod-updated">Updated '. $data[$key]['updated_at'] .'</p>
                            </div>
                        </a>
                    ';
                }
                ?>




















            </div>
        </div>
    </main>


</body>


</html>