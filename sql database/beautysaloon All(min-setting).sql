-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 25 2020 г., 13:15
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `beautysaloon`
--

-- --------------------------------------------------------

--
-- Структура таблицы `administrator`
--

CREATE TABLE `administrator` (
  `id_admin` int(11) NOT NULL,
  `login` varchar(60) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `admin_registered` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `administrator`
--

INSERT INTO `administrator` (`id_admin`, `login`, `pass`, `email`, `admin_registered`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'rodion.vinnichuk@mail.ru', '2019-10-18 19:01:12');

--
-- Триггеры `administrator`
--
DELIMITER $$
CREATE TRIGGER `admin_pass_insert` BEFORE INSERT ON `administrator` FOR EACH ROW BEGIN
		SET NEW.pass = md5(NEW.pass);
	END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `admin_pass_update` BEFORE UPDATE ON `administrator` FOR EACH ROW BEGIN
		SET NEW.pass = md5(NEW.pass);
	END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `consumptionmaterial`
--

CREATE TABLE `consumptionmaterial` (
  `id_consumption` int(11) NOT NULL,
  `id_material` int(11) DEFAULT NULL,
  `date_consumption` datetime DEFAULT NULL,
  `consumed_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `consumptionmaterial`
--

INSERT INTO `consumptionmaterial` (`id_consumption`, `id_material`, `date_consumption`, `consumed_quantity`) VALUES
(1, 2, '2012-12-12 00:00:00', 1),
(2, 1, '2012-12-12 00:00:00', 2),
(3, 3, '2012-12-12 00:00:00', 1),
(4, 7, '2019-12-23 17:25:52', 3),
(5, 9, '2019-12-23 17:26:22', 1),
(6, 13, '2019-12-23 17:26:29', 2),
(7, 5, '2019-12-23 17:26:35', 1),
(8, 12, '2019-12-23 17:26:45', 2),
(9, 10, '2019-12-23 17:27:32', 3),
(10, 2, '2019-12-23 17:28:33', 2),
(11, 19, '2019-12-24 15:45:17', 4),
(12, 2, '2019-12-27 10:15:42', 2),
(13, 13, '2020-05-22 17:59:31', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `email` varchar(55) DEFAULT NULL,
  `phone_number` varchar(55) DEFAULT NULL,
  `first_and_last_name` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `customer_discount` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customer`
--

INSERT INTO `customer` (`id_customer`, `email`, `phone_number`, `first_and_last_name`, `pass`, `customer_discount`) VALUES
(1, 'kuzov.pasha@gmail.com', '+375(29)308-90-16', 'Гузов Павел', '25d55ad283aa400af464c76d713c07ad', 0),
(2, 'maksim.grinevsk@yandex.by', '+375(44)308-80-86', 'Гриневский Максим', '77e93f8ff74789cca70832787babd721', 0),
(3, 'bokutdiana@bk.ru', '+375(25)333-82-86', 'Бокуть Диана', 'd2cb56c86000b703d742c285f5f16c78', 0),
(4, 'arutuz@gmail.com', '+375(33)408-80-11', 'Юзефович Артур', '63fbc34e1ad915d314b54832d93b11e1', 5),
(5, 'zhenyaorlov@mail.ru', '+375(29)620-80-30', 'Орлов Евгений', '33db4a1b93bc2d4ef1ee47b6b7e6339c', 0),
(7, 'veronika_mushtuk@gmail.com', '+375(29)348-50-25', 'Вероника Муштук', NULL, 0),
(8, 'sinevish_maksim@yandex.ru', '+375(29)170-99-34', 'Синевич Максим', NULL, 0),
(9, 'michael88.kulesh@mail.ru', '+375(29)690-20-25', 'Кулеш Михаил', NULL, 0),
(10, 'anastasya_yaroshko@paypal.com', '+375(29)610-20-25', 'Анастасия Ярошко', NULL, 0),
(11, 'vladimir_kuznec@gmail.com', '+375(33)690-20-25', 'Владимир Кузнец', NULL, 0),
(24, NULL, '+375(94)394-32-74', NULL, NULL, 0),
(25, 'alex.vinnichuk@gmail.com', '+375(29)308-80-86', 'Пупкин Алексей', '827ccb0eea8a706c4c34a16891f84e7b', 0),
(28, 'rodion.vinnichuk@gmail.ru', '+375(29)308-80-88', 'Федоренко Александра', NULL, 0),
(29, NULL, '+375(99)394-32-74', NULL, NULL, 0);

--
-- Триггеры `customer`
--
DELIMITER $$
CREATE TRIGGER `customer_pass_insert` BEFORE INSERT ON `customer` FOR EACH ROW BEGIN
		SET NEW.pass = md5(NEW.pass);
	END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `employee`
--

CREATE TABLE `employee` (
  `id_employee` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(55) DEFAULT NULL,
  `length_of_work` int(11) DEFAULT NULL,
  `rank_of_master` int(11) DEFAULT NULL,
  `date_of_employment` date DEFAULT NULL,
  `bonus_percentage` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `employee`
--

INSERT INTO `employee` (`id_employee`, `full_name`, `address`, `phone_number`, `length_of_work`, `rank_of_master`, `date_of_employment`, `bonus_percentage`) VALUES
(1, 'Светличный Всеволод Андреевич', 'ул. Янки Купалы д.3, кв.3', '293107047', 2, 3, '2019-10-10', 2),
(2, 'Драпун Александр Игоревич', 'ул. Якуба Коласа д.22, кв.33', '447533262', 1, 4, '2019-10-05', 1),
(3, 'Винничук Родион Тарасович', 'ул. Леонида Беды д.93, кв.39', '293088086', 3, 5, '2018-12-02', 2),
(4, 'Довальцов Никита Юрьевич', 'ул. Уручская д.21в, кв.22', '443012258', 1, 3, '2016-08-15', 1),
(5, 'Белозарович Данила Александрович', 'ул. Куйбышева д.24, кв.91', '291085592', 2, 1, '2018-02-12', 3);

--
-- Триггеры `employee`
--
DELIMITER $$
CREATE TRIGGER `employee_bonus_percentage` BEFORE INSERT ON `employee` FOR EACH ROW SET NEW.bonus_percentage = NEW.length_of_work / NEW.rank_of_master + 1
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `freeorder`
--

CREATE TABLE `freeorder` (
  `id_free_order` int(11) NOT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `id_service` int(11) DEFAULT NULL,
  `date_of_visit` date DEFAULT NULL,
  `time_of_visit` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `material`
--

CREATE TABLE `material` (
  `id_material` int(11) NOT NULL,
  `name_material` varchar(255) DEFAULT NULL,
  `unit` varchar(55) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `manufacturer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `material`
--

INSERT INTO `material` (`id_material`, `name_material`, `unit`, `quantity`, `manufacturer`) VALUES
(1, 'Перчатки', 'шт.', 130, 'Schwarzkopf'),
(2, 'Шампунь', 'мл.', 47, 'Schauma'),
(3, 'Щипцы', 'шт.', 34, 'Dewal'),
(4, 'Бигуди Липучка', 'шт.', 210, 'Dewal'),
(5, 'Воротничок для парикмахера бумажный', 'рул.', 39, 'Estel'),
(6, 'Лак для волос', 'мл.', 170, 'Taft'),
(7, 'Палетка теней для век', 'шт.', 237, 'Maybelline'),
(9, 'Форма для наращивания ногтей', 'рул.', 44, 'Yoko'),
(10, 'Стойкая краска для волос', 'шт.', 507, 'L\'Oreal Paris'),
(11, 'Стойкая краска для волос', 'шт.', 50, 'Garnier Color Sensation'),
(12, 'Профессиональная краска для волос', 'шт.', 28, 'Estel'),
(13, 'Маска для лица', 'шт.', 86, 'Markell'),
(15, 'Маска для лица кремовая', 'шт.', 24, 'Vichy Purete Thermale'),
(16, 'Маска для лица \"Сияние кожи\"', 'шт.', 34, 'Cafe Mimi'),
(17, 'Глиняные маски для лица', 'шт.', 44, 'Missha Natural'),
(18, 'Клей для украшений ногтей с тонкой кисточкой', 'шт.', 23, 'Special'),
(19, 'Перчатки', 'шт.', 19, 'Estel'),
(20, 'Лак для ногтей', 'шт.', 4, 'Special');

-- --------------------------------------------------------

--
-- Структура таблицы `service`
--

CREATE TABLE `service` (
  `id_service` int(11) NOT NULL,
  `name_service` varchar(55) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description_service` text DEFAULT NULL,
  `category` varchar(55) DEFAULT NULL,
  `duration_service` time DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `service`
--

INSERT INTO `service` (`id_service`, `name_service`, `price`, `description_service`, `category`, `duration_service`, `photo`) VALUES
(1, 'Аппаратный маникюр', 32, 'Аппаратный маникюр – это вид необрезного (европейского) маникюра, при котором кутикула освобождается от омертвевших клеток, оставляя саму кутикулу неповрежденной. Маникюр выполняется при помощи аппарата со сменными шлифовальными насадками, которые быстро вращаются на конце аппарата. Внешне и по издаваемому звуку он очень сильно напоминает бормашинку.', 'Маникюр', '03:00:00', '1'),
(2, 'Обрезной маникюр', 35, 'Классический, или обрезной маникюр - это самый популярный вид маникюра в Беларуси, стоит отметить. что во многих странах он запрещен из-за своей небезопасности. При его проведении можно травмировать кутикулу и занести инфекции, и к тому же при не очень умелой манере мастера маникюра после процедуры возможно появление заусенцев.', 'Маникюр', '04:00:00', '2'),
(3, 'Европейский маникюр (необрезной)', 30, 'Основное достоинство и отличительная черта европейского маникюра- это то, что кожа вокруг ногтя не обрезается, а отодвигается, однако остальные операции проводятся в том же объеме, что и при классическом маникюре. Кутикула размягчается специальными эмульсиями и маслами, а ногтевая пластина шлифуется и полируется. Этот способ абсолютно безопасен и очень подходит обладателям тонкой кожи и близко расположенных кровеносных сосудов.', 'Маникюр', '00:30:00', '3'),
(4, 'Французский маникюр', 41, 'Самый известный и наиболее элегантный вид маникюра- это &quot;французский&quot; маникюр. Он был создан французскими модельерами из фирмы ORLY , как универсальный маникюр, подходящий к любой одежде и любому случаю. Особенность французского маникюра - это акцент на кончике ногтя. На профессиональном языке этот вид маникюра называют «френч».', 'Маникюр', '01:00:00', '4'),
(6, 'Базисный маникюр', 44, 'Базисный маникюр - это основа, без который нельзя обойтись. Это те процедуры, которые обязательно должны присутствовать при любом виде маникюра. Грубо говоря - это мини маникюр плюс уход за кожей и кистями рук, состоящий из пилинга и массажа.', 'Маникюр', '04:00:00', '5'),
(7, 'Классический педикюр', 48, 'Его также называют мокрым или обрезным. Процедура классического педикюра проходит так: кожа ступни распаривается в ванночке с применением эфирных масел и растительных экстрактов. Этот этап также придает свежести и снимает усталость. Затем проводится дезинфицирующая ванночка. Для дезинфекции обычно применяют соляной раствор. После этого удаляются натоптыши, мозоли и ороговелость. Затем мастер формирует ногти, обрезает околоногтевое пространство, если нужно, исправляет вросшие ногти. За следующий этап этот вид педикюра и получил свое название обрезной. В классическом педикюре кутикула полностью вырезается. В конце процедуры наносится крем или лосьон, делается легкий массаж.', 'Педикюр', '01:00:00', '1'),
(8, 'Европейский педикюр', 58, 'Он же необрезной. В сущности то же, что и классический. Выполняются те же этапы в такой же последовательности. Разница заключается в том, что при европейском педикюре кутикула не срезается, а отодвигается к основанию ногтя апельсиновой палочкой. Эта процедура считается более гигиеничной и особенно хороша летом, когда из-за открытой обуви ноги сильнее подвержены инфекции. Европейский педикюр также подходит тем, кто посещает подобные процедуры регулярно, у кого ступни не слишком запущены. В целом, разница этих двух видов несущественна, и среди клиентов оба популярны.', 'Педикюр', '01:00:00', '2'),
(9, 'Аппаратный педикюр', 20, 'Его также называют сухим. Это самый быстрый вид педикюра, который идеально подходит для постоянного ухода за ногами. Процедура действительно проводится насухо. Для размягчения кожи применяют специальный крем или жидкость, которые обладают еще дезинфицирующими и дезодорирующими свойствами. В аппаратном педикюре применяют машинку, напоминающую бор. Все этапы проводятся с помощью насадок и шлифовальных пилок, которые выполняют функции от удаления мозолей до шлифовки ногтей. Регулярный аппаратный педикюр особенно рекомендуется тем, кто постоянно ходит на каблуке.', 'Педикюр', '01:00:00', '3'),
(10, 'Модельная стрижка', 30, 'Этот вариант приветствует разные формы умеренной асимметрии, при этом прическа выглядит аккуратно. Возможно наличие косой челки, хохолка. Особенно любимы многими бокс и полубокс.', 'Парикмахерские услуги', '01:00:00', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `visit`
--

CREATE TABLE `visit` (
  `id_visit` int(11) NOT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `id_service` int(11) DEFAULT NULL,
  `id_employee` int(11) DEFAULT NULL,
  `date_of_visit` date DEFAULT NULL,
  `time_of_visit` time DEFAULT NULL,
  `service_provided` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `visit`
--

INSERT INTO `visit` (`id_visit`, `id_customer`, `id_service`, `id_employee`, `date_of_visit`, `time_of_visit`, `service_provided`) VALUES
(1, 3, 4, 5, '2019-12-19', '17:30:00', 1),
(2, 2, 6, 3, '2019-11-10', '12:00:00', 1),
(3, 1, 3, 1, '2019-12-10', '11:30:00', 1),
(4, 4, 2, 5, '2019-10-04', '12:00:00', 1),
(5, 4, 2, 5, '2019-10-04', '12:00:00', 1),
(6, 4, 2, 5, '2019-10-04', '12:00:00', 1),
(7, 4, 2, 5, '2019-10-04', '12:00:00', 1),
(8, 4, 2, 5, '2019-10-04', '12:00:00', 1),
(9, 4, 2, 5, '2019-10-04', '12:00:00', 1),
(11, 10, 6, 3, '2019-12-24', '18:00:00', 1),
(12, 10, 2, 5, '2019-12-27', '14:00:00', 1),
(13, 2, 1, 5, '2019-12-26', '10:00:00', 0),
(14, 1, 2, 4, '2019-12-26', '12:00:00', 0),
(16, 11, 8, 5, '2019-12-26', '12:00:00', 0),
(17, 11, 3, 5, '2019-12-27', '14:30:00', 0),
(19, 1, 7, 1, '2019-12-27', '11:00:00', 1),
(20, 8, 3, 4, '2019-12-27', '17:00:00', 0),
(21, 10, 8, 4, '2019-12-27', '14:00:00', 1),
(22, 10, 7, 4, '2019-12-27', '16:00:00', 1),
(26, 7, 8, 5, '2019-12-27', '12:00:00', 1),
(30, 10, 1, 3, '2020-01-21', '12:00:00', 0),
(40, 24, 1, 3, '2020-05-24', '14:00:00', 0),
(41, 24, 1, 5, '2020-05-24', '14:30:00', 0),
(42, 25, 1, 5, '2020-05-24', '14:00:00', 0),
(43, 29, 1, 3, '2020-05-25', '14:00:00', 0);

--
-- Триггеры `visit`
--
DELIMITER $$
CREATE TRIGGER `customer_discount_insert` AFTER INSERT ON `visit` FOR EACH ROW BEGIN
    declare new_customer int;
    declare quantity_visit_customer int;
    
    set new_customer = NEW.id_customer;
	set quantity_visit_customer = (select count(id_visit) from Visit where id_customer = new_customer);
    
    if(quantity_visit_customer > 5) then 
        UPDATE Customer SET customer_discount = 5 WHERE id_customer = new_customer; 
	END IF;	
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `customer_discount_update` AFTER UPDATE ON `visit` FOR EACH ROW BEGIN
    declare new_customer int;
    declare quantity_visit_customer int;
    
    set new_customer = NEW.id_customer;
	set quantity_visit_customer = (select count(id_visit) from Visit where id_customer = new_customer and service_provided = true);
    
    if(quantity_visit_customer > 5) then 
        UPDATE Customer SET customer_discount = 5 WHERE id_customer = new_customer; 
	END IF;	
END
$$
DELIMITER ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id_admin`);

--
-- Индексы таблицы `consumptionmaterial`
--
ALTER TABLE `consumptionmaterial`
  ADD PRIMARY KEY (`id_consumption`),
  ADD KEY `id_material` (`id_material`);

--
-- Индексы таблицы `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Индексы таблицы `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id_employee`);

--
-- Индексы таблицы `freeorder`
--
ALTER TABLE `freeorder`
  ADD PRIMARY KEY (`id_free_order`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_service` (`id_service`);

--
-- Индексы таблицы `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id_material`);

--
-- Индексы таблицы `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`);

--
-- Индексы таблицы `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`id_visit`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_service` (`id_service`),
  ADD KEY `id_employee` (`id_employee`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `consumptionmaterial`
--
ALTER TABLE `consumptionmaterial`
  MODIFY `id_consumption` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `employee`
--
ALTER TABLE `employee`
  MODIFY `id_employee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `freeorder`
--
ALTER TABLE `freeorder`
  MODIFY `id_free_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `material`
--
ALTER TABLE `material`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `visit`
--
ALTER TABLE `visit`
  MODIFY `id_visit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `consumptionmaterial`
--
ALTER TABLE `consumptionmaterial`
  ADD CONSTRAINT `consumptionmaterial_ibfk_1` FOREIGN KEY (`id_material`) REFERENCES `material` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `freeorder`
--
ALTER TABLE `freeorder`
  ADD CONSTRAINT `freeorder_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `freeorder_ibfk_2` FOREIGN KEY (`id_service`) REFERENCES `service` (`id_service`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `visit`
--
ALTER TABLE `visit`
  ADD CONSTRAINT `visit_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visit_ibfk_2` FOREIGN KEY (`id_service`) REFERENCES `service` (`id_service`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visit_ibfk_3` FOREIGN KEY (`id_employee`) REFERENCES `employee` (`id_employee`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
