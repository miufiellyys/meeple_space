<?php
/** Escape teks sebelum dicetak ke HTML (mencegah XSS). */
function e(string $text): string
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/** Pindah halaman lalu hentikan script. */
function redirect(string $path): void
{
    header('Location: ' . $path);
    exit;
}
