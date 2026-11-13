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
                    <!-- Ganti dengan gambar roda: <img src="assests/spin-wheel.png" alt="Spin wheel"> -->
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
            <a href="#" class="see-all">See All &rarr;</a>
        </div>
        <div class="card-grid">
            <article class="game-card">
                <div class="game-card-img" data-label="Uno Wild">
                    <!-- Ganti dengan foto cover: <img src="assests/uno-wild.jpg" alt="Uno Wild"> -->
                </div>
                <div class="game-card-body">
                    <h3>Uno Wild</h3>
                    <p class="game-card-meta">3-6 players &middot; 30 min</p>
                    <div class="tags">
                        <span class="tag tag--active">Card Game</span>
                        <span class="tag">Party Game</span>
                        <span class="tag">Easy</span>
                    </div>
                </div>
            </article>
            <article class="game-card">
                <div class="game-card-img" data-label="Se - Kata">
                    <!-- Ganti dengan foto cover: <img src="assests/se-kata.jpg" alt="Se - Kata"> -->
                </div>
                <div class="game-card-body">
                    <h3>Se - Kata</h3>
                    <p class="game-card-meta">3-10 players &middot; 5-10 min</p>
                    <div class="tags">
                        <span class="tag tag--active">Card Game</span>
                        <span class="tag">Word Game</span>
                        <span class="tag">Medium</span>
                    </div>
                </div>
            </article>
            <article class="game-card">
                <div class="game-card-img" data-label="Uno No Mercy">
                    <!-- Ganti dengan foto cover: <img src="assests/uno-no-mercy.jpg" alt="Uno No Mercy"> -->
                </div>
                <div class="game-card-body">
                    <h3>Uno No Mercy</h3>
                    <p class="game-card-meta">3-6 players &middot; 25 min</p>
                    <div class="tags">
                        <span class="tag tag--active">Card Game</span>
                        <span class="tag">Strategy</span>
                        <span class="tag">Medium</span>
                    </div>
                </div>
            </article>
            <article class="game-card">
                <div class="game-card-img" data-label="Uno Flip">
                    <!-- Ganti dengan foto cover: <img src="assests/uno-flip.jpg" alt="Uno Flip"> -->
                </div>
                <div class="game-card-body">
                    <h3>Uno Flip</h3>
                    <p class="game-card-meta">3-6 players &middot; 30 min</p>
                    <div class="tags">
                        <span class="tag tag--active">Card Game</span>
                        <span class="tag">Family Game</span>
                        <span class="tag">Easy</span>
                    </div>
                </div>
            </article>
            <article class="game-card">
                <div class="game-card-img" data-label="Monopoly">
                    <!-- Ganti dengan foto cover: <img src="assests/monopoly.jpg" alt="Monopoly"> -->
                </div>
                <div class="game-card-body">
                    <h3>Monopoly</h3>
                    <p class="game-card-meta">3-10 players &middot; 5-10 min</p>
                    <div class="tags">
                        <span class="tag tag--active">Board Game</span>
                        <span class="tag">Strategy</span>
                        <span class="tag">Hard</span>
                    </div>
                </div>
            </article>
            <article class="game-card">
                <div class="game-card-img" data-label="T-C-G-F-P">
                    <!-- Ganti dengan foto cover: <img src="assests/tcgfp.jpg" alt="T-C-G-F-P"> -->
                </div>
                <div class="game-card-body">
                    <h3>T-C-G-F-P</h3>
                    <p class="game-card-meta">3-8 players &middot; 20 min</p>
                    <div class="tags">
                        <span class="tag tag--active">Card Game</span>
                        <span class="tag">Reflex Game</span>
                        <span class="tag">Easy</span>
                    </div>
                </div>
            </article>
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
            <a href="#" class="see-all">See All &rarr;</a>
        </div>
        <div class="card-grid">
            <article class="menu-card">
                <div class="menu-card-img" data-label="Chicken Katsu">
                    <!-- Ganti dengan foto makanan: <img src="assests/chicken-katsu.jpg" alt="Chicken Katsu"> -->
                </div>
                <div class="menu-card-body">
                    <div class="menu-card-info">
                        <h3>Chicken Katsu</h3>
                        <p>Rp. 30.000</p>
                    </div>
                    <button class="btn-add" type="button" aria-label="Add Chicken Katsu">+</button>
                </div>
            </article>
            <article class="menu-card">
                <div class="menu-card-img" data-label="Rice With Anchovies">
                    <!-- Ganti dengan foto makanan: <img src="assests/rice-anchovies.jpg" alt="Rice With Anchovies"> -->
                </div>
                <div class="menu-card-body">
                    <div class="menu-card-info">
                        <h3>Rice With Anchovies</h3>
                        <p>Rp. 30.000</p>
                    </div>
                    <button class="btn-add" type="button" aria-label="Add Rice With Anchovies">+</button>
                </div>
            </article>
            <article class="menu-card">
                <div class="menu-card-img" data-label="Spaghetti Bolognese">
                    <!-- Ganti dengan foto makanan: <img src="assests/spaghetti-bolognese.jpg" alt="Spaghetti Bolognese"> -->
                </div>
                <div class="menu-card-body">
                    <div class="menu-card-info">
                        <h3>Spaghetti Bolognese</h3>
                        <p>Rp. 30.000</p>
                    </div>
                    <button class="btn-add" type="button" aria-label="Add Spaghetti Bolognese">+</button>
                </div>
            </article>
            <article class="menu-card">
                <div class="menu-card-img" data-label="Spaghetti Carbonara">
                    <!-- Ganti dengan foto makanan: <img src="assests/spaghetti-carbonara.jpg" alt="Spaghetti Carbonara"> -->
                </div>
                <div class="menu-card-body">
                    <div class="menu-card-info">
                        <h3>Spaghetti Carbonara</h3>
                        <p>Rp. 30.000</p>
                    </div>
                    <button class="btn-add" type="button" aria-label="Add Spaghetti Carbonara">+</button>
                </div>
            </article>
            <article class="menu-card">
                <div class="menu-card-img" data-label="Chicken Katsu Teriyaki">
                    <!-- Ganti dengan foto makanan: <img src="assests/chicken-katsu-teriyaki.jpg" alt="Chicken Katsu Teriyaki"> -->
                </div>
                <div class="menu-card-body">
                    <div class="menu-card-info">
                        <h3>Chicken Katsu Teriyaki</h3>
                        <p>Rp. 30.000</p>
                    </div>
                    <button class="btn-add" type="button" aria-label="Add Chicken Katsu Teriyaki">+</button>
                </div>
            </article>
            <article class="menu-card">
                <div class="menu-card-img" data-label="Indomie Goreng">
                    <!-- Ganti dengan foto makanan: <img src="assests/indomie-goreng.jpg" alt="Indomie Goreng"> -->
                </div>
                <div class="menu-card-body">
                    <div class="menu-card-info">
                        <h3>Indomie Goreng</h3>
                        <p>Rp. 30.000</p>
                    </div>
                    <button class="btn-add" type="button" aria-label="Add Indomie Goreng">+</button>
                </div>
            </article>
            <article class="menu-card">
                <div class="menu-card-img" data-label="Indomie Soto">
                    <!-- Ganti dengan foto makanan: <img src="assests/indomie-soto.jpg" alt="Indomie Soto"> -->
                </div>
                <div class="menu-card-body">
                    <div class="menu-card-info">
                        <h3>Indomie Soto</h3>
                        <p>Rp. 30.000</p>
                    </div>
                    <button class="btn-add" type="button" aria-label="Add Indomie Soto">+</button>
                </div>
            </article>
            <article class="menu-card">
                <div class="menu-card-img" data-label="Indomie Goreng Special">
                    <!-- Ganti dengan foto makanan: <img src="assests/indomie-goreng-special.jpg" alt="Indomie Goreng Special"> -->
                </div>
                <div class="menu-card-body">
                    <div class="menu-card-info">
                        <h3>Indomie Goreng Special</h3>
                        <p>Rp. 30.000</p>
                    </div>
                    <button class="btn-add" type="button" aria-label="Add Indomie Goreng Special">+</button>
                </div>
            </article>
            <article class="menu-card">
                <div class="menu-card-img" data-label="Indomie Rendang">
                    <!-- Ganti dengan foto makanan: <img src="assests/indomie-rendang.jpg" alt="Indomie Rendang"> -->
                </div>
                <div class="menu-card-body">
                    <div class="menu-card-info">
                        <h3>Indomie Rendang</h3>
                        <p>Rp. 30.000</p>
                    </div>
                    <button class="btn-add" type="button" aria-label="Add Indomie Rendang">+</button>
                </div>
            </article>
        </div>
    </section>
    <?php require_once __DIR__ . "/components/landing/footer.php" ?>
</div>
</body>
</html>
