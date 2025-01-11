-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 11, 2025 at 04:42 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webpage design project`
--

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

DROP TABLE IF EXISTS `credentials`;
CREATE TABLE IF NOT EXISTS `credentials` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `username` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` text NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs NOT NULL,
  `events` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`ID`, `username`, `first_name`, `last_name`, `email`, `password`, `events`) VALUES
(1, 'admin', 'Yamen', 'Bakerli', 'siencebro@gmail.com', 'roott', ''),
(2, 'psut', 'PSUT', '', 'info@psut.edu.jo', 'psut', ''),
(3, 'new_user', 'Ahmad', 'Rider', 'ahmadrider@gmail.com', 'rider', ''),
(4, 'fitness_coach', 'Draha', 'Columb', 'drahacolumn@fitness.com', 'root', '11,9'),
(5, 'no1investor', 'Dwain', 'Milana', 'dwainmilana@money.com', 'dwain', '');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) NOT NULL,
  `date` datetime NOT NULL,
  `place` varchar(1000) NOT NULL,
  `capacity` int NOT NULL,
  `description` varchar(6000) DEFAULT NULL,
  `current_cap` int NOT NULL,
  `img` varchar(5000) NOT NULL,
  `host_id` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `host_id` (`host_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`ID`, `name`, `date`, `place`, `capacity`, `description`, `current_cap`, `img`, `host_id`) VALUES
(1, 'Tech Talk: Future of AI', '2025-02-06 15:00:00', 'TechHub Auditorium, San Francisco', 150, 'Join us for an insightful discussion on the evolving world of artificial intelligence, its impact on industries, and its potential to reshape the future. Speakers include top AI researchers and entrepreneurs.', 0, 'uploads/artificial-intelligence-new-technology-science-futuristic-abstract-human-brain-ai-technology-cpu-central-processor-unit-chipset-big-data-machine-learning-cyber-mind-domination-generative-ai-39830909.jpg', 2),
(7, 'Coding Bootcamp for Beginners', '2025-02-11 10:00:00', 'Startup Co-Working Space, New York City', 50, 'Learn the basics of programming in this hands-on bootcamp. Perfect for anyone looking to kickstart their coding journey, with guidance from experienced instructors.', 0, 'uploads/working-on-laptop-at-office-workspace-798927273.jpg', 2),
(8, 'Art in the Park', '2025-03-15 13:25:00', 'Central Park, New York City', 75, 'Experience a day of creativity and relaxation as artists of all levels come together to paint, draw, and share their passion for art. Materials provided!', 75, 'uploads/artists-setting-up-their-easels-capture-essence-park_1057859-4915-1112434986.jpg', 2),
(9, 'Music Under the Stars', '2025-04-10 07:00:00', 'Open Air Amphitheater, Austin', 200, 'Unwind with live music from local bands in a magical outdoor setting. Bring your friends, enjoy the atmosphere, and create unforgettable memories.\r\n', 1, 'uploads/pexels-photo-3563172-1417676184.jpeg', 3),
(10, 'Fitness Challenge: Run for Health', '2025-12-01 00:00:00', 'City Park Trail, Seattle', 300, 'Lace up your sneakers and join us for a 5K run/walk to promote health and wellness. Suitable for all fitness levels, with prizes for top finishers.', 150, 'uploads/spa-running-fest-credit-aaron-brewer-64d25923af2e3-657416669.jpg', 4),
(11, 'Startup Pitch Night', '2024-06-25 18:00:00', 'Innovation Center, Boston', 100, 'Watch as budding entrepreneurs present their groundbreaking ideas to a panel of investors and industry leaders. A great networking opportunity for anyone interested in startups.', 100, 'uploads/Presenters-Right-1706361763.jpg', 5),
(12, 'test event', '2025-01-24 19:16:00', 'test location', 200, 'test desc', 0, 'uploads/Captura de pantalla 2025-01-04 171756.png', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`host_id`) REFERENCES `credentials` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
