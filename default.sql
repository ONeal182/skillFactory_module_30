-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 192.168.31.94:3306
-- Время создания: Дек 19 2021 г., 14:55
-- Версия сервера: 5.7.22-log
-- Версия PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `default`
--

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text,
  `file` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`id`, `user_id`, `name`, `comment`, `file`, `created_at`, `update_at`) VALUES
(12, 5, 'ONeal', '', 'uploads/acl1bblsb2hw8uqtc0auzuzjdm3f1ew9.jpg', '2021-12-19 14:17:36', NULL),
(13, 5, 'ONeal', '', 'uploads/ (1).jpg', '2021-12-19 14:20:03', NULL),
(14, 5, 'ONeal', '', 'uploads/ (1).jpeg', '2021-12-19 14:20:08', NULL),
(15, 5, 'ONeal', 'das', 'uploads/ (1).jpg', '2021-12-19 14:28:50', NULL),
(16, 5, 'ONeal', 'das', 'uploads/ (1).jpeg', '2021-12-19 14:34:40', NULL),
(17, 5, 'ONeal', 'dasdas', 'uploads/ (1).jpeg', '2021-12-19 14:34:52', NULL),
(18, 5, 'ONeal', 'fdsfsd', 'uploads/_Ð§Ñ‚Ð¾__Ð“Ð´Ðµ__ÐšÐ¾Ð³Ð´Ð°__2013.jpg', '2021-12-19 14:35:13', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_hash` varchar(500) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_hash`, `created_at`, `updated_at`) VALUES
(5, 'ONeal', 'kigat63@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$VmJ6SlgxOEhtRFVKNXdXSg$mz1jwgG/5p/bLIPqnz7H3C8Tz0TuISqJJqQ4ebm1PtA', 'dd6769ee1effa5d6de70e0a40868854d', '2021-12-19 11:54:15', '2021-12-19 14:52:56');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `email_unique` (`email`) USING BTREE;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
