-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2024 a las 08:35:25
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
  `nombre_usuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banea_usuario`
--

CREATE TABLE `banea_usuario` (
  `nombre_usuario_admin` varchar(255) NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id_cita` int(11) NOT NULL,
  `fecha_cita` datetime NOT NULL,
  `nombre_usuario_cliente` varchar(255) NOT NULL,
  `nombre_usuario_profesional` varchar(255) NOT NULL,
  `id_tipohorario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita_online`
--

CREATE TABLE `cita_online` (
  `id_cita` int(11) NOT NULL,
  `id_lugar_atencion_vir` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita_presencial`
--

CREATE TABLE `cita_presencial` (
  `id_cita` int(11) NOT NULL,
  `id_lugar_atencion_pre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id_ciudad` int(11) NOT NULL,
  `nombre_ciudad` varchar(255) NOT NULL,
  `id_region` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id_ciudad`, `nombre_ciudad`, `id_region`) VALUES
(19, '222', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `nombre_usuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_servicio`
--

CREATE TABLE `cliente_servicio` (
  `nombre_usuario_cliente` varchar(255) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `nombre_usuario_prof` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comuna`
--

CREATE TABLE `comuna` (
  `id_comuna` int(11) NOT NULL,
  `nombre_comuna` varchar(255) NOT NULL,
  `id_ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comuna`
--

INSERT INTO `comuna` (`id_comuna`, `nombre_comuna`, `id_ciudad`) VALUES
(10, 'a', 19),
(11, 'b', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidad`
--

CREATE TABLE `disponibilidad` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(255) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `disponible` tinyint(1) DEFAULT 1,
  `nombre_cliente` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `disponibilidad`
--

INSERT INTO `disponibilidad` (`id`, `nombre_usuario`, `fecha`, `hora`, `disponible`, `nombre_cliente`) VALUES
(34, 'asss', '2024-11-11', '08:00:00', 1, NULL),
(35, 'asss', '2024-11-11', '09:00:00', 1, NULL),
(36, 'asss', '2024-11-11', '10:00:00', 1, NULL),
(37, 'asss', '2024-11-11', '11:00:00', 1, NULL),
(38, 'asss', '2024-11-11', '12:00:00', 1, NULL),
(39, 'asss', '2024-11-18', '08:00:00', 1, NULL),
(40, 'asss', '2024-11-18', '09:00:00', 1, NULL),
(41, 'asss', '2024-11-18', '10:00:00', 1, NULL),
(42, 'asss', '2024-11-18', '11:00:00', 1, NULL),
(43, 'asss', '2024-11-18', '12:00:00', 1, NULL),
(44, 'asss', '2024-11-25', '08:00:00', 1, NULL),
(45, 'asss', '2024-11-25', '09:00:00', 1, NULL),
(46, 'asss', '2024-11-25', '10:00:00', 1, NULL),
(47, 'asss', '2024-11-25', '11:00:00', 1, NULL),
(48, 'asss', '2024-11-25', '12:00:00', 1, NULL),
(49, 'asss', '2024-11-05', '09:00:00', 1, NULL),
(50, 'asss', '2024-11-05', '10:00:00', 1, NULL),
(51, 'asss', '2024-11-05', '11:00:00', 1, NULL),
(52, 'asss', '2024-11-05', '12:00:00', 1, NULL),
(53, 'asss', '2024-11-05', '13:00:00', 1, NULL),
(54, 'asss', '2024-11-12', '09:00:00', 1, NULL),
(55, 'asss', '2024-11-12', '10:00:00', 1, NULL),
(56, 'asss', '2024-11-12', '11:00:00', 1, NULL),
(57, 'asss', '2024-11-12', '12:00:00', 1, NULL),
(58, 'asss', '2024-11-12', '13:00:00', 1, NULL),
(59, 'asss', '2024-11-19', '09:00:00', 1, NULL),
(60, 'asss', '2024-11-19', '10:00:00', 1, NULL),
(61, 'asss', '2024-11-19', '11:00:00', 1, NULL),
(62, 'asss', '2024-11-19', '12:00:00', 1, NULL),
(63, 'asss', '2024-11-19', '13:00:00', 1, NULL),
(64, 'asss', '2024-11-06', '08:00:00', 1, NULL),
(65, 'asss', '2024-11-06', '09:00:00', 1, NULL),
(66, 'asss', '2024-11-06', '10:00:00', 1, NULL),
(67, 'asss', '2024-11-06', '11:00:00', 1, NULL),
(68, 'asss', '2024-11-06', '12:00:00', 1, NULL),
(69, 'asss', '2024-11-06', '13:00:00', 1, NULL),
(70, 'asss', '2024-11-13', '08:00:00', 1, NULL),
(71, 'asss', '2024-11-13', '09:00:00', 1, NULL),
(72, 'asss', '2024-11-13', '10:00:00', 1, NULL),
(73, 'asss', '2024-11-13', '11:00:00', 1, NULL),
(74, 'asss', '2024-11-13', '12:00:00', 1, NULL),
(75, 'asss', '2024-11-13', '13:00:00', 1, NULL),
(76, 'asss', '2024-11-20', '08:00:00', 1, NULL),
(77, 'asss', '2024-11-20', '09:00:00', 1, NULL),
(78, 'asss', '2024-11-20', '10:00:00', 1, NULL),
(79, 'asss', '2024-11-20', '11:00:00', 1, NULL),
(80, 'asss', '2024-11-20', '12:00:00', 1, NULL),
(81, 'asss', '2024-11-20', '13:00:00', 1, NULL),
(82, 'asss', '2024-11-07', '08:00:00', 1, NULL),
(83, 'asss', '2024-11-07', '09:00:00', 1, NULL),
(84, 'asss', '2024-11-07', '10:00:00', 1, NULL),
(85, 'asss', '2024-11-07', '11:00:00', 1, NULL),
(86, 'asss', '2024-11-07', '12:00:00', 1, NULL),
(87, 'asss', '2024-11-07', '13:00:00', 1, NULL),
(88, 'asss', '2024-11-07', '14:00:00', 1, NULL),
(89, 'asss', '2024-11-14', '08:00:00', 1, NULL),
(90, 'asss', '2024-11-14', '09:00:00', 1, NULL),
(91, 'asss', '2024-11-14', '10:00:00', 1, NULL),
(92, 'asss', '2024-11-14', '11:00:00', 1, NULL),
(93, 'asss', '2024-11-14', '12:00:00', 1, NULL),
(94, 'asss', '2024-11-14', '13:00:00', 1, NULL),
(95, 'asss', '2024-11-14', '14:00:00', 1, NULL),
(96, 'asss', '2024-11-21', '08:00:00', 1, NULL),
(97, 'asss', '2024-11-21', '09:00:00', 1, NULL),
(98, 'asss', '2024-11-21', '10:00:00', 1, NULL),
(99, 'asss', '2024-11-21', '11:00:00', 1, NULL),
(100, 'asss', '2024-11-21', '12:00:00', 1, NULL),
(101, 'asss', '2024-11-21', '13:00:00', 1, NULL),
(102, 'asss', '2024-11-21', '14:00:00', 1, NULL),
(103, 'asss', '2024-11-08', '09:00:00', 1, NULL),
(104, 'asss', '2024-11-08', '10:00:00', 1, NULL),
(105, 'asss', '2024-11-08', '11:00:00', 1, NULL),
(106, 'asss', '2024-11-08', '12:00:00', 1, NULL),
(107, 'asss', '2024-11-08', '13:00:00', 1, NULL),
(108, 'asss', '2024-11-15', '09:00:00', 1, NULL),
(109, 'asss', '2024-11-15', '10:00:00', 1, NULL),
(110, 'asss', '2024-11-15', '11:00:00', 1, NULL),
(111, 'asss', '2024-11-15', '12:00:00', 1, NULL),
(112, 'asss', '2024-11-15', '13:00:00', 1, NULL),
(113, 'asss', '2024-11-22', '09:00:00', 1, NULL),
(114, 'asss', '2024-11-22', '10:00:00', 1, NULL),
(115, 'asss', '2024-11-22', '11:00:00', 1, NULL),
(116, 'asss', '2024-11-22', '12:00:00', 1, NULL),
(117, 'asss', '2024-11-22', '13:00:00', 1, NULL),
(118, 'asss', '2024-11-09', '10:00:00', 1, NULL),
(119, 'asss', '2024-11-09', '11:00:00', 1, NULL),
(120, 'asss', '2024-11-09', '12:00:00', 1, NULL),
(121, 'asss', '2024-11-09', '13:00:00', 1, NULL),
(122, 'asss', '2024-11-16', '10:00:00', 1, NULL),
(123, 'asss', '2024-11-16', '11:00:00', 1, NULL),
(124, 'asss', '2024-11-16', '12:00:00', 1, NULL),
(125, 'asss', '2024-11-16', '13:00:00', 1, NULL),
(126, 'asss', '2024-11-23', '10:00:00', 1, NULL),
(127, 'asss', '2024-11-23', '11:00:00', 1, NULL),
(128, 'asss', '2024-11-23', '12:00:00', 1, NULL),
(129, 'asss', '2024-11-23', '13:00:00', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro`
--

CREATE TABLE `foro` (
  `id_foro` int(11) NOT NULL,
  `pregunta` varchar(255) NOT NULL,
  `nombre_usuario_cliente` varchar(255) NOT NULL,
  `respuesta` varchar(255) DEFAULT NULL,
  `nombre_usuario_prof` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `id_institucion` int(11) NOT NULL,
  `nombre_institucion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`id_institucion`, `nombre_institucion`) VALUES
(3, 'Universidad San Sebastián');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar_atencion_presencial`
--

CREATE TABLE `lugar_atencion_presencial` (
  `id_lugar_atencion` int(11) NOT NULL,
  `id_comuna` int(11) NOT NULL,
  `nombre_usuario_prof` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lugar_atencion_presencial`
--

INSERT INTO `lugar_atencion_presencial` (`id_lugar_atencion`, `id_comuna`, `nombre_usuario_prof`) VALUES
(1, 10, 'a'),
(2, 11, 's'),
(3, 11, 'a'),
(4, 11, 'a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar_atencion_virtual`
--

CREATE TABLE `lugar_atencion_virtual` (
  `id_lugar_atencion` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `nombre_usuario_prof` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajea`
--

CREATE TABLE `mensajea` (
  `mensaje` varchar(255) NOT NULL,
  `nombre_usuario_cliente` varchar(255) NOT NULL,
  `nombre_usuario_profesional` varchar(255) NOT NULL
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
(20, 'asdasdasdasdasdasdasdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_rol`
--

CREATE TABLE `permiso_rol` (
  `id_permiso` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesion`
--

CREATE TABLE `profesion` (
  `id_profesion` int(11) NOT NULL,
  `nombre_profesion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesion`
--

INSERT INTO `profesion` (`id_profesion`, `nombre_profesion`) VALUES
(7, 'Chef'),
(8, 'Contador Auditor'),
(4, 'Ingeniero Civil'),
(10, 'Ingeniero Civil Eléctrico'),
(9, 'Ingeniero Civil Industrial'),
(6, 'Ingeniero Civil Informático');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesional`
--

CREATE TABLE `profesional` (
  `nombre_usuario` varchar(255) NOT NULL,
  `id_institucion` int(11) NOT NULL,
  `id_profesion` int(11) NOT NULL,
  `horario` datetime NOT NULL,
  `experiencia` varchar(255) NOT NULL,
  `titulo_prof` varchar(255) NOT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `biografia` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesional`
--

INSERT INTO `profesional` (`nombre_usuario`, `id_institucion`, `id_profesion`, `horario`, `experiencia`, `titulo_prof`, `estado`, `biografia`) VALUES
('a', 3, 7, '2024-11-03 17:05:04', 'a', 'a', NULL, NULL),
('asss', 3, 8, '2024-11-04 08:14:56', 'A', 'A', NULL, 'A'),
('s', 3, 8, '2024-11-03 18:22:22', 'a', 'a', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redes_sociales`
--

CREATE TABLE `redes_sociales` (
  `id_rs` int(11) NOT NULL,
  `nombre_rs` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `redes_sociales`
--

INSERT INTO `redes_sociales` (`id_rs`, `nombre_rs`) VALUES
(1, 'Facebookasdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE `region` (
  `id_region` int(11) NOT NULL,
  `nombre_region` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`id_region`, `nombre_region`) VALUES
(8, 'biobio'),
(2, 'Tarapacá');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporta_profesional`
--

CREATE TABLE `reporta_profesional` (
  `motivo` varchar(255) NOT NULL,
  `nombre_usuario_cliente` varchar(255) NOT NULL,
  `nombre_usuario_profesional` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(10, 'cliente'),
(11, 'profesional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rs_profesional`
--

CREATE TABLE `rs_profesional` (
  `nombre_usuario` varchar(255) NOT NULL,
  `id_rs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id_servicio` int(11) NOT NULL,
  `nombre_servicio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_servicio`, `nombre_servicio`) VALUES
(1, 'Desarrollo de aplicación móvil para Androidasdasd'),
(2, 'hola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_prof`
--

CREATE TABLE `servicio_prof` (
  `nombre_usuario_prof` varchar(255) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `monto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio_prof`
--

INSERT INTO `servicio_prof` (`nombre_usuario_prof`, `id_servicio`, `monto`) VALUES
('a', 1, 1000),
('s', 2, 1000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_horario`
--

CREATE TABLE `tipo_horario` (
  `id_tipohorario` int(11) NOT NULL,
  `horario` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_horario`
--

INSERT INTO `tipo_horario` (`id_tipohorario`, `horario`) VALUES
(15, '11:11:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre_usuario` varchar(255) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `rut` int(11) NOT NULL,
  `apellido_p` varchar(255) NOT NULL,
  `apellido_m` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `fecha_nac` date NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_comuna` int(11) NOT NULL,
  `calle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre_usuario`, `nombres`, `rut`, `apellido_p`, `apellido_m`, `contraseña`, `fecha_nac`, `foto_perfil`, `telefono`, `correo`, `id_rol`, `id_comuna`, `calle`) VALUES
('a', 'a', 20981734, 'a', 'a', 'a', '2002-03-07', 'images/foto_perfil1.jfif', 0, 'nvasquezsu@ing.ucsc.cl', 10, 10, ''),
('asdasdasd', 'asd', 232323, 'asdasdsa', 'asdasdas', '$2y$10$z.vQmOep1Ws7WR0a0ExKGeiESGP8RLhEqw1cexEO1PMxBPXaw6uFa', '2002-03-07', NULL, 232332, 'asdasd@gmail.com', 10, 10, ''),
('asss', 'aa', 2, 'a', 'a', '47bce5c74f589f4867dbd57e9ca9f808', '2002-03-07', 'images/foto_perfil1.jfif', 0, 'asdasd@gmail.com', 10, 10, 'a'),
('s', 'a', 1, 'a', 'a', 'a', '2002-03-07', NULL, 22, 'a', 10, 11, ''),
('yungni', 'nico', 209, 'v', 'v', '$2y$10$iWCLwllp7ZznghU8Kwr/.Ok4qdpwZaoH.mpGcvDoM.Xis3nhN2ytS', '2002-03-07', NULL, 98123, 'nvasquezsu@ing.ucsc.cl', 10, 10, 'a'),
('yungnico', 'nico', 2098, 'v', 'v', '$2y$10$7NKbgvM6Zb5oJMPhiKGcYOYaQJ2V3j6ISPqeMYEM1NfyQbGEO.nHW', '2002-03-07', NULL, 98123, 'nvasquezsu@ing.ucsc.cl', 10, 10, 'a');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`nombre_usuario`);

--
-- Indices de la tabla `banea_usuario`
--
ALTER TABLE `banea_usuario`
  ADD KEY `nombre_usuario_admin` (`nombre_usuario_admin`),
  ADD KEY `nombre_usuario` (`nombre_usuario`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `nombre_usuario_cliente` (`nombre_usuario_cliente`),
  ADD KEY `nombre_usuario_profesional` (`nombre_usuario_profesional`),
  ADD KEY `id_tipohorario` (`id_tipohorario`);

--
-- Indices de la tabla `cita_online`
--
ALTER TABLE `cita_online`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_lugar_atencion_vir` (`id_lugar_atencion_vir`);

--
-- Indices de la tabla `cita_presencial`
--
ALTER TABLE `cita_presencial`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_lugar_atencion_pre` (`id_lugar_atencion_pre`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id_ciudad`),
  ADD UNIQUE KEY `nombre_ciudad` (`nombre_ciudad`),
  ADD KEY `id_region` (`id_region`),
  ADD KEY `id_ciudad` (`id_ciudad`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`nombre_usuario`);

--
-- Indices de la tabla `cliente_servicio`
--
ALTER TABLE `cliente_servicio`
  ADD PRIMARY KEY (`nombre_usuario_cliente`,`id_servicio`,`nombre_usuario_prof`),
  ADD KEY `id_servicio` (`id_servicio`),
  ADD KEY `nombre_usuario_prof` (`nombre_usuario_prof`);

--
-- Indices de la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD PRIMARY KEY (`id_comuna`),
  ADD UNIQUE KEY `nombre_comuna` (`nombre_comuna`),
  ADD KEY `id_ciudad` (`id_ciudad`);

--
-- Indices de la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nombre_usuario` (`nombre_usuario`),
  ADD KEY `nombre_cliente` (`nombre_cliente`);

--
-- Indices de la tabla `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`id_foro`),
  ADD KEY `nombre_usuario_cliente` (`nombre_usuario_cliente`),
  ADD KEY `nombre_usuario_prof` (`nombre_usuario_prof`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`id_institucion`),
  ADD UNIQUE KEY `nombre_institucion` (`nombre_institucion`);

--
-- Indices de la tabla `lugar_atencion_presencial`
--
ALTER TABLE `lugar_atencion_presencial`
  ADD PRIMARY KEY (`id_lugar_atencion`),
  ADD KEY `id_comuna` (`id_comuna`),
  ADD KEY `nombre_usuario_prof` (`nombre_usuario_prof`);

--
-- Indices de la tabla `lugar_atencion_virtual`
--
ALTER TABLE `lugar_atencion_virtual`
  ADD PRIMARY KEY (`id_lugar_atencion`),
  ADD KEY `nombre_usuario_prof` (`nombre_usuario_prof`);

--
-- Indices de la tabla `mensajea`
--
ALTER TABLE `mensajea`
  ADD PRIMARY KEY (`nombre_usuario_cliente`,`nombre_usuario_profesional`),
  ADD KEY `nombre_usuario_profesional` (`nombre_usuario_profesional`);

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
  ADD PRIMARY KEY (`id_profesion`),
  ADD UNIQUE KEY `nombre_profesion` (`nombre_profesion`);

--
-- Indices de la tabla `profesional`
--
ALTER TABLE `profesional`
  ADD PRIMARY KEY (`nombre_usuario`),
  ADD KEY `id_institucion` (`id_institucion`),
  ADD KEY `id_profesion` (`id_profesion`);

--
-- Indices de la tabla `redes_sociales`
--
ALTER TABLE `redes_sociales`
  ADD PRIMARY KEY (`id_rs`),
  ADD UNIQUE KEY `nombre_rs` (`nombre_rs`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id_region`),
  ADD UNIQUE KEY `nombre_region` (`nombre_region`);

--
-- Indices de la tabla `reporta_profesional`
--
ALTER TABLE `reporta_profesional`
  ADD PRIMARY KEY (`nombre_usuario_cliente`,`nombre_usuario_profesional`),
  ADD KEY `nombre_usuario_profesional` (`nombre_usuario_profesional`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre_rol` (`nombre_rol`);

--
-- Indices de la tabla `rs_profesional`
--
ALTER TABLE `rs_profesional`
  ADD PRIMARY KEY (`nombre_usuario`,`id_rs`),
  ADD KEY `id_rs` (`id_rs`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`),
  ADD UNIQUE KEY `nombre_servicio` (`nombre_servicio`);

--
-- Indices de la tabla `servicio_prof`
--
ALTER TABLE `servicio_prof`
  ADD PRIMARY KEY (`nombre_usuario_prof`,`id_servicio`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `tipo_horario`
--
ALTER TABLE `tipo_horario`
  ADD PRIMARY KEY (`id_tipohorario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`nombre_usuario`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_comuna` (`id_comuna`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `comuna`
--
ALTER TABLE `comuna`
  MODIFY `id_comuna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT de la tabla `foro`
--
ALTER TABLE `foro`
  MODIFY `id_foro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `id_institucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `lugar_atencion_presencial`
--
ALTER TABLE `lugar_atencion_presencial`
  MODIFY `id_lugar_atencion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `lugar_atencion_virtual`
--
ALTER TABLE `lugar_atencion_virtual`
  MODIFY `id_lugar_atencion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `profesion`
--
ALTER TABLE `profesion`
  MODIFY `id_profesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `redes_sociales`
--
ALTER TABLE `redes_sociales`
  MODIFY `id_rs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_horario`
--
ALTER TABLE `tipo_horario`
  MODIFY `id_tipohorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`nombre_usuario`) REFERENCES `usuario` (`nombre_usuario`);

--
-- Filtros para la tabla `banea_usuario`
--
ALTER TABLE `banea_usuario`
  ADD CONSTRAINT `banea_usuario_ibfk_1` FOREIGN KEY (`nombre_usuario_admin`) REFERENCES `administrador` (`nombre_usuario`),
  ADD CONSTRAINT `banea_usuario_ibfk_2` FOREIGN KEY (`nombre_usuario`) REFERENCES `usuario` (`nombre_usuario`);

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`nombre_usuario_cliente`) REFERENCES `cliente` (`nombre_usuario`),
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`nombre_usuario_profesional`) REFERENCES `profesional` (`nombre_usuario`),
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`id_tipohorario`) REFERENCES `tipo_horario` (`id_tipohorario`);

--
-- Filtros para la tabla `cita_online`
--
ALTER TABLE `cita_online`
  ADD CONSTRAINT `cita_online_ibfk_1` FOREIGN KEY (`id_cita`) REFERENCES `cita` (`id_cita`),
  ADD CONSTRAINT `cita_online_ibfk_2` FOREIGN KEY (`id_lugar_atencion_vir`) REFERENCES `lugar_atencion_virtual` (`id_lugar_atencion`);

--
-- Filtros para la tabla `cita_presencial`
--
ALTER TABLE `cita_presencial`
  ADD CONSTRAINT `cita_presencial_ibfk_1` FOREIGN KEY (`id_cita`) REFERENCES `cita` (`id_cita`),
  ADD CONSTRAINT `cita_presencial_ibfk_2` FOREIGN KEY (`id_lugar_atencion_pre`) REFERENCES `lugar_atencion_presencial` (`id_lugar_atencion`);

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `ciudad_ibfk_1` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`nombre_usuario`) REFERENCES `usuario` (`nombre_usuario`);

--
-- Filtros para la tabla `cliente_servicio`
--
ALTER TABLE `cliente_servicio`
  ADD CONSTRAINT `cliente_servicio_ibfk_1` FOREIGN KEY (`nombre_usuario_cliente`) REFERENCES `cliente` (`nombre_usuario`),
  ADD CONSTRAINT `cliente_servicio_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicio_prof` (`id_servicio`),
  ADD CONSTRAINT `cliente_servicio_ibfk_3` FOREIGN KEY (`nombre_usuario_prof`) REFERENCES `servicio_prof` (`nombre_usuario_prof`);

--
-- Filtros para la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD CONSTRAINT `comuna_ibfk_1` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudad` (`id_ciudad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  ADD CONSTRAINT `disponibilidad_ibfk_1` FOREIGN KEY (`nombre_usuario`) REFERENCES `profesional` (`nombre_usuario`),
  ADD CONSTRAINT `disponibilidad_ibfk_2` FOREIGN KEY (`nombre_cliente`) REFERENCES `cliente` (`nombre_usuario`);

--
-- Filtros para la tabla `foro`
--
ALTER TABLE `foro`
  ADD CONSTRAINT `foro_ibfk_1` FOREIGN KEY (`nombre_usuario_cliente`) REFERENCES `cliente` (`nombre_usuario`),
  ADD CONSTRAINT `foro_ibfk_2` FOREIGN KEY (`nombre_usuario_prof`) REFERENCES `profesional` (`nombre_usuario`);

--
-- Filtros para la tabla `lugar_atencion_presencial`
--
ALTER TABLE `lugar_atencion_presencial`
  ADD CONSTRAINT `lugar_atencion_presencial_ibfk_1` FOREIGN KEY (`id_comuna`) REFERENCES `comuna` (`id_comuna`),
  ADD CONSTRAINT `lugar_atencion_presencial_ibfk_2` FOREIGN KEY (`nombre_usuario_prof`) REFERENCES `profesional` (`nombre_usuario`);

--
-- Filtros para la tabla `lugar_atencion_virtual`
--
ALTER TABLE `lugar_atencion_virtual`
  ADD CONSTRAINT `lugar_atencion_virtual_ibfk_1` FOREIGN KEY (`nombre_usuario_prof`) REFERENCES `profesional` (`nombre_usuario`);

--
-- Filtros para la tabla `mensajea`
--
ALTER TABLE `mensajea`
  ADD CONSTRAINT `mensajea_ibfk_1` FOREIGN KEY (`nombre_usuario_cliente`) REFERENCES `cliente` (`nombre_usuario`),
  ADD CONSTRAINT `mensajea_ibfk_2` FOREIGN KEY (`nombre_usuario_profesional`) REFERENCES `profesional` (`nombre_usuario`);

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
  ADD CONSTRAINT `profesional_ibfk_1` FOREIGN KEY (`nombre_usuario`) REFERENCES `usuario` (`nombre_usuario`),
  ADD CONSTRAINT `profesional_ibfk_2` FOREIGN KEY (`id_institucion`) REFERENCES `institucion` (`id_institucion`),
  ADD CONSTRAINT `profesional_ibfk_3` FOREIGN KEY (`id_profesion`) REFERENCES `profesion` (`id_profesion`);

--
-- Filtros para la tabla `reporta_profesional`
--
ALTER TABLE `reporta_profesional`
  ADD CONSTRAINT `reporta_profesional_ibfk_1` FOREIGN KEY (`nombre_usuario_cliente`) REFERENCES `cliente` (`nombre_usuario`),
  ADD CONSTRAINT `reporta_profesional_ibfk_2` FOREIGN KEY (`nombre_usuario_profesional`) REFERENCES `profesional` (`nombre_usuario`);

--
-- Filtros para la tabla `rs_profesional`
--
ALTER TABLE `rs_profesional`
  ADD CONSTRAINT `rs_profesional_ibfk_1` FOREIGN KEY (`nombre_usuario`) REFERENCES `profesional` (`nombre_usuario`),
  ADD CONSTRAINT `rs_profesional_ibfk_2` FOREIGN KEY (`id_rs`) REFERENCES `redes_sociales` (`id_rs`);

--
-- Filtros para la tabla `servicio_prof`
--
ALTER TABLE `servicio_prof`
  ADD CONSTRAINT `servicio_prof_ibfk_1` FOREIGN KEY (`nombre_usuario_prof`) REFERENCES `profesional` (`nombre_usuario`),
  ADD CONSTRAINT `servicio_prof_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_comuna`) REFERENCES `comuna` (`id_comuna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
