<?php
require_once __DIR__ . "/config/helpers.php";

// Folder foto (nama folder mengandung spasi, jadi di-encode saat dicetak ke URL)
$imgGame = "assests/images/img boardgame/";
$imgMenu = "assests/images/img makanan/";

// Data kartu "Trending" (foto => nama file di folder img boardgame)
$trendingGames = [
    ["name" => "Uno Wild",     "img" => "unowild.jpg",       "meta" => "3-6 players &middot; 30 min",    "tags" => ["Card Game", "Party Game", "Easy"]],
    ["name" => "Se - Kata",    "img" => "sekata.jpg",       "meta" => "3-10 players &middot; 5-10 min", "tags" => ["Card Game", "Word Game", "Medium"]],
    ["name" => "Uno No Mercy", "img" => "unonomercyy.jpg",  "meta" => "3-6 players &middot; 25 min",    "tags" => ["Card Game", "Strategy", "Medium"]],
    ["name" => "Uno Flip",     "img" => "unoflip.jpg",      "meta" => "3-6 players &middot; 30 min",    "tags" => ["Card Game", "Family Game", "Easy"]],
    ["name" => "Monopoly",     "img" => "monopolyy.jpg",    "meta" => "3-10 players &middot; 5-10 min", "tags" => ["Board Game", "Strategy", "Hard"]],
    ["name" => "T-C-G-F-P",    "img" => "TCGCP.jpg",        "meta" => "3-8 players &middot; 20 min",    "tags" => ["Card Game", "Reflex Game", "Easy"]],
];

// Data kartu "Favorite Menu" (foto => nama file di folder img makanan)
$favoriteMenu = [
    ["name" => "Chicken Katsu",          "img" => "chickenkatsu.jpg",         "price" => "Rp. 30.000"],
    ["name" => "Rice With Anchovies",    "img" => "nasiikanteri.jpg",         "price" => "Rp. 30.000"],
    ["name" => "Spaghetti Bolognese",    "img" => "pastabolognese.jpg",       "price" => "Rp. 30.000"],
    ["name" => "Spaghetti Carbonara",    "img" => "pastacarbonara.jpg",       "price" => "Rp. 30.000"],
    ["name" => "Chicken Katsu Teriyaki", "img" => "chickenkatsuteriyaki.jpg", "price" => "Rp. 30.000"],
    ["name" => "Indomie Goreng",         "img" => "miegoreng.jpg",            "price" => "Rp. 30.000"],
    ["name" => "Indomie Soto",           "img" => "miesoto.jpg",              "price" => "Rp. 30.000"],
    ["name" => "Indomie Goreng Special", "img" => "miekaldu.jpg",             "price" => "Rp. 30.000"],
    ["name" => "Indomie Rendang",        "img" => "mierendang.jpg",           "price" => "Rp. 30.000"],
];

/** Susun URL foto: encode tiap bagian path supaya spasi/kurung aman. */
function imgUrl(string $folder, string $file): string
{
    return implode('/', array_map('rawurlencode', explode('/', rtrim($folder, '/')))) . '/' . rawurlencode($file);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Meeple Space</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/index.css">
</head>
<body>
<div class="wrapper">

    <?php require_once __DIR__ . "/components/landing/header.php" ?>

    <!-- ===== Hero (foto latar: styles/pages/landing.css, bagian .hero) ===== -->
    <section class="hero">
        <div class="hero-content">
            <span class="badge">THE MOST COMPREHENSIVE BOARD GAME CATALOG</span>
            <h1 class="hero-title">Want To play board games while hanging out? Book now!</h1>
            <p class="hero-subtitle">Explore your collection of favorite games and find<br>the ones you want to play with your friends!</p>
        </div>
    </section>

    <!-- ===== Fitur: Random Picker & Quiz ===== -->
    <section class="features">
        <article class="card">
            <h2 class="card-title">Random Game Picker</h2>
            <div class="card-body split">
                <div class="card-img">
                    <div class="wheel-placeholder"></div>
                </div>
                <div class="card-info">
                    <p>Pick a random boardgame for the day!</p>
                    <button class="btn-try" type="button">Try &rarr;</button>
                </div>
            </div>
        </article>

        <article class="card">
            <h2 class="card-title">Game Recommendation Quiz</h2>
            <div class="card-body block">
                <p>Pick a board game that matches your taste with a pop-up quiz that can find your match in the world of the board game!</p>
                <button class="btn-try" type="button">Try &rarr;</button>
            </div>
        </article>
    </section>

    <!-- ===== Trending games ===== -->
    <section class="section">
        <div class="section-head">
            <div>
                <span class="section-eyebrow">Most wanted</span>
                <h2 class="section-title">It's trending right now</h2>
                <p class="section-sub">The game most frequently found sitting on cafe tables.</p>
            </div>
            <a href="/pages/boardgames.php" class="see-all">See All &rarr;</a>
        </div>
        <div class="card-grid">
            <?php foreach ($trendingGames as $game): ?>
            <article class="game-card">
                <div class="game-card-img" data-label="<?= e($game['name']) ?>">
                    <img src="<?= e(imgUrl($imgGame, $game['img'])) ?>" alt="<?= e($game['name']) ?>" loading="lazy">
                </div>
                <div class="game-card-body">
                    <h3><?= e($game['name']) ?></h3>
                    <p class="game-card-meta"><?= $game['meta'] ?></p>
                    <div class="tags">
                        <?php foreach ($game['tags'] as $i => $tag): ?>
                            <span class="tag<?= $i === 0 ? ' tag--active' : '' ?>"><?= e($tag) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- ===== Favorite menu ===== -->
    <section class="section">
        <div class="section-head">
            <div>
                <span class="section-eyebrow">Most favorite</span>
                <h2 class="section-title">Favorite Menu Items</h2>
                <p class="section-sub">The most frequently consumed menu item.</p>
            </div>
            <a href="/pages/menu.php" class="see-all">See All &rarr;</a>
        </div>
        <div class="card-grid">
            <?php foreach ($favoriteMenu as $item): ?>
            <article class="menu-card">
                <div class="menu-card-img" data-label="<?= e($item['name']) ?>">
                    <img src="<?= e(imgUrl($imgMenu, $item['img'])) ?>" alt="<?= e($item['name']) ?>" loading="lazy">
                </div>
                <div class="menu-card-body">
                    <div class="menu-card-info">
                        <h3><?= e($item['name']) ?></h3>
                        <p><?= e($item['price']) ?></p>
                    </div>
                    <button class="btn-add" type="button" aria-label="Add <?= e($item['name']) ?>">+</button>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </section>

    <?php require_once __DIR__ . "/components/landing/footer.php" ?>
</div>
</body>
</html>
