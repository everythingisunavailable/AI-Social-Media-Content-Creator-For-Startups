<?php
require '../server/session.inc.php';
require '../server/posts.php';

startSession();
if(!isset($_SESSION['user_id'])) header("Location: ../public/google_login.php");

$data = get_posts($_SESSION['user_id']);
$selected = [
    'instagram' => null,
    'facebook'  => null,
    'x'         => null,
    'linkedin'  => null,
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ourApp - Dashboard</title>
    <link rel="stylesheet" href="./dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;500&display=swap" rel="stylesheet">

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
                    <a href="./products.php" class="link">Products</a>
                </div>

                <div class="avatar" id="avatar">
                    <?php 
                    echo '<img src=" '."#".' " alt="User Avatar" id="avatarImg">';
                    ?>
                </div>
            </div>


        </div>
    </nav>

    <main class="main">
        <div class="wrap">
            <h2 class="title">Dashboard</h2>

            <div class="grid" id="grid">

                <a href="#popup" class="card" id="addPost">
                    <div class="icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </div>
                </a>
                
                <?php 
                    foreach ($data as $key => $value) {
                        $selected[$data[$key]['platform']] = 'selected';
                        echo '<div class="card">
                                <div class="posts">
                                    <div class="socials">
                                        <a href="#" class="social-icon '. $selected['instagram'] .'"><i class="fab fa-instagram"></i></a>
                                        <a href="#" class="social-icon '. $selected['facebook'] .'"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#" class="social-icon '. $selected['x'] .'"><i class="fab fa-x-twitter"></i></a>
                                        <a href="#" class="social-icon '. $selected['linkedin'] .'"><i class="fab fa-linkedin-in"></i></a>
                                    </div>

                                    <p class="caption">'. $data[$key]['caption'] .'</p>
                                    <div class="status '. $data[$key]['status'] .'">'. $data[$key]['status'] .'</div>
                                </div>
                            </div>
                        ';
                        $selected = [
                            'instagram' => null,
                            'facebook'  => null,
                            'x'         => null,
                            'linkedin'  => null,
                        ];
                    }
                ?>
            </div>
        </div>



        <!-- popup -->

        <div id="popup" class="popup-overlay">
            <div class="popup-content">
                <h3>Create a New Post</h3>
                <div class="popup-links">
                    <a href="./add_product.php" class="popup-link">
                        <i class="fas fa-plus"></i> Use New Product
                    </a>
                    <a href="./saved_products.php" class="popup-link">
                        <i class="fas fa-plus"></i> Use Saved Product
                    </a>
                </div>
                <a href="#" class="close-btn">&times;</a>
            </div>
        </div>
    </main>


    <script src=""></script>
</body>

</html>