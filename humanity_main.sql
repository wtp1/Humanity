-- phpMyAdmin SQL Dump
-- version 4.3.12
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 20 2016 г., 15:47
-- Версия сервера: 5.5.23
-- Версия PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `humanity_main`
--

-- --------------------------------------------------------

--
-- Структура таблицы `d_dirt_types`
--

CREATE TABLE IF NOT EXISTS `d_dirt_types` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL COMMENT 'Наименование типа почвенного покрова',
  `texture_name` varchar(256) NOT NULL COMMENT 'Наименование файла текстуры'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Справочник типов почвенного покрова';

--
-- Дамп данных таблицы `d_dirt_types`
--

INSERT INTO `d_dirt_types` (`id`, `name`, `texture_name`) VALUES
(1, 'Пустыня\r\n', 'img/dirt_type/desert.png'),
(2, 'Тундра', 'img/dirt_type/tundra.png'),
(3, 'Речная пойма', 'img/dirt_type/floodplains.png'),
(4, 'Степь', 'img/dirt_type/prairie.png'),
(5, 'Морское\\океанское дно', 'img/dirt_type/sea.png');

-- --------------------------------------------------------

--
-- Структура таблицы `d_races`
--

CREATE TABLE IF NOT EXISTS `d_races` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL COMMENT 'Навзвание расы'
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Справочник человеческих рас';

--
-- Дамп данных таблицы `d_races`
--

INSERT INTO `d_races` (`id`, `name`) VALUES
(1, 'Европеоиды'),
(2, 'Монголоиды'),
(3, 'Азиаты'),
(4, 'Негры'),
(5, 'Индейцы');

-- --------------------------------------------------------

--
-- Структура таблицы `d_relief_types`
--

CREATE TABLE IF NOT EXISTS `d_relief_types` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL COMMENT 'Наименование типа рельефа',
  `texture_name` varchar(256) NOT NULL,
  `show_on_map` tinyint(1) NOT NULL COMMENT 'Флаг отображения текстуры на карте (1 - да, 0 - нет)'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Справочник типов рельефа';

--
-- Дамп данных таблицы `d_relief_types`
--

INSERT INTO `d_relief_types` (`id`, `name`, `texture_name`, `show_on_map`) VALUES
(1, 'Горы', 'img/relief_type/mountains.png', 1),
(2, 'Равнины', 'img/relief_type/plains.png', 0),
(3, 'Холмы', 'img/relief_type/hills.png', 1),
(4, 'Морское\\океанское дно', 'img/relief_type/sea.png', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `d_resources`
--

CREATE TABLE IF NOT EXISTS `d_resources` (
  `id` int(5) NOT NULL,
  `name` varchar(128) NOT NULL COMMENT 'Наименование ресурса',
  `d_resource_groups_id` int(11) NOT NULL,
  `texture_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `d_resources`
--

INSERT INTO `d_resources` (`id`, `name`, `d_resource_groups_id`, `texture_name`) VALUES
(1, 'Яки', 1, ''),
(2, 'Бизоны', 1, ''),
(3, 'Мул', 1, ''),
(4, 'Козы', 2, ''),
(5, 'Овцы', 2, ''),
(6, 'Горные козлы', 2, ''),
(7, 'Ячмень', 3, ''),
(8, 'Пшеница', 3, ''),
(9, 'Овес', 3, ''),
(10, 'Рожь', 3, ''),
(11, 'Просо', 3, ''),
(12, 'Кукуруза', 3, ''),
(13, 'Гречиха', 3, ''),
(14, 'Гуси', 4, ''),
(15, 'Утки', 4, ''),
(16, 'Страус', 5, ''),
(17, 'Павлин', 5, ''),
(18, 'Куропатка', 5, ''),
(21, 'Фазан', 5, ''),
(22, 'Железо', 6, ''),
(23, 'Медь', 6, ''),
(24, 'Олово', 6, ''),
(25, 'Серебро', 6, ''),
(26, 'Золото', 6, ''),
(27, 'Глина', 7, ''),
(28, 'Гравий', 7, ''),
(29, 'Песок', 7, ''),
(30, 'Камень', 8, ''),
(34, 'Дуб', 9, ''),
(35, 'Береза', 9, ''),
(36, 'Лиственница', 9, ''),
(37, 'Ель', 9, ''),
(38, 'Кедр', 9, ''),
(39, 'Пихта', 9, ''),
(40, 'Сосна', 9, '');

-- --------------------------------------------------------

--
-- Структура таблицы `d_resource_groups`
--

CREATE TABLE IF NOT EXISTS `d_resource_groups` (
  `id` int(5) NOT NULL,
  `name` varchar(128) NOT NULL COMMENT 'Наименование ресурса',
  `texture_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `d_resource_groups`
--

INSERT INTO `d_resource_groups` (`id`, `name`, `texture_name`) VALUES
(1, 'Крупный рогатый скот', 'img/resource_group/cattle.png'),
(2, 'Мелкий рогатый скот', 'img/resource_group/small_cattle.png'),
(3, 'Зерновые', 'img/resource_group/cereals.png'),
(4, 'Водоплавающие птицы', 'img/resource_group/waterfowl.png'),
(5, 'Прочие птицы', 'img/resource_group/birds.png'),
(6, 'Металлы', 'img/resource_group/metalls.png'),
(7, 'Сыпучие стройматериалы', 'img/resource_group/loose_materials.png'),
(8, 'Несыпучие стройматериалы', 'img/resource_group/solid_materials.png'),
(9, 'Древесина', 'img/resource_group/wood.png');

-- --------------------------------------------------------

--
-- Структура таблицы `d_social_groups_types`
--

CREATE TABLE IF NOT EXISTS `d_social_groups_types` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL COMMENT 'Наименование типа социальной группы',
  `description` varchar(512) NOT NULL COMMENT 'Описание'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Справочник типов социальных групп';

--
-- Дамп данных таблицы `d_social_groups_types`
--

INSERT INTO `d_social_groups_types` (`id`, `name`, `description`) VALUES
(1, 'Семья', 'Группа кровных родственников, живущих вместе.'),
(2, 'Род, клан', 'Группа семей, имеющих достаточное количество родственных связей.'),
(3, 'Поселение', 'Все население, живущее в одном населенном пункте.');

-- --------------------------------------------------------

--
-- Структура таблицы `d_vegetation_types`
--

CREATE TABLE IF NOT EXISTS `d_vegetation_types` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL COMMENT 'Наименование типа растительности',
  `texture_name` varchar(256) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='Справочник типов растительности';

--
-- Дамп данных таблицы `d_vegetation_types`
--

INSERT INTO `d_vegetation_types` (`id`, `name`, `texture_name`) VALUES
(1, 'Смешанный лес', 'img/vegetation_type/forest.png'),
(2, 'Хвойный лес', 'img/vegetation_type/pine_forest.png'),
(3, 'Джунгли', 'img/vegetation_type/jungle.png'),
(4, 'Кустарник', 'img/vegetation_type/bush.png'),
(5, 'Трава', 'img/vegetation_type/grass.png'),
(6, 'Слабый травяной покров', 'img/vegetation_type/weak_ground_cover.png'),
(0, 'Растительность отсутствует', 'img/vegetation_type/none.png'),
(8, 'Водоросли', 'img/vegetation_type/water_plants.png');

-- --------------------------------------------------------

--
-- Структура таблицы `d_water_resources_types`
--

CREATE TABLE IF NOT EXISTS `d_water_resources_types` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL COMMENT 'Наименование типа водного ресурса',
  `texture_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Справочник типов водных ресурсов';

--
-- Дамп данных таблицы `d_water_resources_types`
--

INSERT INTO `d_water_resources_types` (`id`, `name`, `texture_name`) VALUES
(0, 'Водные ресурсы отсутствуют', 'img/water_resources_type/none.png'),
(1, 'Озера', 'img/water_resources_type/lake.png'),
(2, 'Реки', 'img/water_resources_type/river.png'),
(3, 'Ручьи', 'img/water_resources_type/stream.png'),
(4, 'Болота', 'img/water_resources_type/marsh.png'),
(5, 'Море', 'img/water_resources_type/sea.png'),
(6, 'Океан', 'img/water_resources_type/ocean.png');

-- --------------------------------------------------------

--
-- Структура таблицы `s_cells`
--

CREATE TABLE IF NOT EXISTS `s_cells` (
  `id` int(11) NOT NULL,
  `s_squares_id` int(11) NOT NULL COMMENT 'x координата',
  `row_number` int(3) NOT NULL,
  `column_number` int(3) NOT NULL,
  `d_dirt_types_id` int(11) NOT NULL COMMENT 'id типа почвенного покрова',
  `d_relief_types_id` int(11) NOT NULL COMMENT 'id типа рельефа',
  `d_vegetation_types_id` int(11) NOT NULL COMMENT 'Id типа растительности',
  `d_water_resources_types_id` int(11) NOT NULL COMMENT 'id типа водного ресурса'
) ENGINE=InnoDB AUTO_INCREMENT=401 DEFAULT CHARSET=utf8 COMMENT='Клетки игрового ландшафта';

--
-- Дамп данных таблицы `s_cells`
--

INSERT INTO `s_cells` (`id`, `s_squares_id`, `row_number`, `column_number`, `d_dirt_types_id`, `d_relief_types_id`, `d_vegetation_types_id`, `d_water_resources_types_id`) VALUES
(1, 1, 1, 1, 1, 2, 4, 3),
(2, 1, 1, 2, 4, 2, 4, 3),
(3, 1, 1, 3, 1, 2, 4, 3),
(4, 1, 1, 4, 4, 2, 4, 3),
(5, 1, 1, 5, 4, 2, 4, 3),
(6, 1, 1, 6, 1, 1, 1, 0),
(7, 1, 1, 7, 1, 1, 1, 0),
(8, 1, 1, 8, 1, 2, 4, 3),
(9, 1, 1, 9, 1, 2, 4, 3),
(10, 1, 1, 10, 5, 4, 4, 3),
(11, 1, 2, 1, 4, 2, 4, 3),
(12, 1, 2, 2, 4, 2, 4, 3),
(13, 1, 2, 3, 4, 2, 4, 3),
(14, 1, 2, 4, 1, 1, 1, 0),
(15, 1, 2, 5, 1, 2, 4, 3),
(16, 1, 2, 6, 1, 2, 4, 3),
(17, 1, 2, 7, 1, 2, 4, 3),
(18, 1, 2, 8, 1, 2, 4, 3),
(19, 1, 2, 9, 5, 4, 4, 3),
(20, 1, 2, 10, 5, 4, 4, 3),
(21, 1, 3, 1, 4, 2, 4, 3),
(22, 1, 3, 2, 1, 2, 4, 3),
(23, 1, 3, 3, 1, 2, 4, 3),
(24, 1, 3, 4, 1, 3, 2, 3),
(25, 1, 3, 5, 1, 3, 2, 3),
(26, 1, 3, 6, 1, 3, 2, 3),
(27, 1, 3, 7, 1, 2, 4, 3),
(28, 1, 3, 8, 1, 2, 4, 3),
(29, 1, 3, 9, 5, 4, 4, 3),
(30, 1, 3, 10, 5, 4, 4, 3),
(31, 1, 4, 1, 4, 2, 4, 3),
(32, 1, 4, 2, 4, 3, 1, 1),
(33, 1, 4, 3, 1, 3, 2, 3),
(34, 1, 4, 4, 4, 1, 2, 3),
(35, 1, 4, 5, 4, 1, 2, 3),
(36, 1, 4, 6, 4, 1, 2, 3),
(37, 1, 4, 7, 1, 3, 2, 3),
(38, 1, 4, 8, 1, 2, 4, 3),
(39, 1, 4, 9, 5, 4, 4, 3),
(40, 1, 4, 10, 5, 4, 4, 3),
(41, 1, 5, 1, 4, 2, 1, 2),
(42, 1, 5, 2, 1, 2, 4, 3),
(43, 1, 5, 3, 1, 3, 2, 3),
(44, 1, 5, 4, 4, 1, 2, 3),
(45, 1, 5, 5, 4, 1, 2, 1),
(46, 1, 5, 6, 4, 1, 2, 2),
(47, 1, 5, 7, 1, 3, 2, 3),
(48, 1, 5, 8, 4, 2, 1, 2),
(49, 1, 5, 9, 5, 4, 4, 3),
(50, 1, 5, 10, 5, 4, 0, 0),
(51, 1, 6, 1, 4, 2, 4, 3),
(52, 1, 6, 2, 1, 2, 4, 3),
(53, 1, 6, 3, 1, 3, 2, 3),
(54, 1, 6, 4, 1, 3, 2, 3),
(55, 1, 6, 5, 4, 1, 2, 3),
(56, 1, 6, 6, 1, 3, 2, 3),
(57, 1, 6, 7, 4, 3, 1, 2),
(58, 1, 6, 8, 1, 2, 0, 0),
(59, 1, 6, 9, 5, 4, 4, 3),
(60, 1, 6, 10, 5, 4, 4, 3),
(61, 1, 7, 1, 4, 2, 4, 3),
(62, 1, 7, 2, 4, 2, 4, 3),
(63, 1, 7, 3, 1, 2, 4, 3),
(64, 1, 7, 4, 1, 2, 4, 3),
(65, 1, 7, 5, 1, 3, 2, 3),
(66, 1, 7, 6, 1, 2, 4, 3),
(67, 1, 7, 7, 1, 2, 4, 3),
(68, 1, 7, 8, 1, 2, 4, 3),
(69, 1, 7, 9, 5, 4, 4, 3),
(70, 1, 7, 10, 5, 4, 4, 3),
(71, 1, 8, 1, 4, 2, 4, 3),
(72, 1, 8, 2, 4, 2, 4, 3),
(73, 1, 8, 3, 4, 2, 4, 3),
(74, 1, 8, 4, 4, 3, 1, 3),
(75, 1, 8, 5, 1, 3, 2, 3),
(76, 1, 8, 6, 1, 2, 4, 3),
(77, 1, 8, 7, 1, 2, 3, 3),
(78, 1, 8, 8, 1, 2, 4, 3),
(79, 1, 8, 9, 5, 4, 8, 3),
(80, 1, 8, 10, 5, 4, 4, 3),
(81, 1, 9, 1, 4, 2, 4, 3),
(82, 1, 9, 2, 4, 2, 4, 3),
(83, 1, 9, 3, 4, 3, 1, 3),
(84, 1, 9, 4, 4, 2, 1, 3),
(85, 1, 9, 5, 4, 3, 2, 3),
(86, 1, 9, 6, 4, 3, 2, 3),
(87, 1, 9, 7, 1, 2, 4, 3),
(88, 1, 9, 8, 1, 2, 4, 3),
(89, 1, 9, 9, 5, 4, 4, 3),
(90, 1, 9, 10, 5, 4, 4, 3),
(91, 1, 10, 1, 4, 2, 4, 3),
(92, 1, 10, 2, 4, 2, 4, 3),
(93, 1, 10, 3, 4, 2, 4, 3),
(94, 1, 10, 4, 4, 2, 4, 3),
(95, 1, 10, 5, 4, 2, 1, 3),
(96, 1, 10, 6, 4, 2, 1, 3),
(97, 1, 10, 7, 4, 2, 1, 3),
(98, 1, 10, 8, 1, 2, 4, 3),
(99, 1, 10, 9, 5, 4, 4, 3),
(100, 1, 10, 10, 5, 4, 4, 3),
(101, 2, 1, 1, 4, 2, 4, 3),
(102, 2, 1, 2, 4, 2, 4, 3),
(103, 2, 1, 3, 4, 2, 4, 3),
(104, 2, 1, 4, 4, 2, 4, 3),
(105, 2, 1, 5, 4, 2, 4, 3),
(106, 2, 1, 6, 4, 2, 4, 3),
(107, 2, 1, 7, 4, 2, 4, 3),
(108, 2, 1, 8, 1, 2, 4, 3),
(109, 2, 1, 9, 5, 4, 4, 3),
(110, 2, 1, 10, 5, 4, 4, 3),
(111, 2, 2, 1, 4, 2, 4, 3),
(112, 2, 2, 2, 4, 2, 4, 3),
(113, 2, 2, 3, 4, 2, 4, 3),
(114, 2, 2, 4, 4, 2, 4, 3),
(115, 2, 2, 5, 4, 2, 4, 3),
(116, 2, 2, 6, 4, 2, 4, 3),
(117, 2, 2, 7, 4, 2, 3, 3),
(118, 2, 2, 8, 4, 2, 3, 3),
(119, 2, 2, 9, 1, 2, 4, 3),
(120, 2, 2, 10, 1, 2, 4, 3),
(121, 2, 3, 1, 4, 2, 4, 3),
(122, 2, 3, 2, 4, 2, 4, 3),
(123, 2, 3, 3, 4, 2, 4, 3),
(124, 2, 3, 4, 4, 2, 4, 3),
(125, 2, 3, 5, 4, 2, 4, 3),
(126, 2, 3, 6, 4, 2, 3, 3),
(127, 2, 3, 7, 4, 2, 3, 3),
(128, 2, 3, 8, 4, 2, 3, 3),
(129, 2, 3, 9, 4, 2, 3, 3),
(130, 2, 3, 10, 1, 2, 4, 3),
(131, 2, 4, 1, 4, 2, 4, 3),
(132, 2, 4, 2, 4, 2, 4, 3),
(133, 2, 4, 3, 4, 2, 4, 3),
(134, 2, 4, 4, 1, 2, 4, 3),
(135, 2, 4, 5, 4, 2, 4, 3),
(136, 2, 4, 6, 4, 2, 3, 3),
(137, 2, 4, 7, 4, 2, 3, 3),
(138, 2, 4, 8, 4, 2, 3, 3),
(139, 2, 4, 9, 4, 2, 3, 3),
(140, 2, 4, 10, 1, 2, 4, 3),
(141, 2, 5, 1, 4, 2, 4, 3),
(142, 2, 5, 2, 4, 2, 4, 3),
(143, 2, 5, 3, 4, 2, 4, 3),
(144, 2, 5, 4, 1, 2, 4, 3),
(145, 2, 5, 5, 4, 2, 4, 3),
(146, 2, 5, 6, 4, 2, 4, 3),
(147, 2, 5, 7, 4, 2, 3, 3),
(148, 2, 5, 8, 4, 2, 3, 3),
(149, 2, 5, 9, 4, 2, 3, 3),
(150, 2, 5, 10, 1, 2, 4, 3),
(151, 2, 6, 1, 1, 2, 4, 3),
(152, 2, 6, 2, 1, 2, 4, 3),
(153, 2, 6, 3, 1, 2, 4, 3),
(154, 2, 6, 4, 4, 2, 4, 3),
(155, 2, 6, 5, 4, 2, 4, 3),
(156, 2, 6, 6, 1, 2, 4, 3),
(157, 2, 6, 7, 4, 2, 4, 3),
(158, 2, 6, 8, 4, 2, 4, 3),
(159, 2, 6, 9, 1, 2, 4, 3),
(160, 2, 6, 10, 1, 2, 4, 3),
(161, 2, 7, 1, 1, 2, 4, 3),
(162, 2, 7, 2, 1, 2, 4, 3),
(163, 2, 7, 3, 1, 2, 4, 3),
(164, 2, 7, 4, 4, 2, 4, 3),
(165, 2, 7, 5, 1, 2, 4, 3),
(166, 2, 7, 6, 1, 2, 4, 3),
(167, 2, 7, 7, 4, 2, 4, 3),
(168, 2, 7, 8, 4, 2, 4, 3),
(169, 2, 7, 9, 1, 2, 4, 3),
(170, 2, 7, 10, 1, 2, 4, 3),
(171, 2, 8, 1, 1, 2, 4, 3),
(172, 2, 8, 2, 4, 2, 4, 3),
(173, 2, 8, 3, 4, 2, 4, 3),
(174, 2, 8, 4, 1, 2, 4, 3),
(175, 2, 8, 5, 1, 2, 4, 3),
(176, 2, 8, 6, 1, 2, 4, 3),
(177, 2, 8, 7, 4, 2, 4, 3),
(178, 2, 8, 8, 4, 2, 4, 3),
(179, 2, 8, 9, 4, 2, 4, 3),
(180, 2, 8, 10, 1, 2, 4, 3),
(181, 2, 9, 1, 4, 2, 4, 3),
(182, 2, 9, 2, 4, 2, 4, 3),
(183, 2, 9, 3, 4, 2, 4, 3),
(184, 2, 9, 4, 1, 2, 4, 3),
(185, 2, 9, 5, 1, 2, 4, 3),
(186, 2, 9, 6, 1, 2, 4, 3),
(187, 2, 9, 7, 4, 2, 4, 3),
(188, 2, 9, 8, 4, 2, 4, 3),
(189, 2, 9, 9, 4, 2, 4, 3),
(190, 2, 9, 10, 4, 2, 4, 3),
(191, 2, 10, 1, 4, 2, 4, 3),
(192, 2, 10, 2, 4, 2, 4, 3),
(193, 2, 10, 3, 4, 2, 4, 3),
(194, 2, 10, 4, 1, 2, 4, 3),
(195, 2, 10, 5, 1, 2, 4, 3),
(196, 2, 10, 6, 1, 2, 4, 3),
(197, 2, 10, 7, 1, 2, 4, 3),
(198, 2, 10, 8, 1, 2, 4, 3),
(199, 2, 10, 9, 4, 2, 4, 3),
(200, 2, 10, 10, 4, 2, 4, 3),
(201, 3, 1, 1, 1, 2, 4, 3),
(202, 3, 1, 2, 1, 2, 0, 0),
(203, 3, 1, 3, 1, 2, 4, 3),
(204, 3, 1, 4, 1, 2, 4, 3),
(205, 3, 1, 5, 1, 2, 4, 3),
(206, 3, 1, 6, 1, 2, 4, 3),
(207, 3, 1, 7, 1, 2, 4, 3),
(208, 3, 1, 8, 1, 2, 4, 3),
(209, 3, 1, 9, 1, 2, 4, 3),
(210, 3, 1, 10, 1, 2, 4, 3),
(211, 3, 2, 1, 1, 2, 0, 0),
(212, 3, 2, 2, 1, 2, 0, 0),
(213, 3, 2, 3, 1, 2, 0, 0),
(214, 3, 2, 4, 1, 2, 0, 0),
(215, 3, 2, 5, 1, 2, 4, 3),
(216, 3, 2, 6, 1, 2, 4, 3),
(217, 3, 2, 7, 1, 2, 0, 0),
(218, 3, 2, 8, 1, 2, 4, 3),
(219, 3, 2, 9, 1, 2, 4, 3),
(220, 3, 2, 10, 1, 2, 4, 3),
(221, 3, 3, 1, 1, 2, 0, 0),
(222, 3, 3, 2, 1, 2, 0, 0),
(223, 3, 3, 3, 1, 2, 0, 0),
(224, 3, 3, 4, 1, 2, 0, 0),
(225, 3, 3, 5, 1, 2, 4, 3),
(226, 3, 3, 6, 1, 2, 4, 3),
(227, 3, 3, 7, 1, 2, 4, 3),
(228, 3, 3, 8, 1, 2, 4, 3),
(229, 3, 3, 9, 1, 2, 4, 3),
(230, 3, 3, 10, 1, 2, 4, 3),
(231, 3, 4, 1, 1, 2, 0, 0),
(232, 3, 4, 2, 1, 2, 0, 0),
(233, 3, 4, 3, 1, 2, 0, 0),
(234, 3, 4, 4, 1, 2, 0, 0),
(235, 3, 4, 5, 1, 2, 4, 3),
(236, 3, 4, 6, 1, 2, 4, 3),
(237, 3, 4, 7, 1, 2, 4, 3),
(238, 3, 4, 8, 1, 2, 4, 3),
(239, 3, 4, 9, 1, 2, 4, 3),
(240, 3, 4, 10, 1, 2, 4, 3),
(241, 3, 5, 1, 1, 2, 0, 0),
(242, 3, 5, 2, 1, 2, 0, 0),
(243, 3, 5, 3, 1, 2, 0, 0),
(244, 3, 5, 4, 1, 2, 0, 0),
(245, 3, 5, 5, 1, 2, 4, 3),
(246, 3, 5, 6, 1, 2, 4, 3),
(247, 3, 5, 7, 1, 2, 4, 3),
(248, 3, 5, 8, 1, 2, 4, 3),
(249, 3, 5, 9, 1, 2, 4, 3),
(250, 3, 5, 10, 1, 2, 4, 3),
(251, 3, 6, 1, 1, 2, 0, 0),
(252, 3, 6, 2, 1, 2, 0, 0),
(253, 3, 6, 3, 1, 2, 0, 0),
(254, 3, 6, 4, 1, 2, 4, 3),
(255, 3, 6, 5, 1, 2, 4, 3),
(256, 3, 6, 6, 1, 2, 4, 3),
(257, 3, 6, 7, 1, 2, 4, 3),
(258, 3, 6, 8, 1, 2, 4, 3),
(259, 3, 6, 9, 1, 2, 4, 3),
(260, 3, 6, 10, 1, 2, 4, 3),
(261, 3, 7, 1, 1, 2, 0, 0),
(262, 3, 7, 2, 1, 2, 0, 0),
(263, 3, 7, 3, 1, 2, 0, 0),
(264, 3, 7, 4, 1, 2, 0, 0),
(265, 3, 7, 5, 1, 2, 4, 3),
(266, 3, 7, 6, 1, 2, 4, 3),
(267, 3, 7, 7, 1, 2, 4, 3),
(268, 3, 7, 8, 1, 2, 4, 3),
(269, 3, 7, 9, 1, 2, 4, 3),
(270, 3, 7, 10, 1, 2, 4, 3),
(271, 3, 8, 1, 1, 2, 4, 3),
(272, 3, 8, 2, 1, 2, 4, 3),
(273, 3, 8, 3, 1, 2, 0, 0),
(274, 3, 8, 4, 1, 2, 0, 0),
(275, 3, 8, 5, 1, 2, 0, 0),
(276, 3, 8, 6, 1, 2, 0, 0),
(277, 3, 8, 7, 1, 2, 4, 3),
(278, 3, 8, 8, 1, 2, 4, 3),
(279, 3, 8, 9, 1, 2, 4, 3),
(280, 3, 8, 10, 1, 2, 4, 3),
(281, 3, 9, 1, 1, 2, 4, 3),
(282, 3, 9, 2, 1, 2, 4, 3),
(283, 3, 9, 3, 1, 2, 0, 0),
(284, 3, 9, 4, 1, 2, 0, 0),
(285, 3, 9, 5, 1, 2, 0, 0),
(286, 3, 9, 6, 1, 2, 0, 0),
(287, 3, 9, 7, 1, 2, 0, 0),
(288, 3, 9, 8, 1, 2, 4, 3),
(289, 3, 9, 9, 1, 2, 4, 3),
(290, 3, 9, 10, 1, 2, 4, 3),
(291, 3, 10, 1, 1, 2, 4, 3),
(292, 3, 10, 2, 1, 2, 4, 3),
(293, 3, 10, 3, 1, 2, 4, 3),
(294, 3, 10, 4, 1, 2, 4, 3),
(295, 3, 10, 5, 1, 2, 0, 0),
(296, 3, 10, 6, 1, 2, 0, 0),
(297, 3, 10, 7, 1, 2, 0, 0),
(298, 3, 10, 8, 1, 2, 4, 3),
(299, 3, 10, 9, 1, 2, 4, 3),
(300, 3, 10, 10, 1, 2, 4, 3),
(301, 4, 1, 1, 1, 2, 4, 3),
(302, 4, 1, 2, 1, 2, 4, 3),
(303, 4, 1, 3, 1, 2, 4, 3),
(304, 4, 1, 4, 1, 2, 4, 3),
(305, 4, 1, 5, 1, 2, 4, 3),
(306, 4, 1, 6, 1, 2, 4, 3),
(307, 4, 1, 7, 1, 2, 4, 3),
(308, 4, 1, 8, 1, 2, 4, 3),
(309, 4, 1, 9, 1, 2, 4, 3),
(310, 4, 1, 10, 1, 2, 4, 3),
(311, 4, 2, 1, 1, 2, 4, 3),
(312, 4, 2, 2, 1, 2, 4, 3),
(313, 4, 2, 3, 1, 2, 4, 3),
(314, 4, 2, 4, 1, 2, 4, 3),
(315, 4, 2, 5, 1, 2, 4, 3),
(316, 4, 2, 6, 1, 2, 4, 3),
(317, 4, 2, 7, 1, 2, 4, 3),
(318, 4, 2, 8, 1, 2, 4, 3),
(319, 4, 2, 9, 1, 2, 4, 3),
(320, 4, 2, 10, 1, 2, 4, 3),
(321, 4, 3, 1, 1, 2, 4, 3),
(322, 4, 3, 2, 1, 2, 4, 3),
(323, 4, 3, 3, 1, 2, 4, 3),
(324, 4, 3, 4, 1, 2, 4, 3),
(325, 4, 3, 5, 1, 2, 4, 3),
(326, 4, 3, 6, 1, 2, 4, 3),
(327, 4, 3, 7, 1, 2, 4, 3),
(328, 4, 3, 8, 1, 2, 4, 3),
(329, 4, 3, 9, 1, 2, 4, 3),
(330, 4, 3, 10, 1, 2, 4, 3),
(331, 4, 4, 1, 1, 2, 4, 3),
(332, 4, 4, 2, 1, 2, 4, 3),
(333, 4, 4, 3, 1, 2, 4, 3),
(334, 4, 4, 4, 1, 2, 4, 3),
(335, 4, 4, 5, 1, 2, 4, 3),
(336, 4, 4, 6, 1, 2, 4, 3),
(337, 4, 4, 7, 1, 2, 4, 3),
(338, 4, 4, 8, 1, 2, 4, 3),
(339, 4, 4, 9, 1, 2, 4, 3),
(340, 4, 4, 10, 1, 2, 4, 3),
(341, 4, 5, 1, 1, 2, 4, 3),
(342, 4, 5, 2, 1, 2, 4, 3),
(343, 4, 5, 3, 1, 2, 4, 3),
(344, 4, 5, 4, 1, 2, 4, 3),
(345, 4, 5, 5, 1, 2, 4, 3),
(346, 4, 5, 6, 1, 2, 4, 3),
(347, 4, 5, 7, 1, 2, 4, 3),
(348, 4, 5, 8, 1, 2, 4, 3),
(349, 4, 5, 9, 1, 2, 4, 3),
(350, 4, 5, 10, 1, 2, 4, 3),
(351, 4, 6, 1, 1, 2, 4, 3),
(352, 4, 6, 2, 1, 2, 4, 3),
(353, 4, 6, 3, 1, 2, 4, 3),
(354, 4, 6, 4, 1, 2, 4, 3),
(355, 4, 6, 5, 1, 2, 4, 3),
(356, 4, 6, 6, 1, 2, 4, 3),
(357, 4, 6, 7, 1, 2, 4, 3),
(358, 4, 6, 8, 1, 2, 4, 3),
(359, 4, 6, 9, 1, 2, 4, 3),
(360, 4, 6, 10, 1, 2, 4, 3),
(361, 4, 7, 1, 1, 2, 4, 3),
(362, 4, 7, 2, 1, 2, 4, 3),
(363, 4, 7, 3, 1, 2, 4, 3),
(364, 4, 7, 4, 1, 2, 4, 3),
(365, 4, 7, 5, 1, 2, 4, 3),
(366, 4, 7, 6, 1, 2, 4, 3),
(367, 4, 7, 7, 1, 2, 4, 3),
(368, 4, 7, 8, 1, 2, 4, 3),
(369, 4, 7, 9, 1, 2, 4, 3),
(370, 4, 7, 10, 1, 2, 4, 3),
(371, 4, 8, 1, 1, 2, 4, 3),
(372, 4, 8, 2, 1, 2, 4, 3),
(373, 4, 8, 3, 1, 2, 4, 3),
(374, 4, 8, 4, 1, 2, 4, 3),
(375, 4, 8, 5, 1, 2, 4, 3),
(376, 4, 8, 6, 1, 2, 4, 3),
(377, 4, 8, 7, 1, 2, 4, 3),
(378, 4, 8, 8, 1, 2, 4, 3),
(379, 4, 8, 9, 1, 2, 4, 3),
(380, 4, 8, 10, 1, 2, 4, 3),
(381, 4, 9, 1, 1, 2, 4, 3),
(382, 4, 9, 2, 1, 2, 4, 3),
(383, 4, 9, 3, 1, 2, 4, 3),
(384, 4, 9, 4, 1, 2, 4, 3),
(385, 4, 9, 5, 1, 2, 4, 3),
(386, 4, 9, 6, 1, 2, 4, 3),
(387, 4, 9, 7, 1, 2, 4, 3),
(388, 4, 9, 8, 1, 2, 4, 3),
(389, 4, 9, 9, 1, 2, 4, 3),
(390, 4, 9, 10, 1, 2, 4, 3),
(391, 4, 10, 1, 1, 2, 4, 3),
(392, 4, 10, 2, 1, 2, 4, 3),
(393, 4, 10, 3, 1, 2, 4, 3),
(394, 4, 10, 4, 1, 2, 4, 3),
(395, 4, 10, 5, 1, 2, 4, 3),
(396, 4, 10, 6, 1, 2, 4, 3),
(397, 4, 10, 7, 1, 2, 4, 3),
(398, 4, 10, 8, 1, 2, 4, 3),
(399, 4, 10, 9, 1, 2, 4, 3),
(400, 4, 10, 10, 1, 2, 4, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `s_cell_resources`
--

CREATE TABLE IF NOT EXISTS `s_cell_resources` (
  `id` int(11) NOT NULL,
  `s_cells_id` int(11) NOT NULL COMMENT 'Идентификатор ячейки',
  `d_resources_id` int(11) NOT NULL COMMENT 'Идентификатор ресурса',
  `value` int(11) NOT NULL COMMENT 'Количественное значение ресурса'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Таблица распределения ресурсов по ячейкам карты';

--
-- Дамп данных таблицы `s_cell_resources`
--

INSERT INTO `s_cell_resources` (`id`, `s_cells_id`, `d_resources_id`, `value`) VALUES
(1, 6, 1, 0),
(3, 7, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `s_settlements`
--

CREATE TABLE IF NOT EXISTS `s_settlements` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL COMMENT 'Наименование поселения',
  `s_cells_id` int(11) NOT NULL COMMENT 'Id ячейки на карте'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Поселения';

--
-- Дамп данных таблицы `s_settlements`
--

INSERT INTO `s_settlements` (`id`, `name`, `s_cells_id`) VALUES
(1, 'Ивановка', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `s_social_rules_sets`
--

CREATE TABLE IF NOT EXISTS `s_social_rules_sets` (
  `id` int(11) NOT NULL,
  `s_social_groups_id` int(11) NOT NULL COMMENT 'Id социальной группы, к которой прикреплен данный набор правил'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Наборы социальных правил для социальных групп';

-- --------------------------------------------------------

--
-- Структура таблицы `s_squares`
--

CREATE TABLE IF NOT EXISTS `s_squares` (
  `id` int(11) NOT NULL,
  `x_coord` int(11) NOT NULL,
  `y_coord` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Квадраты, содержащие ячейки карты';

--
-- Дамп данных таблицы `s_squares`
--

INSERT INTO `s_squares` (`id`, `x_coord`, `y_coord`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 1, 2),
(4, 2, 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `d_dirt_types`
--
ALTER TABLE `d_dirt_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `d_races`
--
ALTER TABLE `d_races`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `d_relief_types`
--
ALTER TABLE `d_relief_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `d_resources`
--
ALTER TABLE `d_resources`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `d_resource_groups`
--
ALTER TABLE `d_resource_groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `d_social_groups_types`
--
ALTER TABLE `d_social_groups_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `d_vegetation_types`
--
ALTER TABLE `d_vegetation_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `d_water_resources_types`
--
ALTER TABLE `d_water_resources_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `s_cells`
--
ALTER TABLE `s_cells`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `s_cell_resources`
--
ALTER TABLE `s_cell_resources`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `s_settlements`
--
ALTER TABLE `s_settlements`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `s_social_rules_sets`
--
ALTER TABLE `s_social_rules_sets`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `s_squares`
--
ALTER TABLE `s_squares`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `d_dirt_types`
--
ALTER TABLE `d_dirt_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `d_races`
--
ALTER TABLE `d_races`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `d_relief_types`
--
ALTER TABLE `d_relief_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `d_resources`
--
ALTER TABLE `d_resources`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT для таблицы `d_resource_groups`
--
ALTER TABLE `d_resource_groups`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `d_social_groups_types`
--
ALTER TABLE `d_social_groups_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `d_vegetation_types`
--
ALTER TABLE `d_vegetation_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `d_water_resources_types`
--
ALTER TABLE `d_water_resources_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `s_cells`
--
ALTER TABLE `s_cells`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=401;
--
-- AUTO_INCREMENT для таблицы `s_cell_resources`
--
ALTER TABLE `s_cell_resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `s_settlements`
--
ALTER TABLE `s_settlements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `s_social_rules_sets`
--
ALTER TABLE `s_social_rules_sets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `s_squares`
--
ALTER TABLE `s_squares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
