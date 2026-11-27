<?php
require_once __DIR__ . "/../../config/helpers.php";
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../middleware/auth.php";
require_once __DIR__ . "/../../repositories/user-repository.php";
require_once __DIR__ . "/../../validations/auth-validation.php";

sessionStart();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !verifyCsrf()) {
    redirect('/pages/auth/login.php?mode=register');
}

$request = getRegisterRequest($_POST);
$errors  = validateRegister($request);

if (!$errors && findUserByEmail($pdo, $request['email'])) {
    $errors['email'] = 'This email is already registered. Please sign in.';
}

if (!$errors) {
    try {
        $user = createUser($pdo, $request);
    } catch (PDOException $ex) {
        $errors['register'] = 'Could not create your account. Please try again.';
    }
}

if ($errors) {
    $_SESSION['auth_errors'] = $errors;
    $_SESSION['auth_old']    = ['email' => $request['email'], 'phone' => $request['phone'], 'dob' => $request['dob']];
    redirect('/pages/auth/login.php?mode=register');
}

session_regenerate_id(true);
$_SESSION['user'] = ['id' => $user['id'], 'email' => $user['email'], 'username' => $user['username'], 'role' => $user['role']];
redirect('/index.php');
