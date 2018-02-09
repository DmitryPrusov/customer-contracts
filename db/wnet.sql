-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 09 2018 г., 15:33
-- Версия сервера: 10.1.29-MariaDB
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `wnet`
--

-- --------------------------------------------------------

--
-- Структура таблицы `obj_contracts`
--

CREATE TABLE `obj_contracts` (
  `id_contract` int(10) UNSIGNED NOT NULL,
  `id_customer` int(10) UNSIGNED NOT NULL,
  `number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_sign` date NOT NULL,
  `staff_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `obj_contracts`
--

INSERT INTO `obj_contracts` (`id_contract`, `id_customer`, `number`, `date_sign`, `staff_number`) VALUES
(1, 1, '23', '2018-02-12', '050 777 77 77'),
(2, 1, '34', '2018-02-14', '234234');

-- --------------------------------------------------------

--
-- Структура таблицы `obj_customers`
--

CREATE TABLE `obj_customers` (
  `id_customer` int(10) UNSIGNED NOT NULL,
  `name_customer` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `company` enum('company_1','company_2','company_3') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `obj_customers`
--

INSERT INTO `obj_customers` (`id_customer`, `name_customer`, `company`) VALUES
(1, 'Artem ', 'company_2'),
(2, 'Kalin', 'company_1'),
(3, 'Soso', 'company_2'),
(4, 'Damir', 'company_1'),
(5, 'Andrey', 'company_3');

-- --------------------------------------------------------

--
-- Структура таблицы `obj_services`
--

CREATE TABLE `obj_services` (
  `id_service` int(11) NOT NULL,
  `id_contract` int(11) UNSIGNED NOT NULL,
  `title_service` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('work','connecting','disconnected') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `obj_services`
--

INSERT INTO `obj_services` (`id_service`, `id_contract`, `title_service`, `status`) VALUES
(1, 1, 'remount', 'work'),
(2, 2, 'our SUPER SERVICE', 'disconnected'),
(3, 1, 'Great SERVICE', 'connecting');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `obj_contracts`
--
ALTER TABLE `obj_contracts`
  ADD PRIMARY KEY (`id_contract`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Индексы таблицы `obj_customers`
--
ALTER TABLE `obj_customers`
  ADD PRIMARY KEY (`id_customer`);

--
-- Индексы таблицы `obj_services`
--
ALTER TABLE `obj_services`
  ADD PRIMARY KEY (`id_service`),
  ADD KEY `id_contract` (`id_contract`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `obj_contracts`
--
ALTER TABLE `obj_contracts`
  MODIFY `id_contract` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `obj_customers`
--
ALTER TABLE `obj_customers`
  MODIFY `id_customer` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `obj_contracts`
--
ALTER TABLE `obj_contracts`
  ADD CONSTRAINT `obj_contracts_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `obj_customers` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `obj_services`
--
ALTER TABLE `obj_services`
  ADD CONSTRAINT `obj_services_ibfk_1` FOREIGN KEY (`id_contract`) REFERENCES `obj_contracts` (`id_contract`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
