-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-07-2025 a las 22:04:02
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
  `department_createdAtDate` date NOT NULL,
  `department_createdAtTime` time NOT NULL,
  `department_updatedAtDate` date NOT NULL,
  `department_updatedAtTime` time NOT NULL,
  `department_isEnable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departments`
--

INSERT INTO `departments` (`department_ID`, `department_name`, `department_location_ID`, `department_createdAtDate`, `department_createdAtTime`, `department_updatedAtDate`, `department_updatedAtTime`, `department_isEnable`) VALUES
(1, 'Oftalmología', 2, '2025-05-16', '00:00:00', '2025-06-16', '12:23:47', 1),
(2, 'Laboratorio', 1, '2025-05-16', '00:00:00', '2025-06-14', '13:38:14', 1),
(5, 'Medicina General', 5, '2025-06-13', '14:55:08', '2025-07-01', '12:56:48', 1),
(6, 'Nefrología Pediátrica', 5, '2025-06-13', '14:55:57', '2025-07-01', '12:56:48', 1),
(7, 'Ecografía', 6, '2025-06-13', '15:11:13', '2025-06-13', '15:11:13', 1),
(8, 'Caja', 5, '2025-06-13', '15:32:00', '2025-07-01', '12:56:48', 1),
(9, 'Farmacia', 2, '2025-06-16', '09:19:54', '2025-06-16', '09:19:54', 1),
(10, 'Informática', 17, '2025-06-16', '10:26:29', '2025-06-16', '10:26:29', 1),
(11, 'Hospitalización', 9, '2025-06-16', '10:34:44', '2025-06-16', '10:34:44', 1),
(12, 'UCI', 8, '2025-06-16', '10:35:22', '2025-06-16', '10:35:22', 1),
(13, 'UCI Pediátrica', 9, '2025-06-16', '10:36:40', '2025-06-16', '10:36:40', 1),
(16, 'Servicios Generales', 17, '2025-06-16', '12:24:34', '2025-06-16', '12:24:34', 1),
(17, 'Café Europa', 17, '2025-06-16', '12:24:55', '2025-06-16', '12:24:55', 1),
(18, 'Rayos X', 17, '2025-06-16', '12:25:17', '2025-06-16', '12:25:17', 1),
(19, 'Emergencias', 18, '2025-06-16', '12:25:26', '2025-06-16', '12:25:26', 1),
(20, 'Caja (Emergencias)', 18, '2025-06-16', '12:25:40', '2025-06-16', '12:25:50', 1),
(21, 'Traumatologia', 5, '2025-06-16', '12:26:45', '2025-07-01', '12:56:48', 1),
(22, 'Infusión Oncológica', 1, '2025-06-16', '12:27:20', '2025-07-01', '07:54:16', 1),
(23, 'Pre-clínica', 5, '2025-06-16', '12:27:51', '2025-07-01', '12:56:48', 1),
(24, 'Historias Médicas', 5, '2025-06-16', '12:28:02', '2025-07-01', '12:56:48', 1),
(25, 'Gastroenterología', 5, '2025-06-16', '12:28:26', '2025-07-01', '12:56:48', 1),
(26, 'ORL', 5, '2025-06-16', '12:28:47', '2025-07-01', '12:56:48', 1),
(27, 'Medicina Familiar', 5, '2025-06-16', '12:29:03', '2025-07-01', '12:56:48', 1),
(28, 'Psicología', 2, '2025-06-16', '12:33:10', '2025-06-16', '12:33:10', 1),
(29, 'Fisiatría', 2, '2025-06-16', '12:33:30', '2025-06-16', '12:33:30', 1),
(32, 'Administración', 6, '2025-06-16', '12:52:30', '2025-06-16', '12:52:30', 1),
(33, 'Información', 6, '2025-06-16', '12:53:03', '2025-06-16', '12:53:03', 1),
(34, 'Medicina Interna', 6, '2025-06-16', '12:53:22', '2025-06-16', '12:53:22', 1),
(35, 'Hospitalización (Aislamiento)', 10, '2025-06-16', '14:34:17', '2025-06-16', '14:34:35', 1),
(36, 'Quirófano', 7, '2025-06-16', '14:36:25', '2025-06-16', '14:36:25', 1),
(37, 'Hospitalización', 13, '2025-06-16', '14:37:50', '2025-06-16', '14:37:50', 1),
(38, 'Presidencia', 13, '2025-06-16', '14:38:18', '2025-06-16', '14:38:18', 1),
(39, 'Contabilidad', 6, '2025-06-16', '15:55:56', '2025-06-16', '15:55:56', 1),
(40, 'Nefrología', 6, '2025-06-16', '15:56:54', '2025-06-16', '15:56:54', 1),
(41, 'Dirección Médica', 6, '2025-06-16', '15:57:42', '2025-06-16', '15:57:42', 1),
(42, 'Gerencia Médica', 6, '2025-06-16', '15:58:03', '2025-06-16', '15:58:03', 1),
(43, 'Taller De Carpintería', 15, '2025-06-16', '15:58:48', '2025-06-16', '15:59:03', 1),
(44, 'Almacén', 16, '2025-06-16', '15:59:16', '2025-06-16', '15:59:16', 1),
(45, 'Trabajo Social', 6, '2025-06-17', '08:06:51', '2025-06-17', '08:06:51', 1),
(46, 'SIMR (Atención Al Cliente)', 1, '2025-07-01', '07:46:56', '2025-07-01', '07:52:59', 1),
(47, 'SIMR (Pre-clínica)', 1, '2025-07-01', '07:47:46', '2025-07-01', '07:47:46', 1),
(48, 'SIMR (Polinter)', 1, '2025-07-01', '07:53:20', '2025-07-01', '07:53:20', 1),
(49, 'Cuarto De Servicio', 5, '2025-07-01', '10:41:30', '2025-07-01', '12:56:48', 1);

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
  `location_createdAtDate` date NOT NULL,
  `location_createdAtTime` time NOT NULL,
  `location_updatedAtDate` date NOT NULL,
  `location_updatedAtTime` time NOT NULL,
  `location_isEnable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `locations`
--

INSERT INTO `locations` (`location_ID`, `location_name`, `location_createdAtDate`, `location_createdAtTime`, `location_updatedAtDate`, `location_updatedAtTime`, `location_isEnable`) VALUES
(1, 'Piso 1, Lado A', '2025-05-16', '00:00:00', '2025-06-14', '13:38:14', 1),
(2, 'Piso 1, Lado B', '2025-05-16', '00:00:00', '2025-06-13', '13:19:06', 1),
(5, 'PB, Lado A', '2025-06-13', '12:59:42', '2025-07-01', '12:56:48', 1),
(6, 'PB, Lado B', '2025-06-13', '12:59:53', '2025-06-13', '12:59:53', 1),
(7, 'Piso 2, Lado A', '2025-06-13', '13:04:09', '2025-06-13', '13:04:09', 1),
(8, 'Piso 2, Lado B', '2025-06-13', '13:04:17', '2025-06-13', '13:04:17', 1),
(9, 'Piso 3, Lado A', '2025-06-13', '13:04:36', '2025-06-13', '13:04:36', 1),
(10, 'Piso 3, Lado B', '2025-06-13', '13:04:44', '2025-06-13', '13:04:44', 1),
(11, 'Piso 4, Lado A', '2025-06-13', '13:04:51', '2025-06-13', '13:04:51', 1),
(12, 'Piso 4, Lado B', '2025-06-13', '13:05:08', '2025-06-13', '13:05:08', 1),
(13, 'Piso 5, Lado A', '2025-06-13', '13:05:22', '2025-06-13', '13:05:22', 1),
(14, 'Piso 5, Lado B', '2025-06-13', '13:05:33', '2025-06-13', '13:05:33', 1),
(15, 'Sótano, Lado A', '2025-06-13', '14:39:08', '2025-06-18', '09:29:07', 1),
(16, 'Sótano, Lado B', '2025-06-13', '14:39:16', '2025-06-18', '09:28:58', 1),
(17, 'Semi-Sótano, Lado A', '2025-06-16', '10:24:17', '2025-06-18', '11:26:37', 1),
(18, 'Semi-Sótano, Lado B', '2025-06-16', '10:24:28', '2025-06-18', '11:26:23', 1);

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
  `observation_updatedAtTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `observations`
--

INSERT INTO `observations` (`observation_ID`, `observation_user_ID`, `observation_reason`, `observation_type_ID`, `observations_priority_ID`, `observation_description`, `observation_createdAtDate`, `observation_createdAtTime`, `observation_updatedAtDate`, `observation_updatedAtTime`) VALUES
(2, 1, 'PRUEBA', 3, 3, '', '2025-07-02', '08:09:52', '2025-07-02', '08:09:52');

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
-- Estructura de tabla para la tabla `storage_categories`
--

CREATE TABLE `storage_categories` (
  `storageCategory_ID` int(11) NOT NULL,
  `storageCategory_name` text NOT NULL,
  `storageCategory_type_ID` int(11) NOT NULL,
  `storageCategory_createdAtDate` date NOT NULL,
  `storageCategory_createdAtTime` time NOT NULL,
  `storageCategory_updatedAtDate` date NOT NULL,
  `storageCategory_updatedAtTime` time NOT NULL,
  `storageCategory_isEnable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `storage_categories`
--

INSERT INTO `storage_categories` (`storageCategory_ID`, `storageCategory_name`, `storageCategory_type_ID`, `storageCategory_createdAtDate`, `storageCategory_createdAtTime`, `storageCategory_updatedAtDate`, `storageCategory_updatedAtTime`, `storageCategory_isEnable`) VALUES
(1, 'Routers', 1, '2025-06-19', '00:00:00', '2025-06-19', '00:00:00', 1),
(3, 'Discos HDD/SSD', 2, '2025-06-19', '15:50:48', '2025-06-19', '15:50:48', 1),
(4, 'Kits De Herramientas', 5, '2025-06-19', '15:52:46', '2025-06-19', '15:52:46', 1),
(5, 'Switches', 1, '2025-06-19', '15:53:45', '2025-06-19', '15:53:45', 1),
(6, 'Teclados', 3, '2025-06-20', '08:06:53', '2025-06-20', '08:06:53', 1),
(7, 'Monitores', 3, '2025-06-20', '08:09:57', '2025-06-20', '08:09:57', 1),
(8, 'Access Point', 1, '2025-06-20', '08:22:18', '2025-06-20', '08:22:18', 1),
(11, 'Tóners', 4, '2025-06-20', '08:36:08', '2025-06-20', '08:36:08', 1),
(12, 'Probador De Cable UTP', 5, '2025-06-23', '14:35:24', '2025-06-23', '14:35:24', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `storage_stock`
--

CREATE TABLE `storage_stock` (
  `stock_ID` int(11) NOT NULL,
  `stock_name` text NOT NULL,
  `stock_description` text NOT NULL,
  `stock_type_ID` int(11) NOT NULL,
  `stock_category_ID` int(11) NOT NULL,
  `stock_amount` int(11) NOT NULL,
  `stock_createdAtDate` date NOT NULL,
  `stock_createdAtTime` time NOT NULL,
  `stock_updatedAtDate` date NOT NULL,
  `stock_updatedAtTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `storage_types`
--

CREATE TABLE `storage_types` (
  `storageType_ID` int(11) NOT NULL,
  `storageType_name` text NOT NULL,
  `storageType_createdAtDate` date NOT NULL,
  `storageType_createdAtTime` time NOT NULL,
  `storageType_updatedAtDate` date NOT NULL,
  `storageType_updatedAtTime` time NOT NULL,
  `storageType_isEnable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `storage_types`
--

INSERT INTO `storage_types` (`storageType_ID`, `storageType_name`, `storageType_createdAtDate`, `storageType_createdAtTime`, `storageType_updatedAtDate`, `storageType_updatedAtTime`, `storageType_isEnable`) VALUES
(1, 'Redes y Conexiones', '2025-06-19', '09:34:11', '2025-06-24', '11:59:06', 1),
(2, 'Computación Y Almacenamiento', '2025-06-19', '09:34:46', '2025-06-19', '09:34:46', 1),
(3, 'Componentes Y Periféricos', '2025-06-19', '09:35:02', '2025-06-24', '11:58:47', 1),
(4, 'Consumibles Y Accesorios', '2025-06-19', '09:35:21', '2025-06-19', '09:35:21', 1),
(5, 'Equipos De Mantenimiento', '2025-06-19', '09:35:41', '2025-06-19', '09:35:41', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `switch_brand_directory`
--

CREATE TABLE `switch_brand_directory` (
  `switchBrand_ID` int(11) NOT NULL,
  `switchBrand_name` varchar(50) NOT NULL,
  `switchBrand_createdAtDate` date NOT NULL,
  `switchBrand_createdAtTime` time NOT NULL,
  `switchBrand_updatedAtDate` date NOT NULL,
  `switchBrand_updatedAtTime` time NOT NULL,
  `switchBrand_isEnable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `switch_brand_directory`
--

INSERT INTO `switch_brand_directory` (`switchBrand_ID`, `switchBrand_name`, `switchBrand_createdAtDate`, `switchBrand_createdAtTime`, `switchBrand_updatedAtDate`, `switchBrand_updatedAtTime`, `switchBrand_isEnable`) VALUES
(1, 'MicroTiK', '2025-06-27', '08:54:32', '2025-07-01', '09:48:07', 1),
(3, 'TP-LINK', '2025-06-27', '09:39:12', '2025-06-30', '09:52:48', 1),
(9, 'Hikvision', '2025-07-01', '09:47:17', '2025-07-02', '15:11:27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `switch_directory`
--

CREATE TABLE `switch_directory` (
  `switch_ID` int(11) NOT NULL,
  `switch_name` text NOT NULL,
  `switch_serialCode` varchar(20) NOT NULL,
  `switch_brand_ID` int(11) NOT NULL,
  `switch_ipManagement` varchar(20) NOT NULL,
  `switch_portAmount` int(11) NOT NULL,
  `switch_location_ID` int(11) NOT NULL,
  `switch_department_ID` int(11) NOT NULL,
  `switch_createdAtDate` date NOT NULL,
  `switch_createdAtTime` time NOT NULL,
  `switch_updatedAtDate` date NOT NULL,
  `switch_updatedAtTime` time NOT NULL,
  `switch_isEnable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `switch_directory`
--

INSERT INTO `switch_directory` (`switch_ID`, `switch_name`, `switch_serialCode`, `switch_brand_ID`, `switch_ipManagement`, `switch_portAmount`, `switch_location_ID`, `switch_department_ID`, `switch_createdAtDate`, `switch_createdAtTime`, `switch_updatedAtDate`, `switch_updatedAtTime`, `switch_isEnable`) VALUES
(3, 'Proveedor Principal', '', 1, '', 8, 17, 10, '2025-07-02', '12:30:39', '2025-07-02', '03:31:53', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `switch_port_directory`
--

CREATE TABLE `switch_port_directory` (
  `port_ID` int(11) NOT NULL,
  `port_number` int(11) NOT NULL,
  `port_conectedDeviceName` text NOT NULL,
  `port_switch_ID` int(11) NOT NULL,
  `port_createdAtDate` date NOT NULL,
  `port_createdAtTime` time NOT NULL,
  `port_updateAtDate` date NOT NULL,
  `port_updateAtTime` time NOT NULL,
  `port_isEnable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `wifi_isMACProtected` tinyint(1) NOT NULL,
  `wifi_createdAt` datetime NOT NULL,
  `wifi_updatedAt` datetime NOT NULL,
  `wifi_isEnable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `wifi_directory`
--

INSERT INTO `wifi_directory` (`wifi_ID`, `wifi_SSID`, `wifi_password`, `wifi_ipDirection`, `wifi_location_ID`, `wifi_department_ID`, `wifi_isMACProtected`, `wifi_createdAt`, `wifi_updatedAt`, `wifi_isEnable`) VALUES
(1, 'INFOR', 'STEC99.INF0R', '', 17, 10, 0, '2025-05-27 13:50:29', '2025-07-03 12:32:38', 1),
(3, 'FARMACIA', 'STEC991.FARM', '192.168.1.1', 1, 9, 1, '2025-06-10 11:19:34', '2025-07-02 12:40:00', 1),
(4, 'STEC', 'STEC991.INFOR', '', 5, 8, 1, '2025-06-13 15:32:22', '2025-06-25 15:35:10', 1),
(11, 'QUIROFANO', 'Ait991.QUIR', '192.168.1.1', 7, 36, 1, '2025-06-18 11:23:26', '2025-06-18 11:25:04', 1);

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
-- Indices de la tabla `storage_categories`
--
ALTER TABLE `storage_categories`
  ADD PRIMARY KEY (`storageCategory_ID`),
  ADD KEY `storageCategory_type_ID` (`storageCategory_type_ID`);

--
-- Indices de la tabla `storage_stock`
--
ALTER TABLE `storage_stock`
  ADD PRIMARY KEY (`stock_ID`),
  ADD KEY `type_ID` (`stock_type_ID`),
  ADD KEY `category_ID` (`stock_category_ID`);

--
-- Indices de la tabla `storage_types`
--
ALTER TABLE `storage_types`
  ADD PRIMARY KEY (`storageType_ID`);

--
-- Indices de la tabla `switch_brand_directory`
--
ALTER TABLE `switch_brand_directory`
  ADD PRIMARY KEY (`switchBrand_ID`);

--
-- Indices de la tabla `switch_directory`
--
ALTER TABLE `switch_directory`
  ADD PRIMARY KEY (`switch_ID`),
  ADD KEY `switch_location_ID` (`switch_location_ID`,`switch_department_ID`),
  ADD KEY `switch_brand_ID` (`switch_brand_ID`),
  ADD KEY `switch_department_ID` (`switch_department_ID`);

--
-- Indices de la tabla `switch_port_directory`
--
ALTER TABLE `switch_port_directory`
  ADD PRIMARY KEY (`port_ID`),
  ADD KEY `port_switch_ID` (`port_switch_ID`);

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
  MODIFY `department_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `devices`
--
ALTER TABLE `devices`
  MODIFY `device_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `locations`
--
ALTER TABLE `locations`
  MODIFY `location_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `observations`
--
ALTER TABLE `observations`
  MODIFY `observation_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT de la tabla `storage_categories`
--
ALTER TABLE `storage_categories`
  MODIFY `storageCategory_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `storage_stock`
--
ALTER TABLE `storage_stock`
  MODIFY `stock_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `storage_types`
--
ALTER TABLE `storage_types`
  MODIFY `storageType_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `switch_brand_directory`
--
ALTER TABLE `switch_brand_directory`
  MODIFY `switchBrand_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `switch_directory`
--
ALTER TABLE `switch_directory`
  MODIFY `switch_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `switch_port_directory`
--
ALTER TABLE `switch_port_directory`
  MODIFY `port_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `wifi_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- Filtros para la tabla `storage_categories`
--
ALTER TABLE `storage_categories`
  ADD CONSTRAINT `storage_categories_ibfk_1` FOREIGN KEY (`storageCategory_type_ID`) REFERENCES `storage_types` (`storageType_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `storage_stock`
--
ALTER TABLE `storage_stock`
  ADD CONSTRAINT `storage_stock_ibfk_1` FOREIGN KEY (`stock_category_ID`) REFERENCES `storage_categories` (`storageCategory_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `storage_stock_ibfk_2` FOREIGN KEY (`stock_type_ID`) REFERENCES `storage_types` (`storageType_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `switch_directory`
--
ALTER TABLE `switch_directory`
  ADD CONSTRAINT `switch_directory_ibfk_1` FOREIGN KEY (`switch_brand_ID`) REFERENCES `switch_brand_directory` (`switchBrand_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `switch_directory_ibfk_2` FOREIGN KEY (`switch_location_ID`) REFERENCES `locations` (`location_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `switch_directory_ibfk_3` FOREIGN KEY (`switch_department_ID`) REFERENCES `departments` (`department_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `switch_port_directory`
--
ALTER TABLE `switch_port_directory`
  ADD CONSTRAINT `switch_port_directory_ibfk_1` FOREIGN KEY (`port_switch_ID`) REFERENCES `switch_directory` (`switch_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
