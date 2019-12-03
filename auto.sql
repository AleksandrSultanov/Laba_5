-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 03 2019 г., 10:11
-- Версия сервера: 10.3.16-MariaDB
-- Версия PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `auto`
--

-- --------------------------------------------------------

--
-- Структура таблицы `car`
--

CREATE TABLE `car` (
  `id_car` int(11) UNSIGNED NOT NULL,
  `mark` varchar(32) NOT NULL,
  `model` varchar(32) NOT NULL,
  `production_year` year(4) NOT NULL,
  `cost` bigint(32) NOT NULL,
  `mileage` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='object_car';

--
-- Дамп данных таблицы `car`
--

INSERT INTO `car` (`id_car`, `mark`, `model`, `production_year`, `cost`, `mileage`, `file_path`) VALUES
(37, 'Tesla', 'Model_3', 2019, 3000000, 70, 'user_file/Afavicon (1).png'),
(40, 'Lada', 'Granta', 2016, 300000, 57000, 'user_file/Camry_1.png'),
(49, 'Tesla', 'Roadster', 2019, 10000000, 90, 'user_file/lada.jpg'),
(50, 'VW', 'Polo', 2018, 800000, 345, 'user_file/renault.jpg'),
(53, 'Toyota', 'Camry', 2016, 1700000, 110000, 'user_file/nissan.jpg'),
(58, 'Tesla', 'polo', 2000, 500000, 2000, 'user_file/Afavicon (3).png');

-- --------------------------------------------------------

--
-- Структура таблицы `relation`
--

CREATE TABLE `relation` (
  `id` int(11) NOT NULL,
  `id_salon` int(11) NOT NULL,
  `id_car` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `relation`
--

INSERT INTO `relation` (`id`, `id_salon`, `id_car`) VALUES
(9, 1, 37),
(12, 2, 40),
(22, 1, 49),
(23, 3, 50),
(26, 54, 53),
(31, 1, 58);

-- --------------------------------------------------------

--
-- Структура таблицы `salon`
--

CREATE TABLE `salon` (
  `id_salon` int(11) NOT NULL,
  `mark` varchar(32) NOT NULL,
  `number` varchar(16) NOT NULL,
  `email` varchar(64) NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `salon`
--

INSERT INTO `salon` (`id_salon`, `mark`, `number`, `email`, `file_path`) VALUES
(1, 'Tesla', '+79044248020', 'email@gmail.como', 'user_file/Afavicon.png'),
(2, 'Lada', '+79370815100', 'lada@ya.ru', 'user_file/Afavicon_1.png'),
(3, 'VW', '+79370815122', 'alexul603@gmail.com', 'user_file/creta.png'),
(54, 'Toyota', '+79370815000', 'alexul603@gmail.ru', 'user_file/kia.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `secret_information`
--

CREATE TABLE `secret_information` (
  `id` int(11) NOT NULL,
  `email` varchar(20) DEFAULT NULL,
  `number` bigint(11) NOT NULL DEFAULT 0,
  `phone` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `secret_information`
--

INSERT INTO `secret_information` (`id`, `email`, `number`, `phone`) VALUES
(0, 'alexul603@gmail.com', 89044248029, 'OnePlus 6'),
(1, 'alrez@mail.com', 89044248037, 'XIAOMI Mi A1');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id_car`),
  ADD UNIQUE KEY `id` (`id_car`);

--
-- Индексы таблицы `relation`
--
ALTER TABLE `relation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `salon`
--
ALTER TABLE `salon`
  ADD PRIMARY KEY (`id_salon`),
  ADD UNIQUE KEY `id_salon` (`id_salon`);

--
-- Индексы таблицы `secret_information`
--
ALTER TABLE `secret_information`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `car`
--
ALTER TABLE `car`
  MODIFY `id_car` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT для таблицы `relation`
--
ALTER TABLE `relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `salon`
--
ALTER TABLE `salon`
  MODIFY `id_salon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
