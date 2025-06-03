CREATE TABLE user (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    address VARCHAR(255) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE parties (
    parties_id INT AUTO_INCREMENT PRIMARY KEY,
    initiator INT NOT NULL,
    recipient INT NOT NULL,
    started_at DATETIME NOT NULL,
    FOREIGN KEY (initiator) REFERENCES user(user_id) ON DELETE CASCADE,
    FOREIGN KEY (recipient) REFERENCES user(user_id) ON DELETE CASCADE
);

CREATE TABLE priv_chat (
    chat_id INT AUTO_INCREMENT PRIMARY KEY,
    parties_id INT NOT NULL,
    message_sender INT NOT NULL,
    timestamp DATETIME NOT NULL,
    message TEXT NOT NULL,
    FOREIGN KEY (parties_id) REFERENCES parties(parties_id) ON DELETE CASCADE,
    FOREIGN KEY (message_sender) REFERENCES user(user_id) ON DELETE CASCADE
);

-- Tabel group
CREATE TABLE groups (
    group_id INT AUTO_INCREMENT PRIMARY KEY,
    group_name VARCHAR(100) NOT NULL,
    creator_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabel anggota group
CREATE TABLE group_members (
    member_id INT AUTO_INCREMENT PRIMARY KEY,
    group_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (group_id) REFERENCES groups(group_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE
);

-- Tabel pesan group
CREATE TABLE group_messages (
    message_id INT AUTO_INCREMENT PRIMARY KEY,
    group_id INT NOT NULL,
    sender_id INT NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    message TEXT NOT NULL,
    FOREIGN KEY (group_id) REFERENCES groups(group_id) ON DELETE CASCADE,
    FOREIGN KEY (sender_id) REFERENCES user(user_id) ON DELETE CASCADE
);
