-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2025 a las 21:47:17
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
-- Estructura de tabla para la tabla `departments`
--

CREATE TABLE `departments` (
  `department_ID` int(11) NOT NULL,
  `department_name` text NOT NULL,
  `department_location_ID` int(11) NOT NULL,
  `department_createdAt` datetime NOT NULL,
  `department_updatedAt` datetime NOT NULL,
  `department_isEnable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departments`
--

INSERT INTO `departments` (`department_ID`, `department_name`, `department_location_ID`, `department_createdAt`, `department_updatedAt`, `department_isEnable`) VALUES
(1, 'Oftalmologia', 2, '2025-05-16 18:19:48', '2025-05-16 18:19:48', 1),
(2, 'Laboratorio', 1, '2025-05-16 18:19:48', '2025-05-16 18:19:48', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devices`
--

CREATE TABLE `devices` (
  `device_ID` int(20) NOT NULL,
  `device_deliveryUser_ID` int(10) NOT NULL,
  `device_recievedByName` text NOT NULL,
  `device_description` varchar(50) NOT NULL,
  `device_serialCode` varchar(50) NOT NULL,
  `device_deliveryDate` date NOT NULL,
  `device_deliveryTime` time NOT NULL,
  `device_location_ID` int(10) NOT NULL,
  `device_department_ID` int(10) NOT NULL,
  `device_roomCode` varchar(50) NOT NULL,
  `device_withdrawDate` date NOT NULL,
  `device_withdrawTime` time NOT NULL,
  `device_withdrawUser_ID` int(11) NOT NULL,
  `device_isDelivered` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `devices`
--

INSERT INTO `devices` (`device_ID`, `device_deliveryUser_ID`, `device_recievedByName`, `device_description`, `device_serialCode`, `device_deliveryDate`, `device_deliveryTime`, `device_location_ID`, `device_department_ID`, `device_roomCode`, `device_withdrawDate`, `device_withdrawTime`, `device_withdrawUser_ID`, `device_isDelivered`) VALUES
(1, 1, '', 'CONTROL SAMSUNG', 'HM-2-97', '2025-05-31', '11:34:14', 1, 2, 'A-314', '0000-00-00', '00:00:00', 1, 1),
(2, 1, 'DANNY MORAN', 'CONTROL SAMSUNG', 'HM-2-646', '2025-05-31', '11:34:41', 1, 2, 'A-332', '2025-06-04', '11:36:20', 2, 0),
(3, 1, 'N/A', 'CONTROL SAMSUNG', 'HM-2-565', '2025-06-05', '14:42:07', 1, 2, 'N/A', '2025-07-05', '14:44:05', 2, 0),
(4, 1, '', 'CABLE HDMI', 'HM-2-100', '2025-06-05', '15:00:04', 1, 2, '', '0000-00-00', '00:00:00', 1, 1),
(5, 1, 'N/A', 'CONTROL SAMSUNG', 'HM-2-500', '2025-07-06', '15:00:51', 2, 1, 'N/A', '0000-00-00', '00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locations`
--

CREATE TABLE `locations` (
  `location_ID` int(11) NOT NULL,
  `location_name` text NOT NULL,
  `location_createdAt` datetime NOT NULL,
  `location_updatedAt` datetime NOT NULL,
  `location_isEnable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `locations`
--

INSERT INTO `locations` (`location_ID`, `location_name`, `location_createdAt`, `location_updatedAt`, `location_isEnable`) VALUES
(1, 'Piso 1, Lado A', '2025-05-16 16:23:01', '2025-05-16 16:23:01', 1),
(2, 'Piso 1, Lado B', '2025-05-16 18:19:19', '2025-05-16 18:19:19', 0);

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
(1, 1, 'PRUEBA 1', 4, 1, 'El estudiante mantiene una actitud atenta y participativa durante la clase, demostrando interés en los temas abordados. Realiza preguntas pertinentes y aporta ideas claras, mostrando comprensión de los contenidos. Sin embargo, ocasionalmente se distrae con facilidad, lo que afecta levemente su ritmo de trabajo', '2025-06-04', '09:09:06', '2025-06-09', '10:05:03', 0),
(2, 1, 'PRUEBA 2', 2, 2, 'l aula está bien iluminada y ordenada. Los estudiantes trabajan en silencio, concentrados en sus tareas. La profesora circula entre las mesas, ofreciendo ayuda individual. Se percibe un ambiente de calma y productividad. Algunos alumnos intercambian comentarios en voz baja.', '2025-06-05', '10:55:01', '2025-06-09', '09:19:04', 1),
(3, 1, 'PRUEBA 3', 3, 3, 'PRUEBA DE ACTUALIZACION 3', '2025-06-06', '10:55:57', '2025-06-09', '15:24:16', 1),
(4, 1, 'PRUEBA 4', 1, 4, 'PRUEBA DE ACTUALIZACION', '2025-06-07', '10:56:15', '2025-06-09', '12:49:03', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observations_priority`
--

CREATE TABLE `observations_priority` (
  `observationsPriority_ID` int(11) NOT NULL,
  `observationsPriority_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `observations_priority`
--

INSERT INTO `observations_priority` (`observationsPriority_ID`, `observationsPriority_name`) VALUES
(1, 'Baja'),
(2, 'Media'),
(3, 'Alta'),
(4, 'Critica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observations_type`
--

CREATE TABLE `observations_type` (
  `observationType_ID` int(11) NOT NULL,
  `observationType_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `observations_type`
--

INSERT INTO `observations_type` (`observationType_ID`, `observationType_name`) VALUES
(1, 'Error'),
(2, 'Sugerencia'),
(3, 'Alerta'),
(4, 'Nota');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `user_fullName` varchar(50) NOT NULL,
  `user_userName` text NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_role_ID` int(11) NOT NULL,
  `user_createdAt` datetime NOT NULL,
  `user_updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_ID`, `user_fullName`, `user_userName`, `user_password`, `user_role_ID`, `user_createdAt`, `user_updatedAt`) VALUES
(1, 'Hector Navarro', 'hectorlnavarro', 'h789123000', 1, '2025-05-27 19:51:45', '2025-05-27 19:51:45'),
(2, 'Danny Moran', 'danny_anderson', 'danny12345', 1, '2025-05-31 16:45:43', '2025-05-31 16:45:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_roles`
--

CREATE TABLE `user_roles` (
  `userRole_ID` int(11) NOT NULL,
  `userRole_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wifi_directory`
--

CREATE TABLE `wifi_directory` (
  `wifi_ID` int(11) NOT NULL,
  `wifi_SSID` varchar(100) NOT NULL,
  `wifi_password` varchar(100) NOT NULL,
  `wifi_ipDirection` varchar(20) NOT NULL,
  `wifi_location_ID` int(11) NOT NULL,
  `wifi_department_ID` int(11) NOT NULL,
  `wifi_createdAt` datetime NOT NULL,
  `wifi_updatedAt` datetime NOT NULL,
  `wifi_isEnable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `wifi_directory`
--

INSERT INTO `wifi_directory` (`wifi_ID`, `wifi_SSID`, `wifi_password`, `wifi_ipDirection`, `wifi_location_ID`, `wifi_department_ID`, `wifi_createdAt`, `wifi_updatedAt`, `wifi_isEnable`) VALUES
(1, 'INFORMATICA', '123456', '', 1, 2, '2025-05-27 13:50:29', '2025-06-02 10:59:00', 1),
(2, 'FARMACIA', 'STEC991.FARM', '192.168.1.1', 2, 1, '2025-06-09 13:07:12', '2025-06-09 13:07:12', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_ID`),
  ADD KEY `department_location_ID` (`department_location_ID`);

--
-- Indices de la tabla `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`device_ID`),
  ADD KEY `device_location_ID` (`device_location_ID`,`device_department_ID`),
  ADD KEY `device_department_ID` (`device_department_ID`),
  ADD KEY `device_deliveryUser_ID` (`device_deliveryUser_ID`),
  ADD KEY `device_withdrawUser_ID` (`device_withdrawUser_ID`);

--
-- Indices de la tabla `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_ID`);

--
-- Indices de la tabla `observations`
--
ALTER TABLE `observations`
  ADD PRIMARY KEY (`observation_ID`),
  ADD KEY `observation_user_ID` (`observation_user_ID`),
  ADD KEY `observation_type_ID` (`observation_type_ID`,`observations_priority_ID`),
  ADD KEY `observations_priority_ID` (`observations_priority_ID`);

--
-- Indices de la tabla `observations_priority`
--
ALTER TABLE `observations_priority`
  ADD PRIMARY KEY (`observationsPriority_ID`);

--
-- Indices de la tabla `observations_type`
--
ALTER TABLE `observations_type`
  ADD PRIMARY KEY (`observationType_ID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indices de la tabla `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`userRole_ID`);

--
-- Indices de la tabla `wifi_directory`
--
ALTER TABLE `wifi_directory`
  ADD PRIMARY KEY (`wifi_ID`),
  ADD KEY `wifi_location_ID` (`wifi_location_ID`,`wifi_department_ID`),
  ADD KEY `wifi_department_ID` (`wifi_department_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `departments`
--
ALTER TABLE `departments`
  MODIFY `department_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `devices`
--
ALTER TABLE `devices`
  MODIFY `device_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `locations`
--
ALTER TABLE `locations`
  MODIFY `location_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `observations`
--
ALTER TABLE `observations`
  MODIFY `observation_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `observations_priority`
--
ALTER TABLE `observations_priority`
  MODIFY `observationsPriority_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `observations_type`
--
ALTER TABLE `observations_type`
  MODIFY `observationType_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `userRole_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `wifi_directory`
--
ALTER TABLE `wifi_directory`
  MODIFY `wifi_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`department_location_ID`) REFERENCES `locations` (`location_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `devices`
--
ALTER TABLE `devices`
  ADD CONSTRAINT `devices_ibfk_1` FOREIGN KEY (`device_department_ID`) REFERENCES `departments` (`department_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `devices_ibfk_2` FOREIGN KEY (`device_location_ID`) REFERENCES `locations` (`location_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `devices_ibfk_3` FOREIGN KEY (`device_deliveryUser_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `devices_ibfk_4` FOREIGN KEY (`device_withdrawUser_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `observations`
--
ALTER TABLE `observations`
  ADD CONSTRAINT `observations_ibfk_1` FOREIGN KEY (`observation_user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `observations_ibfk_2` FOREIGN KEY (`observation_type_ID`) REFERENCES `observations_type` (`observationType_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `observations_ibfk_3` FOREIGN KEY (`observations_priority_ID`) REFERENCES `observations_priority` (`observationsPriority_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `wifi_directory`
--
ALTER TABLE `wifi_directory`
  ADD CONSTRAINT `wifi_directory_ibfk_1` FOREIGN KEY (`wifi_department_ID`) REFERENCES `departments` (`department_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wifi_directory_ibfk_2` FOREIGN KEY (`wifi_location_ID`) REFERENCES `locations` (`location_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
