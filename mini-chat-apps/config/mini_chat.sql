-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2025 at 08:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini_chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(100) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `creator_id`, `created_at`) VALUES
(1, 'PWEB', 2, '2025-06-03 00:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `member_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`member_id`, `group_id`, `user_id`) VALUES
(1, 1, 2),
(2, 1, 1),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `group_messages`
--

CREATE TABLE `group_messages` (
  `message_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `group_messages`
--

INSERT INTO `group_messages` (`message_id`, `group_id`, `sender_id`, `timestamp`, `message`) VALUES
(1, 1, 2, '2025-06-03 00:49:58', 'halo rek'),
(2, 1, 3, '2025-06-03 00:50:07', 'halo junaidi'),
(3, 1, 3, '2025-06-03 00:50:17', 'ini buat pweb kah');

-- --------------------------------------------------------

--
-- Table structure for table `parties`
--

CREATE TABLE `parties` (
  `parties_id` int(11) NOT NULL,
  `initiator` int(11) NOT NULL,
  `recipient` int(11) NOT NULL,
  `started_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parties`
--

INSERT INTO `parties` (`parties_id`, `initiator`, `recipient`, `started_at`) VALUES
(1, 3, 2, '2025-06-02 18:32:42'),
(2, 3, 1, '2025-06-02 18:37:00'),
(3, 2, 2, '2025-06-02 18:37:59');

-- --------------------------------------------------------

--
-- Table structure for table `priv_chat`
--

CREATE TABLE `priv_chat` (
  `chat_id` int(11) NOT NULL,
  `parties_id` int(11) NOT NULL,
  `message_sender` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `priv_chat`
--

INSERT INTO `priv_chat` (`chat_id`, `parties_id`, `message_sender`, `timestamp`, `message`) VALUES
(1, 1, 3, '2025-06-02 18:37:15', 'Halo Junaidi, ini saipul'),
(2, 1, 2, '2025-06-02 18:38:06', 'oy saipul apa kabar'),
(3, 1, 3, '2025-06-02 18:40:27', 'baik bro');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fullname`, `email`, `address`, `username`, `password`) VALUES
(1, 'alex ', 'alex@gmail.com', 'Jl. Keputih no 33', 'alex1', '$2y$10$8VsDWONUK8XzT..z7HcJC.uXIXdYAy0d5yyh/zt86IHJaYGq5uiz2'),
(2, 'junaidi', 'junaidi@gmail.com', 'Jl. Keputih no 55', 'juna', '$2y$10$q185je/jRuGn1yN3gE5BTejBoJExXIi1GOsXohlcK6EwJX4uXCKny'),
(3, 'saipul bahri', 'saipul24@gmail.com', 'Jl. Keputih no 88', 'saipul123', '$2y$10$BPzA4qdHluGH7oftXhxRJ.uqGmOeuMZB8F4SndWrrI2TFI5eGxgbu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `group_messages`
--
ALTER TABLE `group_messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `sender_id` (`sender_id`);

--
-- Indexes for table `parties`
--
ALTER TABLE `parties`
  ADD PRIMARY KEY (`parties_id`),
  ADD KEY `initiator` (`initiator`),
  ADD KEY `recipient` (`recipient`);

--
-- Indexes for table `priv_chat`
--
ALTER TABLE `priv_chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `parties_id` (`parties_id`),
  ADD KEY `message_sender` (`message_sender`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `group_messages`
--
ALTER TABLE `group_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `parties`
--
ALTER TABLE `parties`
  MODIFY `parties_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `priv_chat`
--
ALTER TABLE `priv_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_members_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `group_messages`
--
ALTER TABLE `group_messages`
  ADD CONSTRAINT `group_messages_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_messages_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `parties`
--
ALTER TABLE `parties`
  ADD CONSTRAINT `parties_ibfk_1` FOREIGN KEY (`initiator`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parties_ibfk_2` FOREIGN KEY (`recipient`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `priv_chat`
--
ALTER TABLE `priv_chat`
  ADD CONSTRAINT `priv_chat_ibfk_1` FOREIGN KEY (`parties_id`) REFERENCES `parties` (`parties_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `priv_chat_ibfk_2` FOREIGN KEY (`message_sender`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
