-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15-Abr-2019 às 15:36
-- Versão do servidor: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `systeminfotest`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `userpcinfo`
--

CREATE TABLE `userpcinfo` (
  `id` int(11) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `emailCorporativo` varchar(255) NOT NULL,
  `patrimonio` varchar(6) NOT NULL,
  `loginRede` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `system` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `cpu` varchar(255) NOT NULL,
  `serialnumber` varchar(255) NOT NULL,
  `os` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userpcinfo`
--
ALTER TABLE `userpcinfo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `userpcinfo`
--
ALTER TABLE `userpcinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
