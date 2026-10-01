-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2026 at 03:07 AM
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
-- Database: `tas_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee_tbl`
--

CREATE TABLE `employee_tbl` (
  `employee_id` int(11) NOT NULL,
  `employee_no` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `position_name` varchar(50) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_tbl`
--

INSERT INTO `employee_tbl` (`employee_id`, `employee_no`, `first_name`, `last_name`, `position_name`, `department_id`, `contact_number`, `email`, `photo`, `status`, `created_at`, `password`) VALUES
(4, '2012-0165', 'Carlo Magno Malvar', 'Castro', 'DEPARTMENT HEAD', 6, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:16', '$2y$10$x9DrhHPnBHo/NDHyCkSByu2mlj0H39c.S/BYiz/0CCyNh5m3OgM7q'),
(5, '2000-0109', 'Annalyn Jawili', 'Decena', 'DEPARTMENT HEAD', 9, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:16', '$2y$10$EUXciGttMySPWNAmo8tDbOK/D5IQY1ZPpg60MaEGMYob.0eTXvvl2'),
(6, '1994-0101', 'Hilarion Redugerio', 'Elegado', 'DEPARTMENT HEAD', 7, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:16', '$2y$10$jPiQcu31STt8dPLNAxelZOFnpizypDxG0Mw5cCd1LEIZQWOnB/Oou'),
(7, '2017-0283', 'Charissa May Regio', 'Fernandez', 'Instructor I', 9, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:16', '$2y$10$EVTsaWQrrgDjSRU1GLFKIOSs8CDMGc1Ith9N08qq2SGYr/Cfu/nRq'),
(8, '2011-0158', 'Wilmer II Lancion', 'Imperio', 'Assistant Professor III', 7, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:17', '$2y$10$7UvdwlZC06/pZ1AKP6.ioe508rh5PGr2PFw5byhU7W05NDc8ln5Oe'),
(9, '2018-0316', 'Loriebenn Bañez', 'Madriño', 'DEPARTMENT HEAD', 8, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:17', '$2y$10$rMJIufDS/YtS780SazDvcuYBOJZoNiOVeq6VVNPEgUtt4TBVHNTC2'),
(10, '2026-006', 'Jeanie May Pedrialva', 'Palatino', 'Instructor I', 6, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:17', '$2y$10$KJFSTZ4PVsL0TssQIxprruabfk3mHzDlXHDPVmKCNVpDsJhzjmbfG'),
(11, '2016-135', 'Ken Mark Marquez', 'Palatino', 'Instructor II', 7, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:17', '$2y$10$Q3WYdVPIE9dpIDyL4ehAWe5IB4Jwgm2Pjr1aupRdRS32TmRu1viIa'),
(12, '2022-0366', 'Gilbert Pilar', 'Privado', 'Instructor I', 7, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:17', '$2y$10$rsbEzWzpm4Wecq4jkZ4ShuF02TaEqpnNDyqtTIdh04soNc5XMlqaa'),
(13, '1993-0103', 'Joy Reyes', 'Profugo', 'Associate Professor V', 9, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:17', '$2y$10$mv0r7m1NRPRKv/xJ21ljIudOhhY7qemA6Or0WXTvwAzto1xoaxes.'),
(14, '2011-0169', 'Mergiecelyn Racelis', 'Quezada', 'Assistant Professor III', 9, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:17', '$2y$10$Wd5Z//EZe9zc/3YGZcqVLugSUGEgQbAHCAGJZRrVSHK2AFIDzRMAy'),
(15, '2013-0190', 'Glynis Karen Narido', 'Raza', 'Instructor III', 6, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:17', '$2y$10$j2IlM7egyksGawMm9Pk/.OuPq3p/Xi4jnp0dUFxZVZJknRTuOJp5K'),
(16, '2016-0212', 'Randell Rosales', 'Reginio', 'CAMPUS DIRECTOR', 8, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:17', '$2y$10$ihtJnHq0ypfmV.AHp8zFreP86UBpX0BAJbyNs/9JcPccYPY3gJ.3i'),
(17, '2017-0293', 'Jerome Jara', 'Revidizo', 'Instructor I', 9, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:18', '$2y$10$PWmlOTmZpAjnWnHmek5.XOZAC955zBd8qHwyGytCmMZfOEoSREKfS'),
(18, '1993-0105', 'Alfonso Quimora', 'Reynoso', 'Instructor II', 7, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:18', '$2y$10$hEP2DkOXqAOhZLJYBD0Q..bKBa9vu1.elGyyaAKIrIwU2olgae2K2'),
(19, '1995-0106', 'Jellian Torres', 'Ricafrente', 'Associate Professor II', 7, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:18', '$2y$10$Z1VocWWlF2qhMEoGzXOSPeOepy4FIyCsZfI.4Kulb5hCirwoowCXi'),
(20, '2023-0370', 'Jeremie Regencia', 'Robles', 'Instructor I', 8, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:18', '$2y$10$X5BI8cEJ2WE0iimGT72A.O1.3MfWzng5YN8phBqEZ4JS/N69A17Tu'),
(21, '2013-0187', 'Amelito Reforma', 'Zulueta', 'Assistant Professor II', 9, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:18', '$2y$10$4voEnvclPqGUuQaMmeROcem5HpGOqzb6rVXal/Xw311OOsoDza4ui'),
(22, 'CL2024-03', 'Jeimyleen Angeli Malinao', 'Cas', 'University Lecturer', 6, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:18', '$2y$10$PFU8YQXKf.zc6tgHEBp3J.SsogIfNRcGGlN0MQs6c7ypx/2wc2uw6'),
(23, 'UL2025-057', 'Alfred Delos Reyes', 'Flores', 'University Lecturer', 8, 'TBA', 'tba@marsu.edu.ph', 'emp_23_1780887032.jpg', 1, '2026-03-24 01:01:18', '$2y$10$1pGEqY/ut/im19X.miuDmeJR758n4V0.t/ZbtA13Cqx25hYSyDUtO'),
(24, 'CL2022-518', 'Lean Rivadeniera', 'Meña', 'University Lecturer', 6, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:18', '$2y$10$VRo6I/t2rE8qG1g7r2dQq.cgaEZrq0/M8iUE01998cGZzlSEuNeKu'),
(25, 'CL2023-649', 'Raphael Dale Revidizo', 'Ogbac', 'University Lecturer', 8, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:18', '$2y$10$DS1J9mcnmILtxP6edA2sQum5m2wWJ657qBtyuOk5Uopc0E.2Ug3zq'),
(26, 'CL2024-028', 'Arvin Cesar Rodelas', 'Pernia', 'University Lecturer', 8, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:18', '$2y$10$KakvIsF5Cfv7fswxPsC4e.qNtTRdow92SATfAbIAbkguY3xJtSf4S'),
(27, 'CL2024-093', 'Aldrin Reynoso', 'Rey', 'University Lecturer', 8, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:18', '$2y$10$1cNzJPVJLfn3/mPpAQWoZeyXgEy0iCzbRTx0/govRtxRy6bKJAoyS'),
(28, 'CL2023-607', 'Rechille Baron', 'Ricafrente', 'University Lecturer', 6, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:19', '$2y$10$lhOrLWoU2615lRWXDQdZoeINTyZE.T2q5cwbu0I0KdfX58jlabYdW'),
(29, '2022-0369', 'Marian Kristazel Grimaldo', 'Antolin', 'Librarian I', 10, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:19', '$2y$10$W7Sf2x9Q951N5EWKWufiiuMQJvdWBrNe6BNKYY31JB3L9JHUG693e'),
(30, '2017-0274', 'Mel Aileen Espinosa', 'Belarmino', 'Administrative Aide I', 10, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:19', '$2y$10$qS3Oqp8FIn9CYP6Go0/ECueIMXl8aYLW21znn4jug/ZCJWPvH48Sm'),
(31, '2024-030', 'Mheryl Angelaine Perilla', 'Esplana', 'Administrative Assistant II', 10, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:19', '$2y$10$WkmLVq0NpYhU2XWidKcqAeD.eaR3CMdiyre7gOB6UWWYxMxTyPb5O'),
(32, '2024-011', 'Jethro Landig', 'Magcamit', 'Administrative Officer I', 10, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:19', '$2y$10$NYSxVa7uKTf.51MsjkYrZefdfKNAdA.XDEUEOofRKXyhqOnKOf/ti'),
(33, '2024-043', 'Sanver Andrew Hernandez', 'Mapacpac', 'Administrative Assistant II', 10, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:19', '$2y$10$UTHb3yiEVO9iHCnV4L3ez.sd5iQ.fBilnVKaALokewkg/RdMsrew.'),
(34, '2024-050', 'Joefel Nabos', 'Pabeloña', 'Registrar I', 10, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:19', '$2y$10$I2bopnBKXRqdkH/6ANScHePMQwVHA9hLO5iMoADvtrxBmuQELK3Zy'),
(35, '2012-0177', 'Khristine Hardiniano', 'Palmiery', 'Administrative Officer V', 10, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:19', '$2y$10$/Ue2Hln8BvgEHtzJSuqc7OQRWd.Flpu2R6SjSMR04T5RtDU2AydfW'),
(36, '2026-002', 'Aira Mae Podaca', 'Perlada', 'Administrative Officer I', 10, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:19', '$2y$10$3xyI0nR1dTCx7GSdTJkt1u9t7/mcaKIAxxlLxLeHj2FRpJXX7/x7G'),
(37, '2024-032', 'Sharmaine Joyce De Mesa', 'Regio', 'Administrative Assistant III', 10, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:19', '$2y$10$2C4J.kdc3NOS7NDZrk8dAeEauuYcESw1lyocq6RsEg/RibbaLhUVW'),
(38, '2026-004', 'Jean Joan Paz', 'Revilla', 'Administrative Officer III', 10, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:20', '$2y$10$WM5lcj7xNVev/jfliWJBhu4zeVCvv4WzYf9wufzGKPckaSgYj0JWG'),
(39, '2026-007', 'Roland Hayzcel Profugo', 'Ricamata', 'Administrative Assistant II', 10, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:20', '$2y$10$n6hWWEmqRE4d.9YMc.2HJeTlxtvz1gYAINIUYkVcmyLd0/eK.9KgG'),
(40, 'SS2016-072', 'Ryan Estrella', 'Rius', 'Administrative Aide I (Casual)', 10, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:20', '$2y$10$GjPLBx3QJL.vR0qCp8ehU.UidyM/Iwi6yKRiKQRxQRjEuJB4GbtdW'),
(41, '2025-031', 'Neftali Regalado', 'Vasco', 'Administrative Aide VI', 10, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:20', '$2y$10$0PFu4pTrsY9IELKDoX/z3eLY76fQOcdnxYJ36i6.z/p.wzVaHKX/G'),
(42, 'SS2016-104', 'Randhel Bien Jamola', 'Constantino', 'Technical Staff (Support Staff - Job Order)', 10, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:20', '$2y$10$tXcQG0PewVzWecKvT.fcN.KCM3RExZb5GndMRB9J4vMD0mMO1pQg.'),
(43, 'SS2025-020', 'Venchito R.', 'De Galicia', 'Support Staff (Support Staff - Job Order)', 10, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:20', '$2y$10$OgmCnXlQLkDdAR3qISZjZ.QGnmmVnwvsk45jN4k6AIjfJirjyrFnK'),
(44, 'SS2026-005', 'Jhay Mark P.', 'Podaca', 'Utility (Support Staff - Job Order)', 10, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:20', '$2y$10$nnXeZAtozscUjBjBdRm6OugMQU1h/fanXUKPa5S8fQNLQn2aupoJS'),
(45, 'SS2026-006', 'John Hero P.', 'Puente', 'Electrician (Support Staff - Job Order)', 10, 'TBA', 'tba@marsu.edu.ph', NULL, 1, '2026-03-24 01:01:20', '$2y$10$L9jcuxgfAFYyeP4D1zEqUOQE4f3PphfsVht5iv8tYXS4NHtjHiRou');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `employee_no` (`employee_no`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  ADD CONSTRAINT `employee_tbl_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department_tbl` (`department_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
