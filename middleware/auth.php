<?php
// middleware/auth.php - sesi, status login, dan token CSRF

function sessionStart(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        ini_set('session.gc_maxlifetime', (string) (60 * 60 * 24 * 30)); // sesi tidak dibuang cepat (untuk Remember Me)
        session_start();
    }
}

function getAuthUser(): ?array
{
    sessionStart();
    return $_SESSION['user'] ?? null;
}

function isLoggedIn(): bool
{
    return getAuthUser() !== null;
}

/** Halaman khusus tamu (login/daftar): kalau sudah login, kembali ke Home. */
function requireGuest(): void
{
    if (isLoggedIn()) {
        header('Location: /index.php');
        exit;
    }
}

function csrfToken(): string
{
    sessionStart();
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function verifyCsrf(): bool
{
    sessionStart();
    return isset($_POST['csrf'], $_SESSION['csrf']) && hash_equals($_SESSION['csrf'], (string) $_POST['csrf']);
}

/** Halaman khusus admin (panel admin): selain admin dikembalikan ke halaman login. */
function requireAdmin(): void
{
    $user = getAuthUser();
    if (!$user || ($user['role'] ?? '') !== 'admin') {
        header('Location: /pages/auth/login.php');
        exit;
    }
}
