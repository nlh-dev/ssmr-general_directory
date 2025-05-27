-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2025 a las 21:33:57
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
(2, 1, 'HECTOR NAVARRO', 'CONTROL SAMSUNG', 'HM-2-306', '2025-05-27', '14:19:32', 1, 2, '', '0000-00-00', '00:00:00', 1, 1);

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
(1, 'Hector Navarro', 'hectorlnavarro', 'h789123000', 1, '2025-05-27 19:51:45', '2025-05-27 19:51:45');

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
(1, 'INFORMATICA', '', '', 1, 2, '2025-05-27 13:50:29', '2025-05-27 13:50:29', 1);

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
  MODIFY `device_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `locations`
--
ALTER TABLE `locations`
  MODIFY `location_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `userRole_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `wifi_directory`
--
ALTER TABLE `wifi_directory`
  MODIFY `wifi_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Filtros para la tabla `wifi_directory`
--
ALTER TABLE `wifi_directory`
  ADD CONSTRAINT `wifi_directory_ibfk_1` FOREIGN KEY (`wifi_department_ID`) REFERENCES `departments` (`department_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wifi_directory_ibfk_2` FOREIGN KEY (`wifi_location_ID`) REFERENCES `locations` (`location_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
