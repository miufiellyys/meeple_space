-- Akun admin untuk panel admin (nanti).
-- Jalankan SETELAH config/meeple_space.sql. Aman dijalankan ulang (memperbarui password admin).
USE meeple_space;

INSERT INTO users (email, password_hash, role)
VALUES ('admin@meeplespace.com', '$2y$12$jdzRHNVy0ycUtDt0CmwRcOIXswEYjWvvar4Pz/da2RKDQ/uL1I8zO', 'admin')
ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash), role = 'admin';

INSERT IGNORE INTO user_profiles (user_id, username)
SELECT id, 'Grandmaster' FROM users WHERE email = 'admin@meeplespace.com';
