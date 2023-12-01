-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 08 2023 г., 18:07
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `seven_semen`
--

-- --------------------------------------------------------

--
-- Структура таблицы `collectors`
--

CREATE TABLE `collectors` (
  `id` int(11) NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_team` int(11) NOT NULL,
  `personal_description` varchar(255) NOT NULL,
  `birth_date` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `collectors`
--

INSERT INTO `collectors` (`id`, `img_path`, `name`, `id_team`, `personal_description`, `birth_date`) VALUES
(1, 'man1.jpg', 'Иванов Иван Иванович', 1, 'Опытный сборщик', 1980),
(2, 'man2.jpg', 'Петров Петр Петрович', 3, 'Любит работать вдвоем', 1995),
(3, 'girl1.jpg', 'Сидорова Анна Ивановна', 2, 'Ответственный', 1987),
(4, 'girl2.jpg', 'Козлова Елена Сергеевна', 4, 'Опытный сборщик фруктов', 1990),
(5, 'man3.jpg', 'Николаев Николай Николаевич', 1, 'Энергичный', 2000),
(6, 'man4.jpg', 'Смирнов Сергей Игоревич', 5, 'Опытный сборщик овощей', 1982),
(7, 'girl3.jpg', 'Григорьева Ольга Александровна', 2, 'Любит собирать цветы', 1991),
(8, 'man5.jpg', 'Михайлов Михаил Алексеевич', 3, 'Опытный сборщик ягод', 1985),
(9, 'man6.jpg', 'Лебедев Андрей Викторович', 4, 'Трудолюбивый', 1998),
(10, 'girl4.jpg', 'Захарова Татьяна Игоревна', 5, 'Опытный сборщик орехов', 1993),
(11, 'girl5.jpg', 'Смирнова Екатерина Ивановна', 1, 'Опытный сборщик', 1980),
(12, 'girl6.jpg', 'Иванова Анна Сергеевна', 4, 'Опытный сборщик фруктов', 1990),
(13, 'girl7.jpg', 'Николаева Татьяна Петровна', 3, 'Любит собирать цветы', 1995),
(14, 'man7.jpg', 'Григорьев Игорь Сергеевич', 5, 'Опытный сборщик овощей', 1982),
(15, 'girl8.jpg', 'Петрова Елена Ивановна', 2, 'Опытный сборщик ягод', 1980),
(16, 'man8.jpg', 'Иванов Игорь Игоревич', 3, 'Опытный сборщик орехов', 1990),
(17, 'girl9.jpg', 'Петрова Анна Андреевна', 2, 'Любит собирать цветы', 1988),
(18, 'man9.jpg', 'Сидоров Павел Павлович', 1, 'Опытный сборщик фруктов', 1984),
(19, 'man10.jpg', 'Козлов Максим Максимович', 4, 'Любит работать вдвоем', 1993),
(20, 'man11.jpg', 'Николаев Алексей Алексеевич', 5, 'Ответственный', 1986);

-- --------------------------------------------------------

--
-- Структура таблицы `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `teams`
--

INSERT INTO `teams` (`id`, `name`) VALUES
(1, 'Бригада 1'),
(2, 'Бригада 2'),
(3, 'Бригада 3'),
(4, 'Бригада 4'),
(5, 'Бригада 5');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `collectors`
--
ALTER TABLE `collectors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collectors_fk0` (`id_team`);

--
-- Индексы таблицы `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `collectors`
--
ALTER TABLE `collectors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `collectors`
--
ALTER TABLE `collectors`
  ADD CONSTRAINT `collectors_fk0` FOREIGN KEY (`id_team`) REFERENCES `teams` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
