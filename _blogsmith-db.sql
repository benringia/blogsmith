-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 17, 2021 at 12:09 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogsmith`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(6, 'PHP'),
(7, 'Java'),
(17, 'Category');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(19, 62, 'Gregg', 'arg@gmail.com', 'Nice Post!', 'Approved', '2021-05-16');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) DEFAULT NULL,
  `post_user` varchar(255) DEFAULT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL DEFAULT 0,
  `post_status` varchar(255) NOT NULL DEFAULT 'DRAFT',
  `post_view_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_view_count`) VALUES
(44, 6, 'Test01', NULL, 'ben', '2021-05-12', 'tree.jpeg', '<p>accacacacac</p>', 'asdasdas', 0, 'PUBLISHED', 18),
(45, 18, 'New post', NULL, 'newguy', '2021-05-12', 'house.jpeg', '<p>asdasdasdasd</p>', 'sadasda', 0, 'PUBLISHED', 2),
(48, 18, 'New post', NULL, 'newguy', '2021-05-12', 'house.jpeg', '<p>asdasdasdasd</p>', 'sadasda', 0, 'PUBLISHED', 0),
(49, 6, 'Test01', NULL, 'ben', '2021-05-12', 'tree.jpeg', '<p>accacacacac</p>', 'asdasdas', 0, 'PUBLISHED', 0),
(50, 6, 'Test01', NULL, 'ben', '2021-05-12', 'tree.jpeg', '<p>accacacacac</p>', 'asdasdas', 0, 'PUBLISHED', 0),
(51, 18, 'New post', NULL, 'newguy', '2021-05-12', 'house.jpeg', '<p>asdasdasdasd</p>', 'sadasda', 0, 'PUBLISHED', 0),
(52, 18, 'New post', NULL, 'newguy', '2021-05-12', 'house.jpeg', '<p>asdasdasdasd</p>', 'sadasda', 0, 'PUBLISHED', 0),
(53, 6, 'Test01', NULL, 'ben', '2021-05-12', 'tree.jpeg', '<p>accacacacac</p>', 'asdasdas', 0, 'DRAFT', 0),
(54, 6, 'Test01', NULL, 'ben', '2021-05-12', 'tree.jpeg', '<p>accacacacac</p>', 'asdasdas', 0, 'DRAFT', 0),
(55, 18, 'New post', NULL, 'newguy', '2021-05-12', 'house.jpeg', '<p>asdasdasdasd</p>', 'sadasda', 0, 'PUBLISHED', 0),
(56, 18, 'New post', NULL, 'newguy', '2021-05-12', 'house.jpeg', '<p>asdasdasdasd</p>', 'sadasda', 0, 'DRAFT', 1),
(57, 6, 'Test01', NULL, 'ben', '2021-05-12', 'tree.jpeg', '<p>accacacacac</p>', 'asdasdas', 0, 'DRAFT', 0),
(58, 6, 'Test01', NULL, 'ben', '2021-05-12', 'tree.jpeg', '<p>accacacacac</p>', 'asdasdas', 0, 'PUBLISHED', 0),
(59, 18, 'New post', NULL, 'newguy', '2021-05-12', 'house.jpeg', '<p>asdasdasdasd</p>', 'sadasda', 0, 'PUBLISHED', 0),
(62, 6, 'Escape Test1', NULL, 'newguy', '2021-05-13', 'house.jpeg', '<p>This is an example</p>', 'escape2', 0, 'PUBLISHED', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL DEFAULT '',
  `user_lastname` varchar(255) NOT NULL DEFAULT '',
  `user_email` varchar(255) NOT NULL,
  `user_image` text DEFAULT NULL,
  `user_role` varchar(255) NOT NULL DEFAULT 'subscriber',
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$VY3LJhnKS9iF9bSzN9qAWA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(23, 'ben', '$2y$10$iQQf3B4Akvxz.JNuoPdVGeTPlufPwHh6uPJmKHah43G.1PMmZGspW', 'benfirst', 'benlast', 'ben@gmaii.com', NULL, 'admin', '$2y$10$VY3LJhnKS9iF9bSzN9qAWA'),
(28, 'newguy', '$2y$10$W0087udZ.UCvm74tvC.RNOcJKZeEYGdsFo6EbRzquLwWGFZDSdYjS', 'New', 'Guy', 'newguy@gmail.com', NULL, 'admin', '$2y$10$VY3LJhnKS9iF9bSzN9qAWA'),
(29, 'benclauser', '$2y$10$vqomU7Txzwzk.eGP6hCqQu/yy8svlQABkTPmWBnJWVrV6YeFq6Dyi', 'Ben Clauser', 'Ringia', 'benringia@gmail.com', NULL, 'subscriber', '$2y$10$VY3LJhnKS9iF9bSzN9qAWA'),
(30, 'newguy1', '$2y$10$9j387srG8wiUs0t.cNWzvOuu978WqRG.QIuRsp7QVmx.O3VWmx3Gm', 'Admin2', 'New', 'newguys@gmail.com', NULL, 'admin', '$2y$10$VY3LJhnKS9iF9bSzN9qAWA');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(1, 'p80s2mjkjtavjon2dmkjmmuo2o', 1621220785),
(2, 'jbke9qj15vf484dqidrq601hfn', 1620642417),
(3, 'qcu4a0nrpbe6tb3jb1ngbktoip', 1621220654);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
