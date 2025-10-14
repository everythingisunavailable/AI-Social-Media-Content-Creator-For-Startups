<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="./dashboard.css">
    <link rel="stylesheet" href="./add_product.css">
</head>

<body>
    <nav class="nav">

        <div class="nav-wrap">
            <div class="nav-left">
                <h1 class="logo">shAIr</h1>
            </div>


            <div class="nav-right">
                    <a href="./index.php" class="link active">Home</a>
                    <a href="./products.php" class="link">Products</a>
                </div>

                <div class="avatar" id="avatar">
                    <img src="" alt="User Avatar" id="avatarImg">
                </div>
            </div>
        </div>
    </nav>


    <main class="main">
        <div class="wrap">
            <h2 class="title">Add a New Product</h2>

            <form action="../server/save_product.php" method="POST" enctype="multipart/form-data" class="product-form">
                <label for="name">Product Name</label>
                <input type="text" id="name" name="name" placeholder="Enter product name" required>

                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Enter product description"
                    required></textarea>

                <label for="tone">Tone (optional)</label>
                <input type="text" id="tone" name="tone" placeholder="Enter product tone">

                <label for="keywords">Keywords (optional, comma separated)</label>
                <input type="text" id="keywords" name="keywords" placeholder="keyword1, keyword2">

                <label for="image">Product Image (optional)</label>
                <input type="file" id="image" name="image" accept="image/*">

                <button type="submit" class="submit-btn">Add Product</button>
                <button type="reset" class="submit-btn">Clear</button>
            </form>
        </div>
    </main>



</body>

</html>