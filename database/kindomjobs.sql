-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2024 a las 02:17:23
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kindomjobs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `rut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`rut`) VALUES
(11111111),
(20786387),
(23456789);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id_cita` int(11) NOT NULL,
  `fecha_cita` date NOT NULL,
  `id_th` int(11) NOT NULL,
  `rut_cliente` int(11) NOT NULL,
  `rut_profesional` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `rut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`rut`) VALUES
(7466578),
(10208323),
(10367255),
(11086788),
(11111111),
(12345678),
(12783648),
(13082637),
(13476476),
(14565656),
(15098364),
(15727637),
(16235638),
(16377783),
(16767878),
(18267357),
(18273862),
(19286338),
(20786387),
(20876543),
(23456789);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comuna`
--

CREATE TABLE `comuna` (
  `id_comuna` int(11) NOT NULL,
  `nombre_comuna` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_provincia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comuna`
--

INSERT INTO `comuna` (`id_comuna`, `nombre_comuna`, `id_provincia`) VALUES
(1, 'Arica', 1),
(2, 'Camarones', 1),
(3, 'General Lagos', 2),
(4, 'Putre', 2),
(5, 'Alto Hospicio', 3),
(6, 'Iquique', 3),
(7, 'Camiña', 4),
(8, 'Colchane', 4),
(9, 'Huara', 4),
(10, 'Pica', 4),
(11, 'Pozo Almonte', 4),
(12, 'Tocopilla', 5),
(13, 'María Elena', 5),
(14, 'Calama', 6),
(15, 'Ollague', 6),
(16, 'San Pedro de Atacama', 6),
(17, 'Antofagasta', 7),
(18, 'Mejillones', 7),
(19, 'Sierra Gorda', 7),
(20, 'Taltal', 7),
(21, 'Chañaral', 8),
(22, 'Diego de Almagro', 8),
(23, 'Copiapó', 9),
(24, 'Caldera', 9),
(25, 'Tierra Amarilla', 9),
(26, 'Vallenar', 10),
(27, 'Alto del Carmen', 10),
(28, 'Freirina', 10),
(29, 'Huasco', 10),
(30, 'La Serena', 11),
(31, 'Coquimbo', 11),
(32, 'Andacollo', 11),
(33, 'La Higuera', 11),
(34, 'Paihuano', 11),
(35, 'Vicuña', 11),
(36, 'Ovalle', 12),
(37, 'Combarbalá', 12),
(38, 'Monte Patria', 12),
(39, 'Punitaqui', 12),
(40, 'Río Hurtado', 12),
(41, 'Illapel', 13),
(42, 'Canela', 13),
(43, 'Los Vilos', 13),
(44, 'Salamanca', 13),
(45, 'La Ligua', 14),
(46, 'Cabildo', 14),
(47, 'Zapallar', 14),
(48, 'Papudo', 14),
(49, 'Petorca', 14),
(50, 'Los Andes', 15),
(51, 'San Esteban', 15),
(52, 'Calle Larga', 15),
(53, 'Rinconada', 15),
(54, 'San Felipe', 16),
(55, 'Llaillay', 16),
(56, 'Putaendo', 16),
(57, 'Santa María', 16),
(58, 'Catemu', 16),
(59, 'Panquehue', 16),
(60, 'Quillota', 17),
(61, 'La Cruz', 17),
(62, 'La Calera', 17),
(63, 'Nogales', 17),
(64, 'Hijuelas', 17),
(65, 'Valparaíso', 18),
(66, 'Viña del Mar', 18),
(67, 'Concón', 18),
(68, 'Quintero', 18),
(69, 'Puchuncaví', 18),
(70, 'Casablanca', 18),
(71, 'Juan Fernández', 18),
(72, 'San Antonio', 19),
(73, 'Cartagena', 19),
(74, 'El Tabo', 19),
(75, 'El Quisco', 19),
(76, 'Algarrobo', 19),
(77, 'Santo Domingo', 19),
(78, 'Isla de Pascua', 20),
(79, 'Quilpué', 21),
(80, 'Limache', 21),
(81, 'Olmué', 21),
(82, 'Villa Alemana', 21),
(83, 'Colina', 22),
(84, 'Lampa', 22),
(85, 'Tiltil', 22),
(86, 'Santiago', 23),
(87, 'Vitacura', 23),
(88, 'San Ramón', 23),
(89, 'San Miguel', 23),
(90, 'San Joaquín', 23),
(91, 'Renca', 23),
(92, 'Recoleta', 23),
(93, 'Quinta Normal', 23),
(94, 'Quilicura', 23),
(95, 'Pudahuel', 23),
(96, 'Providencia', 23),
(97, 'Peñalolén', 23),
(98, 'Pedro Aguirre Cerda', 23),
(99, 'Ñuñoa', 23),
(100, 'Maipú', 23),
(101, 'Macul', 23),
(102, 'Lo Prado', 23),
(103, 'Lo Espejo', 23),
(104, 'Lo Barnechea', 23),
(105, 'Las Condes', 23),
(106, 'La Reina', 23),
(107, 'La Pintana', 23),
(108, 'La Granja', 23),
(109, 'La Florida', 23),
(110, 'La Cisterna', 23),
(111, 'Independencia', 23),
(112, 'Huechuraba', 23),
(113, 'Estación Central', 23),
(114, 'El Bosque', 23),
(115, 'Conchalí', 23),
(116, 'Cerro Navia', 23),
(117, 'Cerrillos', 23),
(118, 'Puente Alto', 24),
(119, 'San José de Maipo', 24),
(120, 'Pirque', 24),
(121, 'San Bernardo', 25),
(122, 'Buin', 25),
(123, 'Paine', 25),
(124, 'Calera de Tango', 25),
(125, 'Melipilla', 26),
(126, 'Alhué', 26),
(127, 'Curacaví', 26),
(128, 'María Pinto', 26),
(129, 'San Pedro', 26),
(130, 'Isla de Maipo', 27),
(131, 'El Monte', 27),
(132, 'Padre Hurtado', 27),
(133, 'Peñaflor', 27),
(134, 'Talagante', 27),
(135, 'Codegua', 28),
(136, 'Coínco', 28),
(137, 'Coltauco', 28),
(138, 'Doñihue', 28),
(139, 'Graneros', 28),
(140, 'Las Cabras', 28),
(141, 'Machalí', 28),
(142, 'Malloa', 28),
(143, 'Mostazal', 28),
(144, 'Olivar', 28),
(145, 'Peumo', 28),
(146, 'Pichidegua', 28),
(147, 'Quinta de Tilcoco', 28),
(148, 'Rancagua', 28),
(149, 'Rengo', 28),
(150, 'Requínoa', 28),
(151, 'San Vicente de Tagua Tagua', 28),
(152, 'Chépica', 29),
(153, 'Chimbarongo', 29),
(154, 'Lolol', 29),
(155, 'Nancagua', 29),
(156, 'Palmilla', 29),
(157, 'Peralillo', 29),
(158, 'Placilla', 29),
(159, 'Pumanque', 29),
(160, 'San Fernando', 29),
(161, 'Santa Cruz', 29),
(162, 'La Estrella', 30),
(163, 'Litueche', 30),
(164, 'Marchigüe', 30),
(165, 'Navidad', 30),
(166, 'Paredones', 30),
(167, 'Pichilemu', 30),
(168, 'Curicó', 31),
(169, 'Hualañé', 31),
(170, 'Licantén', 31),
(171, 'Molina', 31),
(172, 'Rauco', 31),
(173, 'Romeral', 31),
(174, 'Sagrada Familia', 31),
(175, 'Teno', 31),
(176, 'Vichuquén', 31),
(177, 'Talca', 32),
(178, 'San Clemente', 32),
(179, 'Pelarco', 32),
(180, 'Pencahue', 32),
(181, 'Maule', 32),
(182, 'San Rafael', 32),
(183, 'Curepto', 33),
(184, 'Constitución', 32),
(185, 'Empedrado', 32),
(186, 'Río Claro', 32),
(187, 'Linares', 33),
(188, 'San Javier', 33),
(189, 'Parral', 33),
(190, 'Villa Alegre', 33),
(191, 'Longaví', 33),
(192, 'Colbún', 33),
(193, 'Retiro', 33),
(194, 'Yerbas Buenas', 33),
(195, 'Cauquenes', 34),
(196, 'Chanco', 34),
(197, 'Pelluhue', 34),
(198, 'Bulnes', 35),
(199, 'Chillán', 35),
(200, 'Chillán Viejo', 35),
(201, 'El Carmen', 35),
(202, 'Pemuco', 35),
(203, 'Pinto', 35),
(204, 'Quillón', 35),
(205, 'San Ignacio', 35),
(206, 'Yungay', 35),
(207, 'Cobquecura', 36),
(208, 'Coelemu', 36),
(209, 'Ninhue', 36),
(210, 'Portezuelo', 36),
(211, 'Quirihue', 36),
(212, 'Ránquil', 36),
(213, 'Treguaco', 36),
(214, 'San Carlos', 37),
(215, 'Coihueco', 37),
(216, 'San Nicolás', 37),
(217, 'Ñiquén', 37),
(218, 'San Fabián', 37),
(219, 'Alto Biobío', 38),
(220, 'Antuco', 38),
(221, 'Cabrero', 38),
(222, 'Laja', 38),
(223, 'Los Ángeles', 38),
(224, 'Mulchén', 38),
(225, 'Nacimiento', 38),
(226, 'Negrete', 38),
(227, 'Quilaco', 38),
(228, 'Quilleco', 38),
(229, 'San Rosendo', 38),
(230, 'Santa Bárbara', 38),
(231, 'Tucapel', 38),
(232, 'Yumbel', 38),
(233, 'Concepción', 39),
(234, 'Coronel', 39),
(235, 'Chiguayante', 39),
(236, 'Florida', 39),
(237, 'Hualpén', 39),
(238, 'Hualqui', 39),
(239, 'Lota', 39),
(240, 'Penco', 39),
(241, 'San Pedro de La Paz', 39),
(242, 'Santa Juana', 39),
(243, 'Talcahuano', 39),
(244, 'Tomé', 39),
(245, 'Arauco', 40),
(246, 'Cañete', 40),
(247, 'Contulmo', 40),
(248, 'Curanilahue', 40),
(249, 'Lebu', 40),
(250, 'Los Álamos', 40),
(251, 'Tirúa', 40),
(252, 'Angol', 41),
(253, 'Collipulli', 41),
(254, 'Curacautín', 41),
(255, 'Ercilla', 41),
(256, 'Lonquimay', 41),
(257, 'Los Sauces', 41),
(258, 'Lumaco', 41),
(259, 'Purén', 41),
(260, 'Renaico', 41),
(261, 'Traiguén', 41),
(262, 'Victoria', 41),
(263, 'Temuco', 42),
(264, 'Carahue', 42),
(265, 'Cholchol', 42),
(266, 'Cunco', 42),
(267, 'Curarrehue', 42),
(268, 'Freire', 42),
(269, 'Galvarino', 42),
(270, 'Gorbea', 42),
(271, 'Lautaro', 42),
(272, 'Loncoche', 42),
(273, 'Melipeuco', 42),
(274, 'Nueva Imperial', 42),
(275, 'Padre Las Casas', 42),
(276, 'Perquenco', 42),
(277, 'Pitrufquén', 42),
(278, 'Pucón', 42),
(279, 'Saavedra', 42),
(280, 'Teodoro Schmidt', 42),
(281, 'Toltén', 42),
(282, 'Vilcún', 42),
(283, 'Villarrica', 42),
(284, 'Valdivia', 43),
(285, 'Corral', 43),
(286, 'Lanco', 43),
(287, 'Los Lagos', 43),
(288, 'Máfil', 43),
(289, 'Mariquina', 43),
(290, 'Paillaco', 43),
(291, 'Panguipulli', 43),
(292, 'La Unión', 44),
(293, 'Futrono', 44),
(294, 'Lago Ranco', 44),
(295, 'Río Bueno', 44),
(296, 'Osorno', 45),
(297, 'Puerto Octay', 45),
(298, 'Purranque', 45),
(299, 'Puyehue', 45),
(300, 'Río Negro', 45),
(301, 'San Juan de la Costa', 45),
(302, 'San Pablo', 45),
(303, 'Calbuco', 46),
(304, 'Cochamó', 46),
(305, 'Fresia', 46),
(306, 'Frutillar', 46),
(307, 'Llanquihue', 46),
(308, 'Los Muermos', 46),
(309, 'Maullín', 46),
(310, 'Puerto Montt', 46),
(311, 'Puerto Varas', 46),
(312, 'Ancud', 47),
(313, 'Castro', 47),
(314, 'Chonchi', 47),
(315, 'Curaco de Vélez', 47),
(316, 'Dalcahue', 47),
(317, 'Puqueldón', 47),
(318, 'Queilén', 47),
(319, 'Quellón', 47),
(320, 'Quemchi', 47),
(321, 'Quinchao', 47),
(322, 'Chaitén', 48),
(323, 'Futaleufú', 48),
(324, 'Hualaihué', 48),
(325, 'Palena', 48),
(326, 'Lago Verde', 49),
(327, 'Coihaique', 49),
(328, 'Aysén', 50),
(329, 'Cisnes', 50),
(330, 'Guaitecas', 50),
(331, 'Río Ibáñez', 51),
(332, 'Chile Chico', 51),
(333, 'Cochrane', 52),
(334, 'O\'Higgins', 52),
(335, 'Tortel', 52),
(336, 'Natales', 53),
(337, 'Torres del Paine', 53),
(338, 'Laguna Blanca', 54),
(339, 'Punta Arenas', 54),
(340, 'Río Verde', 54),
(341, 'San Gregorio', 54),
(342, 'Porvenir', 55),
(343, 'Primavera', 55),
(344, 'Timaukel', 55),
(345, 'Cabo de Hornos', 56),
(346, 'Antártica', 56);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidad`
--

CREATE TABLE `disponibilidad` (
  `id_disponibilidad` int(11) NOT NULL,
  `rut_profesional` int(11) NOT NULL,
  `rut_cliente` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `disponible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `disponibilidad`
--

INSERT INTO `disponibilidad` (`id_disponibilidad`, `rut_profesional`, `rut_cliente`, `fecha`, `hora`, `disponible`) VALUES
(1, 14565656, NULL, '2024-11-25', '08:00:00', 1),
(2, 14565656, NULL, '2024-11-25', '09:00:00', 1),
(3, 14565656, NULL, '2024-11-25', '10:00:00', 1),
(4, 14565656, NULL, '2024-11-25', '11:00:00', 1),
(5, 14565656, NULL, '2024-11-25', '12:00:00', 1),
(6, 14565656, NULL, '2024-11-25', '13:00:00', 1),
(7, 14565656, NULL, '2024-11-25', '14:00:00', 1),
(8, 14565656, NULL, '2024-11-25', '15:00:00', 1),
(9, 14565656, NULL, '2024-11-25', '16:00:00', 1),
(10, 14565656, NULL, '2024-11-25', '17:00:00', 1),
(11, 14565656, NULL, '2024-11-25', '18:00:00', 1),
(12, 14565656, NULL, '2024-11-25', '19:00:00', 1),
(13, 14565656, NULL, '2024-11-25', '20:00:00', 1),
(14, 14565656, NULL, '2024-11-25', '21:00:00', 1),
(15, 14565656, NULL, '2024-12-02', '08:00:00', 1),
(16, 14565656, NULL, '2024-12-02', '09:00:00', 1),
(17, 14565656, NULL, '2024-12-02', '10:00:00', 1),
(18, 14565656, NULL, '2024-12-02', '11:00:00', 1),
(19, 14565656, NULL, '2024-12-02', '12:00:00', 1),
(20, 14565656, NULL, '2024-12-02', '13:00:00', 1),
(21, 14565656, NULL, '2024-12-02', '14:00:00', 1),
(22, 14565656, NULL, '2024-12-02', '15:00:00', 1),
(23, 14565656, NULL, '2024-12-02', '16:00:00', 1),
(24, 14565656, NULL, '2024-12-02', '17:00:00', 1),
(25, 14565656, NULL, '2024-12-02', '18:00:00', 1),
(26, 14565656, NULL, '2024-12-02', '19:00:00', 1),
(27, 14565656, NULL, '2024-12-02', '20:00:00', 1),
(28, 14565656, NULL, '2024-12-02', '21:00:00', 1),
(29, 14565656, NULL, '2024-12-09', '08:00:00', 1),
(30, 14565656, NULL, '2024-12-09', '09:00:00', 1),
(31, 14565656, NULL, '2024-12-09', '10:00:00', 1),
(32, 14565656, NULL, '2024-12-09', '11:00:00', 1),
(33, 14565656, NULL, '2024-12-09', '12:00:00', 1),
(34, 14565656, NULL, '2024-12-09', '13:00:00', 1),
(35, 14565656, NULL, '2024-12-09', '14:00:00', 1),
(36, 14565656, NULL, '2024-12-09', '15:00:00', 1),
(37, 14565656, NULL, '2024-12-09', '16:00:00', 1),
(38, 14565656, NULL, '2024-12-09', '17:00:00', 1),
(39, 14565656, NULL, '2024-12-09', '18:00:00', 1),
(40, 14565656, NULL, '2024-12-09', '19:00:00', 1),
(41, 14565656, NULL, '2024-12-09', '20:00:00', 1),
(42, 14565656, NULL, '2024-12-09', '21:00:00', 1),
(43, 14565656, NULL, '2024-11-26', '09:00:00', 1),
(44, 14565656, NULL, '2024-11-26', '10:00:00', 1),
(45, 14565656, NULL, '2024-11-26', '11:00:00', 1),
(46, 14565656, NULL, '2024-11-26', '12:00:00', 1),
(47, 14565656, NULL, '2024-11-26', '13:00:00', 1),
(48, 14565656, NULL, '2024-11-26', '14:00:00', 1),
(49, 14565656, NULL, '2024-11-26', '15:00:00', 1),
(50, 14565656, NULL, '2024-11-26', '16:00:00', 1),
(51, 14565656, NULL, '2024-11-26', '17:00:00', 1),
(52, 14565656, NULL, '2024-11-26', '18:00:00', 1),
(53, 14565656, NULL, '2024-11-26', '19:00:00', 1),
(54, 14565656, NULL, '2024-11-26', '20:00:00', 1),
(55, 14565656, NULL, '2024-11-26', '21:00:00', 1),
(56, 14565656, NULL, '2024-12-03', '09:00:00', 1),
(57, 14565656, NULL, '2024-12-03', '10:00:00', 1),
(58, 14565656, NULL, '2024-12-03', '11:00:00', 1),
(59, 14565656, NULL, '2024-12-03', '12:00:00', 1),
(60, 14565656, NULL, '2024-12-03', '13:00:00', 1),
(61, 14565656, NULL, '2024-12-03', '14:00:00', 1),
(62, 14565656, NULL, '2024-12-03', '15:00:00', 1),
(63, 14565656, NULL, '2024-12-03', '16:00:00', 1),
(64, 14565656, NULL, '2024-12-03', '17:00:00', 1),
(65, 14565656, NULL, '2024-12-03', '18:00:00', 1),
(66, 14565656, NULL, '2024-12-03', '19:00:00', 1),
(67, 14565656, NULL, '2024-12-03', '20:00:00', 1),
(68, 14565656, NULL, '2024-12-03', '21:00:00', 1),
(69, 14565656, NULL, '2024-12-10', '09:00:00', 1),
(70, 14565656, NULL, '2024-12-10', '10:00:00', 1),
(71, 14565656, NULL, '2024-12-10', '11:00:00', 1),
(72, 14565656, NULL, '2024-12-10', '12:00:00', 1),
(73, 14565656, NULL, '2024-12-10', '13:00:00', 1),
(74, 14565656, NULL, '2024-12-10', '14:00:00', 1),
(75, 14565656, NULL, '2024-12-10', '15:00:00', 1),
(76, 14565656, NULL, '2024-12-10', '16:00:00', 1),
(77, 14565656, NULL, '2024-12-10', '17:00:00', 1),
(78, 14565656, NULL, '2024-12-10', '18:00:00', 1),
(79, 14565656, NULL, '2024-12-10', '19:00:00', 1),
(80, 14565656, NULL, '2024-12-10', '20:00:00', 1),
(81, 14565656, NULL, '2024-12-10', '21:00:00', 1),
(82, 14565656, NULL, '2024-11-27', '09:15:00', 1),
(83, 14565656, NULL, '2024-11-27', '10:15:00', 1),
(84, 14565656, NULL, '2024-11-27', '11:15:00', 1),
(85, 14565656, NULL, '2024-11-27', '12:15:00', 1),
(86, 14565656, NULL, '2024-11-27', '13:15:00', 1),
(87, 14565656, NULL, '2024-11-27', '14:15:00', 1),
(88, 14565656, NULL, '2024-11-27', '15:15:00', 1),
(89, 14565656, NULL, '2024-11-27', '16:15:00', 1),
(90, 14565656, NULL, '2024-11-27', '17:15:00', 1),
(91, 14565656, NULL, '2024-11-27', '18:15:00', 1),
(92, 14565656, NULL, '2024-11-27', '19:15:00', 1),
(93, 14565656, NULL, '2024-11-27', '20:15:00', 1),
(94, 14565656, NULL, '2024-11-27', '21:15:00', 1),
(95, 14565656, NULL, '2024-12-04', '09:15:00', 1),
(96, 14565656, NULL, '2024-12-04', '10:15:00', 1),
(97, 14565656, NULL, '2024-12-04', '11:15:00', 1),
(98, 14565656, NULL, '2024-12-04', '12:15:00', 1),
(99, 14565656, NULL, '2024-12-04', '13:15:00', 1),
(100, 14565656, NULL, '2024-12-04', '14:15:00', 1),
(101, 14565656, NULL, '2024-12-04', '15:15:00', 1),
(102, 14565656, NULL, '2024-12-04', '16:15:00', 1),
(103, 14565656, NULL, '2024-12-04', '17:15:00', 1),
(104, 14565656, NULL, '2024-12-04', '18:15:00', 1),
(105, 14565656, NULL, '2024-12-04', '19:15:00', 1),
(106, 14565656, NULL, '2024-12-04', '20:15:00', 1),
(107, 14565656, NULL, '2024-12-04', '21:15:00', 1),
(108, 14565656, NULL, '2024-12-11', '09:15:00', 1),
(109, 14565656, NULL, '2024-12-11', '10:15:00', 1),
(110, 14565656, NULL, '2024-12-11', '11:15:00', 1),
(111, 14565656, NULL, '2024-12-11', '12:15:00', 1),
(112, 14565656, NULL, '2024-12-11', '13:15:00', 1),
(113, 14565656, NULL, '2024-12-11', '14:15:00', 1),
(114, 14565656, NULL, '2024-12-11', '15:15:00', 1),
(115, 14565656, NULL, '2024-12-11', '16:15:00', 1),
(116, 14565656, NULL, '2024-12-11', '17:15:00', 1),
(117, 14565656, NULL, '2024-12-11', '18:15:00', 1),
(118, 14565656, NULL, '2024-12-11', '19:15:00', 1),
(119, 14565656, NULL, '2024-12-11', '20:15:00', 1),
(120, 14565656, NULL, '2024-12-11', '21:15:00', 1),
(121, 14565656, NULL, '2024-11-28', '09:30:00', 1),
(122, 14565656, NULL, '2024-11-28', '10:30:00', 1),
(123, 14565656, NULL, '2024-11-28', '11:30:00', 1),
(124, 14565656, NULL, '2024-11-28', '12:30:00', 1),
(125, 14565656, NULL, '2024-11-28', '13:30:00', 1),
(126, 14565656, NULL, '2024-11-28', '14:30:00', 1),
(127, 14565656, NULL, '2024-11-28', '15:30:00', 1),
(128, 14565656, NULL, '2024-11-28', '16:30:00', 1),
(129, 14565656, NULL, '2024-11-28', '17:30:00', 1),
(130, 14565656, NULL, '2024-11-28', '18:30:00', 1),
(131, 14565656, NULL, '2024-11-28', '19:30:00', 1),
(132, 14565656, NULL, '2024-12-05', '09:30:00', 1),
(133, 14565656, NULL, '2024-12-05', '10:30:00', 1),
(134, 14565656, NULL, '2024-12-05', '11:30:00', 1),
(135, 14565656, NULL, '2024-12-05', '12:30:00', 1),
(136, 14565656, NULL, '2024-12-05', '13:30:00', 1),
(137, 14565656, NULL, '2024-12-05', '14:30:00', 1),
(138, 14565656, NULL, '2024-12-05', '15:30:00', 1),
(139, 14565656, NULL, '2024-12-05', '16:30:00', 1),
(140, 14565656, NULL, '2024-12-05', '17:30:00', 1),
(141, 14565656, NULL, '2024-12-05', '18:30:00', 1),
(142, 14565656, NULL, '2024-12-05', '19:30:00', 1),
(143, 14565656, NULL, '2024-12-12', '09:30:00', 1),
(144, 14565656, NULL, '2024-12-12', '10:30:00', 1),
(145, 14565656, NULL, '2024-12-12', '11:30:00', 1),
(146, 14565656, NULL, '2024-12-12', '12:30:00', 1),
(147, 14565656, NULL, '2024-12-12', '13:30:00', 1),
(148, 14565656, NULL, '2024-12-12', '14:30:00', 1),
(149, 14565656, NULL, '2024-12-12', '15:30:00', 1),
(150, 14565656, NULL, '2024-12-12', '16:30:00', 1),
(151, 14565656, NULL, '2024-12-12', '17:30:00', 1),
(152, 14565656, NULL, '2024-12-12', '18:30:00', 1),
(153, 14565656, NULL, '2024-12-12', '19:30:00', 1),
(154, 14565656, NULL, '2024-11-29', '11:00:00', 1),
(155, 14565656, NULL, '2024-11-29', '12:00:00', 1),
(156, 14565656, NULL, '2024-11-29', '13:00:00', 1),
(157, 14565656, NULL, '2024-12-06', '11:00:00', 1),
(158, 14565656, NULL, '2024-12-06', '12:00:00', 1),
(159, 14565656, NULL, '2024-12-06', '13:00:00', 1),
(160, 14565656, NULL, '2024-12-13', '11:00:00', 1),
(161, 14565656, NULL, '2024-12-13', '12:00:00', 1),
(162, 14565656, NULL, '2024-12-13', '13:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_usuario`
--

CREATE TABLE `estado_usuario` (
  `id_estado_usuario` int(11) NOT NULL,
  `nombre_estado_usuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_usuario`
--

INSERT INTO `estado_usuario` (`id_estado_usuario`, `nombre_estado_usuario`) VALUES
(1, 'Activado'),
(2, 'Desactivado'),
(3, 'Bloqueado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `rut_usuario` int(11) NOT NULL,
  `rut_profesional` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_respuesta`
--

CREATE TABLE `foro_respuesta` (
  `id_respuesta` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `rut_usuario` int(11) NOT NULL,
  `contenido_respuesta` text NOT NULL,
  `mejor_respuesta` tinyint(1) DEFAULT 0,
  `fecha_respuesta` timestamp NOT NULL DEFAULT current_timestamp(),
  `votos_positivos` int(11) DEFAULT 0,
  `votos_negativos` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `foro_respuesta`
--

INSERT INTO `foro_respuesta` (`id_respuesta`, `id_tema`, `rut_usuario`, `contenido_respuesta`, `mejor_respuesta`, `fecha_respuesta`, `votos_positivos`, `votos_negativos`) VALUES
(3, 1, 20786387, 'Y también puedo escribir las respuestas que quiero...', 0, '2024-11-27 00:03:27', 1, 0),
(4, 1, 20786387, 'Una y otra vez...', 0, '2024-11-27 00:05:06', 0, 0),
(5, 1, 20786387, 'Probando probando', 0, '2024-11-27 00:08:09', 0, 0),
(6, 1, 20786387, '123 123', 0, '2024-11-27 00:23:41', 0, 1),
(7, 1, 20786387, '456 456', 0, '2024-11-27 00:58:17', 0, 0),
(8, 1, 20786387, 'Parece que la cosa funciona...', 0, '2024-11-27 01:13:35', 0, 0),
(9, 1, 20786387, 'Y sigue funcionado :O', 0, '2024-11-27 01:46:39', 0, 0),
(10, 1, 20786387, 'Sigamos probando', 0, '2024-11-27 01:47:26', 0, 0),
(11, 1, 20786387, 'Probandooooo', 0, '2024-11-27 01:53:25', 0, 0),
(12, 1, 20786387, 'Seguimos probando', 0, '2024-11-27 01:54:47', 0, 0),
(13, 1, 20786387, 'Y seguimos, y seguimos probando...', 0, '2024-11-27 01:56:11', 0, 0),
(14, 1, 20786387, 'Una vez más, probando...', 0, '2024-11-27 01:56:26', 0, 0),
(15, 1, 20786387, 'Vamos bien, vamos bien', 0, '2024-11-27 01:57:13', 0, 0),
(16, 1, 20786387, 'Vamos vamosss', 0, '2024-11-27 01:57:32', 0, 0),
(17, 1, 20786387, 'Ahora tiene colores cuando se envía una nueva respuesta', 0, '2024-11-27 01:58:21', 0, 0),
(18, 1, 20786387, 'Otra prueba más', 0, '2024-11-27 02:19:04', 0, 0),
(19, 1, 11086788, 'Hola hola', 0, '2024-11-27 02:21:20', 0, 0),
(20, 2, 11086788, 'Dame ideas para preguntar...', 0, '2024-11-27 02:21:47', 2, 0),
(21, 1, 12345678, 'Finally, problema solucionado...', 0, '2024-11-27 02:22:52', 0, 0),
(22, 1, 12345678, 'Y cerrado', 0, '2024-11-27 02:23:15', 0, 0),
(23, 1, 12345678, 'And solved', 0, '2024-11-27 02:23:30', 0, 0),
(24, 2, 12345678, 'No sé, dime tú...', 1, '2024-11-27 02:23:55', 0, 0),
(25, 4, 20786387, 'Y cuando el tema ya no sea tema, entonces el tema será tema cuando la gente quiere que sea tema, o sea nunca... Mucho gusto estimado', 0, '2024-11-27 02:28:53', 0, 0),
(26, 3, 20786387, 'Ideas de qué, solo si es que se puede saber?', 0, '2024-11-27 02:29:22', 1, 0),
(29, 3, 20786387, 'Alo', 0, '2024-11-27 06:13:23', 1, 0),
(30, 3, 20786387, 'Alo Alo', 0, '2024-11-27 06:14:50', 1, 0),
(31, 3, 20786387, 'Alo Alooooo', 0, '2024-11-27 06:18:51', 1, 0),
(32, 3, 20786387, 'Hola Holaaaa', 0, '2024-11-27 15:03:55', 1, 0),
(33, 3, 20786387, 'Holaaaaaa', 0, '2024-11-27 15:06:42', 1, 0),
(34, 1, 20786387, 'Hola', 0, '2024-11-27 15:13:35', 0, 0),
(35, 1, 20786387, 'A ver A veer', 0, '2024-11-27 15:57:10', 0, 0),
(36, 1, 20786387, 'Alo', 0, '2024-11-27 15:58:17', 0, 0),
(37, 1, 20786387, 'Holaaa', 0, '2024-11-27 16:20:27', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_tema`
--

CREATE TABLE `foro_tema` (
  `id_tema` int(11) NOT NULL,
  `titulo_tema` varchar(255) NOT NULL,
  `contenido_tema` text NOT NULL,
  `rut_cliente` int(11) NOT NULL,
  `estado_tema` enum('abierto','cerrado','resuelto','no_resuelto') DEFAULT 'abierto',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `foro_tema`
--

INSERT INTO `foro_tema` (`id_tema`, `titulo_tema`, `contenido_tema`, `rut_cliente`, `estado_tema`, `fecha_creacion`) VALUES
(1, 'Tema de prueba', 'Aquí hago las preguntas que quiero', 20786387, 'resuelto', '2024-11-26 23:35:00'),
(2, 'Otro tema de prueba', 'Esto está interesante... A ver, qué puedo preguntar aquí...', 20786387, 'abierto', '2024-11-26 23:43:09'),
(3, 'Ideas, ideas', 'Ideaaaas, necesito ideaaaas', 12345678, 'cerrado', '2024-11-27 02:24:29'),
(4, 'Otro temita', 'Y el tema es tema cuando el tema ya no es tema :O', 14565656, 'resuelto', '2024-11-27 02:27:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_voto_respuesta`
--

CREATE TABLE `foro_voto_respuesta` (
  `id_voto` int(11) NOT NULL,
  `id_respuesta` int(11) NOT NULL,
  `rut_usuario` int(11) NOT NULL,
  `tipo_voto` enum('positivo','negativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `foro_voto_respuesta`
--

INSERT INTO `foro_voto_respuesta` (`id_voto`, `id_respuesta`, `rut_usuario`, `tipo_voto`) VALUES
(5, 3, 11086788, 'positivo'),
(7, 6, 11086788, 'negativo'),
(8, 20, 12345678, 'positivo'),
(37, 32, 20786387, 'positivo'),
(38, 31, 20786387, 'positivo'),
(39, 30, 20786387, 'positivo'),
(40, 29, 20786387, 'positivo'),
(43, 33, 20786387, 'positivo'),
(44, 26, 20786387, 'positivo'),
(53, 20, 20786387, 'positivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `id_institucion` int(11) NOT NULL,
  `nombre_institucion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`id_institucion`, `nombre_institucion`) VALUES
(1, 'Universidad Católica de la Santísima Concepción'),
(2, 'Universidad de Concepción'),
(3, 'Universidad del Bío-Bío'),
(4, 'Universidad San Sebastián'),
(5, 'Universidad de Las Américas'),
(6, 'Universidad Andrés Bello'),
(7, 'Universidad de Chile'),
(8, 'Pontificia Universidad Católica de Chile'),
(9, 'Universidad Autónoma de Chile'),
(10, 'Universidad de Santiago de Chile'),
(11, 'Universidad Técnica Federico Santa María'),
(12, 'Pontificia Universidad Católica de Valparaíso'),
(13, 'Universidad Católica del Norte'),
(14, 'Universidad de La Serena'),
(15, 'Universidad Bernardo O\'Higgins'),
(16, 'Universidad Católica del Maule'),
(17, 'Universidad Católica de Temuco'),
(18, 'Universidad Austral de Chile'),
(19, 'Universidad de Talca'),
(20, 'Universidad de Valparaíso'),
(21, 'Universidad del Desarrollo'),
(22, 'Universidad Diego Portales'),
(23, 'Universidad de La Frontera'),
(24, 'Universidad de Los Andes'),
(25, 'Universidad Adolfo Ibáñez'),
(26, 'Universidad de Tarapacá'),
(27, 'Universidad Central de Chile'),
(28, 'Universidad Mayor'),
(29, 'Universidad de Antofagasta'),
(30, 'Universidad Alberto Hurtado'),
(31, 'Universidad de Playa Ancha'),
(32, 'Universidad Arturo Prat'),
(33, 'Universidad Tecnológica Metropolitana'),
(34, 'Universidad Finis Terrae'),
(35, 'Universidad de Los Lagos'),
(36, 'Universidad de Magallanes'),
(37, 'Universidad de Atacama'),
(38, 'Universidad Santo Tomás'),
(39, 'Universidad Metropolitana de Ciencias de la Educación'),
(40, 'Universidad de O\'Higgins'),
(41, 'Universidad Católica Silva Henríquez'),
(42, 'Universidad Gabriela Mistral'),
(43, 'Universidad de Aysén'),
(44, 'Universidad Viña del Mar'),
(45, 'Universidad Adventista de Chile'),
(46, 'Universidad Academia de Humanismo Cristiano'),
(47, 'Universidad SEK'),
(48, 'Universidad del Alba'),
(49, 'Universidad UNIACC'),
(50, 'Universidad Miguel de Cervantes'),
(51, 'Universidad de Aconcagua'),
(52, 'Universidad Bolivariana'),
(53, 'Universidad La República'),
(54, 'Universidad Los Leones'),
(55, 'Universidad Tecnológica de Chile - INACAP'),
(56, 'Duoc UC'),
(57, 'Instituto Profesional EATRI'),
(58, 'Instituto Profesional AIEP'),
(59, 'Instituto Superior de Artes y Ciencias de la Comunicación (IACC)'),
(60, 'Instituto Profesional de Chile (IPCHILE)'),
(61, 'Instituto Profesional Latinoamericano de Comercio Exterior (IPLACEX)'),
(62, 'Instituto Profesional Diego Portales'),
(63, 'Escuela Moderna de Música y Danza'),
(64, 'Instituto Profesional Providencia (IPP)'),
(65, 'Instituto Profesional Virginio Gómez'),
(66, 'Instituto Profesional Los Leones'),
(67, 'Instituto Nacional del Fútbol, Deporte y Actividad Física (INAF)'),
(68, 'Instituto Profesional ESUCOMEX'),
(69, 'Escuela de Cine de Chile'),
(70, 'Instituto Profesional Chileno Norteamericano'),
(71, 'Instituto Profesional Valle Central'),
(72, 'Instituto Profesional Projazz'),
(73, 'Instituto Profesional Ciisa'),
(74, 'Instituto Profesional de Artes Culinarias y Servicios'),
(75, 'Instituto Profesional Escuela de Comercio de Santiago'),
(76, 'Instituto Profesional Escuela de Contadores Auditores'),
(77, 'Instituto Profesional Los Lagos'),
(78, 'Instituto Profesional Galdámez (IPG)'),
(79, 'Instituto Profesional Carlos Casanueva'),
(80, 'Instituto Guillermo Subercaseaux'),
(81, 'Instituto Profesional Alemán Wilhelm von Humboldt'),
(82, 'Instituto Profesional Agrario Adolfo Matthei'),
(83, 'Instituto Profesional Libertador de Los Andes (IPLA)'),
(84, 'Instituto Profesional de Ciencias de la Computación Acuario Data'),
(85, 'Instituto Profesional Chileno Británico de Cultura'),
(86, 'Instituto Profesional de Artes Escénicas Karen Connolly'),
(87, 'Instituto Profesional de Los Ángeles'),
(88, 'Instituto Profesional INACAP'),
(89, 'Instituto Profesional Santo Tomás'),
(90, 'Centro de Formación Técnica INACAP'),
(91, 'Centro de Formación Técnica ENAC'),
(92, 'Corporación Centro de Formación Técnica de la Pontificia Universidad Católica de Valparaíso'),
(93, 'Centro de Formación Técnica San Agustín de Talca'),
(94, 'Centro de Formación Técnica Santo Tomás'),
(95, 'CEDUC UCN'),
(96, 'Centro de Formación Técnica Lota Arauco'),
(97, 'Centro de Formación Técnica Teodoro Wickel Klüwen'),
(98, 'Centro de Formación Técnica Escuela Culinaria Francesa'),
(99, 'Centro de Formación Técnica Juan Bohon'),
(100, 'Centro de Formación Técnica IPROSEC'),
(101, 'Centro de Formación Técnica Alpes'),
(102, 'Centro de Formación Técnica Manpower'),
(103, 'Centro de Formación Técnica CENCO'),
(104, 'Centro de Formación Técnica del Medio Ambiente IDMA'),
(105, 'Centro de Formación Técnica Canon'),
(106, 'Centro de Formación Técnica Escuela de Comercio de Santiago'),
(107, 'Centro de Formación Técnica Instituto Central de Capacitación Educacional (ICCE)'),
(108, 'Centro de Formación Técnica ICEL'),
(109, 'Centro de Formación Técnica Instituto Tecnológico de Chile (ITC)'),
(110, 'Centro de Formación Técnica Centro Tecnológico Superior INFOMED'),
(111, 'Centro de Formación Técnica de la Industria Gráfica'),
(112, 'Centro de Formación Técnica EDUCAP'),
(113, 'Centro de Formación Técnica Laplace'),
(114, 'Centro de Formación Técnica Los Lagos'),
(115, 'Centro de Formación Técnica Massachusetts'),
(116, 'Centro de Formación Técnica PRODATA'),
(117, 'Centro de Formación Técnica Instituto Superior Alemán de Comercio'),
(118, 'Centro de Formación Técnica PROFASOC'),
(119, 'Centro de Formación Técnica Asiste'),
(120, 'Centro de Formación Técnica Estatal de la Región del Maule'),
(121, 'Centro de Formación Técnica Estatal de la Región de La Araucanía'),
(122, 'Centro de Formación Técnica Estatal de la Región de Valparaíso'),
(123, 'Centro de Formación Técnica Estatal de la Región de Coquimbo'),
(124, 'Centro de Formación Técnica Estatal de la Región de Tarapacá'),
(125, 'Centro de Formación Técnica Estatal de la Región de Los Lagos'),
(126, 'Centro de Formación Técnica Estatal de la Región de Los Ríos'),
(127, 'Centro de Formación Técnica Estatal de la Región de Antofagasta'),
(128, 'Centro de Formación Técnica Estatal de la Región Metropolitana'),
(129, 'Centro de Formación Técnica Estatal de la Región de Magallanes'),
(130, 'Centro de Formación Técnica Estatal de la Región de Arica y Parinacota'),
(131, 'Centro de Formación Técnica Estatal de la Región de Atacama'),
(132, 'Centro de Formación Técnica Estatal de la Región de O\'Higgins'),
(133, 'Centro de Formación Técnica Estatal de la Región del Biobío'),
(134, 'Centro de Formación Técnica Estatal de la Región de Aysén'),
(135, 'Centro de Formación Técnica Academia Chilena de Yoga');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar_atencion_presencial`
--

CREATE TABLE `lugar_atencion_presencial` (
  `rut_profesional` int(11) NOT NULL,
  `id_comuna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lugar_atencion_presencial`
--

INSERT INTO `lugar_atencion_presencial` (`rut_profesional`, `id_comuna`) VALUES
(14565656, 78),
(14565656, 79);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar_atencion_virtual`
--

CREATE TABLE `lugar_atencion_virtual` (
  `id_lugar_at_virtual` int(11) NOT NULL,
  `rut_profesional` int(11) NOT NULL,
  `link_sala_virtual` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id_mensaje` int(11) NOT NULL,
  `rut_cliente` int(11) NOT NULL,
  `rut_profesional` int(11) NOT NULL,
  `contenido_mensaje` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id_permiso` int(11) NOT NULL,
  `nombre_permiso` varchar(50) NOT NULL,
  `descripcion_permiso` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id_permiso`, `nombre_permiso`, `descripcion_permiso`) VALUES
(1, 'admin_panel_access', 'Acceder al panel de administración'),
(2, 'mantainers_manage', 'Gestionar los mantenedores de la plataforma'),
(3, 'user_accounts_manage', 'Gestionar las cuentas de usuario'),
(4, 'professional_authorization', 'Gestionar autorizaciones de profesionales'),
(5, 'admin_manage', 'Gestionar administradores de la plataforma'),
(6, 'professional_pages_access', 'Acceder a las páginas de profesionales'),
(7, 'client_pages_access', 'Acceder a las páginas de clientes'),
(8, 'permission_manage', 'Gestionar permisos para roles de usuario'),
(9, 'servicio_profesion_manage', 'Gestionar servicios disponibles para cada profesión'),
(10, 'foro_access', 'Acceder a los foros disponibles de la plataforma'),
(11, 'foro_topic_create', 'Crear temas en los foros disponibles de la plataforma');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_rol`
--

CREATE TABLE `permiso_rol` (
  `id_rol` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permiso_rol`
--

INSERT INTO `permiso_rol` (`id_rol`, `id_permiso`) VALUES
(1, 1),
(2, 1),
(1, 2),
(1, 3),
(2, 3),
(1, 4),
(2, 4),
(1, 5),
(1, 6),
(2, 6),
(3, 6),
(1, 7),
(2, 7),
(3, 7),
(4, 7),
(1, 8),
(1, 9),
(1, 10),
(2, 10),
(3, 10),
(4, 10),
(1, 11),
(2, 11),
(3, 11),
(4, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesion`
--

CREATE TABLE `profesion` (
  `id_profesion` int(11) NOT NULL,
  `nombre_profesion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesion`
--

INSERT INTO `profesion` (`id_profesion`, `nombre_profesion`) VALUES
(1, 'Ingeniero Civil en Computación e Informática'),
(2, 'Ingeniero Civil Industrial'),
(3, 'Ingeniero Civil Geológico'),
(4, 'Ingeniero Civil Eléctrico'),
(5, 'Ingeniero Civil'),
(6, 'Abogado'),
(7, 'Contador Público y/o Auditor'),
(8, 'Ingeniero Comercial'),
(9, 'Ingeniero en Información y Control de Gestión'),
(10, 'Profesor de Educación Media en Matemática'),
(11, 'Profesor de Educación Media en Inglés'),
(12, 'Profesor de Educación Media en Lenguaje y Comunicación'),
(13, 'Administrador Público y/o Cientista Político'),
(14, 'Ingeniero Civil Electrónico'),
(15, 'Ingeniero Civil Mecánico'),
(16, 'Ingeniero en Administración de Empresas'),
(17, 'Nutricionista'),
(18, 'Psicólogo'),
(19, 'Tecnólogo Médico'),
(20, 'Trabajador Social'),
(21, 'Arquitecto'),
(22, 'Biólogo Marino'),
(23, 'Fonoaudiólogo'),
(24, 'Ingeniero Civil Ambiental'),
(25, 'Ingeniero Civil en Minas'),
(26, 'Ingeniero Civil Metalúrgico'),
(27, 'Ingeniero en Administración Logística'),
(28, 'Ingeniero en Biotecnología'),
(29, 'Ingeniero en Comercio Internacional'),
(30, 'Ingeniero de Ejecución Industrial'),
(31, 'Ingeniero de Ejecución en Informática'),
(32, 'Geólogo'),
(33, 'Geógrafo'),
(34, 'Licenciado en Física'),
(35, 'Licenciado en Matemática'),
(36, 'Profesor de Educación Diferencial'),
(37, 'Periodista'),
(38, 'Terapeuta Ocupacional'),
(39, 'Técnico Universitario en Administración de Empresas'),
(40, 'Técnico Universitario en Automatización Industrial'),
(41, 'Técnico Universitario en Electricidad'),
(42, 'Ingeniero Civil en Telecomunicaciones'),
(43, 'Ingeniero Civil Químico'),
(44, 'Publicista'),
(45, 'Sociólogo'),
(46, 'Técnico en Interpretación de Lengua de Señas'),
(47, 'Geofísico'),
(48, 'Psicopedagogo'),
(49, 'Prevencionista de Riesgos'),
(50, 'Kinesiólogo'),
(51, 'Licenciado en Historia'),
(52, 'Químico Ambiental');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesional`
--

CREATE TABLE `profesional` (
  `rut` int(11) NOT NULL,
  `id_profesion` int(11) DEFAULT NULL,
  `id_institucion` int(11) DEFAULT NULL,
  `biografia_prof` varchar(255) DEFAULT NULL,
  `experiencia` varchar(255) DEFAULT NULL,
  `titulo_profesional` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesional`
--

INSERT INTO `profesional` (`rut`, `id_profesion`, `id_institucion`, `biografia_prof`, `experiencia`, `titulo_profesional`) VALUES
(10286235, 3, 8, NULL, 'Mecánica de Rocas', '../../uploads/titulo_profesional/com_data_12.pdf'),
(10367255, 5, 2, 'Esta es mi biografía', 'Mi especialidad son las estructuras', '../../uploads/titulo_profesional/Guía 3-Elasticidad.pdf'),
(11022434, 11, 10, NULL, 'Preparación para TOEFL', '../../uploads/titulo_profesional/Tarea_3_ComData_2024.pdf'),
(12323424, 8, 50, NULL, 'Mmm...', '../../uploads/titulo_profesional/Malla_UA53_ plan3_IngCivilInformática _2017_09_30.pdf'),
(12424567, 12, 7, NULL, 'Clases particulares de Lenguaje y Comunicación y preparación para la PAES de Lenguaje', '../../uploads/titulo_profesional/CronogramaLabIN1053C_2024-2.pdf'),
(14565656, 1, 1, NULL, 'Sé hacer de todo', '../../uploads/titulo_profesional/Consentimiento Informado ENCE CRUCH 2024.docx.pdf'),
(15727637, 34, 2, NULL, 'Clases de física para escolares', '../../uploads/titulo_profesional/Ejercicios ejemplo de óptimo de producción.pdf'),
(16377783, 10, 38, NULL, 'Enseñanza de la matemática para segundo ciclo de enseñanza básica, y enseñanza media (de 1.° a 4.° Medio)', '../../uploads/titulo_profesional/reglamentacion.pdf'),
(16767878, 7, 3, NULL, 'Gestión tributaria y Operación Renta anual', '../../uploads/titulo_profesional/DataTables example - PDF - image.pdf'),
(20786387, NULL, NULL, '', '', NULL),
(20876543, 9, 16, NULL, 'Gestión de información', '../../uploads/titulo_profesional/Feedback Incremento 2.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `id_provincia` int(11) NOT NULL,
  `nombre_provincia` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_region` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id_provincia`, `nombre_provincia`, `id_region`) VALUES
(1, 'Arica', 1),
(2, 'Parinacota', 1),
(3, 'Iquique', 2),
(4, 'El Tamarugal', 2),
(5, 'Tocopilla', 3),
(6, 'El Loa', 3),
(7, 'Antofagasta', 3),
(8, 'Chañaral', 4),
(9, 'Copiapó', 4),
(10, 'Huasco', 4),
(11, 'Elqui', 5),
(12, 'Limarí', 5),
(13, 'Choapa', 5),
(14, 'Petorca', 6),
(15, 'Los Andes', 6),
(16, 'San Felipe de Aconcagua', 6),
(17, 'Quillota', 6),
(18, 'Valparaiso', 6),
(19, 'San Antonio', 6),
(20, 'Isla de Pascua', 6),
(21, 'Marga Marga', 6),
(22, 'Chacabuco', 7),
(23, 'Santiago', 7),
(24, 'Cordillera', 7),
(25, 'Maipo', 7),
(26, 'Melipilla', 7),
(27, 'Talagante', 7),
(28, 'Cachapoal', 8),
(29, 'Colchagua', 8),
(30, 'Cardenal Caro', 8),
(31, 'Curicó', 9),
(32, 'Talca', 9),
(33, 'Linares', 9),
(34, 'Cauquenes', 9),
(35, 'Diguillín', 10),
(36, 'Itata', 10),
(37, 'Punilla', 10),
(38, 'Bio Bío', 11),
(39, 'Concepción', 11),
(40, 'Arauco', 11),
(41, 'Malleco', 12),
(42, 'Cautín', 12),
(43, 'Valdivia', 13),
(44, 'Ranco', 13),
(45, 'Osorno', 14),
(46, 'Llanquihue', 14),
(47, 'Chiloé', 14),
(48, 'Palena', 14),
(49, 'Coyhaique', 15),
(50, 'Aysén', 15),
(51, 'General Carrera', 15),
(52, 'Capitán Prat', 15),
(53, 'Última Esperanza', 16),
(54, 'Magallanes', 16),
(55, 'Tierra del Fuego', 16),
(56, 'Antártica Chilena', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `red_social`
--

CREATE TABLE `red_social` (
  `id_rs` int(11) NOT NULL,
  `nombre_rs` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `red_social`
--

INSERT INTO `red_social` (`id_rs`, `nombre_rs`) VALUES
(1, 'Facebook'),
(2, 'Instagram'),
(3, 'X (ex Twitter)'),
(4, 'LinkedIn'),
(5, 'GitHub'),
(6, 'GitLab');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `red_social_profesional`
--

CREATE TABLE `red_social_profesional` (
  `rut_profesional` int(11) NOT NULL,
  `id_rs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE `region` (
  `id_region` int(11) NOT NULL,
  `nombre_region` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`id_region`, `nombre_region`) VALUES
(1, 'Arica y Parinacota'),
(2, 'Tarapacá'),
(3, 'Antofagasta'),
(4, 'Atacama'),
(5, 'Coquimbo'),
(6, 'Valparaíso'),
(7, 'Metropolitana de Santiago'),
(8, 'Libertador General Bernardo O\'Higgins'),
(9, 'Maule'),
(10, 'Ñuble'),
(11, 'Biobío'),
(12, 'La Araucanía'),
(13, 'Los Ríos'),
(14, 'Los Lagos'),
(15, 'Aysén del General Carlos Ibáñez del Campo'),
(16, 'Magallanes y de la Antártica Chilena');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_profesional`
--

CREATE TABLE `reporte_profesional` (
  `id_reporte` int(11) NOT NULL,
  `rut_cliente` int(11) NOT NULL,
  `rut_profesional` int(11) NOT NULL,
  `motivo_reporte` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'Superadministrador'),
(2, 'Administrador'),
(3, 'Profesional'),
(4, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id_servicio` int(11) NOT NULL,
  `nombre_servicio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_servicio`, `nombre_servicio`) VALUES
(1, 'Desarrollo de aplicaciones móviles en Android'),
(2, 'Desarrollo de aplicaciones móviles en iOS'),
(3, 'Desarrollo de páginas web'),
(4, 'Asesoría en Derecho Civil'),
(5, 'Asesoría en Derecho Laboral'),
(6, 'Asesoría en Derecho de Familia'),
(7, 'Clases particulares de matemática - Enseñanza básica y media'),
(8, 'Clases particulares de lenguaje - Enseñanza básica y media'),
(9, 'Clases particulares de historia, geografía y/o ciencias sociales - Enseñanza básica y media'),
(10, 'Clases particulares de ciencias naturales - Enseñanza básica'),
(11, 'Clases particulares de química - Enseñanza media'),
(12, 'Clases particulares de física - Enseñanza media'),
(13, 'Clases particulares de biología - Enseñanza media'),
(14, 'Clases particulares de matemática - Enseñanza superior'),
(15, 'Clases particulares de física - Enseñanza superior'),
(16, 'Clases particulares de química - Enseñanza superior'),
(17, 'Preparación para la PAES de Competencia Lectora'),
(18, 'Preparación para la PAES de Competencia Matemática M1'),
(19, 'Preparación para la PAES de Competencia Matemática M2'),
(20, 'Preparación para la PAES de Ciencias'),
(21, 'Preparación para la PAES de Historia'),
(22, 'Mantenimiento preventivo de PC y notebook'),
(23, 'Cambio de unidades de almacenamiento (primario y secundario) de PC y notebook'),
(24, 'Cambio de pantalla de PC y notebook'),
(25, 'Cambio de placa madre de PC y notebook'),
(26, 'Formateo e instalación de sistema operativo Windows'),
(27, 'Instalación de Microsoft Office');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_profesion`
--

CREATE TABLE `servicio_profesion` (
  `id_servicio` int(11) NOT NULL,
  `id_profesion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio_profesion`
--

INSERT INTO `servicio_profesion` (`id_servicio`, `id_profesion`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 6),
(5, 6),
(6, 6),
(7, 1),
(7, 2),
(7, 3),
(7, 4),
(7, 5),
(7, 10),
(7, 14),
(7, 15),
(7, 35),
(8, 12),
(9, 51),
(10, 22),
(10, 43),
(10, 52),
(11, 43),
(11, 52),
(12, 1),
(12, 2),
(12, 3),
(12, 4),
(12, 5),
(12, 14),
(12, 15),
(12, 34),
(13, 22),
(14, 1),
(14, 2),
(14, 3),
(14, 4),
(14, 5),
(14, 8),
(14, 14),
(14, 15),
(14, 35),
(15, 1),
(15, 2),
(15, 3),
(15, 4),
(15, 5),
(15, 14),
(15, 15),
(15, 34),
(16, 1),
(16, 2),
(16, 43),
(16, 52),
(17, 12),
(18, 1),
(18, 2),
(18, 3),
(18, 4),
(18, 5),
(18, 8),
(18, 10),
(18, 14),
(18, 15),
(18, 35),
(19, 1),
(19, 2),
(19, 3),
(19, 4),
(19, 5),
(19, 14),
(19, 15),
(19, 35),
(20, 22),
(20, 34),
(20, 43),
(20, 52),
(21, 51),
(22, 1),
(22, 14),
(22, 31),
(23, 1),
(23, 14),
(23, 31),
(24, 1),
(24, 14),
(24, 31),
(25, 1),
(25, 14),
(25, 31),
(26, 1),
(26, 31),
(27, 1),
(27, 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_profesional`
--

CREATE TABLE `servicio_profesional` (
  `id_servicio` int(11) NOT NULL,
  `rut_profesional` int(11) NOT NULL,
  `precio_serv_prof` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio_profesional`
--

INSERT INTO `servicio_profesional` (`id_servicio`, `rut_profesional`, `precio_serv_prof`) VALUES
(1, 14565656, 15000),
(2, 14565656, 20000),
(3, 14565656, 25000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_horario`
--

CREATE TABLE `tipo_horario` (
  `id_th` int(11) NOT NULL,
  `horario` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_horario`
--

INSERT INTO `tipo_horario` (`id_th`, `horario`) VALUES
(1, '08:00:00'),
(2, '08:15:00'),
(3, '08:30:00'),
(4, '08:45:00'),
(5, '09:00:00'),
(6, '09:15:00'),
(7, '09:30:00'),
(8, '09:45:00'),
(9, '10:00:00'),
(10, '10:15:00'),
(11, '10:30:00'),
(12, '10:45:00'),
(13, '11:00:00'),
(14, '11:15:00'),
(15, '11:30:00'),
(16, '11:45:00'),
(17, '12:00:00'),
(18, '12:15:00'),
(19, '12:30:00'),
(20, '12:45:00'),
(21, '13:00:00'),
(22, '13:15:00'),
(23, '13:30:00'),
(24, '13:45:00'),
(25, '14:00:00'),
(26, '14:15:00'),
(27, '14:30:00'),
(28, '14:45:00'),
(29, '15:00:00'),
(30, '15:15:00'),
(31, '15:30:00'),
(32, '15:45:00'),
(33, '16:00:00'),
(34, '16:15:00'),
(35, '16:30:00'),
(36, '16:45:00'),
(37, '17:00:00'),
(38, '17:15:00'),
(39, '17:30:00'),
(40, '17:45:00'),
(41, '18:00:00'),
(42, '18:15:00'),
(43, '18:30:00'),
(44, '18:45:00'),
(45, '19:00:00'),
(46, '19:15:00'),
(47, '19:30:00'),
(48, '19:45:00'),
(49, '20:00:00'),
(50, '20:15:00'),
(51, '20:30:00'),
(52, '20:45:00'),
(53, '21:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `rut` int(11) NOT NULL,
  `dv` char(1) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellido_p` varchar(50) NOT NULL,
  `apellido_m` varchar(50) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` int(11) NOT NULL,
  `fecha_nac` date NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `latitud` varchar(100) DEFAULT NULL,
  `longitud` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) NOT NULL,
  `foto_perfil` varchar(255) NOT NULL DEFAULT 'uploads/foto_perfil/foto_perfil_predeterminada.jpg',
  `id_comuna` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_estado_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`rut`, `dv`, `nombre_usuario`, `nombres`, `apellido_p`, `apellido_m`, `correo`, `telefono`, `fecha_nac`, `direccion`, `latitud`, `longitud`, `contrasena`, `foto_perfil`, `id_comuna`, `id_rol`, `id_estado_usuario`) VALUES
(7466578, '0', 'Mayerly', 'Mayerly', 'Zavala', 'Iturra', 'mayerly@gmail.com', 956543424, '2000-08-31', 'Avenida Michimalonco 278', NULL, NULL, '202cb962ac59075b964b07152d234b70', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 241, 4, 1),
(10208323, '7', 'Guillermo', 'Guillermo', 'Pacheco', 'Cereceda', 'guillermo@gmail.com', 982776382, '1994-02-25', 'ABC 123', NULL, NULL, '202cb962ac59075b964b07152d234b70', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 192, 4, 1),
(10286235, 'K', 'Profesional456', 'ProfesionalP', 'PPP', 'ProfPP', 'profprof@gmail.com', 986372773, '2002-01-12', 'Calle Nueva 343', NULL, NULL, '202cb962ac59075b964b07152d234b70', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 37, 3, 2),
(10367255, '4', 'Natalia', 'Natalia', 'Urrutia', 'Menares', 'natalia@gmail.com', 953535645, '1997-09-03', 'Calle ABC 123', NULL, NULL, 'baaab6fa3b287456d2ff691027920826', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 233, 3, 1),
(11022434, '6', 'Profesional123', 'Profesional', 'Prof', 'ProfProf', 'profesional@gmail.com', 987875646, '1999-12-12', 'Avenida Portales 1234', NULL, NULL, '81dc9bdb52d04dc20036dbd8313ed055', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 78, 3, 2),
(11086788, '3', 'Lorena', 'Lorena', 'Lagos', 'Sanhueza', 'lorena@gmail.com', 998876565, '1998-08-25', 'Avenida Bernardo O\'Higgins 3272', NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 65, 4, 1),
(11111111, '1', 'Admin', 'Admin', 'Admin', 'Admin', 'superadmin@gmail.com', 999999999, '1999-11-11', 'Calle Admin 123', NULL, NULL, '202cb962ac59075b964b07152d234b70', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 233, 1, 1),
(12323424, '3', 'AAASSD', 'Orlando', 'Salazar', 'Urrutia', 'profprofprof@gmail.com', 982878273, '2000-08-12', 'Francisco Pérez 123', NULL, NULL, '202cb962ac59075b964b07152d234b70', 'uploads/foto_perfil/IMG_20240817_182910109.jpg', 32, 3, 2),
(12345678, '5', 'Cliente', 'Cliente', 'Pérez', 'García', 'cliente@gmail.com', 999999999, '1999-08-25', 'Calle DEF, 321', NULL, NULL, '202cb962ac59075b964b07152d234b70', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 1, 4, 1),
(12424567, '2', 'Graciela', 'Graciela', 'Hernández', 'Jiménez', 'graciela@gmail.com', 924566345, '2022-08-12', 'Avenida Las Golondrinas 2485', NULL, NULL, '202cb962ac59075b964b07152d234b70', 'uploads/foto_perfil/Fondo.png', 237, 3, 2),
(12783648, '5', 'Jorge', 'Jorge', 'Bravo', 'Bravo', 'jorge@gmail.com', 928627627, '2001-08-12', 'Rengo 436', '-36.824307450000006', '-73.0543428', 'baaab6fa3b287456d2ff691027920826', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 233, 4, 1),
(13082637, '7', 'ABCDEF', 'Admin', 'Prueba', 'Prueba', 'admin@gmail.com', 982872637, '1995-08-08', 'Calle Nueva 123', NULL, NULL, '81dc9bdb52d04dc20036dbd8313ed055', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 1, 4, 1),
(13476476, '7', 'Renato', 'Renato', 'Poblete', 'Iturra', 'renato@gmail.com', 937363753, '2002-08-08', 'O\'Higgins 680', '-36.827606309302325', '-73.04949143953488', 'baaab6fa3b287456d2ff691027920826', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 233, 4, 1),
(14565656, '7', 'Hector', 'Héctor', 'Jiménez', 'Suazo', 'hector@gmail.com', 965656565, '2002-07-08', 'Avenida Arturo Prat 234', NULL, NULL, '202cb962ac59075b964b07152d234b70', 'uploads/foto_perfil/IMG_20240831_163740121.jpg', 1, 3, 1),
(15098364, '9', 'Barbara', 'Barbara', 'Hernández', 'Ramírez', 'barbara@gmail.com', 936262767, '2000-09-15', 'Calle ABC, 123', NULL, NULL, '202cb962ac59075b964b07152d234b70', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 332, 4, 1),
(15727637, '9', 'Valentina', 'Valentina', 'Figueroa', 'Pereira', 'valentina@gmail.com', 938736726, '1994-06-01', 'Postdam 4332', NULL, NULL, '202cb962ac59075b964b07152d234b70', 'uploads/foto_perfil/Fondo.png', 237, 3, 1),
(16235638, '0', 'Francisco', 'Francisco', 'Figueroa', 'Figueroa', 'francisco@gmail.com', 927673563, '2000-08-13', 'Ramón Carrasco 825', '-36.78906465157923', '-73.05718657506715', 'baaab6fa3b287456d2ff691027920826', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 233, 4, 1),
(16377783, '5', 'Karina', 'Karina', 'Medina', 'Lozano', 'karina@gmail.com', 936726362, '1985-01-12', 'Ramón Carrasco 1023', NULL, NULL, '202cb962ac59075b964b07152d234b70', 'uploads/foto_perfil/IMG_20240831_174544129.jpg', 233, 3, 1),
(16767878, '5', 'Ernesto', 'Ernesto', 'Loyola', 'Zapata', 'ernesto@gmail.com', 988786565, '1991-12-15', 'José Arrieta 2345', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', 'uploads/foto_perfil/IMG_20240810_181021908.jpg', 36, 3, 1),
(18267357, '9', 'Humberto', 'Humberto', 'Pérez', 'Pérez', 'humberto@gmail.com', 972627527, '2001-08-12', 'Serrano 50', '-33.458953050132564', '-70.64623414845794', 'baaab6fa3b287456d2ff691027920826', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 86, 4, 1),
(18273862, 'K', 'Monica', 'Mónica', 'Gallardo', 'Gallardo', 'monica@gmail.com', 928327826, '2000-10-10', 'Los Tulipanes 336', '-37.03329892406181', '-72.394982724876', 'baaab6fa3b287456d2ff691027920826', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 221, 4, 1),
(19286338, '4', 'Carlos', 'Carlos', 'Rebolledo', '', 'carlos@gmail.com', 937838674, '2000-08-12', 'San Diego 333', '-33.449850881632656', '-70.65080746530613', 'baaab6fa3b287456d2ff691027920826', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 86, 4, 1),
(20786387, '4', 'Alvaro', 'Álvaro Alfonso', 'Molina', 'Jara', 'alvaromolinacl@gmail.com', 988888888, '2001-07-10', 'Calle ABC, 1234', NULL, NULL, '202cb962ac59075b964b07152d234b70', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 233, 1, 1),
(20876543, '4', 'PruebaProf', 'Prueba', 'Profesional', 'Prof', 'pruebaprof@gmail.com', 987767657, '2002-08-12', 'Calle Gabriela 143', NULL, NULL, '202cb962ac59075b964b07152d234b70', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 83, 3, 1),
(23456789, '6', 'Juanito', 'Juan', 'Pérez', 'Gar', 'juan@gmail.com', 987654321, '2000-08-02', 'Calle GHI, 786', NULL, NULL, '202cb962ac59075b964b07152d234b70', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 1, 2, 1);

--
-- Disparadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `actualiza_usuario_admin` BEFORE UPDATE ON `usuario` FOR EACH ROW BEGIN
    -- Si el nuevo id_rol es 1 o 2 y no estaba previamente, insertar
    IF NEW.id_rol IN (1, 2) AND OLD.id_rol NOT IN (1, 2) THEN
        INSERT INTO administrador (rut)
        VALUES (NEW.rut);
    END IF;

    -- Si el nuevo id_rol no es 1 ni 2 y estaba previamente, eliminar
    IF NEW.id_rol NOT IN (1, 2) AND OLD.id_rol IN (1, 2) THEN
        DELETE FROM administrador
        WHERE rut = OLD.rut;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `actualiza_usuario_cliente` BEFORE UPDATE ON `usuario` FOR EACH ROW BEGIN
    -- Si el nuevo id_estado_usuario es 1 y no estaba previamente, insertar
    IF NEW.id_estado_usuario IN (1) AND OLD.id_estado_usuario NOT IN (1) THEN
        INSERT INTO cliente (rut)
        VALUES (NEW.rut);
    END IF;

    -- Si el nuevo id_estado_usuario no es 1 y estaba previamente, eliminar
    IF NEW.id_estado_usuario NOT IN (1) AND OLD.id_estado_usuario IN (1) THEN
        DELETE FROM cliente
        WHERE rut = OLD.rut;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `elimina_usuario_admin` BEFORE DELETE ON `usuario` FOR EACH ROW BEGIN
    DELETE FROM administrador
    WHERE rut = OLD.rut;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `elimina_usuario_cliente` BEFORE DELETE ON `usuario` FOR EACH ROW BEGIN
    DELETE FROM cliente
    WHERE rut = OLD.rut;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inserta_usuario_admin` BEFORE INSERT ON `usuario` FOR EACH ROW BEGIN
    IF NEW.id_rol IN (1, 2) THEN
        INSERT INTO administrador (rut)
        VALUES (NEW.rut);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `inserta_usuario_cliente` AFTER INSERT ON `usuario` FOR EACH ROW BEGIN
    IF NEW.id_estado_usuario NOT IN (2, 3) THEN
        INSERT INTO cliente (rut)
        VALUES (NEW.rut);
    END IF;
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`rut`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `cita_ibfk_1` (`rut_cliente`),
  ADD KEY `cita_ibfk_2` (`rut_profesional`),
  ADD KEY `cita_ibfk_3` (`id_th`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`rut`);

--
-- Indices de la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD PRIMARY KEY (`id_comuna`),
  ADD KEY `comuna_ibfk_1` (`id_provincia`);

--
-- Indices de la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  ADD PRIMARY KEY (`id_disponibilidad`),
  ADD KEY `disponibilidad_ibfk_1` (`rut_profesional`),
  ADD KEY `disponibilidad_ibfk_2` (`rut_cliente`);

--
-- Indices de la tabla `estado_usuario`
--
ALTER TABLE `estado_usuario`
  ADD PRIMARY KEY (`id_estado_usuario`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`rut_usuario`,`rut_profesional`),
  ADD KEY `rut_profesional` (`rut_profesional`);

--
-- Indices de la tabla `foro_respuesta`
--
ALTER TABLE `foro_respuesta`
  ADD PRIMARY KEY (`id_respuesta`),
  ADD KEY `foro_respuesta_ibfk_1` (`id_tema`),
  ADD KEY `foro_respuesta_ibfk_2` (`rut_usuario`);

--
-- Indices de la tabla `foro_tema`
--
ALTER TABLE `foro_tema`
  ADD PRIMARY KEY (`id_tema`),
  ADD KEY `foro_tema_ibfk_1` (`rut_cliente`);

--
-- Indices de la tabla `foro_voto_respuesta`
--
ALTER TABLE `foro_voto_respuesta`
  ADD PRIMARY KEY (`id_voto`),
  ADD UNIQUE KEY `id_respuesta` (`id_respuesta`,`rut_usuario`),
  ADD KEY `rut_usuario` (`rut_usuario`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`id_institucion`);

--
-- Indices de la tabla `lugar_atencion_presencial`
--
ALTER TABLE `lugar_atencion_presencial`
  ADD PRIMARY KEY (`rut_profesional`,`id_comuna`),
  ADD KEY `lugar_atencion_presencial_ibfk_2` (`id_comuna`);

--
-- Indices de la tabla `lugar_atencion_virtual`
--
ALTER TABLE `lugar_atencion_virtual`
  ADD PRIMARY KEY (`id_lugar_at_virtual`),
  ADD KEY `rut_profesional` (`rut_profesional`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `mensaje_ibfk_1` (`rut_cliente`),
  ADD KEY `mensaje_ibfk_2` (`rut_profesional`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`),
  ADD UNIQUE KEY `nombre_permiso` (`nombre_permiso`);

--
-- Indices de la tabla `permiso_rol`
--
ALTER TABLE `permiso_rol`
  ADD PRIMARY KEY (`id_permiso`,`id_rol`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `profesion`
--
ALTER TABLE `profesion`
  ADD PRIMARY KEY (`id_profesion`);

--
-- Indices de la tabla `profesional`
--
ALTER TABLE `profesional`
  ADD PRIMARY KEY (`rut`),
  ADD KEY `profesional_ibfk_2` (`id_profesion`),
  ADD KEY `profesional_ibfk_3` (`id_institucion`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id_provincia`),
  ADD KEY `provincia_ibfk_1` (`id_region`);

--
-- Indices de la tabla `red_social`
--
ALTER TABLE `red_social`
  ADD PRIMARY KEY (`id_rs`);

--
-- Indices de la tabla `red_social_profesional`
--
ALTER TABLE `red_social_profesional`
  ADD PRIMARY KEY (`rut_profesional`,`id_rs`),
  ADD KEY `red_social_profesional_ibfk_2` (`id_rs`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id_region`);

--
-- Indices de la tabla `reporte_profesional`
--
ALTER TABLE `reporte_profesional`
  ADD PRIMARY KEY (`id_reporte`),
  ADD KEY `reporte_profesional_ibfk_1` (`rut_cliente`),
  ADD KEY `reporte_profesional_ibfk_2` (`rut_profesional`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `servicio_profesion`
--
ALTER TABLE `servicio_profesion`
  ADD PRIMARY KEY (`id_servicio`,`id_profesion`),
  ADD KEY `id_profesion` (`id_profesion`);

--
-- Indices de la tabla `servicio_profesional`
--
ALTER TABLE `servicio_profesional`
  ADD PRIMARY KEY (`id_servicio`,`rut_profesional`),
  ADD KEY `servicio_profesional_ibfk_1` (`rut_profesional`);

--
-- Indices de la tabla `tipo_horario`
--
ALTER TABLE `tipo_horario`
  ADD PRIMARY KEY (`id_th`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`rut`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD UNIQUE KEY `rut` (`rut`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `usuario_ibfk_1` (`id_rol`),
  ADD KEY `usuario_ibfk_2` (`id_estado_usuario`),
  ADD KEY `usuario_ibfk_3` (`id_comuna`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comuna`
--
ALTER TABLE `comuna`
  MODIFY `id_comuna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;

--
-- AUTO_INCREMENT de la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  MODIFY `id_disponibilidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT de la tabla `estado_usuario`
--
ALTER TABLE `estado_usuario`
  MODIFY `id_estado_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `foro_respuesta`
--
ALTER TABLE `foro_respuesta`
  MODIFY `id_respuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `foro_tema`
--
ALTER TABLE `foro_tema`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `foro_voto_respuesta`
--
ALTER TABLE `foro_voto_respuesta`
  MODIFY `id_voto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `id_institucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de la tabla `lugar_atencion_virtual`
--
ALTER TABLE `lugar_atencion_virtual`
  MODIFY `id_lugar_at_virtual` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `profesion`
--
ALTER TABLE `profesion`
  MODIFY `id_profesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `red_social`
--
ALTER TABLE `red_social`
  MODIFY `id_rs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `reporte_profesional`
--
ALTER TABLE `reporte_profesional`
  MODIFY `id_reporte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `tipo_horario`
--
ALTER TABLE `tipo_horario`
  MODIFY `id_th` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`rut`) REFERENCES `usuario` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`rut_cliente`) REFERENCES `cliente` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`rut_profesional`) REFERENCES `profesional` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`id_th`) REFERENCES `tipo_horario` (`id_th`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`rut`) REFERENCES `usuario` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD CONSTRAINT `comuna_ibfk_1` FOREIGN KEY (`id_provincia`) REFERENCES `provincia` (`id_provincia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  ADD CONSTRAINT `disponibilidad_ibfk_1` FOREIGN KEY (`rut_profesional`) REFERENCES `profesional` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disponibilidad_ibfk_2` FOREIGN KEY (`rut_cliente`) REFERENCES `cliente` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`rut_usuario`) REFERENCES `usuario` (`rut`),
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`rut_profesional`) REFERENCES `profesional` (`rut`);

--
-- Filtros para la tabla `foro_respuesta`
--
ALTER TABLE `foro_respuesta`
  ADD CONSTRAINT `foro_respuesta_ibfk_1` FOREIGN KEY (`id_tema`) REFERENCES `foro_tema` (`id_tema`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foro_respuesta_ibfk_2` FOREIGN KEY (`rut_usuario`) REFERENCES `usuario` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `foro_tema`
--
ALTER TABLE `foro_tema`
  ADD CONSTRAINT `foro_tema_ibfk_1` FOREIGN KEY (`rut_cliente`) REFERENCES `cliente` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `foro_voto_respuesta`
--
ALTER TABLE `foro_voto_respuesta`
  ADD CONSTRAINT `foro_voto_respuesta_ibfk_1` FOREIGN KEY (`id_respuesta`) REFERENCES `foro_respuesta` (`id_respuesta`) ON DELETE CASCADE,
  ADD CONSTRAINT `foro_voto_respuesta_ibfk_2` FOREIGN KEY (`rut_usuario`) REFERENCES `usuario` (`rut`) ON DELETE CASCADE;

--
-- Filtros para la tabla `lugar_atencion_presencial`
--
ALTER TABLE `lugar_atencion_presencial`
  ADD CONSTRAINT `lugar_atencion_presencial_ibfk_1` FOREIGN KEY (`rut_profesional`) REFERENCES `profesional` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lugar_atencion_presencial_ibfk_2` FOREIGN KEY (`id_comuna`) REFERENCES `comuna` (`id_comuna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lugar_atencion_virtual`
--
ALTER TABLE `lugar_atencion_virtual`
  ADD CONSTRAINT `lugar_atencion_virtual_ibfk_1` FOREIGN KEY (`rut_profesional`) REFERENCES `profesional` (`rut`);

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `mensaje_ibfk_1` FOREIGN KEY (`rut_cliente`) REFERENCES `cliente` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mensaje_ibfk_2` FOREIGN KEY (`rut_profesional`) REFERENCES `profesional` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permiso_rol`
--
ALTER TABLE `permiso_rol`
  ADD CONSTRAINT `permiso_rol_ibfk_1` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id_permiso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permiso_rol_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesional`
--
ALTER TABLE `profesional`
  ADD CONSTRAINT `profesional_ibfk_1` FOREIGN KEY (`rut`) REFERENCES `usuario` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profesional_ibfk_2` FOREIGN KEY (`id_profesion`) REFERENCES `profesion` (`id_profesion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profesional_ibfk_3` FOREIGN KEY (`id_institucion`) REFERENCES `institucion` (`id_institucion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `provincia_ibfk_1` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `red_social_profesional`
--
ALTER TABLE `red_social_profesional`
  ADD CONSTRAINT `red_social_profesional_ibfk_1` FOREIGN KEY (`rut_profesional`) REFERENCES `profesional` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `red_social_profesional_ibfk_2` FOREIGN KEY (`id_rs`) REFERENCES `red_social` (`id_rs`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reporte_profesional`
--
ALTER TABLE `reporte_profesional`
  ADD CONSTRAINT `reporte_profesional_ibfk_1` FOREIGN KEY (`rut_cliente`) REFERENCES `cliente` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reporte_profesional_ibfk_2` FOREIGN KEY (`rut_profesional`) REFERENCES `profesional` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicio_profesion`
--
ALTER TABLE `servicio_profesion`
  ADD CONSTRAINT `servicio_profesion_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `servicio_profesion_ibfk_2` FOREIGN KEY (`id_profesion`) REFERENCES `profesion` (`id_profesion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicio_profesional`
--
ALTER TABLE `servicio_profesional`
  ADD CONSTRAINT `servicio_profesional_ibfk_1` FOREIGN KEY (`rut_profesional`) REFERENCES `profesional` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `servicio_profesional_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_estado_usuario`) REFERENCES `estado_usuario` (`id_estado_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`id_comuna`) REFERENCES `comuna` (`id_comuna`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
