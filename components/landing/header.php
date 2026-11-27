<?php
require_once __DIR__ . '/../../middleware/auth.php';
$authUser = getAuthUser();
?>
<header class="navbar">
    <div class="logo">
        <img src="/assests/images/image.png" alt="Meeple Space">
    </div>
    <nav class="nav-links">
        <a href="/index.php" class="active">HOME</a>
        <a href="/pages/boardgames.php">BOARDGAME</a>
        <a href="/pages/menu.php">MENU</a>
        <a href="/pages/booking.php">BOOKING</a>
    </nav>
    <?php if ($authUser): ?>
        <!-- Sudah login. TODO: arahkan ke halaman profil / panel admin kalau sudah dibuat (sementara: log out) -->
        <a href="/actions/auth/logout.php" class="nav-avatar" title="Log out"><?= htmlspecialchars(strtoupper(substr($authUser['username'] ?? 'U', 0, 1)), ENT_QUOTES, 'UTF-8') ?></a>
    <?php else: ?>
        <a href="/pages/auth/login.php" class="btn-auth">Sign Up/Sign In</a>
    <?php endif; ?>
</header>