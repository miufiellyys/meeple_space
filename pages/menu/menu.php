<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Menu | Meeple Space</title>
    
    <link rel="stylesheet" href="../styles/pages/menu.css">
</head>
<body>

    <!-- Header / Navbar -->
    <header class="navbar">
        <div class="logo">
            <img src="../assets/logo-meeple.png" alt="Logo"> 
            <span>Meeple Space</span>
        </div>
        <nav class="nav-links">
            <a href="landing.html">HOME</a>
            <a href="#">BOARDGAME</a>
            <a href="menu.html" class="active">MENU</a>
            <a href="#">BOOKING</a>
        </nav>
        <button class="btn-auth">Sign Up/Sign In</button>
    </header>

    <main class="menu-container">
        
        <!-- Hero Section Menu -->
        <section class="menu-hero">
            <div class="menu-hero-content">
                <h1 class="menu-hero-title">E-Menu</h1>
                <p class="menu-hero-subtitle">Enjoy a wide selection of special food and<br>drinks to accompany your playtime.</p>
            </div>
            <div class="menu-hero-illustration">
                <!-- Ganti dengan path ilustrasi piring & HP milikmu -->
                <img src="../assets/menu-illustration.png" alt="Menu Illustration">
            </div>
        </section>

        <!-- Filter Kategori -->
        <div class="menu-filters">
            <button class="filter-btn active">All</button>
            <button class="filter-btn">Food</button>
            <button class="filter-btn">Drink</button>
            <button class="filter-btn">Snack</button>
        </div>

        <!-- Bagian Grid Kategori -->
        <section class="menu-category">
            <h2 class="category-title">Food</h2>
            
            <div class="menu-grid">
                <!-- Card Item 1 -->
                <article class="menu-card">
                    <div class="menu-card-img">
                        <img src="../assets/chicken-katsu.jpg" alt="Chicken Katsu">
                    </div>
                    <div class="menu-card-body">
                        <div class="menu-card-info">
                            <h3>Chicken Katsu</h3>
                            <p>Rp. 30.000</p>
                        </div>
                        <button class="btn-add">+</button>
                    </div>
                </article>

                <!-- Card Item 2 -->
                <article class="menu-card">
                    <div class="menu-card-img">
                        <img src="../assets/rice-anchovies.jpg" alt="Rice With Anchovies">
                    </div>
                    <div class="menu-card-body">
                        <div class="menu-card-info">
                            <h3>Rice With Anchovies</h3>
                            <p>Rp. 30.000</p>
                        </div>
                        <button class="btn-add">+</button>
                    </div>
                </article>

                <!-- Card Item 3 -->
                <article class="menu-card">
                    <div class="menu-card-img">
                        <img src="../assets/spaghetti.jpg" alt="Spaghetti Bolognese">
                    </div>
                    <div class="menu-card-body">
                        <div class="menu-card-info">
                            <h3>Spaghetti Bolognese</h3>
                            <p>Rp. 30.000</p>
                        </div>
                        <button class="btn-add">+</button>
                    </div>
                </article>
                
                <!-- Tambahkan card lain sesuai kebutuhan -->
            </div>
        </section>

    </main>
</body>
</html>