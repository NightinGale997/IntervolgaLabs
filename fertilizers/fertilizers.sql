-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 26 2025 г., 09:29
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
  `brigade_id` int(11) NOT NULL,
  `personal_characteristic` text DEFAULT NULL,
  `birth_year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `collectors`
--

INSERT INTO `collectors` (`id`, `photo`, `full_name`, `brigade_id`, `personal_characteristic`, `birth_year`) VALUES
(1, 'photo1.jpg', 'Иванов Иван Иванович', 1, 'Ударник соцтруда', 1952),
(2, 'photo2.jpg', 'Сидоров Пётр Петрович', 1, 'Опытный механизатор', 1957),
(3, 'photo3.jpg', 'Кузнецов Анатолий Васильевич', 2, 'Ветеран колхоза', 1949),
(4, 'photo4.jpg', 'Петрова Валентина Сергеевна', 4, 'Активистка бригады', 1962),
(5, 'photo5.jpg', 'Егорова Нина Ивановна', 3, 'Новатор-передовик', 1965);

-- --------------------------------------------------------

--
-- Структура таблицы `harvest_journal`
--

CREATE TABLE `harvest_journal` (
  `id` int(11) NOT NULL,
  `collector_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `harvest_date` date NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `unit_of_measure` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `harvest_journal`
--

INSERT INTO `harvest_journal` (`id`, `collector_id`, `product_id`, `harvest_date`, `quantity`, `unit_of_measure`) VALUES
(1, 1, 1, '1984-07-12', 150.00, 'кг'),
(2, 2, 3, '1979-08-22', 300.00, 'кг'),
(3, 3, 4, '1986-09-01', 120.00, 'кг'),
(4, 4, 5, '1978-10-11', 200.00, 'кг'),
(5, 5, 2, '1990-06-15', 180.00, 'кг');

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
  ADD KEY `fk_collectors_brigade` (`brigade_id`);

--
-- Индексы таблицы `harvest_journal`
--
ALTER TABLE `harvest_journal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hj_collector` (`collector_id`),
  ADD KEY `fk_hj_product` (`product_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `harvest_journal`
--
ALTER TABLE `harvest_journal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Ограничения внешнего ключа таблицы `collectors`
--
ALTER TABLE `collectors`
  ADD CONSTRAINT `fk_collectors_brigade` FOREIGN KEY (`brigade_id`) REFERENCES `brigades` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `harvest_journal`
--
ALTER TABLE `harvest_journal`
  ADD CONSTRAINT `fk_hj_collector` FOREIGN KEY (`collector_id`) REFERENCES `collectors` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_hj_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_product_type` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
