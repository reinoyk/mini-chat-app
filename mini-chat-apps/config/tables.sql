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
