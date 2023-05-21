-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2023 a las 03:55:11
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agenda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `dia` tinyint(2) NOT NULL,
  `nrodiasemana` tinyint(2) NOT NULL,
  `mes` tinyint(2) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `completado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id` int(10) NOT NULL,
  `title` varchar(45) NOT NULL,
  `start` date NOT NULL,
  `color` varchar(25) NOT NULL,
  `tarea` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id`, `title`, `start`, `color`, `tarea`) VALUES
(5, 'hacer la comida', '2023-05-17', '#00ff91', 'dafsdgdfagsfdg'),
(6, 'hacer las tareas', '2023-05-17', '#000000', 'dafsdgdfagsfdg'),
(10, 'ir a clases', '2023-05-18', '#000000', 'gxhngzgfdg'),
(11, 'manejar mi carro', '2023-05-18', '#000000', 'hhhkkjfhhhhhhhhhhhhhhhhhhhhhhhhhhh'),
(12, 'dormir', '2023-05-18', '#000000', 'hhhkkjfhhhhhhhhhhhhhhhhhhhhhhhhhhh'),
(13, 'Pasear al perro', '2023-05-17', '#ff0000', 'undefined'),
(14, 'subir el proyecto a github', '2023-05-20', '#e1ff00', ''),
(15, 'hola soy una tarea', '2023-05-20', '#0033ff', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `status` enum('PENDIENTE','REALIZADA') DEFAULT 'PENDIENTE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `description`, `date`, `status`) VALUES
(90, 'Tarea ejecutar base de datos', 'base de datos en mysql con AWS', '2023-05-16', 'PENDIENTE'),
(91, 'esta es una tarea', 'subir contenido a fitsi', '2023-05-20', 'PENDIENTE'),
(92, 'mi tarea 2.0', 'esta es la tarea de cargar archivos a la web', '2023-05-13', 'PENDIENTE'),
(157, 'mi tarea', 'fsdgdffbdafsfgdfg', '2023-05-24', 'REALIZADA'),
(158, 'admin tarea', 'tarea terminada ejercicios matematicas', '2023-05-04', 'REALIZADA'),
(161, 'Tarea ejecutar base de datos', 'base de datos en mysql con AWS', '2023-05-16', 'PENDIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `todo`
--

CREATE TABLE `todo` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` tinyint(4) NOT NULL COMMENT '	0 for not completed, 1 for completed, 2 for hidden	',
  `fecha_hora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `todo`
--

INSERT INTO `todo` (`id`, `descripcion`, `estado`, `fecha_hora`) VALUES
(1, 'Subir al github el proyecto', 0, '0000-00-00 00:00:00'),
(2, 'trabajar en la pagina de ferrotienda', 0, '0000-00-00 00:00:00'),
(3, 'activar las campañas de facebook de bullstore', 0, '0000-00-00 00:00:00'),
(5, 'crear la web de ferrotienda', 0, '0000-00-00 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT de la tabla `todo`
--
ALTER TABLE `todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
