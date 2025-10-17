<?php
require "../server/session.inc.php";
startSession();

if (!isset($_SESSION['captions'])) {
    echo "Something went wrong!";
    exit();
}

$data = $_SESSION['captions']; 
$image = $_SESSION['image_url'];
$platforms = array_filter(array_keys($data), fn($key) => $key !== 'image_url'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Select Post</title>
    <link rel="stylesheet" href="./dashboard.css">
    <link rel="stylesheet" href="./previews.css">
</head>

<body>
<nav class="nav">
    <div class="nav-wrap">
        <div class="nav-left">
            <h1 class="logo">sh<span class="gradient">AI</span>r</h1>
        </div>
        <div class="nav-right">
            <div class="links">
                <a href="./index.php" class="link active">Home</a>
                <a href="./products.php" class="link">Products</a>
                <a href="./data.php" class="link">Analytics</a>
                <a href="./api.php" class="link">Connect to the API</a>
            </div>
            <div class="avatar" id="avatar">
                <img src="https://api.dicebear.com/9.x/bottts/svg?seed=sii" alt="avatar">
            </div>
        </div>
    </div>
</nav>

<!-- Tabs -->
<div class="tabs" role="tablist" aria-p="Social platforms">
    <?php foreach ($platforms as $index => $platform): ?>
        <div class="tab <?= $index === 0 ? 'active' : '' ?>"
             data-platform="<?= strtolower($platform) ?>"
             role="tab"
             aria-selected="<?= $index === 0 ? 'true' : 'false' ?>">
            <?= $platform ?>
        </div>
    <?php endforeach; ?>
</div>

<main class="container">
    <section class="card" aria-labelledby="create-post-title">
        <h2 id="create-post-title"><?= $platforms[0] ?></h2>
        <p id="helperText" class="helper">Preview your full post before sharing.</p>

        <?php foreach ($platforms as $index => $platform): 
            $caption = htmlspecialchars($data[$platform] ?? '');
        ?>
            <div class="platform-section <?= $index === 0 ? 'active' : '' ?>" data-platform="<?= strtolower($platform) ?>" id="section-<?= strtolower($platform) ?>">
                <div class="media-area" aria-live="polite">
                    <?php if ($image): ?>
                        <img src="<?= $image ?>" alt="<?= $platform ?> image" class="product-img" id="img-<?= strtolower($platform) ?>">
                    <?php endif; ?>
                    <div class="add-image-btn"><a href="#" data-input="input-<?= strtolower($platform) ?>">+</a></div>
                    <input type="file" id="input-<?= strtolower($platform) ?>" accept="image/*" style="display:none">
                </div>

                <p for="desc-<?= strtolower($platform) ?>" class="small">Captions</p>
                <textarea id="desc-<?= strtolower($platform) ?>" placeholder="<?= $platform ?> caption..."><?= $caption ?></textarea>
            </div>
        <?php endforeach; ?>
    </section>

    <div class="actions" style="margin-top:18px">
        <button id="postBtn" class="btn-primary purple" type="button">📤 Post</button>
        <button id="scheduleBtn" class="btn-primary" type="button">📅 Schedule</button>
        <button id="rutineBtn" class="btn-primary" type="button">🔄 Rutine</button>
        <button id="shareBtn" class="btn-primary" type="button">🔗 Share</button>
    </div>
</main>

<script>
const tabs = document.querySelectorAll('.tab');
const sections = document.querySelectorAll('.platform-section');
const heading = document.getElementById('create-post-title');
const helperText = document.getElementById('helperText');

const helperByPlatform = {
    instagram: 'Preview your full Instagram post before sharing.',
    facebook: 'Preview your full Facebook post before sharing.',
    x: 'Preview your full X post before sharing.',
    linkedin: 'Preview your full LinkedIn post before sharing.'
};

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        tabs.forEach(t => { t.classList.remove('active'); t.setAttribute('aria-selected', 'false'); });
        tab.classList.add('active');
        tab.setAttribute('aria-selected', 'true');

        const platform = tab.dataset.platform;
        sections.forEach(s => s.classList.toggle('active', s.dataset.platform === platform));

        heading.textContent = platform.charAt(0).toUpperCase() + platform.slice(1);
        helperText.textContent = helperByPlatform[platform] || 'Add an image, write a description, then schedule or post immediately.';
    });
});

// Handle image upload & live preview
document.querySelectorAll('.add-image-btn a').forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        const input = document.getElementById(btn.dataset.input);
        if (input) input.click();
    });
});

document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', (e) => {
        const file = e.target.files && e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = ev => {
            const section = input.closest('.platform-section');
            let img = section.querySelector('.product-img');

            // If there is no img yet (image was empty), create one
            if (!img) {
                img = document.createElement('img');
                img.className = 'product-img';
                section.querySelector('.media-area').prepend(img);
            }
            img.src = ev.target.result;
        };
        reader.readAsDataURL(file);
    });
});

document.getElementById('postBtn').addEventListener('click', () => {
    const platformsData = {};

    document.querySelectorAll('.platform-section').forEach(section => {
        const platform = section.dataset.platform;
        const caption = section.querySelector('textarea').value.trim();
        const imgEl = section.querySelector('.product-img');
        const image = imgEl ? imgEl.src : null; // This will be base64 or original URL

        platformsData[platform] = {
            caption: caption,
            image: image
        };
    });

    // Send to backend via AJAX
    fetch('../server/save_post.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(platformsData)
    })
    .then(res => res.text())
    .then(window.location.href = "data.html")
    .catch(err => console.error(err));
});


</script>
</body>
</html>
