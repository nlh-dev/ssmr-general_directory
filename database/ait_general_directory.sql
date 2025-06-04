-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2025 a las 21:30:54
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
-- Base de datos: `ait_general_directory`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observations`
--

CREATE TABLE `observations` (
  `observation_ID` int(11) NOT NULL,
  `observation_user_ID` int(11) NOT NULL,
  `observation_reason` text NOT NULL,
  `observation_type_ID` int(11) NOT NULL,
  `observations_priority_ID` int(11) NOT NULL,
  `observation_description` text NOT NULL,
  `observation_createdAtDate` date NOT NULL,
  `observation_createdAtTime` time NOT NULL,
  `observation_updatedAtDate` date NOT NULL,
  `observation_updatedAtTime` time NOT NULL,
  `observation_isDone` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `observations`
--

INSERT INTO `observations` (`observation_ID`, `observation_user_ID`, `observation_reason`, `observation_type_ID`, `observations_priority_ID`, `observation_description`, `observation_createdAtDate`, `observation_createdAtTime`, `observation_updatedAtDate`, `observation_updatedAtTime`, `observation_isDone`) VALUES
(1, 1, 'PRUEBA 1', 4, 1, 'El estudiante mantiene una actitud atenta y participativa durante la clase, demostrando interés en los temas abordados. Realiza preguntas pertinentes y aporta ideas claras, mostrando comprensión de los contenidos. Sin embargo, ocasionalmente se distrae con facilidad, lo que afecta levemente su ritmo de trabajo', '2025-06-04', '09:09:06', '2025-06-04', '09:09:06', 1),
(2, 1, 'PRUEBA 2', 2, 2, '', '2025-06-04', '10:55:01', '2025-06-04', '10:55:01', 0),
(3, 1, 'PRUEBA 3', 3, 3, '', '2025-06-04', '10:55:57', '2025-06-04', '10:55:57', 0),
(4, 1, 'PRUEBA 4', 1, 4, '', '2025-06-04', '10:56:15', '2025-06-04', '10:56:15', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `observations`
--
ALTER TABLE `observations`
  ADD PRIMARY KEY (`observation_ID`),
  ADD KEY `observation_user_ID` (`observation_user_ID`),
  ADD KEY `observation_type_ID` (`observation_type_ID`,`observations_priority_ID`),
  ADD KEY `observations_priority_ID` (`observations_priority_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `observations`
--
ALTER TABLE `observations`
  MODIFY `observation_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `observations`
--
ALTER TABLE `observations`
  ADD CONSTRAINT `observations_ibfk_1` FOREIGN KEY (`observation_user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `observations_ibfk_2` FOREIGN KEY (`observation_type_ID`) REFERENCES `observations_type` (`observationType_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `observations_ibfk_3` FOREIGN KEY (`observations_priority_ID`) REFERENCES `observations_priority` (`observationsPriority_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
