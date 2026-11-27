<?php

function findUserByEmail(PDO $pdo, string $email): ?array
{
    $stmt = $pdo->prepare(
        'SELECT u.id, u.email, u.password_hash, u.role, p.username
         FROM users u
         LEFT JOIN user_profiles p ON p.user_id = u.id
         WHERE u.email = :email
         LIMIT 1'
    );
    $stmt->execute(['email' => $email]);
    return $stmt->fetch() ?: null;
}

/* create account: baris di users dan user_profiles disimpan bersamaan (transaksi). */
function createUser(PDO $pdo, array $data): array
{
    $pdo->beginTransaction();
    try {
        $stmt = $pdo->prepare('INSERT INTO users (email, password_hash) VALUES (:email, :password_hash)');
        $stmt->execute([
            'email'         => $data['email'],
            'password_hash' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);
        $userId = (int) $pdo->lastInsertId();

        $stmt = $pdo->prepare(
            'INSERT INTO user_profiles (user_id, username, phone_number, birth_date)
             VALUES (:user_id, :username, :phone_number, :birth_date)'
        );
        $stmt->execute([
            'user_id'      => $userId,
            'username'     => explode('@', $data['email'])[0],
            'phone_number' => $data['phone'],
            'birth_date'   => $data['dob'],
        ]);

        $pdo->commit();
    } catch (PDOException $ex) {
        $pdo->rollBack();
        throw $ex;
    }
    return findUserByEmail($pdo, $data['email']);
}
