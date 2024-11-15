-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2024 a las 19:56:54
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
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id_ciudad` int(11) NOT NULL,
  `nombre_ciudad` varchar(50) NOT NULL,
  `id_region` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id_ciudad`, `nombre_ciudad`, `id_region`) VALUES
(1, 'Arica', 1),
(2, 'Putre', 1),
(3, 'Iquique', 2),
(4, 'Pozo Almonte', 2),
(6, 'Antofagasta', 3),
(7, 'Calama', 3),
(8, 'Tocopilla', 3),
(9, 'Chañaral', 4),
(10, 'Copiapó', 4),
(11, 'Vallenar', 4),
(12, 'Coquimbo', 5),
(13, 'Ovalle', 5),
(14, 'Illapel', 5),
(15, 'Hanga Roa', 6),
(16, 'Los Andes', 6),
(17, 'La Ligua', 6),
(18, 'Quillota', 6),
(19, 'San Antonio', 6),
(20, 'San Felipe', 6),
(21, 'Valparaíso', 6),
(22, 'Quilpué', 6),
(23, 'Colina', 7),
(24, 'Puente Alto', 7),
(25, 'San Bernardo', 7),
(26, 'Melipilla', 7),
(27, 'Santiago', 7),
(28, 'Talagante', 7),
(29, 'Rancagua', 8),
(30, 'Pichilemu', 8),
(31, 'San Fernando', 8),
(32, 'Cauquenes', 9),
(33, 'Curicó', 9),
(34, 'Linares', 9),
(35, 'Talca', 9),
(36, 'Quirihue', 10),
(37, 'Bulnes', 10),
(38, 'San Carlos', 10),
(39, 'Lebu', 11),
(40, 'Los Ángeles', 11),
(41, 'Concepción', 11),
(42, 'Temuco', 12),
(43, 'Angol', 12),
(44, 'Valdivia', 13),
(45, 'La Unión', 13),
(46, 'Castro', 14),
(47, 'Puerto Montt', 14),
(48, 'Osorno', 14),
(49, 'Chaitén', 14),
(50, 'Puerto Aysén', 15),
(51, 'Cochrane', 15),
(52, 'Coyhaique', 15),
(53, 'Chile Chico', 15),
(54, 'Puerto Williams', 16),
(55, 'Punta Arenas', 16),
(56, 'Porvenir', 16),
(57, 'Puerto Natales', 16);

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
  `nombre_comuna` varchar(50) NOT NULL,
  `id_ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comuna`
--

INSERT INTO `comuna` (`id_comuna`, `nombre_comuna`, `id_ciudad`) VALUES
(1, 'Arica', 1),
(3, 'Camarones', 1),
(4, 'General Lagos', 2),
(5, 'Putre', 2),
(6, 'Alto Hospicio', 3),
(7, 'Iquique', 3),
(8, 'Camiña', 4),
(9, 'Colchane', 4),
(10, 'Huara', 4),
(11, 'Pica', 4),
(12, 'Pozo Almonte', 4),
(13, 'Antofagasta', 6),
(14, 'Mejillones', 6),
(15, 'Sierra Gorda', 6),
(16, 'Taltal', 6),
(17, 'Calama', 7),
(18, 'Ollagüe', 7),
(19, 'San Pedro de Atacama', 7),
(20, 'María Elena', 8),
(21, 'Tocopilla', 8),
(22, 'Chañaral', 9),
(23, 'Diego de Almagro', 9),
(24, 'Caldera', 10),
(25, 'Copiapó', 10),
(26, 'Tierra Amarilla', 10),
(27, 'Alto del Carmen', 11),
(28, 'Freirina', 11),
(29, 'Huasco', 11),
(30, 'Vallenar', 11),
(31, 'Andacollo', 12),
(32, 'Coquimbo', 12),
(33, 'La Higuera', 12),
(34, 'La Serena', 12),
(35, 'Paihuano', 12),
(36, 'Vicuña', 12),
(37, 'Combarbalá', 13),
(38, 'Monte Patria', 13),
(39, 'Ovalle', 13),
(40, 'Punitaqui', 13),
(41, 'Río Hurtado', 13),
(42, 'Canela', 14),
(43, 'Los Vilos', 14),
(44, 'Salamanca', 14),
(45, 'Isla de Pascua', 15),
(46, 'Calle Larga', 16),
(47, 'Los Andes', 16),
(48, 'Rinconada', 16),
(49, 'San Esteban', 16),
(50, 'Cabildo', 17),
(51, 'La Ligua', 17),
(52, 'Papudo', 17),
(53, 'Papudo', 17),
(54, 'Petorca', 17),
(55, 'Zapallar', 17),
(56, 'Hijuelas', 18),
(57, 'La Calera', 18),
(58, 'La Cruz', 18),
(59, 'Nogales', 18),
(60, 'Quillota', 18),
(61, 'Algarrobo', 19),
(62, 'Cartagena', 19),
(63, 'El Quisco', 19),
(64, 'El Tabo', 19),
(65, 'San Antonio', 19),
(66, 'Santo Domingo', 19),
(67, 'Catemu', 20),
(68, 'Llay-Llay', 20),
(69, 'Panquehue', 20),
(70, 'Putaendo', 20),
(71, 'San Felipe', 20),
(72, 'Santa María', 20),
(73, 'Casablanca', 21),
(74, 'Concón', 21),
(75, 'Juan Fernández', 21),
(76, 'Puchuncaví', 21),
(77, 'Quintero', 21),
(78, 'Valparaíso', 21),
(79, 'Viña del Mar', 21),
(80, 'Limache', 22),
(81, 'Olmué', 22),
(82, 'Quilpué', 22),
(83, 'Villa Alemana', 22);

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
(14565656, 1, 1, NULL, 'Sé hacer de todo', '../../uploads/titulo_profesional/Consentimiento Informado ENCE CRUCH 2024.docx.pdf'),
(16767878, 7, 3, NULL, 'Gestión tributaria y Operación Renta anual', '../../uploads/titulo_profesional/DataTables example - PDF - image.pdf');

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
  `nombre_region` varchar(50) NOT NULL
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
(11086788, 'Lorena', 'Lorena', 'Lagos', 'Sanhueza', 'lorena@gmail.com', 998876565, '1998-08-25', 'Avenida Bernardo O\'Higgins 3272', '827ccb0eea8a706c4c34a16891f84e7b', '', 65, 4, 1),
(12345678, 'Cliente', 'Cliente', 'Pérez', 'García', 'cliente@gmail.com', 999999999, '1999-08-25', 'Calle DEF, 321', '202cb962ac59075b964b07152d234b70', NULL, 1, 4, 1),
(13082637, 'Admin', 'Admin', 'Prueba', 'Prueba', 'admin@gmail.com', 982872637, '1995-08-08', 'Calle Nueva 123', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 1, 2, 1),
(14565656, 'Hector', 'Héctor', 'Jiménez', 'Suazo', 'hector@gmail.com', 965656565, '2002-07-08', 'Avenida Arturo Prat 234', '202cb962ac59075b964b07152d234b70', 'uploads/foto_perfil/IMG_20240831_163740121.jpg', 1, 3, 1),
(16767878, 'Ernesto', 'Ernesto', 'Loyola', 'Zapata', 'ernesto@gmail.com', 988786565, '1991-12-15', 'José Arrieta 2345', 'e10adc3949ba59abbe56e057f20f883e', 'uploads/foto_perfil/IMG_20240810_181021908.jpg', 36, 3, 0),
(20786387, 'Alvaro', 'Álvaro Alfonso', 'Molina', 'Jara', 'alvaromolinacl@gmail.com', 951269878, '2001-07-10', 'Calle ABC, 123', '202cb962ac59075b964b07152d234b70', 'uploads/foto_perfil/foto_perfil_predeterminada.jpg', 1, 1, 1),
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
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id_ciudad`),
  ADD KEY `id_region` (`id_region`);

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
  ADD KEY `id_ciudad` (`id_ciudad`);

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
  ADD KEY `id_comuna` (`id_comuna`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_estado_usuario` (`id_estado_usuario`);

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
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `comuna`
--
ALTER TABLE `comuna`
  MODIFY `id_comuna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

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
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `ciudad_ibfk_1` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`rut`) REFERENCES `usuario` (`rut`);

--
-- Filtros para la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD CONSTRAINT `comuna_ibfk_1` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudad` (`id_ciudad`);

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
  ADD CONSTRAINT `lugar_atencion_presencial_ibfk_1` FOREIGN KEY (`rut_profesional`) REFERENCES `profesional` (`rut`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lugar_atencion_presencial_ibfk_2` FOREIGN KEY (`id_comuna`) REFERENCES `comuna` (`id_comuna`);

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

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_comuna`) REFERENCES `comuna` (`id_comuna`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`id_estado_usuario`) REFERENCES `estado_usuario` (`id_estado_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
