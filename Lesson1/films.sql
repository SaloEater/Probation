-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 01 2018 г., 15:22
-- Версия сервера: 5.6.41
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `films`
--

-- --------------------------------------------------------

--
-- Структура таблицы `films-genres`
--

CREATE TABLE `films-genres` (
  `title` int(11) NOT NULL,
  `genre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `films-genres`
--

INSERT INTO `films-genres` (`title`, `genre`) VALUES
(3, 5),
(5, 5),
(1, 1),
(1, 3),
(1, 4),
(2, 5),
(2, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `producers`
--

CREATE TABLE `producers` (
  `id` int(11) NOT NULL,
  `surname` text NOT NULL,
  `name` text NOT NULL,
  `patronymic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `producers`
--

INSERT INTO `producers` (`id`, `surname`, `name`, `patronymic`) VALUES
(2, 'Эми ', 'Паскаль', ''),
(3, 'Гейл ', 'Энн ', 'Хёрд'),
(4, 'Ави ', 'Арад', ''),
(5, 'Стивен ', 'Бруссар', ''),
(1, 'Кевин', 'Файги', '');

-- --------------------------------------------------------

--
-- Структура таблицы `_genres_`
--

CREATE TABLE `_genres_` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `_genres_`
--

INSERT INTO `_genres_` (`id`, `name`) VALUES
(1, 'Супергеройский фильм'),
(2, 'Фантастика'),
(3, 'Боевик'),
(4, 'Приключенский фильм'),
(5, 'Комедия');

-- --------------------------------------------------------

--
-- Структура таблицы `_titles_`
--

CREATE TABLE `_titles_` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `_titles_`
--

INSERT INTO `_titles_` (`id`, `name`) VALUES
(1, 'Тор: Рагнарёк'),
(2, 'Человек-паук: Возвращение домой'),
(3, 'Невероятный Халк'),
(4, 'Человек-муравей и Оса'),
(5, 'Железный человек');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `films-genres`
--
ALTER TABLE `films-genres`
  ADD KEY `title` (`title`),
  ADD KEY `genre` (`genre`) USING BTREE;

--
-- Индексы таблицы `_genres_`
--
ALTER TABLE `_genres_`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `_titles_`
--
ALTER TABLE `_titles_`
  ADD PRIMARY KEY (`id`);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `films-genres`
--
ALTER TABLE `films-genres`
  ADD CONSTRAINT `films-genres_ibfk_1` FOREIGN KEY (`title`) REFERENCES `_titles_` (`id`),
  ADD CONSTRAINT `films-genres_ibfk_2` FOREIGN KEY (`genre`) REFERENCES `_genres_` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
