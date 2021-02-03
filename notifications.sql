-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 03, 2021 alle 09:08
-- Versione del server: 10.4.17-MariaDB
-- Versione PHP: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `consegnaf`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `template` varchar(150) DEFAULT NULL,
  `vars` text DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `state` int(11) DEFAULT 1,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `tracking_id` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `notifications`
--

INSERT INTO `notifications` (`id`, `template`, `vars`, `user_id`, `state`, `created`, `modified`, `tracking_id`) VALUES
(1, 'newBlog', '{\"username\":\"Bob Mulder\",\"name\":\"My great new blogpost\"}', 1, 0, '2021-02-02 16:55:21', '2021-02-02 18:00:44', '5'),
(2, 'newBlog', '{\"username\":\"Bob Mulder\",\"name\":\"My great new blogpost\"}', 2, 1, '2021-02-02 16:55:21', '2021-02-02 16:55:21', '5'),
(3, 'newBlog', '{\"username\":\"Bob Mulder\",\"name\":\"My great new blogpost\"}', 1, 1, '2021-02-02 16:57:16', '2021-02-02 16:57:16', '3FdFQfjOSB'),
(4, 'newBlog', '{\"username\":\"Bob Mulder\",\"name\":\"My great new blogpost\"}', 2, 1, '2021-02-02 16:57:16', '2021-02-02 16:57:16', '3FdFQfjOSB'),
(5, 'newBlog', '{\"username\":\"Bob Mulder\",\"name\":\"My great new blogpost\"}', 1, 1, '2021-02-02 16:59:35', '2021-02-02 16:59:35', 'ZdBLkJvA7S'),
(6, 'newBlog', '{\"username\":\"Bob Mulder\",\"name\":\"My great new blogpost\"}', 2, 1, '2021-02-02 16:59:35', '2021-02-02 16:59:35', 'ZdBLkJvA7S'),
(7, 'default', '[]', 1, 1, '2021-02-02 16:59:35', '2021-02-02 16:59:35', 'OengrWcjhY'),
(8, 'newBlog', '{\"username\":\"Bob Mulder\",\"name\":\"My great new blogpost\"}', 1, 1, '2021-02-02 17:01:57', '2021-02-02 17:01:57', 'M1KBWmm4db'),
(9, 'newBlog', '{\"username\":\"Bob Mulder\",\"name\":\"My great new blogpost\"}', 2, 1, '2021-02-02 17:01:57', '2021-02-02 17:01:57', 'M1KBWmm4db'),
(10, 'default', '[]', 1, 1, '2021-02-02 17:01:57', '2021-02-02 17:01:57', 'CxayAnYyyG'),
(11, 'newBlog', '{\"username\":\"Bob Mulder\",\"name\":\"My great new blogpost\"}', 1, 1, '2021-02-02 17:02:07', '2021-02-02 17:02:07', 'Zmquet9Ze2'),
(12, 'newBlog', '{\"username\":\"Bob Mulder\",\"name\":\"My great new blogpost\"}', 2, 1, '2021-02-02 17:02:07', '2021-02-02 17:02:07', 'Zmquet9Ze2'),
(13, 'default', '[]', 1, 1, '2021-02-02 17:02:07', '2021-02-02 17:02:07', 'OfPKhvUphq'),
(14, 'newBlog', '{\"username\":\"Bob Mulder\",\"name\":\"My great new blogpost\"}', 1, 1, '2021-02-02 17:02:19', '2021-02-02 17:02:19', 'obrDAiubN9'),
(15, 'newBlog', '{\"username\":\"Bob Mulder\",\"name\":\"My great new blogpost\"}', 2, 1, '2021-02-02 17:02:19', '2021-02-02 17:02:19', 'obrDAiubN9'),
(16, 'default', '[]', 1, 1, '2021-02-02 17:02:19', '2021-02-02 17:02:19', 'sxc9BkAqE2'),
(17, 'newBlog', '{\"username\":\"Bob Mulder\",\"name\":\"My great new blogpost\"}', 1, 1, '2021-02-02 17:04:04', '2021-02-02 17:04:04', 'arLYYxznFI'),
(18, 'newBlog', '{\"username\":\"Bob Mulder\",\"name\":\"My great new blogpost\"}', 2, 1, '2021-02-02 17:04:04', '2021-02-02 17:04:04', 'arLYYxznFI'),
(19, 'default', '[]', 1, 1, '2021-02-02 17:04:04', '2021-02-02 17:04:04', 'rLpNhUrWqw'),
(20, 'newBlog', '{\"username\":\"Bob Mulder\",\"name\":\"My great new blogpost\"}', 1, 1, '2021-02-02 17:17:03', '2021-02-02 17:17:03', '06W4w9ibFA'),
(21, 'newBlog', '{\"username\":\"Bob Mulder\",\"name\":\"My great new blogpost\"}', 2, 1, '2021-02-02 17:17:03', '2021-02-02 17:17:03', '06W4w9ibFA'),
(22, 'default', '[]', 1, 1, '2021-02-02 17:17:03', '2021-02-02 17:17:03', 'jFzvq1JHoZ'),
(23, 'newBlog', '{\"username\":\"Bob Mulder\",\"name\":\"My great new blogpost\"}', 1, 1, '2021-02-02 17:45:17', '2021-02-02 17:45:17', 'pGS3KZQMGr'),
(24, 'newBlog', '{\"username\":\"Bob Mulder\",\"name\":\"My great new blogpost\"}', 2, 1, '2021-02-02 17:45:17', '2021-02-02 17:45:17', 'pGS3KZQMGr'),
(25, 'default', '[]', 1, 1, '2021-02-02 17:45:17', '2021-02-02 17:45:17', 'LL9vHy9GGe');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
