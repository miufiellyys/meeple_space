<?php
// validations/auth-validation.php - ambil dan periksa input form login/daftar

function getLoginRequest(array $post): array
{
    return [
        'email'    => strtolower(trim($post['email'] ?? '')),
        'password' => (string) ($post['password'] ?? ''),
    ];
}

function getRegisterRequest(array $post): array
{
    return getLoginRequest($post) + [
        'phone' => trim($post['phone'] ?? ''),
        'dob'   => trim($post['dob'] ?? ''),
    ];
}

function validateLogin(array $r): array
{
    $errors = [];
    if (!filter_var($r['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }
    if ($r['password'] === '') {
        $errors['password'] = 'Please enter your password.';
    }
    return $errors;
}

function validateRegister(array $r): array
{
    $errors = [];
    if (!filter_var($r['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }
    if (strlen($r['password']) < 8) {
        $errors['password'] = 'Password must be at least 8 characters.';
    }
    if (!preg_match('/^[0-9+\-\s]{8,16}$/', $r['phone'])) {
        $errors['phone'] = 'Please enter a valid phone number.';
    }
    $date = DateTime::createFromFormat('Y-m-d', $r['dob']);
    if (!$date || $date->format('Y-m-d') !== $r['dob'] || $date > new DateTime('today')) {
        $errors['dob'] = 'Please enter a valid date of birth.';
    }
    return $errors;
}
