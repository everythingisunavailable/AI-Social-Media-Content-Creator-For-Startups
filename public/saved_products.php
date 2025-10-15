<?php
require '../server/session.inc.php';
require '../server/product.php';

startSession();
if(!isset($_SESSION['user_id']))
{
    echo '<p>User not logged in!</p>';
    exit();
}
$saved_products = get_products($_SESSION['user_id']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Products</title>

    <link rel="stylesheet" href="./products.css">
    <link rel="stylesheet" href="./saved_products.css">
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

    <!-- TODO: handle the selection of a product -->
    <form action="" method="" class="products-form">
        <h2 class="title">SAVED PRODUCTS</h2>

            <div class="grid" role="list">
            <?php foreach ($saved_products as $product): ?>
                <label class="card" role="listitem">
                    <input type="radio" name="product_id" value="<?= htmlspecialchars($product['id']) ?>" required>
                    <div class="products">
                        <p class="prod-name"><?= htmlspecialchars($product['name']) ?></p>
                        <p class="prod-desc"><?= htmlspecialchars($product['description']) ?></p>
                        <p class="prod-tone"><strong>Tone:</strong> <?= htmlspecialchars($product['tone']) ?></p>
                        <p class="prod-keywords"><strong>Keywords:</strong> <?= htmlspecialchars($product['keywords']) ?></p>
                        <?php if (!empty($product['image_url'])): ?>
                            <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" width="100">
                        <?php endif; ?>
                        <p class="prod-updated">
                            Updated <time datetime="<?= date('c', strtotime($product['updated_at'] ?? date('Y-m-d'))) ?>">
                            <?= date('M d, Y', strtotime($product['updated_at'] ?? date('Y-m-d'))) ?></time>
                        </p>
                    </div>
                </label>
            <?php endforeach; ?>
            </div>

        <div class="actions">
            <a id="createLink" class="create-post disabled" aria-disabled="true" tabindex="-1" role="button"> Create
                Post</a>
        </div>
    </form>

</body>

<script>

    // mundeson qe mos te kalohet ne faqen e bej postimin pa selektuar nje produkt.
    (() => {
        const link = document.getElementById('createLink');
        const radios = document.querySelectorAll('input[name="product_id"]');

        const updateLink = () => {
            const checked = document.querySelector('input[name="product_id"]:checked');
            link.href = checked ? `post.php?product_id=${encodeURIComponent(checked.value)}` : '';
            link.classList.toggle('disabled', !checked);
            link.setAttribute('aria-disabled', !checked);
            link.tabIndex = checked ? 0 : -1;
        };

        radios.forEach(r => r.addEventListener('change', updateLink));
        updateLink();
    })();;

</script>

</html>