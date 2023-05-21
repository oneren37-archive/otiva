-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 21 2023 г., 17:50
-- Версия сервера: 5.7.39-log
-- Версия PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `otiva`
--
CREATE DATABASE IF NOT EXISTS `otiva` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `otiva`;

-- --------------------------------------------------------

--
-- Структура таблицы `advert`
--

CREATE TABLE `advert` (
  `aid` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` text COLLATE utf8mb4_unicode_ci COMMENT 'ссылка на картинку',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '1',
  `category` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `advert`
--

INSERT INTO `advert` (`aid`, `author`, `title`, `img`, `description`, `status`, `category`, `date`, `price`) VALUES
(33, 2, 'Стул старый', '/otiva/uploads/1684675714хс43-1000x1000.jpg', 'вроде пока не развался', 1, 4, '2023-05-21 16:28:34', 10),
(34, 2, 'Компьютер', '/otiva/uploads/1684675783kompyuter-ds-5.jpg', ' Супер пупер.\r\n\r\nPaint на тормозит\r\nВ сапере 300 fps', 1, 3, '2023-05-21 16:29:43', 89000),
(35, 4, 'Стул черный', '/otiva/uploads/1684676840H09323ffdf719479aa3e3179f35af8cbfj.jpg', 'черный', 1, 4, '2023-05-21 16:47:20', 200),
(36, 4, 'Грабли', '/otiva/uploads/168467692850ff3f9d2e60c350a008fb8bb93219d4-400x400.jpg', 'если не наступать, то хорошие', 1, 1, '2023-05-21 16:48:48', 300),
(37, 1, 'Стул деревянный', '/otiva/uploads/1684677054stulhalmarrafoolkha.jpg', 'стул как стул', 1, 4, '2023-05-21 16:50:54', 50),
(38, 1, 'Яндекс', '/otiva/uploads/16846771112.jpg', 'Отдам в хорошие руки за бесценок', 1, 1, '2023-05-21 16:51:51', 7000000);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `cid` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci COMMENT 'Название категории'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`cid`, `name`) VALUES
(1, 'Разное'),
(2, 'Автомобили'),
(3, 'Электроника'),
(4, 'Стулья');

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `get_messages`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `get_messages` (
`advert` int(11)
,`name` text
,`text` text
,`date` datetime
);

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `home_view`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `home_view` (
`uid` int(11)
,`author` text
,`title` text
,`img` text
,`description` longtext
,`status` text
,`category` text
,`cid` int(11)
,`date` datetime
,`price` int(11)
,`aid` int(11)
);

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `mid` int(11) NOT NULL,
  `advert` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`mid`, `advert`, `sender`, `receiver`, `text`, `date`) VALUES
(1, 1, 1, 2, 'Hello world', '2023-05-21 15:34:02'),
(2, 1, 2, 1, 'Воистину Hello', '2023-05-21 15:34:02'),
(3, 21, 1, 2, 'Привет', '2023-05-21 15:34:02'),
(4, 32, 1, 2, 'пуп', '2023-05-21 15:34:02'),
(5, 32, 2, 1, 'пып', '2023-05-21 15:38:01'),
(6, 32, 1, 2, 'пап', '2023-05-21 15:59:07'),
(7, 32, 1, 2, '234', '2023-05-21 16:09:32'),
(8, 32, 1, 2, 'wed', '2023-05-21 16:09:53'),
(9, 32, 1, 2, 'wed', '2023-05-21 16:09:55'),
(10, 32, 1, 2, 'wed', '2023-05-21 16:09:56'),
(11, 32, 1, 2, 'wed', '2023-05-21 16:10:00'),
(12, 32, 1, 2, 'wed', '2023-05-21 16:10:00'),
(13, 32, 1, 2, 'Привет', '2023-05-21 16:11:26'),
(14, 32, 2, 2, 'Привет в ответ', '2023-05-21 16:14:51');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `rid` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`rid`, `name`) VALUES
(1, 'administrator'),
(2, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `sid` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`sid`, `name`) VALUES
(1, 'Продается'),
(2, 'Продано');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `login` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '2',
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`uid`, `login`, `password`, `role`, `name`) VALUES
(1, 'admin', 'admin', 1, 'Admin'),
(2, '123', '123', 2, 'Миша'),
(3, 'qwerty', '123', 2, 'Петя'),
(4, 'qwe', 'qwe', 2, 'Евгений');

-- --------------------------------------------------------

--
-- Структура для представления `get_messages`
--
DROP TABLE IF EXISTS `get_messages`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `get_messages`  AS   (select `message`.`advert` AS `advert`,`s`.`name` AS `name`,`message`.`text` AS `text`,`message`.`date` AS `date` from (`message` join `user` `s` on((`s`.`uid` = `message`.`sender`))) order by `message`.`date`)  ;

-- --------------------------------------------------------

--
-- Структура для представления `home_view`
--
DROP TABLE IF EXISTS `home_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `home_view`  AS   (select `u`.`uid` AS `uid`,`u`.`name` AS `author`,`advert`.`title` AS `title`,`advert`.`img` AS `img`,`advert`.`description` AS `description`,`s`.`name` AS `status`,`c`.`name` AS `category`,`c`.`cid` AS `cid`,`advert`.`date` AS `date`,`advert`.`price` AS `price`,`advert`.`aid` AS `aid` from (((`advert` join `user` `u` on((`advert`.`author` = `u`.`uid`))) join `category` `c` on((`c`.`cid` = `advert`.`category`))) join `status` `s` on((`s`.`sid` = `advert`.`status`))) order by `advert`.`date` desc)  ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `advert`
--
ALTER TABLE `advert`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `advert_caterory_cid_fk` (`category`),
  ADD KEY `advert_user_uid_fk` (`author`),
  ADD KEY `advert_status_sid_fk` (`status`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `message_user_uid_fk` (`sender`),
  ADD KEY `message_user_uid_fk2` (`receiver`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`rid`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`sid`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `user_pk2` (`login`(255)),
  ADD KEY `user_role_rid_fk` (`role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `advert`
--
ALTER TABLE `advert`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `advert`
--
ALTER TABLE `advert`
  ADD CONSTRAINT `advert_caterory_cid_fk` FOREIGN KEY (`category`) REFERENCES `category` (`cid`),
  ADD CONSTRAINT `advert_status_sid_fk` FOREIGN KEY (`status`) REFERENCES `status` (`sid`),
  ADD CONSTRAINT `advert_user_uid_fk` FOREIGN KEY (`author`) REFERENCES `user` (`uid`);

--
-- Ограничения внешнего ключа таблицы `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_user_uid_fk` FOREIGN KEY (`sender`) REFERENCES `user` (`uid`),
  ADD CONSTRAINT `message_user_uid_fk2` FOREIGN KEY (`receiver`) REFERENCES `user` (`uid`);

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_role_rid_fk` FOREIGN KEY (`role`) REFERENCES `role` (`rid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
