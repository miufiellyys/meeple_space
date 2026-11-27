
CREATE DATABASE IF NOT EXISTS meeple_space CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE meeple_space;

--user
CREATE TABLE users (
    id            INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email         VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role          ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    created_at    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE user_profiles (            -- one to one dengan users
    id            INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id       INT UNSIGNED NOT NULL UNIQUE,
    username      VARCHAR(50) NOT NULL,
    phone_number  VARCHAR(20) NULL,
    birth_date    DATE NULL,
    avatar        VARCHAR(255) NULL,
    xp            INT UNSIGNED NOT NULL DEFAULT 0,
    level         INT UNSIGNED NOT NULL DEFAULT 1,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

--Badge, riwayat, undangan
CREATE TABLE badges (
    id          INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    code        VARCHAR(30) NOT NULL UNIQUE,
    name        VARCHAR(50) NOT NULL,
    description VARCHAR(255) NULL,
    icon        VARCHAR(255) NULL
) ENGINE=InnoDB;

CREATE TABLE user_badges (
    user_id   INT UNSIGNED NOT NULL,
    badge_id  INT UNSIGNED NOT NULL,
    earned_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (user_id, badge_id),
    FOREIGN KEY (user_id)  REFERENCES users(id)  ON DELETE CASCADE,
    FOREIGN KEY (badge_id) REFERENCES badges(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE user_activities (
    id            INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id       INT UNSIGNED NOT NULL,
    activity_type ENUM('change_boardgame', 'invite_friend', 'order_drink', 'order_food', 'book_table') NOT NULL,
    description   VARCHAR(255) NULL,
    created_at    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE friend_invites (
    id            INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    inviter_id    INT UNSIGNED NOT NULL,
    invitee_email VARCHAR(255) NOT NULL,
    created_at    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (inviter_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

--Board game
CREATE TABLE categories (
    id         INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(30) NOT NULL UNIQUE,
    sort_order TINYINT UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB;

CREATE TABLE board_games (
    id           INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name         VARCHAR(100) NOT NULL,
    description  TEXT NULL,
    image        VARCHAR(255) NULL,
    min_players  TINYINT UNSIGNED NOT NULL,
    max_players  TINYINT UNSIGNED NOT NULL,
    duration_min SMALLINT UNSIGNED NOT NULL,
    difficulty   ENUM('easy', 'medium', 'hard') NOT NULL DEFAULT 'easy',
    copies_total TINYINT UNSIGNED NOT NULL DEFAULT 1,
    is_active    BOOLEAN NOT NULL DEFAULT TRUE
) ENGINE=InnoDB;

CREATE TABLE board_game_categories (
    game_id     INT UNSIGNED NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    is_primary  BOOLEAN NOT NULL DEFAULT FALSE,
    UNIQUE (game_id, category_id),
    FOREIGN KEY (game_id)     REFERENCES board_games(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id)  ON DELETE CASCADE
) ENGINE=InnoDB;

--Menu
CREATE TABLE menu_items (
    id           INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name         VARCHAR(100) NOT NULL,
    category     ENUM('food', 'drink', 'snack') NOT NULL,
    price        INT UNSIGNED NOT NULL,
    image        VARCHAR(255) NULL,
    is_available BOOLEAN NOT NULL DEFAULT TRUE
) ENGINE=InnoDB;

--Booking
CREATE TABLE cafe_tables (
    id           INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    table_name   VARCHAR(20) NOT NULL,
    min_capacity TINYINT UNSIGNED NOT NULL,
    max_capacity TINYINT UNSIGNED NOT NULL,
    is_active    BOOLEAN NOT NULL DEFAULT TRUE
) ENGINE=InnoDB;

CREATE TABLE bookings (
    id           INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id      INT UNSIGNED NOT NULL,
    table_id     INT UNSIGNED NOT NULL,
    full_name    VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    booking_date DATE NOT NULL,
    arrival_time TIME NOT NULL,
    party_size   TINYINT UNSIGNED NOT NULL,
    notes        TEXT NULL,
    status       ENUM('pending', 'confirmed', 'canceled', 'completed') NOT NULL DEFAULT 'pending',
    created_at   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id)  REFERENCES users(id)       ON DELETE CASCADE,
    FOREIGN KEY (table_id) REFERENCES cafe_tables(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE payments (                 -- one to one bookings
    id         INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    booking_id INT UNSIGNED NOT NULL UNIQUE,
    method     ENUM('qris', 'dana', 'gopay', 'shopeepay') NOT NULL,
    amount     INT UNSIGNED NOT NULL,
    status     ENUM('pending', 'paid', 'failed') NOT NULL DEFAULT 'pending',
    paid_at    DATETIME NULL,
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE booking_games (            -- game yang disewa (base leaderboard game paling banyak disewa)
    booking_id INT UNSIGNED NOT NULL,
    game_id    INT UNSIGNED NOT NULL,
    UNIQUE (booking_id, game_id),
    FOREIGN KEY (booking_id) REFERENCES bookings(id)    ON DELETE CASCADE,
    FOREIGN KEY (game_id)    REFERENCES board_games(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE booking_items (            -- menu yang dipesan
    id           INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    booking_id   INT UNSIGNED NOT NULL,
    menu_item_id INT UNSIGNED NOT NULL,
    quantity     SMALLINT UNSIGNED NOT NULL DEFAULT 1,
    unit_price   INT UNSIGNED NOT NULL,
    FOREIGN KEY (booking_id)   REFERENCES bookings(id)   ON DELETE CASCADE,
    FOREIGN KEY (menu_item_id) REFERENCES menu_items(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

--Favorit
CREATE TABLE favorite_games (
    user_id    INT UNSIGNED NOT NULL,
    game_id    INT UNSIGNED NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (user_id, game_id),
    FOREIGN KEY (user_id) REFERENCES users(id)       ON DELETE CASCADE,
    FOREIGN KEY (game_id) REFERENCES board_games(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE favorite_menu_items (
    user_id      INT UNSIGNED NOT NULL,
    menu_item_id INT UNSIGNED NOT NULL,
    created_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (user_id, menu_item_id),
    FOREIGN KEY (user_id)      REFERENCES users(id)      ON DELETE CASCADE,
    FOREIGN KEY (menu_item_id) REFERENCES menu_items(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- DATA AWAL
INSERT INTO categories (name, sort_order) VALUES
    ('Card', 1),
    ('Board', 2),
    ('Strategic', 3),
    ('Memory', 4),
    ('Puzzle', 5),
    ('Cooperative', 6),
    ('Dexterity', 7),
    ('Trivia', 8),
    ('Mind', 9),
    ('Word', 10),
    ('Party', 11);

INSERT INTO badges (code, name, description) VALUES
    ('energetic', 'Energetic', 'Play 20 Boardgames'),
    ('hungerrrss', 'Hungerrrss', 'Order 10 menu in 5 Minutes'),
    ('loyal', 'Loyal', 'Frequently Books'),
    ('fanatic', 'Fanatic', 'Play 100+ Boardgames'),
    ('chaotic', 'Chaotic', 'Invite 10+ Friends'),
    ('tourist', 'Tourist', 'Explore All Boardgames');

INSERT INTO cafe_tables (table_name, min_capacity, max_capacity) VALUES
    ('Table 1', 2, 4),
    ('Table 2', 2, 4),
    ('Table 3', 2, 4);

INSERT INTO menu_items (name, category, price, image) VALUES
    ('Chicken Katsu', 'food', 25000, 'chicken-katsu.jpg'),
    ('Rice With Anchovies', 'food', 20000, 'rice-anchovies.jpg'),
    ('Spaghetti Bolognese', 'food', 28000, 'spaghetti-bolognese.jpg'),
    ('Spaghetti Carbonara', 'food', 28000, 'spaghetti-carbonara.jpg'),
    ('Chicken Rice Teriyaki', 'food', 25000, 'chicken-teriyaki.jpg'),
    ('Indomie Goreng', 'food', 15000, 'indomie-goreng.jpg'),
    ('Indomie Soto', 'food', 15000, 'indomie-soto.jpg'),
    ('Indomie Kuah', 'food', 15000, 'indomie-kuah.jpg'),
    ('Mojito', 'drink', 18000, 'mojito.jpg'),
    ('Orange Juice', 'drink', 15000, 'orange-juice.jpg'),
    ('Americano Ice', 'drink', 18000, 'americano-ice.jpg'),
    ('Blue Lagoon', 'drink', 18000, 'blue-lagoon.jpg'),
    ('Strawberry Milk Shake', 'drink', 20000, 'strawberry-milkshake.jpg'),
    ('Ice Coffee', 'drink', 18000, 'ice-coffee.jpg'),
    ('Cookies&Cream Milkshake', 'drink', 22000, 'cookies-cream.jpg'),
    ('Coke Cola', 'drink', 10000, 'coke-cola.jpg'),
    ('Mango Milkshake', 'drink', 20000, 'mango-milkshake.jpg'),
    ('Onigiri', 'snack', 12000, 'onigiri.jpg'),
    ('Caramel Pudding', 'snack', 12000, 'caramel-pudding.jpg'),
    ('French Fries', 'snack', 15000, 'french-fries.jpg'),
    ('Chicken Nuggets', 'snack', 18000, 'chicken-nuggets.jpg'),
    ('Brownies Mini', 'snack', 12000, 'brownies-mini.jpg'),
    ('Churros', 'snack', 15000, 'churros.jpg'),
    ('Donuts', 'snack', 10000, 'donuts.jpg'),
    ('Chicken Sticks', 'snack', 15000, 'chicken-sticks.jpg'),
    ('Cookies', 'snack', 10000, 'cookies.jpg');

INSERT INTO board_games (name, min_players, max_players, duration_min, difficulty, copies_total) VALUES
    ('Uno Wild', 2, 10, 15, 'easy', 2),
    ('Se - Kata', 2, 4, 30, 'easy', 2),
    ('Uno No Mercy', 2, 10, 20, 'medium', 2),
    ('Uno Flip', 2, 10, 20, 'easy', 2),
    ('Catan', 3, 6, 30, 'easy', 2),
    ('Monopoly', 3, 10, 90, 'medium', 2),
    ('Ludo', 3, 6, 35, 'medium', 2),
    ('Fired Up', 3, 6, 30, 'easy', 2),
    ('Checkers', 2, 2, 10, 'medium', 2),
    ('Chess', 2, 2, 35, 'medium', 2),
    ('T-C-G-F-P', 3, 8, 30, 'easy', 2),
    ('That''s Not A Hat', 3, 10, 10, 'medium', 2),
    ('Simon', 1, 4, 15, 'medium', 2),
    ('Ubongo', 2, 4, 20, 'easy', 2),
    ('Rush Hour', 1, 1, 10, 'medium', 2),
    ('Azul', 2, 4, 35, 'medium', 2),
    ('Pandemic', 2, 4, 30, 'easy', 2),
    ('Forbidden Island', 2, 4, 30, 'medium', 2),
    ('Horrified', 1, 5, 35, 'medium', 2),
    ('Jenga', 2, 8, 30, 'easy', 2),
    ('Klask', 2, 2, 10, 'medium', 2),
    ('Flick ''Em Up', 2, 10, 35, 'medium', 2),
    ('Trivial Pursuit', 2, 6, 30, 'easy', 2),
    ('Wits And Wagers', 3, 10, 30, 'medium', 2),
    ('Smart 10', 2, 6, 15, 'medium', 2),
    ('Mastermind', 2, 4, 30, 'easy', 2),
    ('Set', 2, 6, 15, 'medium', 2),
    ('Qwirkle', 2, 4, 30, 'medium', 2),
    ('Scrabble', 2, 4, 60, 'medium', 2),
    ('Boggle', 2, 8, 15, 'medium', 2),
    ('Exploding Kittens', 2, 5, 15, 'easy', 2),
    ('Codenames', 4, 8, 20, 'medium', 2),
    ('Dixit', 3, 6, 30, 'easy', 2);

INSERT INTO board_game_categories (game_id, category_id, is_primary)
SELECT g.id, c.id, x.is_primary FROM (
    SELECT 'Uno Wild' AS gname, 'Card' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Uno Wild' AS gname, 'Party' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Se - Kata' AS gname, 'Card' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Se - Kata' AS gname, 'Word' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Se - Kata' AS gname, 'Party' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Uno No Mercy' AS gname, 'Card' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Uno No Mercy' AS gname, 'Strategic' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Uno Flip' AS gname, 'Card' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Uno Flip' AS gname, 'Party' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Catan' AS gname, 'Board' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Catan' AS gname, 'Party' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Monopoly' AS gname, 'Board' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Monopoly' AS gname, 'Word' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Ludo' AS gname, 'Board' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Ludo' AS gname, 'Strategic' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Fired Up' AS gname, 'Strategic' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Fired Up' AS gname, 'Party' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Checkers' AS gname, 'Strategic' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Chess' AS gname, 'Strategic' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'T-C-G-F-P' AS gname, 'Memory' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'T-C-G-F-P' AS gname, 'Party' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'That''s Not A Hat' AS gname, 'Memory' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'That''s Not A Hat' AS gname, 'Word' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Simon' AS gname, 'Memory' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Simon' AS gname, 'Strategic' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Ubongo' AS gname, 'Puzzle' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Ubongo' AS gname, 'Party' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Rush Hour' AS gname, 'Puzzle' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Rush Hour' AS gname, 'Word' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Azul' AS gname, 'Puzzle' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Azul' AS gname, 'Strategic' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Pandemic' AS gname, 'Cooperative' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Pandemic' AS gname, 'Party' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Forbidden Island' AS gname, 'Cooperative' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Forbidden Island' AS gname, 'Word' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Horrified' AS gname, 'Cooperative' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Horrified' AS gname, 'Strategic' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Jenga' AS gname, 'Dexterity' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Jenga' AS gname, 'Party' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Klask' AS gname, 'Dexterity' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Klask' AS gname, 'Word' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Flick ''Em Up' AS gname, 'Dexterity' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Flick ''Em Up' AS gname, 'Strategic' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Trivial Pursuit' AS gname, 'Trivia' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Trivial Pursuit' AS gname, 'Party' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Wits And Wagers' AS gname, 'Trivia' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Wits And Wagers' AS gname, 'Word' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Smart 10' AS gname, 'Trivia' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Smart 10' AS gname, 'Strategic' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Mastermind' AS gname, 'Mind' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Mastermind' AS gname, 'Party' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Set' AS gname, 'Mind' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Set' AS gname, 'Party' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Qwirkle' AS gname, 'Mind' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Qwirkle' AS gname, 'Party' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Scrabble' AS gname, 'Word' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Scrabble' AS gname, 'Party' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Boggle' AS gname, 'Word' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Boggle' AS gname, 'Party' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Exploding Kittens' AS gname, 'Party' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Exploding Kittens' AS gname, 'Card' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Codenames' AS gname, 'Party' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Codenames' AS gname, 'Word' AS cname, 0 AS is_primary
    UNION ALL
    SELECT 'Dixit' AS gname, 'Party' AS cname, 1 AS is_primary
    UNION ALL
    SELECT 'Dixit' AS gname, 'Memory' AS cname, 0 AS is_primary
) x JOIN board_games g ON g.name = x.gname JOIN categories c ON c.name = x.cname;
