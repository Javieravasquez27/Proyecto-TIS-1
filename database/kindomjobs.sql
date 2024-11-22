-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2024 a las 06:11:54
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
(13082637);

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
(11086788);

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
(1, 14565656, NULL, '2024-11-11', '08:00:00', 1),
(2, 14565656, NULL, '2024-11-11', '09:00:00', 1),
(3, 14565656, NULL, '2024-11-11', '10:00:00', 1),
(4, 14565656, NULL, '2024-11-11', '11:00:00', 1),
(5, 14565656, NULL, '2024-11-11', '12:00:00', 1),
(6, 14565656, NULL, '2024-11-18', '08:00:00', 1),
(7, 14565656, NULL, '2024-11-18', '09:00:00', 1),
(8, 14565656, NULL, '2024-11-18', '10:00:00', 1),
(9, 14565656, NULL, '2024-11-18', '11:00:00', 1),
(10, 14565656, NULL, '2024-11-18', '12:00:00', 1),
(11, 14565656, NULL, '2024-11-25', '08:00:00', 1),
(12, 14565656, NULL, '2024-11-25', '09:00:00', 1),
(13, 14565656, NULL, '2024-11-25', '10:00:00', 1),
(14, 14565656, NULL, '2024-11-25', '11:00:00', 1),
(15, 14565656, NULL, '2024-11-25', '12:00:00', 1),
(16, 14565656, NULL, '2024-11-05', '09:00:00', 1),
(17, 14565656, NULL, '2024-11-05', '10:00:00', 1),
(18, 14565656, NULL, '2024-11-05', '11:00:00', 1),
(19, 14565656, NULL, '2024-11-05', '12:00:00', 1),
(20, 14565656, NULL, '2024-11-05', '13:00:00', 1),
(21, 14565656, NULL, '2024-11-12', '09:00:00', 1),
(22, 14565656, NULL, '2024-11-12', '10:00:00', 1),
(23, 14565656, NULL, '2024-11-12', '11:00:00', 1),
(24, 14565656, NULL, '2024-11-12', '12:00:00', 1),
(25, 14565656, NULL, '2024-11-12', '13:00:00', 1),
(26, 14565656, NULL, '2024-11-19', '09:00:00', 1),
(27, 14565656, NULL, '2024-11-19', '10:00:00', 1),
(28, 14565656, NULL, '2024-11-19', '11:00:00', 1),
(29, 14565656, NULL, '2024-11-19', '12:00:00', 1),
(30, 14565656, NULL, '2024-11-19', '13:00:00', 1),
(31, 14565656, NULL, '2024-11-06', '08:00:00', 1),
(32, 14565656, NULL, '2024-11-06', '09:00:00', 1),
(33, 14565656, NULL, '2024-11-06', '10:00:00', 1),
(34, 14565656, NULL, '2024-11-06', '11:00:00', 1),
(35, 14565656, NULL, '2024-11-06', '12:00:00', 1),
(36, 14565656, NULL, '2024-11-06', '13:00:00', 1),
(37, 14565656, NULL, '2024-11-13', '08:00:00', 1),
(38, 14565656, NULL, '2024-11-13', '09:00:00', 1),
(39, 14565656, NULL, '2024-11-13', '10:00:00', 1),
(40, 14565656, NULL, '2024-11-13', '11:00:00', 1),
(41, 14565656, NULL, '2024-11-13', '12:00:00', 1),
(42, 14565656, NULL, '2024-11-13', '13:00:00', 1),
(43, 14565656, NULL, '2024-11-20', '08:00:00', 1),
(44, 14565656, NULL, '2024-11-20', '09:00:00', 1),
(45, 14565656, NULL, '2024-11-20', '10:00:00', 1),
(46, 14565656, NULL, '2024-11-20', '11:00:00', 1),
(47, 14565656, NULL, '2024-11-20', '12:00:00', 1),
(48, 14565656, NULL, '2024-11-20', '13:00:00', 1),
(49, 14565656, NULL, '2024-11-07', '08:00:00', 1),
(50, 14565656, NULL, '2024-11-07', '09:00:00', 1),
(51, 14565656, NULL, '2024-11-07', '10:00:00', 1),
(52, 14565656, NULL, '2024-11-07', '11:00:00', 1),
(53, 14565656, NULL, '2024-11-07', '12:00:00', 1),
(54, 14565656, NULL, '2024-11-07', '13:00:00', 1),
(55, 14565656, NULL, '2024-11-07', '14:00:00', 1),
(56, 14565656, NULL, '2024-11-14', '08:00:00', 1),
(57, 14565656, NULL, '2024-11-14', '09:00:00', 1),
(58, 14565656, NULL, '2024-11-14', '10:00:00', 1),
(59, 14565656, NULL, '2024-11-14', '11:00:00', 1),
(60, 14565656, NULL, '2024-11-14', '12:00:00', 1),
(61, 14565656, NULL, '2024-11-14', '13:00:00', 1),
(62, 14565656, NULL, '2024-11-14', '14:00:00', 1),
(63, 14565656, NULL, '2024-11-21', '08:00:00', 1),
(64, 14565656, NULL, '2024-11-21', '09:00:00', 1),
(65, 14565656, NULL, '2024-11-21', '10:00:00', 1),
(66, 14565656, NULL, '2024-11-21', '11:00:00', 1),
(67, 14565656, NULL, '2024-11-21', '12:00:00', 1),
(68, 14565656, NULL, '2024-11-21', '13:00:00', 1),
(69, 14565656, NULL, '2024-11-21', '14:00:00', 1),
(70, 14565656, NULL, '2024-11-08', '09:00:00', 1),
(71, 14565656, NULL, '2024-11-08', '10:00:00', 1),
(72, 14565656, NULL, '2024-11-08', '11:00:00', 1),
(73, 14565656, NULL, '2024-11-08', '12:00:00', 1),
(74, 14565656, NULL, '2024-11-08', '13:00:00', 1),
(75, 14565656, NULL, '2024-11-15', '09:00:00', 1),
(76, 14565656, NULL, '2024-11-15', '10:00:00', 1),
(77, 14565656, NULL, '2024-11-15', '11:00:00', 1),
(78, 14565656, NULL, '2024-11-15', '12:00:00', 1),
(79, 14565656, NULL, '2024-11-15', '13:00:00', 1),
(80, 14565656, NULL, '2024-11-22', '09:00:00', 1),
(81, 14565656, NULL, '2024-11-22', '10:00:00', 1),
(82, 14565656, NULL, '2024-11-22', '11:00:00', 1),
(83, 14565656, NULL, '2024-11-22', '12:00:00', 1),
(84, 14565656, NULL, '2024-11-22', '13:00:00', 1),
(85, 14565656, NULL, '2024-11-09', '10:00:00', 1),
(86, 14565656, NULL, '2024-11-09', '11:00:00', 1),
(87, 14565656, NULL, '2024-11-09', '12:00:00', 1),
(88, 14565656, NULL, '2024-11-09', '13:00:00', 1),
(89, 14565656, NULL, '2024-11-16', '10:00:00', 1),
(90, 14565656, NULL, '2024-11-16', '11:00:00', 1),
(91, 14565656, NULL, '2024-11-16', '12:00:00', 1),
(92, 14565656, NULL, '2024-11-16', '13:00:00', 1),
(93, 14565656, NULL, '2024-11-23', '10:00:00', 1),
(94, 14565656, NULL, '2024-11-23', '11:00:00', 1),
(95, 14565656, NULL, '2024-11-23', '12:00:00', 1),
(96, 14565656, NULL, '2024-11-23', '13:00:00', 1);

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
(0, 'Desactivado'),
(1, 'Activado'),
(2, 'Bloqueado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro`
--

CREATE TABLE `foro` (
  `id_foro` int(11) NOT NULL,
  `rut_cliente` int(11) NOT NULL,
  `pregunta_foro` varchar(255) NOT NULL,
  `rut_profesional` int(11) NOT NULL,
  `respuesta_foro` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(55, 'Universidad Tecnológica de Chile - INACAP');

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
  `nombre_permiso` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id_permiso`, `nombre_permiso`) VALUES
(1, 'Acceder al panel de administración'),
(2, 'Gestionar los mantenedores de la plataforma'),
(3, 'Gestionar roles y activación de las cuentas de usuario'),
(4, 'Gestionar autorizaciones de profesionales'),
(5, 'Gestionar administradores de la plataforma'),
(6, 'Acceder a las páginas de profesionales'),
(7, 'Acceder a las páginas de clientes');

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
(4, 7);

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
(1, 'Ingeniero Civil Informático'),
(2, 'Ingeniero Civil Industrial'),
(3, 'Ingeniero Civil Geológico'),
(4, 'Ingeniero Civil Eléctrico'),
(5, 'Ingeniero Civil'),
(6, 'Abogado'),
(7, 'Contador Auditor'),
(8, 'Ingeniero Comercial'),
(9, 'Ingeniero en Información y Control de Gestión'),
(10, 'Profesor de Educación Media en Matemática'),
(11, 'Profesor de Educación Media en Inglés'),
(12, 'Profesor de Educación Media en Lenguaje y Comunicación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesional`
--

CREATE TABLE `profesional` (
  `rut` int(11) NOT NULL,
  `id_profesion` int(11) NOT NULL,
  `id_institucion` int(11) NOT NULL,
  `biografia_prof` varchar(255) DEFAULT NULL,
  `experiencia` varchar(255) NOT NULL,
  `titulo_profesional` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesional`
--

INSERT INTO `profesional` (`rut`, `id_profesion`, `id_institucion`, `biografia_prof`, `experiencia`, `titulo_profesional`) VALUES
(10286235, 3, 8, NULL, 'Mecánica de Rocas', '../../uploads/titulo_profesional/com_data_12.pdf'),
(11022434, 11, 10, NULL, 'Preparación para TOEFL', '../../uploads/titulo_profesional/Tarea_3_ComData_2024.pdf'),
(14565656, 1, 1, NULL, 'Sé hacer de todo', '../../uploads/titulo_profesional/Consentimiento Informado ENCE CRUCH 2024.docx.pdf'),
(16767878, 7, 3, NULL, 'Gestión tributaria y Operación Renta anual', '../../uploads/titulo_profesional/DataTables example - PDF - image.pdf'),
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
(6, 'Valparaiso'),
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
(3, 'Desarrollo de páginas web');

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
  `nombre_usuario` varchar(50) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellido_p` varchar(50) NOT NULL,
  `apellido_m` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` int(11) NOT NULL,
  `fecha_nac` date NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `id_comuna` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_estado_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`rut`, `nombre_usuario`, `nombres`, `apellido_p`, `apellido_m`, `correo`, `telefono`, `fecha_nac`, `direccion`, `contrasena`, `foto_perfil`, `id_comuna`, `id_rol`, `id_estado_usuario`) VALUES
(10286235, 'Profesional456', 'ProfesionalP', 'PPP', 'ProfPP', 'profprof@gmail.com', 986372773, '2002-01-12', 'Calle Nueva 343', '202cb962ac59075b964b07152d234b70', '../../uploads/foto_perfil/IMG_20240831_181353881.jpg', 37, 3, 0),
(11022434, 'Profesional123', 'Profesional', 'Prof', 'ProfProf', 'profesional@gmail.com', 987875646, '1999-12-12', 'Avenida Portales 1234', '81dc9bdb52d04dc20036dbd8313ed055', '../../uploads/foto_perfil/IMG_20240831_175406455.jpg', 78, 3, 0),
(11086788, 'Lorena', 'Lorena', 'Lagos', 'Sanhueza', 'lorena@gmail.com', 998876565, '1998-08-25', 'Avenida Bernardo O\'Higgins 3272', '827ccb0eea8a706c4c34a16891f84e7b', '', 65, 4, 1),
(12345678, 'Cliente', 'Cliente', 'Pérez', 'García', 'cliente@gmail.com', 999999999, '1999-08-25', 'Calle DEF, 321', '202cb962ac59075b964b07152d234b70', NULL, 1, 4, 1),
(13082637, 'Admin', 'Admin', 'Prueba', 'Prueba', 'admin@gmail.com', 982872637, '1995-08-08', 'Calle Nueva 123', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 1, 2, 1),
(14565656, 'Hector', 'Héctor', 'Jiménez', 'Suazo', 'hector@gmail.com', 965656565, '2002-07-08', 'Avenida Arturo Prat 234', '202cb962ac59075b964b07152d234b70', 'uploads/foto_perfil/IMG_20240831_163740121.jpg', 1, 3, 1),
(16767878, 'Ernesto', 'Ernesto', 'Loyola', 'Zapata', 'ernesto@gmail.com', 988786565, '1991-12-15', 'José Arrieta 2345', 'e10adc3949ba59abbe56e057f20f883e', 'uploads/foto_perfil/IMG_20240810_181021908.jpg', 36, 3, 0),
(20786387, 'Alvaro', 'Álvaro Alfonso', 'Molina', 'Jara', 'alvaromolinacl@gmail.com', 951269878, '2001-07-10', 'Calle ABC, 123', '202cb962ac59075b964b07152d234b70', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 1, 1, 1),
(20876543, 'PruebaProf', 'Prueba', 'Profesional', 'Prof', 'pruebaprof@gmail.com', 987767657, '2002-08-12', 'Calle Gabriela 143', '202cb962ac59075b964b07152d234b70', '../../uploads/foto_perfil/Calculadora_01_AforoApp.jpg', 83, 3, 1),
(23456789, 'Juanito', 'Juan', 'Pérez', 'Gar', 'juan@gmail.com', 987654321, '2000-08-02', 'Calle GHI, 786', '202cb962ac59075b964b07152d234b70', NULL, 1, 3, 1);

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
  ADD KEY `rut_cliente` (`rut_cliente`),
  ADD KEY `rut_profesional` (`rut_profesional`),
  ADD KEY `id_th` (`id_th`);

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
  ADD KEY `rut_cliente` (`rut_cliente`),
  ADD KEY `disponibilidad_ibfk_1` (`rut_profesional`);

--
-- Indices de la tabla `estado_usuario`
--
ALTER TABLE `estado_usuario`
  ADD PRIMARY KEY (`id_estado_usuario`);

--
-- Indices de la tabla `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`id_foro`),
  ADD KEY `rut_cliente` (`rut_cliente`),
  ADD KEY `rut_profesional` (`rut_profesional`);

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
  ADD KEY `id_comuna` (`id_comuna`);

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
  ADD KEY `rut_profesional` (`rut_profesional`),
  ADD KEY `rut_cliente` (`rut_cliente`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`);

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
  ADD KEY `id_profesion` (`id_profesion`),
  ADD KEY `id_institucion` (`id_institucion`);

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
  ADD KEY `id_rs` (`id_rs`);

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
  ADD KEY `rut_cliente` (`rut_cliente`),
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
  ADD KEY `usuario_ibfk_1` (`id_comuna`),
  ADD KEY `usuario_ibfk_2` (`id_rol`),
  ADD KEY `usuario_ibfk_3` (`id_estado_usuario`);

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
  MODIFY `id_disponibilidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `foro`
--
ALTER TABLE `foro`
  MODIFY `id_foro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `id_institucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

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
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `profesion`
--
ALTER TABLE `profesion`
  MODIFY `id_profesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`rut`) REFERENCES `usuario` (`rut`);

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`rut_cliente`) REFERENCES `cliente` (`rut`),
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`rut_profesional`) REFERENCES `profesional` (`rut`),
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`id_th`) REFERENCES `tipo_horario` (`id_th`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`rut`) REFERENCES `usuario` (`rut`);

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
  ADD CONSTRAINT `disponibilidad_ibfk_2` FOREIGN KEY (`rut_cliente`) REFERENCES `cliente` (`rut`);

--
-- Filtros para la tabla `foro`
--
ALTER TABLE `foro`
  ADD CONSTRAINT `foro_ibfk_1` FOREIGN KEY (`rut_cliente`) REFERENCES `cliente` (`rut`),
  ADD CONSTRAINT `foro_ibfk_2` FOREIGN KEY (`rut_profesional`) REFERENCES `profesional` (`rut`);

--
-- Filtros para la tabla `lugar_atencion_presencial`
--
ALTER TABLE `lugar_atencion_presencial`
  ADD CONSTRAINT `lugar_atencion_presencial_ibfk_1` FOREIGN KEY (`rut_profesional`) REFERENCES `profesional` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lugar_atencion_virtual`
--
ALTER TABLE `lugar_atencion_virtual`
  ADD CONSTRAINT `lugar_atencion_virtual_ibfk_1` FOREIGN KEY (`rut_profesional`) REFERENCES `profesional` (`rut`);

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `mensaje_ibfk_1` FOREIGN KEY (`rut_cliente`) REFERENCES `cliente` (`rut`),
  ADD CONSTRAINT `mensaje_ibfk_2` FOREIGN KEY (`rut_profesional`) REFERENCES `profesional` (`rut`);

--
-- Filtros para la tabla `permiso_rol`
--
ALTER TABLE `permiso_rol`
  ADD CONSTRAINT `permiso_rol_ibfk_1` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id_permiso`),
  ADD CONSTRAINT `permiso_rol_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);

--
-- Filtros para la tabla `profesional`
--
ALTER TABLE `profesional`
  ADD CONSTRAINT `profesional_ibfk_1` FOREIGN KEY (`rut`) REFERENCES `usuario` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profesional_ibfk_2` FOREIGN KEY (`id_profesion`) REFERENCES `profesion` (`id_profesion`),
  ADD CONSTRAINT `profesional_ibfk_3` FOREIGN KEY (`id_institucion`) REFERENCES `institucion` (`id_institucion`);

--
-- Filtros para la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `provincia_ibfk_1` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `red_social_profesional`
--
ALTER TABLE `red_social_profesional`
  ADD CONSTRAINT `red_social_profesional_ibfk_1` FOREIGN KEY (`rut_profesional`) REFERENCES `profesional` (`rut`),
  ADD CONSTRAINT `red_social_profesional_ibfk_2` FOREIGN KEY (`id_rs`) REFERENCES `red_social` (`id_rs`);

--
-- Filtros para la tabla `reporte_profesional`
--
ALTER TABLE `reporte_profesional`
  ADD CONSTRAINT `reporte_profesional_ibfk_1` FOREIGN KEY (`rut_cliente`) REFERENCES `cliente` (`rut`),
  ADD CONSTRAINT `reporte_profesional_ibfk_2` FOREIGN KEY (`rut_profesional`) REFERENCES `profesional` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicio_profesional`
--
ALTER TABLE `servicio_profesional`
  ADD CONSTRAINT `servicio_profesional_ibfk_1` FOREIGN KEY (`rut_profesional`) REFERENCES `profesional` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `servicio_profesional_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
