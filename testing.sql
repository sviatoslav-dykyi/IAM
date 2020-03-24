-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 24 2020 г., 13:01
-- Версия сервера: 10.4.10-MariaDB
-- Версия PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testing`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users_management`
--

DROP TABLE IF EXISTS `users_management`;
CREATE TABLE IF NOT EXISTS `users_management` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `status` varchar(24) NOT NULL DEFAULT 'not-active',
  `role` varchar(24) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_management`
--

INSERT INTO `users_management` (`id_user`, `firstName`, `lastName`, `status`, `role`, `date`) VALUES
(50, 'Alex', 'Petrov', 'active', 'admin', '2020-03-24 13:00:39'),
(46, 'Sviatoslasv', 'Dykyi', 'active', 'admin', '2020-03-24 12:52:02'),
(47, 'Zahar', 'Berkut', 'not-active', 'user', '2020-03-24 12:52:14'),
(48, 'Jonhy', 'Glad', 'active', 'user', '2020-03-24 12:52:26'),
(49, 'Valeriy', 'Rozenbaum', 'not-active', 'user', '2020-03-24 13:00:24');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
