-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-05-2023 a las 22:12:26
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `academia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `dnia` int(11) NOT NULL,
  `curso` varchar(40) NOT NULL,
  `centro` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`dnia`, `curso`, `centro`) VALUES
(666666666, '1bach', 'ies Triana'),
(333333333, '3eso', 'ies Triana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE `clase` (
  `d_semana` varchar(20) NOT NULL,
  `h_clase` varchar(20) NOT NULL,
  `t_clase` varchar(20) NOT NULL,
  `id_prof` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`d_semana`, `h_clase`, `t_clase`, `id_prof`) VALUES
('lunes', '16', 'mathemáticas 	', 111111111),
('lunes', '17', 'mathemáticas 	', 111111111),
('lunes', '18', 'mathemáticas 	', 111111111);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE `evaluacion` (
  `id_alumno_nota` int(11) NOT NULL,
  `nota` double(4,2) NOT NULL,
  `fecha` varchar(10) NOT NULL,
  `asignatura` varchar(20) NOT NULL,
  `id_nota` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `evaluacion`
--

INSERT INTO `evaluacion` (`id_alumno_nota`, `nota`, `fecha`, `asignatura`, `id_nota`) VALUES
(333333333, 5.00, '15.9', 'matemáticas', 1),
(333333333, 6.00, '20.9', 'matemáticas', 2),
(333333333, 6.20, '24.9', 'matemáticas', 3),
(333333333, 6.90, '28.9', 'matemáticas', 4),
(333333333, 7.50, '11.10', 'matemáticas', 5),
(333333333, 7.90, '15.10', 'matemáticas', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `horario_prof` int(11) NOT NULL,
  `dia` varchar(20) NOT NULL,
  `hora` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`horario_prof`, `dia`, `hora`) VALUES
(111111111, 'jueves', '17'),
(111111111, 'jueves', '18'),
(111111111, 'lunes', '16'),
(111111111, 'lunes', '17'),
(111111111, 'lunes', '18'),
(111111111, 'martes', '16'),
(111111111, 'martes', '17'),
(222222222, 'lunes', '19'),
(222222222, 'lunes', '20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `id_alumno` int(11) NOT NULL,
  `h_clase` varchar(20) NOT NULL,
  `d_clase` varchar(20) NOT NULL,
  `t_clase` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`id_alumno`, `h_clase`, `d_clase`, `t_clase`) VALUES
(333333333, '17', 'lunes', 'fisica'),
(333333333, '18', 'lunes', 'matematicas'),
(666666666, '18', 'lunes', 'matematicas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `dni` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`dni`, `nombre`, `apellidos`, `email`) VALUES
(111111111, 'Luis', 'Morales', 'morales@msn.com'),
(222222222, 'Maria', 'Carillo', 'carillo@msn.com'),
(333333333, 'marta', 'montero', 'marta@msn.com'),
(666666666, 'lucia', 'barco', 'lucia@msn.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `dnip` int(11) NOT NULL,
  `tipo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`dnip`, `tipo`) VALUES
(111111111, 'matematicas'),
(222222222, 'fisica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `fecha` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `asignatura` varchar(20) NOT NULL,
  `id` int(11) NOT NULL,
  `email_alumno` varchar(50) NOT NULL,
  `recurso` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`fecha`, `asignatura`, `id`, `email_alumno`, `recurso`) VALUES
('2023-05-19 18:15:29.647940', 'matematicas', 14, 'marta@msn.com', 'app/views/alumno/app_views_alumno_tabla3-4.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE `tarea` (
  `id_alumno` int(11) NOT NULL,
  `f_entrega` varchar(10) NOT NULL,
  `nota` decimal(10,0) NOT NULL,
  `tarea_nom` varchar(40) NOT NULL,
  `coment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`d_semana`,`h_clase`,`t_clase`,`id_prof`);

--
-- Indices de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`horario_prof`,`dia`,`hora`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`dnip`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  MODIFY `id_nota` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
