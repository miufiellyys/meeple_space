<?php
require_once __DIR__ . "/../../config/helpers.php";
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../middleware/auth.php";
require_once __DIR__ . "/../../repositories/user-repository.php";
require_once __DIR__ . "/../../validations/auth-validation.php";

sessionStart();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !verifyCsrf()) {
    redirect('/pages/auth/login.php');
}

$request = getLoginRequest($_POST);
$errors  = validateLogin($request);

if (!$errors) {
    $user = findUserByEmail($pdo, $request['email']);
    if (!$user || !password_verify($request['password'], $user['password_hash'])) {
        $errors['login'] = 'Wrong email or password.';
    }
}

if ($errors) {
    $_SESSION['auth_errors'] = $errors;
    $_SESSION['auth_old']    = ['email' => $request['email']];
    redirect('/pages/auth/login.php');
}

session_regenerate_id(true);
$_SESSION['user'] = ['id' => $user['id'], 'email' => $user['email'], 'username' => $user['username'], 'role' => $user['role']];

// Remember Me: cookie sesi bertahan 30 hari
if (!empty($_POST['remember'])) {
    setcookie(session_name(), session_id(), ['expires' => time() + 60 * 60 * 24 * 30, 'path' => '/', 'httponly' => true, 'samesite' => 'Lax']);
}

redirect('/index.php');
