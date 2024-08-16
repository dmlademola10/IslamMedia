-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2021 at 09:45 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `islammedia_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(40) NOT NULL,
  `userImg` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `passWord` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `surName` varchar(255) NOT NULL,
  `otherName` varchar(255) NOT NULL,
  `gender` varchar(40) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephoneNumber` text NOT NULL,
  `maritalStatus` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `placeOfWork` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `lifeMoments` text NOT NULL,
  `dateJoined` date NOT NULL DEFAULT current_timestamp(),
  `userType` varchar(255) NOT NULL DEFAULT 'user',
  `mailVerified` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userImg`, `userName`, `passWord`, `firstName`, `surName`, `otherName`, `gender`, `dateOfBirth`, `email`, `telephoneNumber`, `maritalStatus`, `occupation`, `placeOfWork`, `location`, `hobbies`, `about`, `lifeMoments`, `dateJoined`, `userType`, `mailVerified`) VALUES
(1, '', 'dml_ademola', '$2y$10$otwpAdWscr9B12P0OwUOF.S8jitS83.pME7az2KHzlHHiaF33JRPO', 'Abdul Raheem', 'Ademola', '', 'm', '2005-03-27', '', '08126485978', '', '', '', '', '', '', '', '2021-11-05', 'super_admin', ''),
(2, '', 'drowsyman', '$2y$10$pz.HIP5ROn5ORskOG66UOeHXl73uMKzkcKO956vxTLO9p8OqVY6Q6', 'Abdul Raheem', 'Ademola', '', 'm', '2005-03-27', '', '08126485978', '', '', '', '', '', '', '', '2021-11-06', 'user', ''),
(3, '', 'testman10', '$2y$10$APprTR6AOJTW5BFotYjGWeEE1zK1ktZCJ6xVeC7ebHo4x5oXeikIm', 'Test', 'Man', '', 'm', '2005-03-27', '', '08126485978', '', '', '', '', '', '', '', '2021-11-06', 'user', ''),
(4, '', 'hahaha', '$2y$10$VIZZviFRw71g9p.RY4ITHuyDaRtEhm8CUTbZMFgA81X7m/fn1DL1e', 'Test', 'Man', '', 'm', '2005-03-27', '', '08126485978', '', '', '', '', '', '', '', '2021-11-06', 'user', ''),
(5, '', 'nonono', '$2y$10$epNmFesNZh2cmngoL.8qmO1QbqwxQbURHdGfWcbO5OymaPaYqiKJW', 'Test', 'Man', '', 'm', '2005-03-27', '', '08126485978', '', '', '', '', '', '', '', '2021-11-06', 'user', ''),
(6, '', 'nononof', '$2y$10$DdZbjjGWw8xNUJe5nUBOJ.WTXVitJh/RRq/kIcnPitGAlyGrUKN4i', 'Test', 'Man', '', 'm', '2005-03-27', '', '08126485978', '', '', '', '', '', '', '', '2021-11-06', 'user', ''),
(7, '', 'nononofg', '$2y$10$7bHmW9XQsdUZ2D1Q.BPZvOsZYIaazqL.00A9JVCQ3G0X14THzITfe', 'Test', 'Man', '', 'm', '2005-03-27', '', '08126485978', '', '', '', '', '', '', '', '2021-11-06', 'user', ''),
(8, '', 'nononofgi', '$2y$10$838ppwHYd37oxIfL3Cg9ZeoSdbrk251vf/nTLnVyaufZ.pTdOcgEu', 'Test', 'Man', '', 'm', '2005-03-27', '', '08126485978', '', '', '', '', '', '', '', '2021-11-06', 'user', ''),
(9, '', 'nononofgik', '$2y$10$iGkp5lJ552W2ey0o4TNTP.XyIUoB2kpF1KaBC66yj0MVnvBSbHTnC', 'Test', 'Man', '', 'm', '2005-03-27', '', '08126485978', '', '', '', '', '', '', '', '2021-11-06', 'user', ''),
(10, '', 'john_doe', '$2y$10$tfb3TOiU1JuvFyDJKlOk..dJE7/fMomeSU9PzWFI7L2xMUvPMKiWu', 'John', 'Doe', '', 'm', '2008-05-12', '', '090267800890', '', '', '', '', '', '', '', '2021-11-06', 'user', ''),
(11, '', 'drowsyman2', '$2y$10$XpL7DtjgyT.9TeQb0xtUUOptH95g0j9fdZG0eU9uO9u.cgOm2w75K', 'John', 'Doe', '', 'm', '2009-09-03', '', '09090809899887', '', '', '', '', '', '', '', '2021-11-06', 'user', ''),
(12, '', 'abuduh', '$2y$10$RY2Qdn4bCoJSfw9C//69D.AJjmjIi2tra9E6bBqJIdxzs8/lzloL6', 'Abudu', 'Abudukeji', '', 'm', '2020-03-27', '', '09090890898', '', '', '', '', '', '', '', '2021-11-06', 'user', ''),
(13, '', 'dml_ademola78', '$2y$10$VbknbhborvAjhvmLnO6H3OcvOGWhm1TLtbbrVposcmkLXHsjHsw9S', 'John', 'Doe', '', 'm', '2008-05-12', '', '090267800890', '', '', '', '', '', '', '', '2021-11-09', 'user', ''),
(14, '', 'httplosignupphp', '$2y$10$75fDZ9IdRYWlFLcERa89x.iLjWbEO/U8rmTp3d01vyndVkk9h3dRi', 'John', 'Doe', '', 'r', '2008-05-12', '', '090267800890', '', '', '', '', '', '', '', '2021-11-09', 'user', ''),
(15, '', 'titilayokafura', '$2y$10$Ffe.qbPMg1x00kxbk25bduNrQZk.PRfaSPuoCgw7s9YSScySth7tm', 'Titilayo', 'Kafura', '', 'm', '2005-03-27', '', '08130081393', '', '', '', '', '', '', '', '2021-11-09', 'user', ''),
(16, '', 'titilayokafura10', '$2y$10$8hvuRvwRcPLsnAiOWi0Dp.2d38vThT8D08oEXktG.x6if47GDgm2e', 'Titilayo', 'Kafura', '', 'm', '2005-03-27', '', '08130081393', '', '', '', '', '', '', '', '2021-11-09', 'user', ''),
(17, '', 'titilayokafura20', '$2y$10$EQ1zkDT5ryKkpZjHMUEiQe/q2orj8O/dlT/1c1S8S3e3UxNFtgJtS', 'Titilayo', 'Kafura', '', 'm', '2005-03-27', '', '08130081393', '', '', '', '', '', '', '', '2021-11-09', 'user', ''),
(18, '', 'humanbeing', '$2y$10$YFF6jsj.UT4x6.nISVzQoefJgiZHy1kWPdWwEWZj85s/yBHi6PpBW', 'Testing', 'Database', '', 'm', '2020-05-23', '', '090267800890', '', '', '', '', '', '', '', '2021-11-09', 'user', ''),
(19, '', 'motherfucker', '$2y$10$5ZGwsbGchp4xbaCKCjuRpOlpx7Bg0MQavxUMHAalg.Cx6dlbstr8G', 'Imaginary', 'Motherfucker', '', 'r', '2008-09-22', '', '0988302983', '', '', '', '', '', '', '', '2021-11-10', 'user', ''),
(20, '', 'idiot', '$2y$10$2Ok99ql87kxB2KN7bdz/I.rpUJ0fO38ZeIJaoAVmeXL2eQUWgA82y', 'Another', 'Idiot', '', 'm', '2005-01-30', '', '09300339909', '', '', '', '', '', '', '', '2021-11-10', 'user', ''),
(21, '', 'new_user', '$2y$10$5D2jIfTzvN3bZ6IXz11/cui2Wic3ZChf34z9sFhFumzhC/Y6is6S.', 'New', 'User', '', 'm', '2008-05-12', '', '090267800890', '', '', '', '', '', '', '', '2021-11-10', 'user', ''),
(22, '', 'human_being', '$2y$10$wI6u1NowtXDJQP1Wj07lcuNdU50G6JXek5haLgzvX9W4CCWREmRHW', 'Human', 'Being', '', 'm', '1999-08-26', '', '090267800890', '', '', '', '', '', '', '', '2021-11-10', 'user', ''),
(23, '', 'anonymous', '$2y$10$KYN48T.5S4KcMgqFXoBPK.sbBfrBPEgvDmmK4C147Muwplsnmr/py', 'Anonymous', 'User', '', 'r', '1990-01-01', '', '091000000000', '', '', '', '', '', '', '', '2021-11-10', 'user', ''),
(24, '', 'islammedia', '$2y$10$T3L8E9GnvzzgeG8tzdHH1OUiFAmphlh2.pf7Kktvv0kxOA5Owsqne', 'IslamMedia', 'User', '', 'm', '2000-01-01', '', '090267800890', '', '', '', '', '', '', '', '2021-11-10', 'user', ''),
(25, '', 'buhari', '$2y$10$ZDl0UYmD7R2AXDugApuMIOBX2ZsGHrhiZMU8VJc26lWYbEG26uoUy', 'Buhari', 'Omo Musa', '', 'm', '1985-03-12', '', '09876542234', '', '', '', '', '', '', '', '2021-11-10', 'user', ''),
(26, '', 'muhammadu', '$2y$10$Fks3MD3G8iGp0p97/fH0XOuzA4Rty1iFaPRF2sAHHoFzjltUbs73G', 'Muhammadu', 'Buhari', '', 'm', '2003-04-12', '', '09090399039', '', '', '', '', '', '', '', '2021-11-10', 'user', ''),
(27, '', 'titilayokafura50', '$2y$10$iFUu8if28Gpn2BzpAEe4CuKzmOyWfCFDW.kSQEVKr5xWIhM22vbTK', 'Titilayo', 'Kafura', '', 'f', '2005-03-07', '', '08130081393', '', '', '', '', '', '', '', '2021-11-15', 'user', ''),
(28, '', 'aaaaaa', '$2y$10$PhzODjFfRUN3wpPkiYOdKehX52v/gyH47mgvmBzUURDhiUZyLNWD2', 'yuiopoiuyt', 'ytyyuiuopiuy', '', 'm', '2007-10-10', '', '0987656789', '', '', '', '', '', '', '', '2021-11-15', 'user', ''),
(29, '', 'hacker', '$2y$10$rRYfpe79dxgPc/QXWVA5p.CZ.FS2k/q3iQg13NY1s6D.fi2D1K4Na', 'Another', 'Hacker', '', 'm', '2006-01-01', '', '09876543', '', '', '', '', '', '', '', '2021-11-15', 'user', ''),
(30, '', 'emmanuel', '$2y$10$udY5pA9d.QbOzVwFS5yGR.CJq3D.Y.JTl9CUPfZ0J7tdtw7WGMUJW', 'Emmanuel', 'Adebayo', '', 'm', '2006-08-12', '', '098765439854', '', '', '', '', '', '', '', '2021-11-16', 'user', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
