-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 25, 2020 at 04:07 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zadarma`
--

-- --------------------------------------------------------

--
-- Table structure for table `phonebook`
--

CREATE TABLE `phonebook` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(320) NOT NULL,
  `src-photo` varchar(500) NOT NULL,
  `id-user` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phonebook`
--

INSERT INTO `phonebook` (`id`, `firstname`, `lastname`, `phone`, `email`, `src-photo`, `id-user`) VALUES
(1, 'Vladimir', 'Podyapolskiy', '79124558425', 'vladimir.brolib@gmail.com', '/uploads/face.png', 10),
(2, 'Artem', 'Sidorov', '79123230312', 'test@test.com', '/uploads/face.png', 10),
(4, 'fsafsa', 'fsfs', '42421', 'vovansi@ya.ru', '/uploads/0415a210724cc31a0da5973a37ef2d0ac21ffe54.png', 13),
(5, 'Test', 'Petr', '323232', 'vovansi@ya.ru', '/uploads/0415a210724cc31a0da5973a37ef2d0ac21ffe54.png', 13),
(6, '<input>', 'Petr', '323232', 'vovansi@ya.ru', '/uploads/a497a05da0e87ece591eac46c01eff1640384277.jpg', 13),
(7, 'fsafsa', 'fsafas', '241421', 'fasfsafs@fsfsa.com', '/uploads/face.png', 13),
(8, 'Test', 'fs', '2442', 'vovansi@ya.ru', '/uploads/a497a05da0e87ece591eac46c01eff1640384277.jpg', 13),
(9, 'ÐŸÑ€Ð¸Ð²ÐµÑ‚', 'ÐšÐ°Ðº Ð´ÐµÐ»Ð° ==)', '242442', 'vovansi@ya.ru', '/uploads/0415a210724cc31a0da5973a37ef2d0ac21ffe54.png', 13),
(10, 'Test', 'Podyapolskiy', '79123', 'vovansi@ya.ru', '/uploads/a497a05da0e87ece591eac46c01eff1640384277.jpg', 13),
(11, 'Test', 'Podyapolskiy', '434343', 'vovansi@ya.ru', '/uploads/face.png', 13),
(12, 'Test', 'Test', '7777', 'vovansi@ya.ru', '/uploads/face.png', 13),
(13, 'Test', 'Test', '2332', 'vcxvds@aasf.ru', '/uploads/face.png', 13),
(14, 'Test', 'test', '21125', 'vvds@ya.ru', '/uploads/0415a210724cc31a0da5973a37ef2d0ac21ffe54.png', 13),
(15, 'Test', 'sf', '3124', 'fdsdf@ya.ru', '/uploads/face.png', 13),
(16, 'Test', 'fsd', '214', '421@fsd.com', '/uploads/face.png', 13),
(17, 'sf', 'fsa', '24421', 'fsdf@fsad.com', '/uploads/face.png', 13),
(18, 'Test', 'rs', '241421', 'fdsfds@fds.com', '/uploads/face.png', 13),
(19, 'Test', 'rs', '241421', 'fdsfds@fds.com', '/uploads/face.png', 13),
(20, 'Test', 'Test', '2323', 'vovansi@ya.ru', '/uploads/face.png', 13),
(21, 'Test', 'Test', '2323', 'vovansi@ya.ru', '/uploads/face.png', 13),
(26, 'Test', 'Podyapolskiy', '4242', 'vovansi@ya.ru', '/uploads/0415a210724cc31a0da5973a37ef2d0ac21ffe54.png', 13),
(27, 'Test', 'gfh', '756765', 'hhfd@gdsgds.com', '/uploads/818649ef341ed9a797389f32dea51097d875c8fa.jpg', 13),
(28, 'fsa', 'fsa', '421', 'fds@fsda.com', '/uploads/0415a210724cc31a0da5973a37ef2d0ac21ffe54.png', 13),
(29, 'TE', 'fds', '43243', 'fsdfa@fd.com', '/uploads/0415a210724cc31a0da5973a37ef2d0ac21ffe54.png', 13),
(30, 'tt', 'tt', '432432', 'fasfs@fs.com', '/uploads/a497a05da0e87ece591eac46c01eff1640384277.jpg', 13);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(32) NOT NULL,
  `id-user` int(11) UNSIGNED NOT NULL,
  `datetime-created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `id-user`, `datetime-created`, `ip`) VALUES
('562fee6de43b06fc8f4cc073223d79c1', 13, '2020-08-21 10:33:55', '::1'),
('6d1ce9b68154dd1f9fa5b2ea035b16bf', 10, '2020-08-20 08:59:07', '::1'),
('6f7d9fe865cc0c524b42873bf685a5dd', 10, '2020-08-20 11:58:07', '::1'),
('bf11583e3f9c29edd229496176689afe', 13, '2020-08-25 10:45:03', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(16) CHARACTER SET utf8 NOT NULL,
  `pass` varchar(32) CHARACTER SET utf8 NOT NULL,
  `email` varchar(320) CHARACTER SET utf8 NOT NULL,
  `datetime-created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `email`, `datetime-created`) VALUES
(10, 'user', 'e5d9dee0892c9f474a174d3bfffb7810', 'vladimir.brolib@gmail.com', '2020-08-20 08:58:51'),
(11, 'admin', 'e5d9dee0892c9f474a174d3bfffb7810', 'test@gmail.com', '2020-08-20 11:57:10'),
(12, 'admin2', 'e5d9dee0892c9f474a174d3bfffb7810', 'test2@gmail.com', '2020-08-20 11:57:53'),
(13, 'superadmin', '3e9cbf7d6829545e1a93bf4cc72f6623', 'vovansi@ya.ru', '2020-08-21 08:15:47'),
(14, 'superadmin1', '80e631b50095ea4e542a3e64ab549f3c', 'vovansi1@ya.ru', '2020-08-21 08:44:49'),
(15, 'superadmin22', '9b70d6dbfb1457d05e4e2c2fbb42d7db', 'vovansi22@ya.ru', '2020-08-21 08:47:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `phonebook`
--
ALTER TABLE `phonebook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id-user` (`id-user`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id-user` (`id-user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_auth` (`login`,`pass`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `phonebook`
--
ALTER TABLE `phonebook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `phonebook`
--
ALTER TABLE `phonebook`
  ADD CONSTRAINT `phonebook_ibfk_1` FOREIGN KEY (`id-user`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`id-user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
