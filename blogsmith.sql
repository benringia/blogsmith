-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 10, 2021 at 04:26 PM
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
(6, 'PHPs'),
(7, 'Java'),
(10, 'get'),
(16, 'example'),
(17, 'Category'),
(18, 'hello'),
(20, 'sharmen');

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
(10, 22, 'Third Example', 'Example@gmail.com', 'Test Comment', 'Approved', '2021-05-02'),
(13, 23, 'Commenter', 'comm@yahoo.com', 'Comment', 'Approved', '2021-05-03'),
(14, 22, 'Tinkles', 'tin@gmail.com', 'This is thinkes', 'Approved', '2021-05-06');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
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

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_view_count`) VALUES
(22, 6, 'Another Example Post', 'Tinkles', '2021-05-08', 'ocean.jpeg', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 'example', 5, 'PUBLISHED', 3),
(24, 6, 'Just Another Posts', 'Benny', '2021-05-08', 'tree.jpeg', '<p><i>This IS ANOTHER POST</i></p>', 'benben', 0, 'PUBLISHED', 0),
(25, 18, 'This Is another post', 'Hello', '2021-05-08', 'wood.jpeg', '<p>LOREM</p>', 'asdasd', 0, 'DRAFT', 0),
(26, 16, 'Another great post', 'Tinkles', '2021-05-09', 'tree.jpeg', '<p>asasdkakshdaskjdhaskjdahsdkjasdasd</p>', 'tree', 0, 'PUBLISHED', 0),
(27, 18, 'This Is another post', 'Hello', '2021-05-09', 'wood.jpeg', '<p>LOREM</p>', 'asdasd', 0, 'DRAFT', 0),
(28, 18, 'This Is another post', 'Hello', '2021-05-09', 'wood.jpeg', '<p>LOREM</p>', 'asdasd', 0, 'DRAFT', 0),
(29, 16, 'Another great post', 'Tinkles', '2021-05-09', 'tree.jpeg', '<p>asasdkakshdaskjdhaskjdahsdkjasdasd</p>', 'tree', 0, 'PUBLISHED', 0),
(30, 16, 'Another great post', 'Tinkles', '2021-05-09', 'tree.jpeg', '<p>asasdkakshdaskjdhaskjdahsdkjasdasd</p>', 'tree', 0, 'PUBLISHED', 0),
(31, 18, 'This Is another post', 'Hello', '2021-05-09', 'wood.jpeg', '<p>LOREM</p>', 'asdasd', 0, 'DRAFT', 1),
(32, 6, 'Just Another Posts', 'Benny', '2021-05-09', 'tree.jpeg', '<p><i>This IS ANOTHER POST</i></p>', 'benben', 0, 'PUBLISHED', 0),
(33, 6, 'Another Example Post', 'Tinkles', '2021-05-09', 'ocean.jpeg', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 'example', 0, 'PUBLISHED', 0),
(34, 16, 'Another great post', 'Tinkles', '2021-05-09', 'tree.jpeg', '<p>asasdkakshdaskjdhaskjdahsdkjasdasd</p>', 'tree', 0, 'PUBLISHED', 0),
(35, 16, 'Another great post', 'Tinkles', '2021-05-09', 'tree.jpeg', '<p>asasdkakshdaskjdhaskjdahsdkjasdasd</p>', 'tree', 0, 'PUBLISHED', 0),
(36, 18, 'This Is another post', 'Hello', '2021-05-09', 'wood.jpeg', '<p>LOREM</p>', 'asdasd', 0, 'DRAFT', 0),
(37, 18, 'This Is another post', 'Hello', '2021-05-09', 'wood.jpeg', '<p>LOREM</p>', 'asdasd', 0, 'DRAFT', 0),
(38, 16, 'Another great post', 'Tinkles', '2021-05-09', 'tree.jpeg', '<p>asasdkakshdaskjdhaskjdahsdkjasdasd</p>', 'tree', 0, 'PUBLISHED', 0),
(39, 18, 'This Is another post', 'Hello', '2021-05-09', 'wood.jpeg', '<p>LOREM</p>', 'asdasd', 0, 'DRAFT', 0),
(40, 6, 'Just Another Posts', 'Benny', '2021-05-09', 'tree.jpeg', '<p><i>This IS ANOTHER POST</i></p>', 'benben', 0, 'PUBLISHED', 0),
(41, 6, 'Another Example Post', 'Tinkles', '2021-05-09', 'ocean.jpeg', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 'example', 0, 'PUBLISHED', 0);

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
(13, 'newuser1', 'beniscure', 'newuser', 'newuser', 'newuser1@gmail.com', NULL, 'subscriber', '$2y$10$VY3LJhnKS9iF9bSzN9qAWA'),
(23, 'ben', '$2y$10$VY3LJhnKS9iF9bSzN9qAW.IX7RaPHyf/UCu//tpMQNMpYfqUhscp2', '', '', 'ben@gmaii.com', NULL, 'subscriber', '$2y$10$VY3LJhnKS9iF9bSzN9qAWA');

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
(1, 'p80s2mjkjtavjon2dmkjmmuo2o', 1620643546),
(2, 'jbke9qj15vf484dqidrq601hfn', 1620642417);

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
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
