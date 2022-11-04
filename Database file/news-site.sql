-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2022 at 04:07 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news-site`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `post` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `post`) VALUES
(1, 'business', 3),
(2, 'entertainment', 2),
(3, 'sports', 3),
(4, 'politics', 2),
(5, 'ccccccc', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `post_date` varchar(50) DEFAULT NULL,
  `author` int(11) NOT NULL,
  `post_img` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES
(36, 'Business first post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '1', '03 Nov, 2022', 1, '1667511136-s1.jpg'),
(37, 'Business second post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '1', '03 Nov, 2022', 1, '1667511136-s1.jpg'),
(38, 'Entertainment first post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '2', '03 Nov, 2022', 2, '1667511136-s1.jpg'),
(39, 'Entertainment second post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '2', '03 Nov, 2022', 2, '1667511136-s1.jpg'),
(40, 'Sports first post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '3', '03 Nov, 2022', 3, '1667511136-s1.jpg'),
(41, 'Sports second post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '3', '03 Nov, 2022', 3, '1667511136-s1.jpg'),
(42, 'Politics first post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '4', '03 Nov, 2022', 4, '1667511136-s1.jpg'),
(43, 'Politics second post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '4', '03 Nov, 2022', 4, '1667511136-s1.jpg'),
(44, 'New post', '                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eos aut quis dolore, quaerat animi recusandae in consequuntur vel aliquid rerum vitae veniam unde corporis aspernatur, praesentium perferendis quae doloremque totam ea ut atque cumque! Odio cum labore fuga eum, quaerat consectetur eaque neque saepe, sapiente aliquid harum consequuntur tempore impedit ut quisquam magni dolor accusantium? Aperiam sit nesciunt perferendis neque tempora, deserunt tenetur a porro soluta enim molestias ab sint eum quas voluptatibus quasi? Fugit dolor incidunt iste veniam minus nemo! Error, aliquid nemo. Explicabo perferendis corrupti praesentium numquam non tempora magni nam, maxime quis dolorem ducimus eveniet facere excepturi aspernatur reiciendis atque ab quam odit est. In sint, quisquam magni nesciunt voluptatum fugit harum dicta corrupti exercitationem rem, animi similique quam ex labore perspiciatis vero? Quam deserunt, vero praesentium sed dolore blanditiis ullam aperiam porro. Enim rerum iste odit quas consequatur cumque nihil corporis. Totam quia quasi repellendus quibusdam nesciunt quidem beatae deleniti perferendis animi aliquam laudantium ullam eaque ad cum, quam eligendi repellat autem quas nisi sed velit distinctio illo pariatur asperiores! Nesciunt harum minima at alias ut explicabo sunt expedita voluptas fuga earum qui molestias, maiores, aliquam fugiat obcaecati incidunt suscipit nam perspiciatis aperiam nostrum eveniet hic odio totam quibusdam! Nemo, neque nisi tenetur in rem temporibus laudantium soluta natus possimus expedita vel dolorum provident laborum animi adipisci veniam corrupti unde quasi delectus iure iusto. Numquam, dicta amet, accusamus nihil iste fuga qui delectus perspiciatis similique cum mollitia eveniet vero accusantium molestiae blanditiis sint. Est ut aperiam, ducimus non temporibus consequuntur voluptates perspiciatis voluptate dolore fugit quidem asperiores maxime impedit repellendus deleniti officia porro unde! Maiores sint repudiandae non vel quibusdam, ipsum fugiat adipisci deleniti corporis delectus eaque exercitationem incidunt laborum molestias in provident autem quod consequuntur quia doloremque. Aliquam consequuntur itaque numquam at necessitatibus voluptates obcaecati.', '3', '03 Nov, 2022', 1, '1667511136-s1.jpg'),
(45, 'Football 2', 'ectetur eaque neque saepe, sapiente aliquid harum consequuntur tempore impedit ut quisquam magni dolor accusantium? Aperiam sit nesciunt perferendis neque tempora, deserunt tenetur a porro soluta enim molestias ab sint eum quas voluptatibus quasi? Fugit dolor incidunt iste veniam minus nemo! Error, aliquid nemo. Explicabo perferendis corrupti praesentium numquam non tempora magni nam, maxime quis dolorem ducimus eveniet facere excepturi aspernatur reiciendis atque ab quam odit est. In sint, quisquam magni nesciunt voluptatum fugit harum dicta corrupti exercitationem rem, animi similique quam ex labore perspiciatis vero? Quam deserunt, vero praesentium sed dolore blanditiis ullam aperiam porro. Enim rerum iste odit quas consequatur cumque nihil corporis. Totam quia quasi repellendus quibusdam nesciunt quidem beatae deleniti perferendis animi aliquam laudantium ullam eaque ad cum, quam eligendi repellat autem quas nisi sed velit distinctio illo pariatur asperiores! Nesciunt harum minima at alias ut explicabo sunt expedita voluptas fuga earum qui molestias, maiores, aliquam fugiat obcaecati incidunt suscipit nam perspiciatis aperiam nostrum eveniet hic o', '1', '03 Nov, 2022', 1, '1667511136-s1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `websiteName` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `footerDescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `websiteName`, `logo`, `footerDescription`) VALUES
(1, 'new-website', 'news.jpg', '© Copyright 2022 News | Powered by Umair');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `role` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `password`, `role`) VALUES
(1, 'Nathan', 'Drake', 'nathan', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 1),
(2, 'Luke', 'Dani', 'luke', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 0),
(3, 'Manni', 'Mouse', 'manni', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 1),
(4, 'Janne', 'Miinimaa', 'janne', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 0),
(5, 'user', 'admin', 'useradmin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 1),
(6, 'user', 'normal', 'usernormal', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD UNIQUE KEY `post_id` (`post_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
