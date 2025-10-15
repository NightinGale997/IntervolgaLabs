-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 15 2025 г., 07:05
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fertilizers`
--

-- --------------------------------------------------------

--
-- Структура таблицы `brigades`
--

CREATE TABLE `brigades` (
  `id` int(11) NOT NULL,
  `brigade_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `brigades`
--

INSERT INTO `brigades` (`id`, `brigade_name`) VALUES
(1, 'Бригада им. Ленина'),
(2, 'Бригада \"Колос\"'),
(3, 'Бригада \"Аврора\"'),
(4, 'Бригада им. Горького'),
(5, 'Бригада \"Красная Заря\"');

-- --------------------------------------------------------

--
-- Структура таблицы `collectors`
--

CREATE TABLE `collectors` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `personal_characteristic` text DEFAULT NULL,
  `birth_year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `collectors`
--

INSERT INTO `collectors` (`id`, `photo`, `full_name`, `personal_characteristic`, `birth_year`) VALUES
(1, 'photo_68ebaa6c8fd1e8.64824712.jpg', 'Муканалиев Данияр Кайратович', 'Ударник соцтруда!!!', 1952),
(2, 'photo2.jpg', 'Сидоров Пётр Петрович', 'Опытный механизатор', 1957),
(3, 'photo3.jpg', 'Кузнецов Анатолий Васильевич', 'Ветеран колхоза', 1949),
(4, 'photo4.jpg', 'Петрова Валентина Сергеевна', 'Активистка бригады', 1962);

-- --------------------------------------------------------

--
-- Структура таблицы `harvests`
--

CREATE TABLE `harvests` (
  `id` int(11) NOT NULL,
  `collector_id` int(11) NOT NULL,
  `harvest_date` date NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `unit_of_measure` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `harvests`
--

INSERT INTO `harvests` (`id`, `collector_id`, `harvest_date`, `quantity`, `unit_of_measure`) VALUES
(1, 2, '1984-07-27', 150.00, 'кг1'),
(2, 2, '1979-08-22', 300.00, 'кг123'),
(8, 1, '2025-10-24', 111.00, 'test');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_type_id`) VALUES
(1, 'Пшеница', 1),
(2, 'Рожь', 1),
(3, 'Картофель', 2),
(4, 'Яблоки', 3),
(5, 'Свёкла', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `product_types`
--

CREATE TABLE `product_types` (
  `id` int(11) NOT NULL,
  `product_type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `product_types`
--

INSERT INTO `product_types` (`id`, `product_type_name`) VALUES
(1, 'Зерновые'),
(2, 'Овощи'),
(3, 'Фрукты'),
(4, 'Ягоды'),
(5, 'Технические культуры');

-- --------------------------------------------------------

--
-- Структура таблицы `проекты`
--

CREATE TABLE `проекты` (
  `Номер_проекта` int(11) NOT NULL,
  `Название` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `выполнение_задачи_сотрудником`
--

CREATE TABLE `выполнение_задачи_сотрудником` (
  `Номер_струдника` int(11) NOT NULL,
  `Номер_проекта` int(11) NOT NULL,
  `Номер_задачи` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `отделы`
--

CREATE TABLE `отделы` (
  `Номер_отдела` int(11) NOT NULL,
  `Название` varchar(255) DEFAULT NULL,
  `Номер_телефона` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `сотрудники`
--

CREATE TABLE `сотрудники` (
  `Номер_сотрудника` int(11) NOT NULL,
  `ФИО` varchar(255) DEFAULT NULL,
  `Должность` varchar(255) DEFAULT NULL,
  `Номер_отдела` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `brigades`
--
ALTER TABLE `brigades`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `collectors`
--
ALTER TABLE `collectors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `harvests`
--
ALTER TABLE `harvests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_hj_collector` (`collector_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_product_type` (`product_type_id`);

--
-- Индексы таблицы `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `проекты`
--
ALTER TABLE `проекты`
  ADD PRIMARY KEY (`Номер_проекта`);

--
-- Индексы таблицы `выполнение_задачи_сотрудником`
--
ALTER TABLE `выполнение_задачи_сотрудником`
  ADD PRIMARY KEY (`Номер_струдника`,`Номер_проекта`),
  ADD KEY `Номер_проекта` (`Номер_проекта`);

--
-- Индексы таблицы `отделы`
--
ALTER TABLE `отделы`
  ADD PRIMARY KEY (`Номер_отдела`);

--
-- Индексы таблицы `сотрудники`
--
ALTER TABLE `сотрудники`
  ADD PRIMARY KEY (`Номер_сотрудника`),
  ADD KEY `Номер_отдела` (`Номер_отдела`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `brigades`
--
ALTER TABLE `brigades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `collectors`
--
ALTER TABLE `collectors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `harvests`
--
ALTER TABLE `harvests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `harvests`
--
ALTER TABLE `harvests`
  ADD CONSTRAINT `fk_hj_collector` FOREIGN KEY (`collector_id`) REFERENCES `collectors` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_product_type` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `выполнение_задачи_сотрудником`
--
ALTER TABLE `выполнение_задачи_сотрудником`
  ADD CONSTRAINT `выполнение_задачи_сотрудником_ibfk_1` FOREIGN KEY (`Номер_струдника`) REFERENCES `сотрудники` (`Номер_сотрудника`),
  ADD CONSTRAINT `выполнение_задачи_сотрудником_ibfk_2` FOREIGN KEY (`Номер_проекта`) REFERENCES `проекты` (`Номер_проекта`);

--
-- Ограничения внешнего ключа таблицы `сотрудники`
--
ALTER TABLE `сотрудники`
  ADD CONSTRAINT `сотрудники_ibfk_1` FOREIGN KEY (`Номер_отдела`) REFERENCES `отделы` (`Номер_отдела`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
