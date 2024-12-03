-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2024 at 07:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_form_submissions`
--

CREATE TABLE `contact_form_submissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_seen` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact_form_submissions`
--

INSERT INTO `contact_form_submissions` (`id`, `name`, `email`, `subject`, `message`, `submitted_at`, `is_seen`) VALUES
(1, 'Naseer Ahmad', 'badboyafg102@gmail.com', 'Enter Level Job', 'hello \r\nthis is me', '2024-09-16 19:52:37', 0),
(2, 'Ahmad Khan', 'ahmad@gmail.com', 'Enter Level Job', 'hello \r\nhow are you \r\ni have a job for you', '2024-09-16 17:25:56', 0),
(3, 'Ahmad Khan', 'ahmad@gmail.com', 'Enter Level Job', 'hello \r\nhow are you \r\ni have a job for you', '2024-09-16 17:26:43', 0),
(4, 'Ahmad Khan', 'ahmad@gmail.com', 'Enter Level Job', 'hello \r\nhow are you \r\ni have a job for you', '2024-09-16 17:26:48', 0),
(5, 'Ali', 'admin22@gmail.com', 'king', 'hello \r\nhow are you\r\n', '2024-09-16 17:32:49', 0),
(6, 'Naseer Totaki', 'badboyafg102@gmail.com', 'Enter Level Job', 'hello', '2024-09-16 17:38:17', 0),
(7, 'Imaran ', 'imar@gmail.com', 'Hello', 'Hi,Naseer\r\nhow are you', '2024-09-17 04:40:22', 0),
(8, 'Ahmad Khan', 'imar@gmail.com', 'Enter Level Job in Kardan Unversity', 'hello\r\nhow are you\r\n\r\nLorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis illo possimus nesciunt, hic earum quae nostrum et, at quas quia velit aliquam reprehenderit cumque adipisci aut provident rerum dolorum odio.\r\n', '2024-09-17 04:42:11', 0),
(9, 'Naseer Totaki', 'admin22@gmail.com', 'Enter Level Job in Kardan Unversity', 'you@example.com\r\n\r\nyou@example.comyou@example.comyou@example.comyou@example.comyou@example.comyou@example.comyou@example.comyou@example.comyou@example.comyou@example.comyou@example.comyou@example.comyou@example.comyou@example.comyou@example.com', '2024-09-17 04:51:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) UNSIGNED NOT NULL,
  `log_type` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(6) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `author_name` varchar(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `category`, `tags`, `image`, `publish_date`, `author_name`, `created_at`) VALUES
(40, 'First Blog', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis quis consequuntur necessitatibus id, dolorem accusantium fuga dicta assumenda fugit blanditiis placeat ad ab, iusto repudiandae earum, impedit nihil quia quaerat explicabo laudantium nulla magni! Quod labore harum assumenda autem quam libero cumque omnis quidem? A eligendi rem consequuntur optio temporibus impedit voluptatibus aliquid distinctio esse nostrum. Explicabo esse, saepe, exercitationem unde omnis voluptatem eligendi molestias inventore quaerat accusantium sapiente, alias blanditiis! Incidunt, eius! Unde, ex tempore! Nesciunt nobis ex aspernatur maiores optio, accusamus deleniti? Molestias mollitia odio ab a illo modi adipisci, maxime non accusamus perferendis, unde explicabo laboriosam optio doloremque rem voluptates debitis! Cupiditate saepe quidem, quam architecto consequatur suscipit sequi, velit sunt debitis quod ipsum doloribus doloremque. Sapiente sint ipsa ut aspernatur, molestiae sequi inventore earum debitis hic? Error ipsum saepe sunt cupiditate magnam quaerat, autem recusandae amet aut? Voluptatum molestiae dignissimos eos? Ratione numquam culpa officia blanditiis nobis iusto esse nostrum sapiente vero reiciendis, dignissimos asperiores quas quibusdam temporibus provident quo voluptates omnis est reprehenderit? Repellat quam pariatur vero maiores sequi perspiciatis deserunt dolores blanditiis aut corporis excepturi saepe, quia eligendi fuga suscipit ex numquam, unde beatae est tempore eius et facilis quis voluptatum. Quas officiis, eos dignissimos at earum numquam perferendis ea eius nisi dolorem molestias blanditiis temporibus placeat optio magnam! Optio veniam, voluptas dolorum nulla commodi eveniet, deleniti cum quae fuga minus corrupti? Rem sed exercitationem deserunt eaque, ad est incidunt. Provident, commodi nesciunt possimus nisi nulla soluta odio dolorum velit ullam aperiam accusantium earum tempore cupiditate excepturi! Temporibus sapiente inventore quae autem soluta ducimus odio odit omnis ipsam corrupti magni iure aspernatur incidunt cupiditate quisquam non, possimus numquam velit suscipit magnam ex aliquam harum! Esse eveniet et odio laudantium dignissimos obcaecati quos voluptas veritatis eligendi, ab minus soluta nisi, veniam expedita rem unde eos asperiores ipsum, quasi ex? Amet, natus? Placeat, officiis tempora porro at fugiat neque repellat amet labore ducimus. Excepturi tempora consequuntur quam, nisi dolore ipsam voluptates. Accusamus delectus exercitationem maiores ratione mollitia a earum placeat perferendis quasi aut asperiores tempora natus, cumque quod ullam recusandae? Aperiam possimus quibusdam est nesciunt quam voluptates vel animi commodi nisi voluptatem. Maiores perferendis, omnis nostrum saepe sunt officia, tempora atque, fugit in assumenda commodi incidunt distinctio mollitia minus ipsa doloremque hic eos. Blanditiis pariatur deserunt delectus voluptate quo quis enim similique omnis iste illo soluta qui doloremque odit voluptates quia exercitationem, eligendi architecto! Porro, magnam.', 'Technology', 'blog', 'asdsn.png', '2024-09-16', 'Naseer', '2024-09-16 17:09:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` varchar(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `phone`, `role`, `address`, `gender`, `created_at`) VALUES
(1, 'ahmad', 'ahmad@gmail.com', '$2y$10$z7ENCIapFnS46tKNopi/heFGPWD.RUqT1RFr4JKCErGQtY0zE3p7y', '0702113190', 'admin', 'kabul', 'male', '2024-09-13 17:13:23'),
(10, 'jhan', 'jhan2@hdj.com', '$2y$10$mBuJO1DtP4Vc2NOr7LI6OeyWesS/ZJ55fZwSx6l.CEc498YhGhbkW', '1234567890', 'Srole', 'mazer', 'male', '2024-09-14 13:01:33'),
(15, 'demo', 'demo@demo.com', '$2y$10$M024gr5mGcnicP9et.Pieu8vPLEicc8tZAoWZ7N5bVA1u5a3dmqja', '0000000000', 'admin', 'demo', 'male', '2024-09-22 05:22:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_form_submissions`
--
ALTER TABLE `contact_form_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_form_submissions`
--
ALTER TABLE `contact_form_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
