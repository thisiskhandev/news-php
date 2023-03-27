-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2023 at 10:51 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(30) NOT NULL,
  `post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `post`) VALUES
(3, 'HTML', 4),
(7, 'TB', 1),
(8, 'TV', 0),
(9, 'Pickaju', 1),
(10, 'Asj', 0),
(11, 'abc', 0),
(12, '112', 0),
(13, 'adf', 0),
(14, 'Gala', 1),
(15, 'Tomato', 1),
(16, 'Orange', 1),
(17, 'Banana', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `category` int(11) NOT NULL,
  `post_date` varchar(50) NOT NULL,
  `author` int(11) NOT NULL,
  `post_img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES
(8, 'Adil', 'ABC 123', 1, '13 Mar, 2023', 13, 'play-icon-manager-revamp.png'),
(9, 'Ullam optio excepte', 'Deleniti animi saep', 3, '21 Mar, 2023', 13, '314-600x600.jpg'),
(15, 'Veniam deleniti ver', 'Magnam aute voluptas', 9, '21 Mar, 2023', 13, '85-600x600.jpg'),
(16, 'Sint dolore cumque e', 'Velit laboriosam es', 7, '21 Mar, 2023', 14, '513-600x600.jpg'),
(17, 'Vel esse elit et n', 'Deserunt neque tempo', 16, '21 Mar, 2023', 14, '352-600x600.jpg'),
(19, 'Fahad Tittle', 'Description testing', 17, '22 Mar, 2023', 13, 'PSW-TR1-2028-1S-I (1).png'),
(20, 'Testing', 'Testing desc', 3, '22 Mar, 2023', 13, 'play-icon-manager-revamp.png'),
(21, 'Testing 123', 'lkadsjflaksdfjlkasjfd', 3, '22 Mar, 2023', 13, 'call-icon-today.png'),
(22, 'ABCD id 3', 'laskdjfalsk;dfja;lsdfh', 3, '22 Mar, 2023', 13, 'lets-talk-circle.png'),
(23, 'So slow', 'description testing', 14, '22 Mar, 2023', 13, 'exist-pages-hutterstock_2175167713.jpg'),
(24, 'Top secret brook heaven RP', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 15, '27 Mar, 2023', 21, 'top secret in brook haven.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `username`, `password`, `role`) VALUES
(7, 'Yardley Atkinson', 'India Leach', 'Do quod tempora ex u', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1),
(8, 'Daquan Shepard', 'Allistair Mann', 'Beatae ut rerum omni', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0),
(9, 'Paul Sims', 'Tashya Galloway', 'Exercitation volupta', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0),
(10, 'Garrett Robertson', 'Bernard Bird', 'Rerum quia quis moll', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0),
(11, 'Devin English', 'Anastasia Baxter', 'Molestiae voluptatem', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1),
(12, 'Aspen Conley', 'Amal Salazar', 'Sint dolorum eu mole', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1),
(13, 'Hassan', 'Khan', 'hassan', '21232f297a57a5a743894a0e4a801fc3', 1),
(14, 'Salman', 'Sheikh', 'sallu', '21232f297a57a5a743894a0e4a801fc3', 0),
(16, 'Xyla Thornton', 'Casey Frederick', 'Quasi alias ullamco ', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0),
(17, 'Abdul', 'Hadi', 'pandey', '21232f297a57a5a743894a0e4a801fc3', 1),
(18, 'Wallace Pope', 'Dawn Walton', 'Omnis sequi est exc', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0),
(19, 'Ali', 'Bugti', 'ali', '21232f297a57a5a743894a0e4a801fc3', 1),
(20, 'Fahad', 'Ghaffar', 'fahad', '21232f297a57a5a743894a0e4a801fc3', 0),
(21, 'Abdul Hadi', 'Khan', 'hadi', '21232f297a57a5a743894a0e4a801fc3', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
