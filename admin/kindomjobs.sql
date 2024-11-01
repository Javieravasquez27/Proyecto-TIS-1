-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-10-2024 a las 21:13:10
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
(2, 'Iquique', 2);

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
(1, 'Alto Hospicio', 2);

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
(2, 'Universidad Andrés Bello'),
(1, 'Universidad Concepción'),
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
(1, 'Agendar citas con profesionales');

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
(5, 'Arquitecto'),
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
  `titulo_prof` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Facebook');

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
(1, 'Administrador');

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
(1, 'Desarrollo de aplicación móvil para Android');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_prof`
--

CREATE TABLE `servicio_prof` (
  `nombre_usuario_prof` varchar(255) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `monto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_horario`
--

CREATE TABLE `tipo_horario` (
  `id_tipohorario` int(11) NOT NULL,
  `horario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_horario`
--

INSERT INTO `tipo_horario` (`id_tipohorario`, `horario`) VALUES
(2, '30 min');

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
  `id_comuna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD KEY `id_region` (`id_region`);

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
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comuna`
--
ALTER TABLE `comuna`
  MODIFY `id_comuna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `foro`
--
ALTER TABLE `foro`
  MODIFY `id_foro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `id_institucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `lugar_atencion_presencial`
--
ALTER TABLE `lugar_atencion_presencial`
  MODIFY `id_lugar_atencion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lugar_atencion_virtual`
--
ALTER TABLE `lugar_atencion_virtual`
  MODIFY `id_lugar_atencion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `profesion`
--
ALTER TABLE `profesion`
  MODIFY `id_profesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `redes_sociales`
--
ALTER TABLE `redes_sociales`
  MODIFY `id_rs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_horario`
--
ALTER TABLE `tipo_horario`
  MODIFY `id_tipohorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `ciudad_ibfk_1` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`);

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
  ADD CONSTRAINT `comuna_ibfk_1` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudad` (`id_ciudad`);

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
  ADD CONSTRAINT `permiso_rol_ibfk_1` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id_permiso`),
  ADD CONSTRAINT `permiso_rol_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);

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
