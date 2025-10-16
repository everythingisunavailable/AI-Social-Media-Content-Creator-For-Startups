<?php
    require '../server/session.inc.php';
    require '../server/product.php';
    startSession();
    if (!isset($_SESSION['product_id'])) 
    {
        echo '<p>Product not selected or session has failed!</p>';
        exit();
    }
    $product = get_product($_SESSION['product_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet" href="./dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="./post.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;500&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="nav">

        <div class="nav-wrap">
            <div class="nav-left">
                <h1 class="logo">sh<span class="logo gradient">AI</span>r</h1>
            </div>


            <div class="nav-right">
                <div class="links">
                    <a href="./index.php" class="link active">Home</a>
                    <a href="./products.php" class="link">Products</a>
                    <a href="./data.html" class="link active">Analytics</a>
                    <a href="./api.php" class="link">Connect to the API</a>
                </div>

                <div class="avatar" id="avatar">
                    <img src="" alt="User Avatar" id="avatarImg">
                </div>
            </div>
        </div>
    </nav>

    <div class="wrap">
        <h2 class="title">Create Post for "
            <?php echo htmlspecialchars($product['name']); ?>"
        </h2>

        <div class="product-info">
            <h3>
                <?php echo htmlspecialchars($product['name']); ?>
            </h3>
            <p>
                <?php echo htmlspecialchars($product['description']); ?>
            </p>
            <p><strong>Tone:</strong>
                <?php echo htmlspecialchars($product['tone'] ?? 'None'); ?>
            </p>
            <p><strong>Keywords:</strong>
                <?php echo htmlspecialchars($product['keywords'] ?? 'None'); ?>
            </p>
            <?php if (!empty($product['image_url'])): ?>
            <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="Product Image">
            <?php endif; ?>
        </div>
        <form action="../server/generate_post.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <label>Choose Where to Post</label>
            <div class="socials-checkboxes">
                <label class="platform">
                    <div class="top-row">
                        <input type="checkbox" name="platforms[]" value="instagram">
                        <i class="fab fa-instagram"></i>
                    </div>
                    <span class="platform-name">Instagram</span>
                </label>

                <label class="platform">
                    <div class="top-row">
                        <input type="checkbox" name="platforms[]" value="facebook">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <span class="platform-name">Facebook</span>
                </label>


                <label class="platform">
                    <div class="top-row">
                        <input type="checkbox" name="platforms[]" value="x">
                        <i class="fab fa-x-twitter"></i>
                    </div>
                    <span class="platform-name">X</span>
                </label>



                <label class="platform">
                    <div class="top-row">
                        <input type="checkbox" name="platforms[]" value="linkedin">
                        <i class="fab fa-linkedin-in"></i>
                    </div>
                    <span class="platform-name">LinkedIn</span>
                </label>
            </div>


            <label>AI Photo Options</label>
            <div class="ai-options">
                <label><input type="radio" name="ai_option" value="create" required> Let AI Create New Photo</label>
                <label><input type="radio" name="ai_option" value="modify" required> Let AI Modify Uploaded
                    Photo</label>
                <label><input type="radio" name="ai_option" value="none" required>No Image Generation</label>
            </div>

            <button type="submit" class="submit-btn">Create Post</button>
        </form>
    </div>
    </main>
</body>

</html>