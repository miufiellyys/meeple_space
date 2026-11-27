<?php
require_once __DIR__ . '/../../config/helpers.php';
require_once __DIR__ . '/../../middleware/auth.php';

requireGuest();

// Tampilan: ?mode=register = Create an account, selain itu = Login
$isRegister = ($_GET['mode'] ?? '') === 'register';

$errors = $_SESSION['auth_errors'] ?? [];
$old    = $_SESSION['auth_old'] ?? [];
unset($_SESSION['auth_errors'], $_SESSION['auth_old']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $isRegister ? 'Create an account' : 'Login' ?> | Meeple Space</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/auth/login.css">
</head>
<body>
<div class="wrapper auth-page">

    <a href="/index.php" class="auth-back" aria-label="Back to Home">&larr;</a>

    <main class="auth-card">
        <img class="auth-card__logo" src="/assests/images/logo.png" alt="Meeple Space">

        <?php if ($isRegister): ?>
            <!-- ===== Tampilan: Create an account ===== -->
            <h1 class="auth-card__title">Create an account</h1>

            <?php foreach ($errors as $message): ?>
                <p class="auth-error" role="alert"><?= e($message) ?></p>
            <?php endforeach; ?>

            <form class="auth-form" method="post" action="/actions/auth/register.php" novalidate>
                <input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>">
                <input class="auth-field" type="email" name="email" placeholder="Email Address" autocomplete="email" required value="<?= e($old['email'] ?? '') ?>">
                <input class="auth-field" type="password" name="password" placeholder="Password (min. 8 characters)" autocomplete="new-password" required>
                <input class="auth-field" type="tel" name="phone" placeholder="Phone Number" autocomplete="tel" required value="<?= e($old['phone'] ?? '') ?>">
                <input class="auth-field" type="date" name="dob" aria-label="Date Of Birth" required value="<?= e($old['dob'] ?? '') ?>">
                <label class="auth-remember"><input type="checkbox" name="remember" value="1"> Remember Me</label>
                <button class="auth-submit" type="submit">Create</button>
            </form>

            <p class="auth-switch">Already have an account? <a href="/pages/auth/login.php">Login Now</a></p>

        <?php else: ?>
            <!-- ===== Tampilan: Login ===== -->
            <h1 class="auth-card__title">Welcome Back to Meeplezone</h1>

            <?php foreach ($errors as $message): ?>
                <p class="auth-error" role="alert"><?= e($message) ?></p>
            <?php endforeach; ?>

            <form class="auth-form" method="post" action="/actions/auth/login.php" novalidate>
                <input type="hidden" name="csrf" value="<?= e(csrfToken()) ?>">
                <input class="auth-field" type="email" name="email" placeholder="Email Address" autocomplete="email" required value="<?= e($old['email'] ?? '') ?>">
                <input class="auth-field" type="password" name="password" placeholder="Password" autocomplete="current-password" required>
                <div class="auth-row">
                    <label class="auth-remember"><input type="checkbox" name="remember" value="1"> Remember Me</label>
                    <a href="#">Forgot Password?</a> <!-- TODO: halaman lupa password -->
                </div>
                <button class="auth-submit" type="submit">Sign In</button>
            </form>

            <p class="auth-or">Or</p>
            <!-- TODO: login Google/Apple belum diaktifkan -->
            <button class="auth-social" type="button" disabled title="Coming soon">Sign With Google</button>
            <button class="auth-social" type="button" disabled title="Coming soon">Sign With Apple</button>

            <p class="auth-switch">New to Meeplezone? <a href="/pages/auth/login.php?mode=register">Create an Account Now</a></p>
        <?php endif; ?>
    </main>

</div>
</body>
</html>
