-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2024 a las 22:40:57
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dboiltanking`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cont_trans_buque`
--

CREATE TABLE `cont_trans_buque` (
  `id_control_trans` int(11) NOT NULL,
  `buque` varchar(32) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `tipo_trans` varchar(32) DEFAULT NULL,
  `num_operacion` int(11) NOT NULL,
  `cant_combustible1` varchar(16) NOT NULL,
  `cant_combustible2` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cont_trans_info`
--

CREATE TABLE `cont_trans_info` (
  `id_info` int(11) NOT NULL,
  `hito_trans` tinyint(1) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `transferido_buque` int(11) DEFAULT NULL,
  `regimen_buque` int(11) DEFAULT NULL,
  `tranferir_buque` int(11) DEFAULT NULL,
  `presion_tk_buque` int(11) DEFAULT NULL,
  `presion_manifiesto` float DEFAULT NULL,
  `temp_manifiesto` float DEFAULT NULL,
  `transferido_tierra` int(11) DEFAULT NULL,
  `regimen_tierra` int(11) DEFAULT NULL,
  `proa_cal` float DEFAULT NULL,
  `popa_cal` float DEFAULT NULL,
  `concepto_hito` varchar(32) DEFAULT NULL,
  `id_control_trans` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cont_trans_regimen`
--

CREATE TABLE `cont_trans_regimen` (
  `id_regimen` int(11) NOT NULL,
  `MBDS` float DEFAULT NULL,
  `DIESEL` float DEFAULT NULL,
  `PROPANE` float DEFAULT NULL,
  `NAPHTA` float DEFAULT NULL,
  `BUTANE` float DEFAULT NULL,
  `MBDS_time` float DEFAULT NULL,
  `DIESEL_time` float DEFAULT NULL,
  `PROPANE_time` float DEFAULT NULL,
  `NAPHTA_time` float DEFAULT NULL,
  `BUTANE_time` float DEFAULT NULL,
  `id_control_trans` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_trans_buque`
--

CREATE TABLE `data_trans_buque` (
  `id_data_trans` int(11) NOT NULL,
  `id_buque` int(11) DEFAULT NULL,
  `mes` varchar(16) DEFAULT NULL,
  `año` varchar(16) DEFAULT NULL,
  `due` varchar(64) DEFAULT NULL,
  `tipo_operacion` varchar(64) DEFAULT NULL,
  `tipo_ingreso` varchar(64) DEFAULT NULL,
  `destiny` varchar(64) DEFAULT NULL,
  `finalizado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_trans_detalle`
--

CREATE TABLE `data_trans_detalle` (
  `id_detalle` int(11) NOT NULL,
  `id_data_trans` int(11) DEFAULT NULL,
  `producto` varchar(32) DEFAULT NULL,
  `fecha_hora_ini` datetime DEFAULT NULL,
  `fecha_hora_fin` datetime DEFAULT NULL,
  `cant_carg` varchar(32) DEFAULT NULL,
  `cant_des` varchar(32) DEFAULT NULL,
  `regimen_prom` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_trans_est_hechos`
--

CREATE TABLE `data_trans_est_hechos` (
  `id_est_hechos` int(11) NOT NULL,
  `id_data_trans` int(11) DEFAULT NULL,
  `eta` date DEFAULT NULL,
  `etd` date DEFAULT NULL,
  `num_opera` varchar(16) DEFAULT NULL,
  `num_opera_anual` varchar(16) DEFAULT NULL,
  `viaje` varchar(16) DEFAULT NULL,
  `agencia` varchar(64) DEFAULT NULL,
  `lleg` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_trans_info_buque`
--

CREATE TABLE `data_trans_info_buque` (
  `id_info_buque` int(11) NOT NULL,
  `id_data_trans` int(11) DEFAULT NULL,
  `imo` varchar(64) DEFAULT NULL,
  `trb` varchar(64) DEFAULT NULL,
  `trn` varchar(64) DEFAULT NULL,
  `sdwt` varchar(64) DEFAULT NULL,
  `loa` varchar(64) DEFAULT NULL,
  `breath` varchar(64) DEFAULT NULL,
  `depth` varchar(64) DEFAULT NULL,
  `año_fab` varchar(64) DEFAULT NULL,
  `draft_sum` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_trans_viaje`
--

CREATE TABLE `data_trans_viaje` (
  `id_viaje` int(11) NOT NULL,
  `id_data_trans` int(11) DEFAULT NULL,
  `ult_puerto` varchar(64) DEFAULT NULL,
  `des_producto` varchar(64) DEFAULT NULL,
  `con_propano` varchar(64) DEFAULT NULL,
  `des_lastre` varchar(64) DEFAULT NULL,
  `obs_lastre` varchar(128) DEFAULT NULL,
  `vessel_left` datetime DEFAULT NULL,
  `sailing` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `est_hec_buque`
--

CREATE TABLE `est_hec_buque` (
  `num_operacion` int(11) NOT NULL,
  `id_buque` int(11) NOT NULL,
  `buque` varchar(32) NOT NULL,
  `laycan_inicio` date DEFAULT NULL,
  `laycan_final` date DEFAULT NULL,
  `nor_extendido` datetime DEFAULT NULL,
  `nor_recibido` datetime DEFAULT NULL,
  `calado_arribo_antes` varchar(16) DEFAULT NULL,
  `calado_arribo_despues` varchar(16) DEFAULT NULL,
  `calado_zarpe_antes` varchar(16) DEFAULT NULL,
  `calado_zarpe_despues` varchar(16) DEFAULT NULL,
  `finalizado` tinyint(1) NOT NULL,
  `observaciones_demoras` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `est_hec_buque`
--

INSERT INTO `est_hec_buque` (`num_operacion`, `id_buque`, `buque`, `laycan_inicio`, `laycan_final`, `nor_extendido`, `nor_recibido`, `calado_arribo_antes`, `calado_arribo_despues`, `calado_zarpe_antes`, `calado_zarpe_despues`, `finalizado`, `observaciones_demoras`) VALUES
(1, 1, 'M.T. ATLANTIC JOURNEY', '2023-06-07', '2023-06-07', '2023-06-07 03:06:00', '2023-06-07 07:54:00', '6.10', '6.10', '8.30', '8.70', 1, ''),
(2, 3, 'LPG/c COLCA', '2023-06-16', '2023-06-17', '2023-06-13 06:00:00', '2023-06-16 15:48:00', '6.35', '6.50', '8.50', '8.70', 0, ''),
(4, 2, 'M.T. CARAL', '2024-01-24', '2024-01-25', '2024-01-23 05:02:00', '2024-01-25 00:48:00', '4.70', '7.90', '0', '0', 1, ''),
(6, 5, 'KONTICH', '2024-02-19', NULL, '2024-02-19 16:00:00', '2024-02-21 05:00:00', '9.40', '9.60', '5.70', '7.40', 0, ''),
(7, 7, 'LPG/c COLCA', '2024-03-14', '2024-03-14', '2024-03-15 23:29:00', '2024-03-15 08:30:00', '6.00', '7.00', '9.00', '10.00', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `est_hec_embarque`
--

CREATE TABLE `est_hec_embarque` (
  `num_operacion` int(11) NOT NULL,
  `producto` varchar(16) NOT NULL,
  `num_tanque` varchar(32) DEFAULT NULL,
  `cantidad` varchar(32) DEFAULT NULL,
  `densidad` varchar(16) DEFAULT NULL,
  `peso_mol` varchar(16) DEFAULT NULL,
  `temp_planta` varchar(16) DEFAULT NULL,
  `temp_buque` varchar(16) DEFAULT NULL,
  `cant_cargada` varchar(16) DEFAULT NULL,
  `cant_descargada` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `est_hec_embarque`
--

INSERT INTO `est_hec_embarque` (`num_operacion`, `producto`, `num_tanque`, `cantidad`, `densidad`, `peso_mol`, `temp_planta`, `temp_buque`, `cant_cargada`, `cant_descargada`) VALUES
(1, 'BUTANE', 'TKBJ-23010', '3,500 M.T', '0.5771', '58.0700', '24.9', 'N/A', '3,510.009 M.T', 'N/A'),
(1, 'DIESELB5S50', '', '', '', '', '', '', '', ''),
(1, 'MBDS', '', '', '', '', '', '', '', ''),
(1, 'NAPHTHA', '', '', '', '', '', '', '', ''),
(1, 'PROPANE', 'TKBJ-23005', '6,500 M.T', '0.5071', '44.1577', '-44.2', 'N/A', '6,508.227 M.T', 'N/A'),
(2, 'BUTANE', '', '', '', '', '', '', '', ''),
(2, 'DIESELB5S50', '', '', '', '', '', '', '', ''),
(2, 'MBDS', '', '', '', '', '', '', '', ''),
(2, 'NAPHTHA', '', '', '', '', '', '', '', ''),
(2, 'PROPANE', '', '', '', '', '', '', '', ''),
(4, 'BUTANE', '', '', '', '', '', '', '', ''),
(4, 'DIESELB5S50', 'TKBJ-43030', '70000', '36.4', '', '75.4', '', '', 'N/A'),
(4, 'MBDS', 'TKBJ-3030', '55000', '49', '', '79.1', '', '', 'N/A'),
(4, 'NAPHTHA', '', '', '', '', '', '', '', ''),
(4, 'PROPANE', '', '', '', '', '', '', '', ''),
(6, 'BUTANE', 'TKBJ-23010', '6962.795', '0.5841', '58.2050', '24.9', '32.58', '', '6965.297'),
(6, 'DIESELB5S50', '', '', '', '', '', '', '', ''),
(6, 'MBDS', '', '', '', '', '', '', '', ''),
(6, 'NAPHTHA', '', '', '', '', '', '', '', ''),
(6, 'PROPANE', 'TKBJ-23005', '10000', '0.5055', '44.0500', '-44.4', '-43.87', '', '9,976.728'),
(7, 'BUTANE', 'TKBJ-13010', '4050', '0.5771', '58.0615', '24.8', '', '', ''),
(7, 'DIESELB5S50', '', '', '', '', '', '', '', ''),
(7, 'MBDS', '', '', '', '', '', '', '', ''),
(7, 'NAPHTHA', '', '', '', '', '', '', '', ''),
(7, 'PROPANE', 'TKBJ-3005', '9450', '0.5063', '44.0692', '-44.9', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `est_hec_eventos`
--

CREATE TABLE `est_hec_eventos` (
  `id_evento` int(11) NOT NULL,
  `evento` varchar(64) DEFAULT NULL,
  `mostrar_predeterminado` tinyint(1) DEFAULT NULL,
  `mostrar` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `est_hec_eventos`
--

INSERT INTO `est_hec_eventos` (`id_evento`, `evento`, `mostrar_predeterminado`, `mostrar`) VALUES
(1, 'EOSP', 1, 0),
(2, 'VESSEL ANCHORED AT PISCO ROADS ', 1, 0),
(3, 'AUTHORITIES AND AGENT ON BOARD', 1, 0),
(4, 'FREE PRATIQUE GRANTED', 1, 0),
(5, 'LOADING MASTER ON BOARD', 0, 1),
(6, 'PILOT ON BOARD', 0, 1),
(7, 'SURVEYOR ON BOARD', 0, 1),
(8, 'BALLAST INSPECTORS ON BOARD', 0, 1),
(9, 'PRE ARRIVAL INSPECTION', 1, 0),
(10, 'BALLAST SAMPLING', 1, 0),
(11, 'ANCHOR AWEIGH. APPROACHING COMMENCED ', 1, 0),
(12, 'FIRST LINE ASHORE', 1, 0),
(13, 'ALL FAST', 1, 0),
(14, 'ALL MOORING LINES INSPECTED BY CHIEF OFFICER & LOADING MASTER', 1, 0),
(15, 'SHIP-SHORE SAFETY CHECK LIST', 1, 0),
(16, 'DEPLOYMENT OF CONTAINMENT BOOM', 1, 0),
(17, 'CARGO KEY MEETING', 1, 0),
(18, 'CARGO TANKS INSPECTION', 1, 0),
(19, 'OBQ CALCULATION / EMPTY TANKS CERTIFICATE', 1, 0),
(20, 'SHORE LINE COOL DOWN STOPPED', 1, 0),
(21, 'LOADING ARM MZZ-6015 1x12\" CONNECTION', 0, 1),
(22, 'LOADING ARM MZZ-6020 1x12\" CONNECTION', 0, 1),
(23, 'LOADING ARM MZZ-6320 1x8\" CONNECTION', 0, 1),
(24, 'LOADING ARMS MZZ-6015 & MZZ-6020 2x12\" AND FLEXIBLE HOSE 1x8\" CO', 0, 1),
(25, 'LINE UP SHIP AND SHORE SYSTEM', 1, 0),
(26, 'DEBALLASTING OPERATIONS', 1, 0),
(27, 'PROPANE LOADING. SHIP STOP ', 0, 1),
(28, 'BUTANE LOADING. SHIP STOP ', 0, 1),
(29, 'NAPHTHA LOADING. SHIP STOP ', 0, 1),
(30, 'NAPHTHA LOADING. SHORE STOP ', 0, 1),
(31, 'DIESEL B5S50 LOADING. SHIP STOP ', 0, 1),
(32, 'DIESEL B5S50 LOADING. SHORE STOP ', 0, 1),
(33, 'DIESEL 2 LOADING. SHIP STOP ', 0, 1),
(34, 'DIESEL 2 LOADING. SHORE STOP ', 0, 1),
(35, 'MDBS LOADING. SHIP STOP ', 0, 1),
(36, 'MDBS LOADING. SHORE STOP ', 0, 1),
(37, 'ULSD DISCHARGING. SHIP STOP ', 0, 1),
(38, 'PROPANE DISCHARGING. SHIP STOP ', 0, 1),
(39, 'BUTANE DISCHARGING. SHIP STOP ', 0, 1),
(40, 'SHORE TO SHORE LINE DISPLACEMENT WITH BUTANE', 1, 0),
(41, 'SHORE TO SHORE LINE DISPLACEMENT WITH PROPANE', 1, 0),
(42, 'DEPLOYMENT OF CONTAINMENT BOOM', 1, 0),
(43, 'RECOVERY OF CONTAINMENT BOOM', 1, 0),
(44, 'CARGO TANKS INSPECTION', 1, 0),
(45, 'BLOWING SHORE LINE AND LOADING  WITH NITROGEN', 1, 0),
(46, 'LOADING ARM MZZ-6015 DISCONNECTION', 0, 1),
(47, 'LOADING ARM MZZ-6020 DISCONNECTION', 0, 1),
(48, 'LOADING ARM MZZ-6320 DISCONNECTION', 0, 1),
(49, 'PURGING WITH NITROGEN', 1, 0),
(50, 'CARGO TANKS INSPECTION', 1, 0),
(51, 'CARGO CALCULATIONS', 1, 0),
(52, 'UNMOORING MANEUVERS', 1, 0),
(53, 'CARGO TANKS SAMPLING', 1, 0),
(54, 'BILL FIGURES PROVIDED BY SURVEYOR', 1, 0),
(55, 'CARGO DOCUMENTS SIGNED', 1, 0),
(56, 'LOADING MASTER OFF', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `est_hec_info`
--

CREATE TABLE `est_hec_info` (
  `num_operacion` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_termino` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `est_hec_info`
--

INSERT INTO `est_hec_info` (`num_operacion`, `id_evento`, `fecha`, `hora_inicio`, `hora_termino`) VALUES
(1, 1, '2023-06-07', NULL, '03:06:00'),
(1, 2, '2023-06-07', NULL, '03:36:00'),
(1, 3, '2023-06-07', NULL, '04:30:00'),
(1, 4, '2023-06-07', NULL, '04:42:00'),
(1, 5, '2023-06-07', NULL, '05:18:00'),
(1, 6, '2023-06-07', NULL, '04:42:00'),
(1, 7, '2023-06-07', NULL, '05:18:00'),
(1, 8, '2023-06-07', NULL, '05:18:00'),
(1, 9, '2023-06-07', '05:24:00', '06:12:00'),
(1, 10, '2023-06-07', '05:24:00', '05:40:00'),
(1, 11, '2023-06-07', '06:18:00', NULL),
(1, 12, '2023-06-07', '07:18:00', '07:48:00'),
(1, 13, NULL, NULL, NULL),
(1, 14, '2023-06-07', '07:48:00', '07:54:00'),
(1, 15, '2023-06-07', '07:54:00', '08:06:00'),
(1, 16, NULL, NULL, NULL),
(1, 17, '2023-06-07', '08:06:00', '08:12:00'),
(1, 18, '2023-06-07', '08:12:00', '08:30:00'),
(1, 19, NULL, NULL, NULL),
(1, 20, '2023-06-07', NULL, '09:04:00'),
(1, 21, NULL, NULL, NULL),
(1, 22, '2023-06-07', '08:42:00', '09:00:00'),
(1, 23, NULL, NULL, NULL),
(1, 24, NULL, NULL, NULL),
(1, 25, '2023-06-07', '09:00:00', '09:12:00'),
(1, 26, NULL, NULL, NULL),
(1, 27, '2023-06-07', '09:12:00', '17:00:00'),
(1, 28, NULL, NULL, NULL),
(1, 29, NULL, NULL, NULL),
(1, 30, NULL, NULL, NULL),
(1, 31, NULL, NULL, NULL),
(1, 32, NULL, NULL, NULL),
(1, 33, NULL, NULL, NULL),
(1, 34, NULL, NULL, NULL),
(1, 35, NULL, NULL, NULL),
(1, 36, NULL, NULL, NULL),
(1, 37, NULL, NULL, NULL),
(1, 38, NULL, NULL, NULL),
(1, 39, NULL, NULL, NULL),
(1, 40, NULL, NULL, NULL),
(1, 41, NULL, NULL, NULL),
(1, 42, NULL, NULL, NULL),
(1, 43, NULL, NULL, NULL),
(1, 44, NULL, NULL, NULL),
(1, 45, NULL, NULL, NULL),
(1, 46, NULL, NULL, NULL),
(1, 47, '2023-06-08', '05:06:00', '05:18:00'),
(1, 48, NULL, NULL, NULL),
(1, 49, '2023-06-08', '04:54:00', '05:06:00'),
(1, 50, '2023-06-08', '05:18:00', '05:36:00'),
(1, 51, '2023-06-08', '05:36:00', '05:48:00'),
(1, 52, '2023-06-08', '06:24:00', '06:30:00'),
(1, 53, NULL, NULL, NULL),
(1, 54, '2023-06-08', NULL, '05:48:00'),
(1, 55, '2023-06-08', NULL, '06:06:00'),
(1, 56, '2023-06-08', NULL, '06:12:00'),
(2, 1, '2023-06-16', NULL, NULL),
(2, 2, '2023-06-16', NULL, NULL),
(2, 3, '2023-06-16', NULL, NULL),
(2, 4, NULL, NULL, NULL),
(2, 5, '2024-03-13', '18:17:00', '18:22:00'),
(2, 6, NULL, NULL, NULL),
(2, 7, NULL, NULL, NULL),
(2, 8, NULL, NULL, NULL),
(2, 9, NULL, NULL, NULL),
(2, 10, NULL, NULL, NULL),
(2, 11, NULL, NULL, NULL),
(2, 12, NULL, NULL, NULL),
(2, 13, NULL, NULL, NULL),
(2, 14, NULL, NULL, NULL),
(2, 15, NULL, NULL, NULL),
(2, 16, NULL, NULL, NULL),
(2, 17, NULL, NULL, NULL),
(2, 18, NULL, NULL, NULL),
(2, 19, NULL, NULL, NULL),
(2, 20, NULL, NULL, NULL),
(2, 21, NULL, NULL, NULL),
(2, 22, NULL, NULL, NULL),
(2, 23, NULL, NULL, NULL),
(2, 24, NULL, NULL, NULL),
(2, 25, NULL, NULL, NULL),
(2, 26, NULL, NULL, NULL),
(2, 27, NULL, NULL, NULL),
(2, 28, NULL, NULL, NULL),
(2, 29, NULL, NULL, NULL),
(2, 30, NULL, NULL, NULL),
(2, 31, NULL, NULL, NULL),
(2, 32, NULL, NULL, NULL),
(2, 33, NULL, NULL, NULL),
(2, 34, NULL, NULL, NULL),
(2, 35, NULL, NULL, NULL),
(2, 36, NULL, NULL, NULL),
(2, 37, NULL, NULL, NULL),
(2, 38, NULL, NULL, NULL),
(2, 39, NULL, NULL, NULL),
(2, 40, NULL, NULL, NULL),
(2, 41, NULL, NULL, NULL),
(2, 42, NULL, NULL, NULL),
(2, 43, NULL, NULL, NULL),
(2, 44, NULL, NULL, NULL),
(2, 45, NULL, NULL, NULL),
(2, 46, NULL, NULL, NULL),
(2, 47, NULL, NULL, NULL),
(2, 48, NULL, NULL, NULL),
(2, 49, NULL, NULL, NULL),
(2, 50, NULL, NULL, NULL),
(2, 51, NULL, NULL, NULL),
(2, 52, NULL, NULL, NULL),
(2, 53, NULL, NULL, NULL),
(2, 54, NULL, NULL, NULL),
(2, 55, NULL, NULL, NULL),
(2, 56, NULL, NULL, NULL),
(4, 1, '2024-01-23', NULL, '05:02:00'),
(4, 2, '2024-01-23', NULL, '05:32:00'),
(4, 3, '2024-01-23', NULL, '06:30:00'),
(4, 4, '2024-01-23', NULL, '06:45:00'),
(4, 5, '2024-01-23', NULL, '06:45:00'),
(4, 6, NULL, NULL, NULL),
(4, 7, NULL, NULL, NULL),
(4, 8, NULL, NULL, NULL),
(4, 9, '2024-01-23', '06:50:00', '07:15:00'),
(4, 10, '2024-01-23', '06:50:00', '07:15:00'),
(4, 11, '2024-01-23', '07:30:00', NULL),
(4, 12, '2024-01-23', '08:00:00', '08:30:00'),
(4, 13, NULL, NULL, NULL),
(4, 14, NULL, NULL, NULL),
(4, 15, NULL, NULL, NULL),
(4, 16, NULL, NULL, NULL),
(4, 17, NULL, NULL, NULL),
(4, 18, NULL, NULL, NULL),
(4, 19, NULL, NULL, NULL),
(4, 20, NULL, NULL, NULL),
(4, 21, NULL, NULL, NULL),
(4, 22, NULL, NULL, NULL),
(4, 23, NULL, NULL, NULL),
(4, 24, NULL, NULL, NULL),
(4, 25, NULL, NULL, NULL),
(4, 26, NULL, NULL, NULL),
(4, 27, NULL, NULL, NULL),
(4, 28, NULL, NULL, NULL),
(4, 29, NULL, NULL, NULL),
(4, 30, NULL, NULL, NULL),
(4, 31, NULL, NULL, NULL),
(4, 32, NULL, NULL, NULL),
(4, 33, NULL, NULL, NULL),
(4, 34, NULL, NULL, NULL),
(4, 35, NULL, NULL, NULL),
(4, 36, NULL, NULL, NULL),
(4, 37, NULL, NULL, NULL),
(4, 38, NULL, NULL, NULL),
(4, 39, NULL, NULL, NULL),
(4, 40, NULL, NULL, NULL),
(4, 41, NULL, NULL, NULL),
(4, 42, NULL, NULL, NULL),
(4, 43, NULL, NULL, NULL),
(4, 44, NULL, NULL, NULL),
(4, 45, NULL, NULL, NULL),
(4, 46, NULL, NULL, NULL),
(4, 47, NULL, NULL, NULL),
(4, 48, NULL, NULL, NULL),
(4, 49, '2024-01-24', '04:15:00', '04:50:00'),
(4, 50, '2024-01-24', '05:15:00', '05:32:00'),
(4, 51, '2024-01-24', '05:40:00', '06:00:00'),
(4, 52, '2024-01-24', NULL, '07:00:00'),
(4, 53, NULL, NULL, NULL),
(4, 54, '2024-01-25', NULL, '06:20:00'),
(4, 55, '2024-01-25', NULL, '06:30:00'),
(4, 56, '2024-01-25', NULL, '06:45:00'),
(6, 1, '2024-02-19', '14:30:00', NULL),
(6, 2, '2024-02-19', '16:00:00', NULL),
(6, 3, '2024-02-19', '16:00:00', NULL),
(6, 4, '2024-02-19', '16:12:00', NULL),
(6, 5, NULL, NULL, NULL),
(6, 6, NULL, NULL, NULL),
(6, 7, NULL, NULL, NULL),
(6, 8, NULL, NULL, NULL),
(6, 9, '2024-02-21', '02:06:00', '03:00:00'),
(6, 10, '2024-02-21', NULL, NULL),
(6, 11, '2024-02-21', '03:12:00', NULL),
(6, 12, '2024-02-21', '03:54:00', NULL),
(6, 13, '2024-02-21', NULL, '04:54:00'),
(6, 14, '2024-02-21', '04:54:00', '05:00:00'),
(6, 15, '2024-02-21', '05:00:00', '05:12:00'),
(6, 16, '2024-02-21', NULL, NULL),
(6, 17, '2024-02-21', '05:12:00', '05:24:00'),
(6, 18, '2024-02-21', '05:24:00', '05:42:00'),
(6, 19, '2024-02-21', '05:42:00', '05:48:00'),
(6, 20, '2024-02-21', '06:12:00', NULL),
(6, 21, NULL, NULL, NULL),
(6, 22, '2024-02-21', '05:48:00', '06:06:00'),
(6, 23, NULL, NULL, NULL),
(6, 24, NULL, NULL, NULL),
(6, 25, '2024-02-21', '06:18:00', '06:24:00'),
(6, 26, '2024-02-21', NULL, NULL),
(6, 27, NULL, NULL, NULL),
(6, 28, NULL, NULL, NULL),
(6, 29, NULL, NULL, NULL),
(6, 30, NULL, NULL, NULL),
(6, 31, NULL, NULL, NULL),
(6, 32, NULL, NULL, NULL),
(6, 33, NULL, NULL, NULL),
(6, 34, NULL, NULL, NULL),
(6, 35, NULL, NULL, NULL),
(6, 36, NULL, NULL, NULL),
(6, 37, NULL, NULL, NULL),
(6, 38, '2024-02-21', '06:30:00', '23:48:00'),
(6, 39, NULL, NULL, NULL),
(6, 40, '2024-02-21', '00:50:00', '04:00:00'),
(6, 41, '2024-02-21', NULL, NULL),
(6, 42, '2024-02-21', NULL, NULL),
(6, 43, '2024-02-21', NULL, NULL),
(6, 44, '2024-02-21', NULL, NULL),
(6, 45, '2024-02-22', '20:30:00', '20:42:00'),
(6, 46, NULL, NULL, NULL),
(6, 47, '2024-02-22', '20:42:00', '20:48:00'),
(6, 48, NULL, NULL, NULL),
(6, 49, '2024-02-22', NULL, NULL),
(6, 50, '2024-02-22', '19:42:00', '20:00:00'),
(6, 51, '2024-02-22', '20:00:00', '20:06:00'),
(6, 52, '2024-02-22', '20:48:00', '21:00:00'),
(6, 53, '2024-02-22', NULL, NULL),
(6, 54, '2024-02-22', NULL, NULL),
(6, 55, '2024-02-22', '22:00:00', NULL),
(6, 56, '2024-02-22', '22:12:00', NULL),
(7, 1, '2024-03-14', NULL, '08:30:00'),
(7, 2, '2024-03-14', NULL, '09:18:00'),
(7, 3, '2024-03-14', NULL, '09:54:00'),
(7, 4, '2024-03-14', NULL, '10:00:00'),
(7, 5, '2024-03-15', NULL, '06:24:00'),
(7, 6, '2024-03-15', NULL, '08:42:00'),
(7, 7, '2024-03-15', NULL, '06:24:00'),
(7, 8, '2024-03-15', NULL, '06:24:00'),
(7, 9, '2024-03-15', '06:30:00', '07:36:00'),
(7, 10, '2024-03-15', '06:30:00', '06:56:00'),
(7, 11, '2024-03-15', NULL, '08:18:00'),
(7, 12, '2024-03-15', '09:06:00', NULL),
(7, 13, '2024-03-15', NULL, '09:42:00'),
(7, 14, '2024-03-15', '09:42:00', '09:48:00'),
(7, 15, '2024-03-15', '09:48:00', '10:06:00'),
(7, 16, NULL, NULL, NULL),
(7, 17, '2024-03-15', '10:06:00', '10:18:00'),
(7, 18, '2024-03-15', '10:18:00', '10:30:00'),
(7, 19, '2024-03-15', '10:30:00', '10:48:00'),
(7, 20, NULL, NULL, NULL),
(7, 21, NULL, NULL, NULL),
(7, 22, '2024-03-15', '10:48:00', '11:00:00'),
(7, 23, NULL, NULL, NULL),
(7, 24, NULL, NULL, NULL),
(7, 25, '2024-03-15', '11:06:00', '11:18:00'),
(7, 26, '2024-03-15', '14:00:00', NULL),
(7, 27, '2024-03-15', '11:24:00', '21:30:00'),
(7, 28, '2024-03-16', '03:00:00', '08:30:00'),
(7, 29, NULL, NULL, NULL),
(7, 30, NULL, NULL, NULL),
(7, 31, NULL, NULL, NULL),
(7, 32, NULL, NULL, NULL),
(7, 33, NULL, NULL, NULL),
(7, 34, NULL, NULL, NULL),
(7, 35, NULL, NULL, NULL),
(7, 36, NULL, NULL, NULL),
(7, 37, NULL, NULL, NULL),
(7, 38, NULL, NULL, NULL),
(7, 39, NULL, NULL, NULL),
(7, 40, '2024-03-15', '21:52:00', NULL),
(7, 41, NULL, NULL, NULL),
(7, 42, NULL, NULL, NULL),
(7, 43, NULL, NULL, NULL),
(7, 44, '2024-03-16', '08:36:00', '08:42:00'),
(7, 45, '2024-03-16', '08:42:00', '09:00:00'),
(7, 46, NULL, NULL, NULL),
(7, 47, '2024-03-16', '09:12:00', '09:24:00'),
(7, 48, NULL, NULL, NULL),
(7, 49, '2024-03-16', '09:00:00', '09:12:00'),
(7, 50, NULL, NULL, NULL),
(7, 51, NULL, NULL, NULL),
(7, 52, NULL, NULL, NULL),
(7, 53, '2024-03-16', '09:24:00', '09:42:00'),
(7, 54, NULL, NULL, NULL),
(7, 55, '2024-03-16', NULL, '10:30:00'),
(7, 56, '2024-03-16', NULL, '10:36:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `est_hec_nuevos_eventos`
--

CREATE TABLE `est_hec_nuevos_eventos` (
  `id_nuevo_evento` int(11) NOT NULL,
  `num_operacion` int(11) NOT NULL,
  `evento_fecha` date DEFAULT NULL,
  `evento_inicio` time DEFAULT NULL,
  `evento_final` time DEFAULT NULL,
  `nombre_evento` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `est_hec_nuevos_eventos`
--

INSERT INTO `est_hec_nuevos_eventos` (`id_nuevo_evento`, `num_operacion`, `evento_fecha`, `evento_inicio`, `evento_final`, `nombre_evento`) VALUES
(1, 2, '2023-06-13', NULL, '14:24:00', 'BALLAST INSPECTOR OFF'),
(2, 7, '2024-03-15', '08:00:00', '08:24:00', 'M.T. CARAL CAST OFF'),
(3, 7, '2024-03-15', NULL, '11:07:00', 'SHORE LINE COOL DOWN STOPPED');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ins_pre_detalles`
--

CREATE TABLE `ins_pre_detalles` (
  `id_buque` int(11) NOT NULL,
  `buque` varchar(32) NOT NULL,
  `lugar` varchar(32) NOT NULL,
  `terminal` varchar(64) NOT NULL,
  `operacion` varchar(32) NOT NULL,
  `prod_transferir` varchar(32) NOT NULL,
  `fecha_hora_inicio` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ins_pre_detalles`
--

INSERT INTO `ins_pre_detalles` (`id_buque`, `buque`, `lugar`, `terminal`, `operacion`, `prod_transferir`, `fecha_hora_inicio`) VALUES
(1, 'M.T. ATLANTIC JOURNEY', 'Pisco - Perú', 'Pisco Camisea Marine Terminal', 'LOADING', 'NAPHTHA', '2023-09-06 20:54:00'),
(2, 'M.T. CARAL', 'Pisco - Perú', 'Pisco Camisea Marine Terminal', 'LOADING', 'DIESEL 2 &amp; ULSD', '2023-09-08 21:48:00'),
(3, 'LPG/c COLCA', 'Pisco - Perú', 'Pisco Camisea Marine Terminal', 'CARGA', 'PROPANE / BUTANE', '2023-09-24 10:12:00'),
(4, 'M/T &quot;STI GALATA&quot;', 'Pisco - Perú', 'Pisco Camisea Marine Terminal', 'Unloading', 'ULSD', '2023-08-28 15:30:00'),
(5, 'KONTICH', 'Pisco - Perú', 'Pisco Camisea Marine Terminal', 'Descarga', 'Propano-Butano', '2024-02-21 02:06:00'),
(6, 'TORM SUCCESS', 'Pisco - Perú', 'Pisco Camisea Marine Terminal', 'Carga', 'Nafta', '2024-03-08 02:42:00'),
(7, 'LPG/c COLCA', 'Pisco - Perú', 'Pisco Camisea Marine Terminal', 'CARGA', 'PROPANO / BUTANO', '2024-03-15 08:40:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ins_pre_firmas`
--

CREATE TABLE `ins_pre_firmas` (
  `id_buque` int(11) NOT NULL,
  `firma_buque` tinytext DEFAULT NULL,
  `grado_buque` varchar(32) DEFAULT NULL,
  `fecha_hora_buque` datetime DEFAULT NULL,
  `firma_terminal` tinytext DEFAULT NULL,
  `grado_terminal` varchar(32) DEFAULT NULL,
  `fecha_hora_terminal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ins_pre_firmas`
--

INSERT INTO `ins_pre_firmas` (`id_buque`, `firma_buque`, `grado_buque`, `fecha_hora_buque`, `firma_terminal`, `grado_terminal`, `fecha_hora_terminal`) VALUES
(1, NULL, '', '2023-09-06 22:30:00', NULL, 'Loading Master', '2023-09-06 22:30:00'),
(2, NULL, '', '2023-09-09 23:06:00', NULL, 'Loading Master', '2023-09-09 23:06:00'),
(3, NULL, 'Primer Piloto', '2023-09-24 11:12:00', NULL, 'Loading Master', '2023-09-24 11:12:00'),
(4, NULL, 'C/O', '2023-08-28 16:36:00', NULL, 'Loading Master', '2023-08-28 16:36:00'),
(5, NULL, '', '2024-02-21 03:00:00', NULL, 'Loading Master', '2024-02-21 03:00:00'),
(6, NULL, 'Ch. Officer', '2024-03-08 07:30:00', NULL, 'Loading Master', '2024-03-08 07:30:00'),
(7, NULL, 'Chief Officer', '2024-03-15 11:00:00', NULL, 'Loading Master', '2024-03-15 11:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ins_pre_info`
--

CREATE TABLE `ins_pre_info` (
  `id_buque` int(11) NOT NULL,
  `detalle_inspeccion` int(11) NOT NULL,
  `expiracion` varchar(32) DEFAULT NULL,
  `conformidad` char(2) NOT NULL,
  `observacion` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ins_pre_info`
--

INSERT INTO `ins_pre_info` (`id_buque`, `detalle_inspeccion`, `expiracion`, `conformidad`, `observacion`) VALUES
(1, 1, NULL, 'si', '10.03.2023'),
(2, 1, '2024-01-05', 'si', ''),
(3, 1, '2024-01-17', 'si', ''),
(4, 1, '2027-03-29', 'si', 'Issued on march 29th 2022.'),
(5, 1, NULL, 'si', ''),
(6, 1, NULL, 'si', ''),
(7, 1, '2024-01-17', 'si', 'Model: GP-6001P\r\nS/N: 51F0255901-2 RN\r\nAlarm 1: 10%\r\nAlarm 2: 30%'),
(1, 2, NULL, 'si', '10.03.2023'),
(2, 2, '2023-08-23', 'si', 'Model: Flexity D-2401-2\r\nSerie: 29446'),
(3, 2, NULL, 'na', 'UTI equipment does not apply (closed system)'),
(4, 2, '2023-12-30', 'si', 'Maker: HERMetic UTImeter.\r\nModel: Gtex (25m)\r\nS/N: G22146'),
(5, 2, NULL, 'na', ''),
(6, 2, NULL, 'si', ''),
(7, 2, 'N/A', 'na', ''),
(1, 3, NULL, 'si', '10.03.2023'),
(2, 3, '2023-04-26', 'si', 'Model: XAM-7000\r\nSerie: ARHD-0060'),
(3, 3, NULL, 'na', 'Not apply'),
(4, 3, '2024-03-01', 'si', 'Riken Keiki GX-8000 (Portable)\r\nS/N: 0Z5020326\r\n812040017\r\n\r\nRiken Keiki GX-2009 (Personal)\r\nS/N: 186201563RN\r\n186201587RN'),
(5, 3, NULL, 'si', ''),
(6, 3, NULL, 'si', ''),
(7, 3, 'N/A', 'na', ''),
(1, 4, NULL, 'si', ''),
(2, 4, NULL, 'si', 'Last cargo Diesel B5S50\r\nCleaning method duly checked by cargo surveyor'),
(3, 4, NULL, 'na', 'Not apply'),
(4, 4, NULL, 'na', 'Disch. operation'),
(5, 4, NULL, 'na', ''),
(6, 4, NULL, 'si', ''),
(7, 4, 'N/A', 'na', ''),
(1, 5, NULL, 'si', ''),
(2, 5, '2023-05-19', 'si', 'Last inspection:\r\n19.05.23'),
(3, 5, NULL, 'si', ''),
(4, 5, '2024-02-03', 'si', 'B.H.C.: 31.8 Tns.'),
(5, 5, NULL, 'si', ''),
(6, 5, NULL, 'si', ''),
(7, 5, '2023-11-12', 'si', 'BHC: 29.4 tons.'),
(1, 6, NULL, 'si', ''),
(2, 6, NULL, 'si', 'Certificates duly received by e-mail'),
(3, 6, NULL, 'si', ''),
(4, 6, NULL, 'si', 'Ropes: 26mm / 53 Tns.\r\nUHMWPE, cover 100% Polyester.\r\n\r\nTails: 56mm / 68 Tn.\r\nNIKA-Steel fibers (mixture of polypropylene, polyethylene &amp; UV stabilizer) &amp; High tenacity polyester fibers.'),
(5, 6, 'N/A', 'si', ''),
(6, 6, NULL, 'si', ''),
(7, 6, NULL, 'si', 'Certificates duly received by e-mail'),
(1, 7, NULL, 'si', ''),
(2, 7, NULL, 'si', 'Last monthly inspection: 31.03.23'),
(3, 7, NULL, 'si', ''),
(4, 7, NULL, 'si', 'Last inventory on August 23rd 2023'),
(5, 7, '2024-01-30', 'si', ''),
(6, 7, NULL, 'si', ''),
(7, 7, '2024-03-03', 'si', 'Last record'),
(1, 8, NULL, 'si', ''),
(2, 8, NULL, 'si', 'Last anual test developed by TENAIN S.A.C.\r\n26.04.23'),
(3, 8, NULL, 'si', ''),
(4, 8, '2024-03-31', 'si', '+2,000 mmGW\r\n- 350 mmGW'),
(5, 8, '2024-01-18', 'si', ''),
(6, 8, NULL, 'si', ''),
(7, 8, '2022-04-02', 'si', 'M.A.R.V.S.: 450 mBars'),
(1, 9, NULL, 'si', ''),
(2, 9, NULL, 'si', 'Last annual test on 16.06.23'),
(3, 9, NULL, 'si', 'Last anual check on 03.01.23'),
(4, 9, '2024-04-07', 'si', 'SWL 10 Tns.'),
(5, 9, '2023-08-22', 'si', ''),
(6, 9, NULL, 'si', ''),
(7, 9, '2023-01-03', 'si', 'SWL: 5 tons'),
(1, 10, NULL, 'si', ''),
(2, 10, NULL, 'si', '95%-98% alarm tested\r\nPressure, ullage, temperatures of cargo tanks (pre-arrival checks) developed by vessel&#039;s personnel.\r\n11.08.23'),
(3, 10, NULL, 'si', 'ESD from port manifold and high level alarms of each cargo tanks duly tested on 24.09.2023'),
(4, 10, NULL, 'si', 'Last on August 28th, 2023'),
(5, 10, '2024-01-26', 'si', ''),
(6, 10, NULL, 'si', ''),
(7, 10, '2024-02-18', 'si', 'Tested at TMPC'),
(1, 11, NULL, 'si', ''),
(2, 11, NULL, 'si', 'Good conditions'),
(3, 11, NULL, 'si', 'Good conditions'),
(4, 11, NULL, 'si', 'Ingood conditions'),
(5, 11, NULL, 'si', ''),
(6, 11, NULL, 'si', ''),
(7, 11, NULL, 'si', 'Good conditions'),
(1, 12, NULL, 'si', ''),
(2, 12, NULL, 'si', 'Fully operative'),
(3, 12, NULL, 'si', 'Fully operative'),
(4, 12, NULL, 'si', 'Fully operative'),
(5, 12, NULL, 'si', ''),
(6, 12, NULL, 'si', ''),
(7, 12, NULL, 'si', 'Fully operative'),
(1, 13, NULL, 'si', ''),
(2, 13, NULL, 'si', 'Annex I: 0347/0348\r\nAnnex II: 0440/0437\r\nDuly closed and flanged'),
(3, 13, NULL, 'si', 'Annex I only, closed and sealed'),
(4, 13, NULL, 'si', ''),
(5, 13, NULL, 'si', ''),
(6, 13, NULL, 'si', ''),
(7, 13, NULL, 'si', 'Sealed:\r\nOnly Annex I: A610535'),
(1, 14, NULL, 'si', ''),
(2, 14, NULL, 'si', 'Duly tested with C/O on 08.09.23'),
(3, 14, NULL, 'si', 'Duly tested with C/O'),
(4, 14, NULL, 'na', 'Disch operat.'),
(5, 14, NULL, 'si', ''),
(6, 14, NULL, 'si', ''),
(7, 14, NULL, 'si', 'Duly tested with C/O on 03.03.24\r\nFully operative'),
(1, 15, NULL, 'na', 'Loading operations'),
(2, 15, NULL, 'si', 'ESD activated from port side in manifold'),
(3, 15, NULL, 'si', 'ESD activated from local button on port side'),
(4, 15, NULL, 'si', 'Operative'),
(5, 15, NULL, 'si', ''),
(6, 15, NULL, 'na', ''),
(7, 15, NULL, 'si', 'ESD tested at port side in manifold.\r\nOn 03.03.24'),
(1, 16, NULL, 'si', 'Average : 4.9%'),
(2, 16, NULL, 'si', 'All cargo tank with less than 4.5% O2'),
(3, 16, NULL, 'na', 'All cargo tanks with C3/C4 (liquid/vapours)'),
(4, 16, NULL, 'no', 'Fully cargo'),
(5, 16, NULL, 'na', ''),
(6, 16, NULL, 'si', ''),
(7, 16, NULL, 'na', ''),
(1, 17, NULL, 'na', 'Loading operations'),
(2, 17, NULL, 'si', 'IGS Fully operative'),
(3, 17, NULL, 'na', 'Loading Operations'),
(4, 17, NULL, 'si', 'I.G. system'),
(5, 17, NULL, 'na', ''),
(6, 17, NULL, 'si', ''),
(7, 17, NULL, 'na', ''),
(1, 18, NULL, 'si', ''),
(2, 18, NULL, 'si', ''),
(3, 18, NULL, 'na', 'Refrigerated cargo (just apply for oiltankers / chemicaltankers)'),
(4, 18, NULL, 'na', 'Disch. operation'),
(5, 18, NULL, 'na', ''),
(6, 18, NULL, 'si', ''),
(7, 18, NULL, 'na', ''),
(1, 19, NULL, 'si', ''),
(2, 19, NULL, 'si', 'Fully operative.\r\nFire hoses duly tested'),
(3, 19, NULL, 'si', 'Fully operative. Fire hoses and spray system duly tested 24.09.2023'),
(4, 19, NULL, 'si', 'Fully operative'),
(5, 19, NULL, 'si', ''),
(6, 19, NULL, 'si', ''),
(7, 19, NULL, 'si', 'Fully operative.\r\nFire hoses duly tested on 03.03.24'),
(1, 20, NULL, 'si', '1x12&#039;&#039; ANSI 150 for Loading arm\r\n\r\n1x8&#039;&#039; for Vapour recovery hose'),
(2, 20, NULL, 'si', '1x12&#039;&#039; ANSI 150 &amp; 1x8&#039;&#039; ANSI 150 for Loading arm'),
(3, 20, NULL, 'si', '1x12&#039;&#039; ansi 150 duly presented'),
(4, 20, NULL, 'si', '1x12&#039;&#039; ANSI 150'),
(5, 20, NULL, 'si', ''),
(6, 20, NULL, 'si', ''),
(7, 20, NULL, 'si', '1x12” ANSI 150 for Loading arm'),
(1, 21, NULL, 'si', 'Closed and sealed:\r\nN° B687900'),
(2, 21, NULL, 'si', 'Closed and sealed:\r\nN° 5717509'),
(3, 21, NULL, 'si', 'Closed and sealed'),
(4, 21, NULL, 'si', 'Seal #: 2009426'),
(5, 21, NULL, 'si', ''),
(6, 21, NULL, 'si', ''),
(7, 21, NULL, 'si', 'Closed and locked:\r\nKey with C/E'),
(1, 22, NULL, 'si', 'Closed and sealed:\r\nN° B687898\r\nN° B687896\r\nN° B687899'),
(2, 22, NULL, 'si', 'Closed and sealed:\r\nN° 5717501\r\nN° 5717502\r\nN° 5717503'),
(3, 22, NULL, 'si', 'Closed and sealed'),
(4, 22, NULL, 'si', 'Seal #: 2009430\r\n2002617\r\nGW: 2200049/2009499'),
(5, 22, NULL, 'si', ''),
(6, 22, NULL, 'si', ''),
(7, 22, NULL, 'si', 'Closed and sealed:\r\nN° 3224585\r\nN° 3224563'),
(1, 23, NULL, 'si', ''),
(2, 23, NULL, 'si', ''),
(3, 23, NULL, 'si', ''),
(4, 23, NULL, 'si', ''),
(5, 23, NULL, 'si', ''),
(6, 23, NULL, 'si', ''),
(7, 23, NULL, 'si', ''),
(1, 24, NULL, 'si', ''),
(2, 24, NULL, 'na', ''),
(3, 24, NULL, 'na', 'Mooring lines only without tail'),
(4, 24, NULL, 'si', 'In good conditions'),
(5, 24, NULL, 'na', ''),
(6, 24, NULL, 'na', ''),
(7, 24, NULL, 'na', ''),
(1, 25, NULL, 'si', ''),
(2, 25, NULL, 'si', 'Fully operative'),
(3, 25, NULL, 'si', 'Operative'),
(4, 25, NULL, 'si', 'Operative'),
(5, 25, NULL, 'si', ''),
(6, 25, NULL, 'si', ''),
(7, 25, NULL, 'si', 'Fully operative\r\nTested on 03.03.24'),
(1, 26, NULL, 'na', ''),
(2, 26, NULL, 'na', ''),
(3, 26, NULL, 'no', ''),
(4, 26, NULL, 'no', 'Chemical &amp; Oil tanker'),
(5, 26, NULL, 'si', ''),
(6, 26, NULL, 'si', ''),
(7, 26, NULL, 'na', 'Not fitted as per vessel design'),
(1, 27, NULL, 'si', ''),
(2, 27, NULL, 'si', 'P: 1,700 mmWG\r\nV: - 350 mmWG'),
(3, 27, NULL, 'si', 'Max Pressure P/V 450mBar (M.A.R.V.S)'),
(4, 27, NULL, 'si', 'In good condit.'),
(5, 27, NULL, 'si', ''),
(6, 27, NULL, 'si', ''),
(7, 27, NULL, 'si', 'M.A.R.V.S.: 0.45 Bars'),
(1, 28, NULL, 'na', ''),
(2, 28, NULL, 'na', ''),
(3, 28, NULL, 'si', 'Fully operative and duty tested with C/O on 24.09.2023'),
(4, 28, NULL, 'no', 'Chemical &amp; Oil tanker'),
(5, 28, NULL, 'si', ''),
(6, 28, NULL, 'na', ''),
(7, 28, NULL, 'si', 'Fully operative\r\nTested on 03.03.24'),
(1, 29, NULL, 'si', ''),
(2, 29, NULL, 'si', 'As per Marine Terminal Information and Regulations Manual'),
(3, 29, NULL, 'si', 'As per data brochure regulations'),
(4, 29, NULL, 'si', ''),
(5, 29, NULL, 'si', ''),
(6, 29, NULL, 'si', ''),
(7, 29, NULL, 'si', 'As per Marine Terminal Information and Regulations Manual'),
(1, 30, NULL, 'si', ''),
(2, 30, NULL, 'si', 'ECDIS charts'),
(3, 30, NULL, 'si', 'ECDIS Charts'),
(4, 30, NULL, 'si', ''),
(5, 30, NULL, 'si', ''),
(6, 30, NULL, 'si', ''),
(7, 30, NULL, 'si', 'ECDIS Charts'),
(1, 31, NULL, 'si', ''),
(2, 31, NULL, 'si', 'Mooring plan duly checked and approved by mutual agreement'),
(3, 31, NULL, 'si', 'Mooring plan duly checked and approved in mutual aggrement'),
(4, 31, NULL, 'si', ''),
(5, 31, NULL, 'si', ''),
(6, 31, NULL, 'si', ''),
(7, 31, NULL, 'si', 'Mooring plan duly checked and approved by mutual agreement');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `res_trans_buque`
--

CREATE TABLE `res_trans_buque` (
  `id_term_buque` int(11) NOT NULL,
  `num_operacion` int(11) NOT NULL,
  `buque` varchar(64) DEFAULT NULL,
  `fecha_trans` date DEFAULT NULL,
  `inicio_amarre` datetime DEFAULT NULL,
  `NOR` datetime DEFAULT NULL,
  `calado_arribo_antes` varchar(16) DEFAULT NULL,
  `calado_arribo_despues` varchar(16) DEFAULT NULL,
  `calado_zarpe_antes` varchar(16) DEFAULT NULL,
  `calado_zarpe_despues` varchar(16) DEFAULT NULL,
  `termino_amarre` datetime DEFAULT NULL,
  `desamarrado` datetime DEFAULT NULL,
  `finalizado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `res_trans_buque`
--

INSERT INTO `res_trans_buque` (`id_term_buque`, `num_operacion`, `buque`, `fecha_trans`, `inicio_amarre`, `NOR`, `calado_arribo_antes`, `calado_arribo_despues`, `calado_zarpe_antes`, `calado_zarpe_despues`, `termino_amarre`, `desamarrado`, `finalizado`) VALUES
(1, 1, 'M.T. ATLANTIC JOURNEY', '2023-07-16', '2023-07-16 19:54:00', '2023-07-16 20:36:00', '5.05', '6.10', '8.95', '9.35', '2023-07-16 20:30:00', '2023-07-17 23:30:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `res_trans_car_remol`
--

CREATE TABLE `res_trans_car_remol` (
  `id_car` int(11) NOT NULL,
  `id_term_buque` int(11) NOT NULL,
  `remolcador_1` varchar(32) DEFAULT NULL,
  `inicio_1` varchar(32) DEFAULT NULL,
  `termino_1` varchar(32) DEFAULT NULL,
  `remolcador_2` varchar(32) DEFAULT NULL,
  `inicio_2` varchar(32) DEFAULT NULL,
  `termino_2` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `res_trans_car_remol`
--

INSERT INTO `res_trans_car_remol` (`id_car`, `id_term_buque`, `remolcador_1`, `inicio_1`, `termino_1`, `remolcador_2`, `inicio_2`, `termino_2`) VALUES
(1, 1, '', '', '', '', '', ''),
(2, 1, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `res_trans_data_ungrouped`
--

CREATE TABLE `res_trans_data_ungrouped` (
  `id_term_buque` int(11) NOT NULL,
  `obs_reg_lineas` varchar(64) DEFAULT NULL,
  `time_total_car_remol_1` varchar(16) DEFAULT NULL,
  `time_total_car_remol_2` varchar(16) DEFAULT NULL,
  `obs_otras_demoras` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `res_trans_data_ungrouped`
--

INSERT INTO `res_trans_data_ungrouped` (`id_term_buque`, `obs_reg_lineas`, `time_total_car_remol_1`, `time_total_car_remol_2`, `obs_otras_demoras`) VALUES
(1, '', '', '', '*Se presentó carta protesto por demora de Práctico Marítimo y por diferencia de cantidades.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `res_trans_info_amarre`
--

CREATE TABLE `res_trans_info_amarre` (
  `id_term_buque` int(11) NOT NULL,
  `prac_maniobra` varchar(32) DEFAULT NULL,
  `remol_maniobra` varchar(32) DEFAULT NULL,
  `lan_amarre` varchar(32) DEFAULT NULL,
  `lan_perma` varchar(32) DEFAULT NULL,
  `tipo_amarras` varchar(32) DEFAULT NULL,
  `material` varchar(32) DEFAULT NULL,
  `vel_vie_max` varchar(32) DEFAULT NULL,
  `vel_vie_min` varchar(32) DEFAULT NULL,
  `vel_cor_max` varchar(32) DEFAULT NULL,
  `obs` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `res_trans_info_amarre`
--

INSERT INTO `res_trans_info_amarre` (`id_term_buque`, `prac_maniobra`, `remol_maniobra`, `lan_amarre`, `lan_perma`, `tipo_amarras`, `material`, `vel_vie_max`, `vel_vie_min`, `vel_cor_max`, `obs`) VALUES
(1, 'Eduardo Lozada', 'MARCAHUASI', 'ALESSANDRA', 'DIXIIE V', 'Neoflex rope 12', 'Propylene and Polyester', '16.71', '3.89', 'Inoperativo', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `res_trans_info_buque`
--

CREATE TABLE `res_trans_info_buque` (
  `id_term_buque` int(11) NOT NULL,
  `tipo` varchar(32) DEFAULT NULL,
  `bandera` varchar(32) DEFAULT NULL,
  `puerto_origen` varchar(32) DEFAULT NULL,
  `tripulacion` varchar(32) DEFAULT NULL,
  `nom_capitan` varchar(32) DEFAULT NULL,
  `nom_primer_oficial` varchar(32) DEFAULT NULL,
  `manga` varchar(32) DEFAULT NULL,
  `eslora_total` varchar(32) DEFAULT NULL,
  `puntal` varchar(32) DEFAULT NULL,
  `calado_verano` varchar(32) DEFAULT NULL,
  `peso_muerto` varchar(32) DEFAULT NULL,
  `num_tanques` varchar(32) DEFAULT NULL,
  `capacidad_carga` varchar(32) DEFAULT NULL,
  `max_presion` varchar(32) DEFAULT NULL,
  `armador` varchar(32) DEFAULT NULL,
  `naviera` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `res_trans_info_buque`
--

INSERT INTO `res_trans_info_buque` (`id_term_buque`, `tipo`, `bandera`, `puerto_origen`, `tripulacion`, `nom_capitan`, `nom_primer_oficial`, `manga`, `eslora_total`, `puntal`, `calado_verano`, `peso_muerto`, `num_tanques`, `capacidad_carga`, `max_presion`, `armador`, `naviera`) VALUES
(1, 'GASERO', 'Perú', 'Callao', 'Peruana', 'Walter Sladjen', 'Carlos Salvador', '27.36', '179', '18.6', '11.62', '29.383', '1-2 y 3 P/S', '37511.316', '450', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `res_trans_info_pers_guard`
--

CREATE TABLE `res_trans_info_pers_guard` (
  `id_term_buque` int(11) NOT NULL,
  `loading_master` varchar(64) DEFAULT NULL,
  `supervisor_dia` varchar(32) DEFAULT NULL,
  `supervisor_noche` varchar(32) DEFAULT NULL,
  `brazo_carga` varchar(32) DEFAULT NULL,
  `opera_dia` varchar(32) DEFAULT NULL,
  `opera_noche` varchar(32) DEFAULT NULL,
  `panel_dia` varchar(32) DEFAULT NULL,
  `panel_noche` varchar(32) DEFAULT NULL,
  `otro1` varchar(32) DEFAULT NULL,
  `otro2` varchar(32) DEFAULT NULL,
  `obs` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `res_trans_info_pers_guard`
--

INSERT INTO `res_trans_info_pers_guard` (`id_term_buque`, `loading_master`, `supervisor_dia`, `supervisor_noche`, `brazo_carga`, `opera_dia`, `opera_noche`, `panel_dia`, `panel_noche`, `otro1`, `otro2`, `obs`) VALUES
(1, 'MARTIN COLLANTES', 'LUIS MATTA', 'DARWIN TACORA', 'MZZ-6020', 'PEDRO LINARES', 'Moises Reyes', 'Felix Herrera', 'Pool Suarez', 'Oscar Marquez', 'No', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `res_trans_lineas_amarre`
--

CREATE TABLE `res_trans_lineas_amarre` (
  `id_term_buque` int(11) NOT NULL,
  `largo_proa` varchar(32) DEFAULT NULL,
  `dolphin_l_proa` varchar(32) DEFAULT NULL,
  `traves_proa` varchar(32) DEFAULT NULL,
  `dolphin_t_proa` varchar(32) DEFAULT NULL,
  `spr_proa_1` varchar(32) DEFAULT NULL,
  `dolphin_s_proa1` varchar(32) DEFAULT NULL,
  `spr_proa_2` varchar(32) DEFAULT NULL,
  `dolphin_s_proa2` varchar(32) DEFAULT NULL,
  `spr_popa_1` varchar(32) DEFAULT NULL,
  `dolphin_s_popa1` varchar(32) DEFAULT NULL,
  `spr_popa_2` varchar(32) DEFAULT NULL,
  `dolphin_s_popa2` varchar(32) DEFAULT NULL,
  `traves_popa` varchar(32) DEFAULT NULL,
  `dolphin_t_popa` varchar(32) DEFAULT NULL,
  `largo_popa` varchar(32) DEFAULT NULL,
  `dolphin_l_popa` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `res_trans_lineas_amarre`
--

INSERT INTO `res_trans_lineas_amarre` (`id_term_buque`, `largo_proa`, `dolphin_l_proa`, `traves_proa`, `dolphin_t_proa`, `spr_proa_1`, `dolphin_s_proa1`, `spr_proa_2`, `dolphin_s_proa2`, `spr_popa_1`, `dolphin_s_popa1`, `spr_popa_2`, `dolphin_s_popa2`, `traves_popa`, `dolphin_t_popa`, `largo_popa`, `dolphin_l_popa`) VALUES
(1, '2 (w/w)', '1', '3 (w/w/b)', '2', '1 (b)', '3', '2 (w/w)', '4', '2 (w/w)', '5', '2 (w/w)', '6', '3 (w/w/b)', '7', '2 (w/b)', '8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `res_trans_perf_nave`
--

CREATE TABLE `res_trans_perf_nave` (
  `id_term_buque` int(11) NOT NULL,
  `coo_oficial` varchar(32) DEFAULT NULL,
  `demo_oper` varchar(32) DEFAULT NULL,
  `para_oper` varchar(32) DEFAULT NULL,
  `incid_emb` varchar(32) DEFAULT NULL,
  `coo_trip` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `res_trans_perf_nave`
--

INSERT INTO `res_trans_perf_nave` (`id_term_buque`, `coo_oficial`, `demo_oper`, `para_oper`, `incid_emb`, `coo_trip`) VALUES
(1, 'Buena', 'No', 'No', 'No', 'Muy buena');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `res_trans_perf_prac`
--

CREATE TABLE `res_trans_perf_prac` (
  `id_term_buque` int(11) NOT NULL,
  `coo_emb` varchar(32) DEFAULT NULL,
  `relev_prac` varchar(32) DEFAULT NULL,
  `empresa` varchar(32) DEFAULT NULL,
  `prac_entre` varchar(32) DEFAULT NULL,
  `agencia` varchar(32) DEFAULT NULL,
  `num_mani` varchar(32) DEFAULT NULL,
  `lancha` varchar(32) DEFAULT NULL,
  `obs_amar` varchar(32) DEFAULT NULL,
  `obs_desam` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `res_trans_perf_prac`
--

INSERT INTO `res_trans_perf_prac` (`id_term_buque`, `coo_emb`, `relev_prac`, `empresa`, `prac_entre`, `agencia`, `num_mani`, `lancha`, `obs_amar`, `obs_desam`) VALUES
(1, 'Buena', 'No', 'Pilotos del Sur', 'No', 'Renadsa', '2', 'Hermes', 'No', 'No');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `res_trans_reg_lineas`
--

CREATE TABLE `res_trans_reg_lineas` (
  `id_reg_linea` int(11) NOT NULL,
  `id_term_buque` int(11) NOT NULL,
  `hora_1` time DEFAULT NULL,
  `codigo_1` varchar(32) DEFAULT NULL,
  `dolphin_1` varchar(32) DEFAULT NULL,
  `calado_pp_1` varchar(32) DEFAULT NULL,
  `hora_enmienda_1` time DEFAULT NULL,
  `hora_2` time DEFAULT NULL,
  `codigo_2` varchar(32) DEFAULT NULL,
  `dolphin_2` varchar(32) DEFAULT NULL,
  `calado_pp_2` varchar(32) DEFAULT NULL,
  `hora_enmienda_2` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `res_trans_reg_lineas`
--

INSERT INTO `res_trans_reg_lineas` (`id_reg_linea`, `id_term_buque`, `hora_1`, `codigo_1`, `dolphin_1`, `calado_pp_1`, `hora_enmienda_1`, `hora_2`, `codigo_2`, `dolphin_2`, `calado_pp_2`, `hora_enmienda_2`) VALUES
(1, 1, NULL, '', '', '', NULL, NULL, '', '', '', NULL),
(2, 1, NULL, '', '', '', NULL, NULL, '', '', '', NULL),
(3, 1, NULL, '', '', '', NULL, NULL, '', '', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `res_trans_tipo_trans`
--

CREATE TABLE `res_trans_tipo_trans` (
  `id_tipo_trans` int(11) NOT NULL,
  `id_term_buque` int(11) NOT NULL,
  `tipo_trans` varchar(16) DEFAULT NULL,
  `producto` varchar(16) DEFAULT NULL,
  `cant_nominada` varchar(32) DEFAULT NULL,
  `num_tanque` varchar(32) DEFAULT NULL,
  `densidad` varchar(32) DEFAULT NULL,
  `peso_mol` varchar(32) DEFAULT NULL,
  `temp` varchar(32) DEFAULT NULL,
  `cant_trans` varchar(32) DEFAULT NULL,
  `tiempo_neto` varchar(32) DEFAULT NULL,
  `regimen` varchar(32) DEFAULT NULL,
  `destino` varchar(64) DEFAULT NULL,
  `cant_trans_uni` varchar(16) DEFAULT NULL,
  `tiempo_neto_uni` varchar(16) DEFAULT NULL,
  `regimen_uni` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `res_trans_tipo_trans`
--

INSERT INTO `res_trans_tipo_trans` (`id_tipo_trans`, `id_term_buque`, `tipo_trans`, `producto`, `cant_nominada`, `num_tanque`, `densidad`, `peso_mol`, `temp`, `cant_trans`, `tiempo_neto`, `regimen`, `destino`, `cant_trans_uni`, `tiempo_neto_uni`, `regimen_uni`) VALUES
(1, 1, 'carga', 'PROPANE', '10500', 'TKBJ-13005', '0.5073', '44.2167', '-44.5', '', '', '', '', '', 'hrs', ''),
(2, 1, 'carga', 'BUTANE', '4500', 'TKBJ-3010', '0.5771', '58.0921', '24.6', '', '', '', '', '', 'hrs', ''),
(3, 1, 'descarga', '', '', '', '', '', '', '', '', '', '', '', 'hrs', ''),
(4, 1, 'descarga', '', '', '', '', '', '', '', '', '', '', '', 'hrs', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_1a_tanker`
--

CREATE TABLE `safety_list_1a_tanker` (
  `id_1a_tanker` int(11) NOT NULL,
  `id_safety_buque` int(11) DEFAULT NULL,
  `status_1a` varchar(32) DEFAULT NULL,
  `remarks_1a` tinytext DEFAULT NULL,
  `id_1a_tanker_d` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_1a_tanker_d`
--

CREATE TABLE `safety_list_1a_tanker_d` (
  `id_1a_tanker_d` int(11) NOT NULL,
  `item_1a` varchar(16) DEFAULT NULL,
  `check_1a` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `safety_list_1a_tanker_d`
--

INSERT INTO `safety_list_1a_tanker_d` (`id_1a_tanker_d`, `item_1a`, `check_1a`) VALUES
(1, '1.', 'Pre-arrival information is exchanged (6.5, 21.2)'),
(2, '2.', 'International shore fire connection is available (5.5, 19.4.3.1)'),
(3, '3.', 'Transfer hoses are of suitable construction (18.2)'),
(4, '4.', 'Terminal information booklet reviewed (15.2.2)'),
(5, '5.', 'Pre-berthing information is exchanged (21.3, 22.3)'),
(6, '6.', 'Pressure/vacuum valves and/or high velocity vents are operational (11.1.8)'),
(7, '7.', 'Fixed and portable oxygen analyzers are operational (2.4)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_1b_tanker`
--

CREATE TABLE `safety_list_1b_tanker` (
  `id_1b_tanker` int(11) NOT NULL,
  `id_safety_buque` int(11) DEFAULT NULL,
  `status_1b` varchar(32) DEFAULT NULL,
  `remarks_1b` tinytext DEFAULT NULL,
  `id_1b_tanker_d` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_1b_tanker_d`
--

CREATE TABLE `safety_list_1b_tanker_d` (
  `id_1b_tanker_d` int(11) NOT NULL,
  `item_1b` varchar(16) DEFAULT NULL,
  `check_1b` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `safety_list_1b_tanker_d`
--

INSERT INTO `safety_list_1b_tanker_d` (`id_1b_tanker_d`, `item_1b`, `check_1b`) VALUES
(1, '8.', 'Inert gas system pressure and oxygen recorders are operational (11.1.5.2, 11.1.11)'),
(2, '9.', 'Inert gas system and associated equipment are operational (11.1.5.2, 11.1.11)'),
(3, '10.', 'Cargo tank atmospheres’ oxygen content is less than 8% (11.1.3)'),
(4, '11.', 'Cargo tank atmospheres are at positive pressure (11.1.3)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_2_terminal`
--

CREATE TABLE `safety_list_2_terminal` (
  `id_2_terminal` int(11) NOT NULL,
  `id_safety_buque` int(11) DEFAULT NULL,
  `status_2` varchar(32) DEFAULT NULL,
  `remarks_2` tinytext DEFAULT NULL,
  `id_2_terminal_d` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_2_terminal_d`
--

CREATE TABLE `safety_list_2_terminal_d` (
  `id_2_terminal_d` int(11) NOT NULL,
  `item_2` varchar(16) DEFAULT NULL,
  `check_2` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `safety_list_2_terminal_d`
--

INSERT INTO `safety_list_2_terminal_d` (`id_2_terminal_d`, `item_2`, `check_2`) VALUES
(1, '12.', 'Pre-arrival information is exchanged (6.5, 21.2)'),
(2, '13.', 'International shore fire connection is available (5.5, 19.4.3.1, 19.4.3.5)'),
(3, '14.', 'Transfer equipment is of suitable construction (18.1, 18.2)'),
(4, '15.', 'Terminal information booklet transmitted to tanker (15.2.2)'),
(5, '16.', 'Pre-berthing information is exchanged (21.3, 22.3)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_3_tanker`
--

CREATE TABLE `safety_list_3_tanker` (
  `id_3_tanker` int(11) NOT NULL,
  `id_safety_buque` int(11) DEFAULT NULL,
  `status_3` varchar(32) DEFAULT NULL,
  `remarks_3` tinytext DEFAULT NULL,
  `id_3_tanker_d` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_3_tanker_d`
--

CREATE TABLE `safety_list_3_tanker_d` (
  `id_3_tanker_d` int(11) NOT NULL,
  `item_3` varchar(16) DEFAULT NULL,
  `check_3` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `safety_list_3_tanker_d`
--

INSERT INTO `safety_list_3_tanker_d` (`id_3_tanker_d`, `item_3`, `check_3`) VALUES
(1, '17.', 'Fendering system is effective (22.4.1)'),
(2, '18.', 'Mooring arrangement is effective (22.2, 22.4.3)'),
(3, '19.', 'Access to and from the tanker is safe (16.4)'),
(4, '20.', 'Scuppers and open drains are completely plugged (23.7.4, 23.7.5)'),
(5, '21.', 'Cargo system sea connections and overboard discharges are secured (23.7.3)'),
(6, '22.', 'Very high frequency and ultra-high frequency transceivers are set to low power mode (4.11.6, 4.13.2.2)'),
(7, '23.', 'External openings in superstructures are controlled (23.1)'),
(8, '24.', 'Pump room ventilation is effective (10.12.2)'),
(9, '25.', 'Medium frequency/high frequency radio antennae are isolated (4.11.4, 4.13.2.1)'),
(10, '26.', 'Accommodation spaces are at positive pressure (23.2)'),
(11, '27.', 'Fire control plans are readily available (9.11.2.5)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_4_terminal`
--

CREATE TABLE `safety_list_4_terminal` (
  `id_4_terminal` int(11) NOT NULL,
  `id_safety_buque` int(11) DEFAULT NULL,
  `status_4` varchar(32) DEFAULT NULL,
  `remarks_4` tinytext DEFAULT NULL,
  `id_4_terminal_d` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_4_terminal_d`
--

CREATE TABLE `safety_list_4_terminal_d` (
  `id_4_terminal_d` int(11) NOT NULL,
  `item_4` varchar(16) DEFAULT NULL,
  `check_4` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `safety_list_4_terminal_d`
--

INSERT INTO `safety_list_4_terminal_d` (`id_4_terminal_d`, `item_4`, `check_4`) VALUES
(1, '28.', 'Fendering system is effective (22.4.1)'),
(2, '29.', 'Tanker is moored according to the terminal mooring plan (22.2, 22.4.3)'),
(3, '30.', 'Access to and from the terminal is safe (16.4)'),
(4, '31.', 'Spill containment and sumps are secure (18.4.2, 18.4.3, 23.7.4, 23.7.5)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_5a_tanker_terminal`
--

CREATE TABLE `safety_list_5a_tanker_terminal` (
  `id_5a_tanker` int(11) NOT NULL,
  `id_safety_buque` int(11) DEFAULT NULL,
  `status_tanker_5a` varchar(16) DEFAULT NULL,
  `status_terminal_5a` varchar(16) DEFAULT NULL,
  `remarks_5a` tinytext DEFAULT NULL,
  `id_5a_tanker_terminal_d` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_5a_tanker_terminal_d`
--

CREATE TABLE `safety_list_5a_tanker_terminal_d` (
  `id_5a_tanker_terminal_d` int(11) NOT NULL,
  `item_5a` varchar(16) DEFAULT NULL,
  `check_5a` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `safety_list_5a_tanker_terminal_d`
--

INSERT INTO `safety_list_5a_tanker_terminal_d` (`id_5a_tanker_terminal_d`, `item_5a`, `check_5a`) VALUES
(1, '32.', 'Tanker is ready to move at agreed notice period (9.11, 21.7.1.1, 22.5.4)'),
(2, '33.', 'Effective tanker and terminal communications are established (21.1.1, 21.1.2)'),
(3, '34.', 'Transfer equipment is in safe condition (isolated, drained and de-pressurised) (18.4.1)'),
(4, '35.', 'Operation supervision and effective watch keeping is adequate (7.9, 23.11)'),
(5, '36.', 'There are sufficient personnel to deal with an emergency (9.11.2.2, 23.11)'),
(6, '37.', 'Smoking restrictions and designated smoking areas are established (4.10, 23.10)'),
(7, '38.', 'Naked light restrictions are established (4.10.1)'),
(8, '39.', 'Control of electrical and electronic devices is agreed (4.11, 4.12)'),
(9, '40.', 'Means of emergency escape from both tanker and terminal are established (20.5)'),
(10, '41.', 'Firefighting equipment is ready for use (5, 19.4, 23.8)'),
(11, '42.', 'Oil spill clean-up material is available (20.4)'),
(12, '43.', 'Manifolds are properly connected (23.6.1)'),
(13, '44.', 'Sampling and gauging protocols are agreed (23.5.3.2, 23.7.7.5)'),
(14, '45.', 'Procedures for cargo, bunkers and ballast handling operations are agreed (21.4, 21.5, 21.6)'),
(15, '46.', 'Cargo transfer management controls are agreed (12.1)'),
(16, '47.', 'Cargo tank cleaning requirements, including crude oil washing, are agreed (12.3, 12.5, 21.4.1)'),
(17, '48.', 'Cargo tank gas freeing arrangements agreed (12.4)'),
(18, '49.', 'Cargo and bunker slop handling requirements agreed (12.1, 21.2, 21.4)'),
(19, '50.', 'Routine for regular checks on cargo transferred are agreed (23.7.2)'),
(20, '51.', 'Emergency signals and shutdown procedures are agreed (12.1.6.3, 18.5, 21.1.2)'),
(21, '52.', 'Safety data sheets are available (1.4.4, 20.1, 21.4)'),
(22, '53.', 'Hazardous properties of the products to be transferred are discussed (1.2, 1.4)'),
(23, '54.', 'Electrical insulation of the tanker/terminal interface is effective (12.9.5, 17.4, 18.2.14)'),
(24, '55.', 'Tank venting system and closed operation procedures are agreed (11.3.3.1, 21.4, 21.5, 23.3.3)'),
(25, '56.', 'Vapour return line operational parameters are agreed (11.5, 18.3, 23.7.7)'),
(26, '57.', 'Measures to avoid cargo back-filling are agreed (12.1.13.7)'),
(27, '58.', 'Status of unused cargo and bunker connections is satisfactory (23.7.1, 23.7.6)'),
(28, '59.', 'Portable very high frequency and ultra-high frequency radios are intrinsically safe (4.12.4, 21.1.1)'),
(29, '60.', 'Procedures for receiving nitrogen from terminal to cargo tank are agreed (12.1.14.8)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_5b_tanker`
--

CREATE TABLE `safety_list_5b_tanker` (
  `id_5b_tanker` int(11) NOT NULL,
  `id_safety_buque` int(11) DEFAULT NULL,
  `status_tanker_5b` varchar(16) DEFAULT NULL,
  `status_terminal_5b` varchar(16) DEFAULT NULL,
  `remarks_5b` tinytext DEFAULT NULL,
  `id_5b_tanker_d` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_5b_tanker_d`
--

CREATE TABLE `safety_list_5b_tanker_d` (
  `id_5b_tanker_d` int(11) NOT NULL,
  `item_5b` varchar(16) DEFAULT NULL,
  `check_5b` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `safety_list_5b_tanker_d`
--

INSERT INTO `safety_list_5b_tanker_d` (`id_5b_tanker_d`, `item_5b`, `check_5b`) VALUES
(1, '61.', 'Inhibition certificate received (if required) from manufacturer'),
(2, '62.', 'Appropriate personal protective equipment identified and available (4.8.1)'),
(3, '63.', 'Countermeasures against personal contact with cargo are agreed (1.4)'),
(4, '64.', 'Cargo handling rate and relationship with valve closure times and automatic shutdown systems is agreed (16.8, 21.4, 21.5, 21.6)'),
(5, '65.', 'Cargo system gauge operation and alarm set points are confirmed (12.1.6.6.1)'),
(6, '66.', 'Adequate portable vapour detection instruments are in use (2.4)'),
(7, '67.', 'Information on firefighting media and procedures is exchanged (5, 19)'),
(8, '68.', 'Transfer hoses confirmed suitable for the product being handled (18.2)'),
(9, '69.', 'Confirm cargo handling is only by a permanent installed pipeline system'),
(10, '70.', 'Procedures are in place to receive nitrogen from the terminal for inerting or purging (12.1.14.8)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_5c_tanker`
--

CREATE TABLE `safety_list_5c_tanker` (
  `id_5c_tanker` int(11) NOT NULL,
  `id_safety_buque` int(11) DEFAULT NULL,
  `status_tanker_5c` varchar(16) DEFAULT NULL,
  `status_terminal_5c` varchar(16) DEFAULT NULL,
  `remarks_5c` tinytext DEFAULT NULL,
  `id_5c_tanker_d` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_5c_tanker_d`
--

CREATE TABLE `safety_list_5c_tanker_d` (
  `id_5c_tanker_d` int(11) NOT NULL,
  `item_5c` varchar(16) DEFAULT NULL,
  `check_5c` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `safety_list_5c_tanker_d`
--

INSERT INTO `safety_list_5c_tanker_d` (`id_5c_tanker_d`, `item_5c`, `check_5c`) VALUES
(1, '71.', 'Inhibition certificate received (if required) from manufacturer'),
(2, '72.', 'Water spray system is operational (5.3.1, 19.4.3)'),
(3, '73.', 'Appropriate personal protective equipment is identified and available (4.8.1)'),
(4, '74.', 'Remote control valves are operational'),
(5, '75.', 'Cargo pumps and compressors are operational'),
(6, '76.', 'Maximum working pressures are agreed between tanker and terminal (21.4, 21.5, 21.6)'),
(7, '77.', 'Reliquefaction or boil-off control equipment is operational'),
(8, '78.', 'Gas detection equipment is appropriately set for the cargo (2.4)'),
(9, '79.', 'Cargo system gauge operation and alarm set points are confirmed (12.1.6.6.1)'),
(10, '80.', 'Emergency shutdown systems are tested and operational (18.5)'),
(11, '81.', 'Cargo handling rate and relationship with valve closure times and automatic shutdown systems is agreed (16.8, 21.4, 21.5, 21.6)'),
(12, '82.', 'Maximum / minimum temperatures / pressures of the cargo to be transferred are agreed (21.4, 21.5, 21.6)'),
(13, '83.', 'Cargo tank relief valve settings are confirmed (12.11, 21.2, 21.4)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_6_details`
--

CREATE TABLE `safety_list_6_details` (
  `id_details_6` int(11) NOT NULL,
  `details_6` varchar(128) DEFAULT NULL,
  `id_safety_buque` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_6_tanker`
--

CREATE TABLE `safety_list_6_tanker` (
  `id_6_tanker` int(11) NOT NULL,
  `id_safety_buque` int(11) DEFAULT NULL,
  `tanker_initials_6` varchar(16) DEFAULT NULL,
  `terminal_initials_6` varchar(16) DEFAULT NULL,
  `id_6_tanker_d` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_6_tanker_d`
--

CREATE TABLE `safety_list_6_tanker_d` (
  `id_6_tanker_d` int(11) NOT NULL,
  `item_6` varchar(16) DEFAULT NULL,
  `check_6` varchar(512) DEFAULT NULL,
  `details_6` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `safety_list_6_tanker_d`
--

INSERT INTO `safety_list_6_tanker_d` (`id_6_tanker_d`, `item_6`, `check_6`, `details_6`) VALUES
(1, '32.', 'Tanker manoeuvring readiness', 'Notice period (maximum) for full readiness to manoeuvre:'),
(4, '33.', 'Security protocols', 'Security level:'),
(6, '33.', 'Effective tanker / terminal communications', 'Primary system:'),
(8, '35.', 'Operational supervision and watch keeping', 'Tanker:'),
(10, '37. 38.', 'Dedicated smoking areas and naked lights restrictions', 'Tanker:'),
(12, '45.', 'Maximum wind, current and sea/swell criteria or other environmental factors', 'Stop cargo transfer:'),
(15, '45. 46.', 'Limits for cargo, bunkers and ballast handling', 'Maximum transfer rates:'),
(20, '45. 46.', 'Pressure surge control', 'Minimum number of cargo tanks open:'),
(25, '46.', 'Cargo transfer management procedures', 'Action notice periods:'),
(27, '50.', 'Routine for regular checks on cargo transferred are agreed', 'Routine transferred quantity checks:'),
(28, '51.', 'Emergency signals', 'Tanker:'),
(30, '55.', 'Tank venting system', 'Procedure:'),
(31, '55.', 'Closed operations', 'Requirements:'),
(32, '56.', 'Vapour return line', 'Operational parameters:'),
(34, '60.', 'Nitrogen supply from terminal', 'Procedures to receive:'),
(37, '83.', 'For gas tanker only: cargo tank relief valve settings', 'Tank 1:');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_7a_general`
--

CREATE TABLE `safety_list_7a_general` (
  `id_7a_general` int(11) NOT NULL,
  `id_safety_buque` int(11) DEFAULT NULL,
  `status_7a` varchar(16) DEFAULT NULL,
  `remarks_7a` tinytext DEFAULT NULL,
  `id_7a_general_d` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_7a_general_d`
--

CREATE TABLE `safety_list_7a_general_d` (
  `id_7a_general_d` int(11) NOT NULL,
  `item_7a` varchar(16) DEFAULT NULL,
  `check_7a` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `safety_list_7a_general_d`
--

INSERT INTO `safety_list_7a_general_d` (`id_7a_general_d`, `item_7a`, `check_7a`) VALUES
(1, '84.', 'Portable drip trays are correctly positioned and empty (23.7.5)'),
(2, '85.', 'Individual cargo tank inert gas supply valves are secured for cargo plan (12.1.13.4)'),
(3, '86.', 'Inert gas system delivering inert gas with oxygen content not more than 5% (11.1.3)'),
(4, '87.', 'Cargo tank high level alarms are operational (12.1.6.6.1)'),
(5, '88.', 'All cargo, ballast and bunker tanks openings are secured (23.3)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_7b_tanker`
--

CREATE TABLE `safety_list_7b_tanker` (
  `id_7b_tanker` int(11) NOT NULL,
  `id_safety_buque` int(11) DEFAULT NULL,
  `status_7b` varchar(16) DEFAULT NULL,
  `remarks_7b` tinytext DEFAULT NULL,
  `id_7b_tanker_d` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_7b_tanker_d`
--

CREATE TABLE `safety_list_7b_tanker_d` (
  `id_7b_tanker_d` int(11) NOT NULL,
  `item_7b` varchar(16) DEFAULT NULL,
  `check_7b` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `safety_list_7b_tanker_d`
--

INSERT INTO `safety_list_7b_tanker_d` (`id_7b_tanker_d`, `item_7b`, `check_7b`) VALUES
(1, '89.', 'The completed pre-arrival crude oil washing checklist, as contained in the approved crude oil washing manual, is copied to terminal (12.5.2, 21.2.3)'),
(2, '90.', 'Crude oil washing checklists for use before, during and after crude oil washing are in place ready to complete, as contained in the approved crude oil washing manual (12.5.2, 21.6)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_7c_tanker`
--

CREATE TABLE `safety_list_7c_tanker` (
  `id_7c_tanker` int(11) NOT NULL,
  `id_safety_buque` int(11) DEFAULT NULL,
  `status_7c` varchar(16) DEFAULT NULL,
  `remarks_7c` tinytext DEFAULT NULL,
  `id_7c_tanker_d` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_7c_tanker_d`
--

CREATE TABLE `safety_list_7c_tanker_d` (
  `id_7c_tanker_d` int(11) NOT NULL,
  `item_7c` varchar(16) DEFAULT NULL,
  `check_7c` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `safety_list_7c_tanker_d`
--

INSERT INTO `safety_list_7c_tanker_d` (`id_7c_tanker_d`, `item_7c`, `check_7c`) VALUES
(1, '91.', 'Permission for tank cleaning operations is confirmed (21.2.3, 21.4, 25.4.3)'),
(2, '92.', 'Permission for gas freeing operations is confirmed (12.4.3)'),
(3, '93.', 'Tank cleaning procedures are agreed (12.3.2, 21.4, 21.6)'),
(4, '94.', 'If cargo tank entry is required, procedures for entry have been agreed with the terminal (10.5)'),
(5, '95.', 'Slop reception facilities and requirements are confirmed (12.1, 21.2, 21.4)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_8_tanker`
--

CREATE TABLE `safety_list_8_tanker` (
  `id_8_tanker` int(11) NOT NULL,
  `id_safety_buque` int(11) DEFAULT NULL,
  `time_8_1` varchar(16) DEFAULT NULL,
  `time_8_2` varchar(16) DEFAULT NULL,
  `time_8_3` varchar(16) DEFAULT NULL,
  `time_8_4` varchar(16) DEFAULT NULL,
  `time_8_5` varchar(16) DEFAULT NULL,
  `time_8_6` varchar(16) DEFAULT NULL,
  `time_8_7` varchar(16) DEFAULT NULL,
  `time_8_8` varchar(16) DEFAULT NULL,
  `time_8_9` varchar(16) DEFAULT NULL,
  `time_8_10` varchar(16) DEFAULT NULL,
  `id_8_tanker_d` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_8_tanker_d`
--

CREATE TABLE `safety_list_8_tanker_d` (
  `id_8_tanker_d` int(11) NOT NULL,
  `item_8` varchar(16) DEFAULT NULL,
  `check_8` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `safety_list_8_tanker_d`
--

INSERT INTO `safety_list_8_tanker_d` (`id_8_tanker_d`, `item_8`, `check_8`) VALUES
(1, '8.', 'Inert gas system pressure and oxygen recording operational'),
(2, '9.', 'Inert gas system and all associated equipment are operational'),
(3, '11.', 'Cargo tank atmospheres are at positive pressure'),
(4, '18.', 'Mooring arrangement is effective'),
(5, '19.', 'Access to and from the tanker is safe'),
(6, '20.', 'Scuppers and savealls are plugged'),
(7, '23.', 'External openings in superstructures are controlled'),
(8, '24.', 'Pumproom ventilation is effective'),
(9, '28.', 'Tanker is ready to move at agreed notice period'),
(10, '29.', 'Fendering is effective'),
(11, '33.', 'Communications are effective'),
(12, '35.', 'Supervision and watchkeeping is adequate'),
(13, '36.', 'Sufficient personnel are available to deal with an emergency'),
(14, '37.', 'Smoking restrictions and designated smoking areas are complied with'),
(15, '38.', 'Naked light restrictions are complied with'),
(16, '39.', 'Control of electrical devices and equipment in hazardous zones is complied with'),
(17, '40. 41. 42. 51.', 'Emergency response preparedness is satisfactory'),
(18, '54.', 'Electrical insulation of the tanker/terminal interface is effective'),
(19, '55.', 'Tank venting system and closed operation procedures are as agreed'),
(20, '85.', 'Individual cargo tank inert gas valves settings are as agreed'),
(21, '86.', 'Inert gas delivery maintained at not more than 5% oxygen'),
(22, '87.', 'Cargo tank high level alarms are operational'),
(23, '', 'Initials');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_9_terminal`
--

CREATE TABLE `safety_list_9_terminal` (
  `id_9_terminal` int(11) NOT NULL,
  `id_safety_buque` int(11) DEFAULT NULL,
  `time_9_1` varchar(16) DEFAULT NULL,
  `time_9_2` varchar(16) DEFAULT NULL,
  `time_9_3` varchar(16) DEFAULT NULL,
  `time_9_4` varchar(16) DEFAULT NULL,
  `time_9_5` varchar(16) DEFAULT NULL,
  `time_9_6` varchar(16) DEFAULT NULL,
  `time_9_7` varchar(16) DEFAULT NULL,
  `time_9_8` varchar(16) DEFAULT NULL,
  `time_9_9` varchar(16) DEFAULT NULL,
  `time_9_10` varchar(16) DEFAULT NULL,
  `id_9_terminal_d` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_9_terminal_d`
--

CREATE TABLE `safety_list_9_terminal_d` (
  `id_9_terminal_d` int(11) NOT NULL,
  `item_9` varchar(16) DEFAULT NULL,
  `check_9` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `safety_list_9_terminal_d`
--

INSERT INTO `safety_list_9_terminal_d` (`id_9_terminal_d`, `item_9`, `check_9`) VALUES
(1, '18.', 'Mooring arrangement is effective'),
(2, '19.', 'Access to and from the terminal is safe'),
(3, '29.', 'Fendering is effective'),
(4, '32.', 'Spill containment and sumps are secure'),
(5, '33.', 'Communications are effective'),
(6, '35.', 'Supervision and watch keeping is adequate'),
(7, '36.', 'Sufficient personnel are available to deal with an emergency'),
(8, '37.', 'Smoking restrictions and designated smoking areas are complied with'),
(9, '38.', 'Naked light restrictions are complied with'),
(10, '39.', 'Control of electrical devices and equipment in hazardous zones is complied with'),
(11, '40. 41. 47. 51.', 'Emergency response preparedness is satisfactory'),
(12, '54.', 'Electrical insulation of the tanker/terminal interface is effective'),
(13, '55.', 'Tank venting system and closed operation procedures are as agreed'),
(14, '', 'Initials');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_buque`
--

CREATE TABLE `safety_list_buque` (
  `id_safety_buque` int(11) NOT NULL,
  `id_term_buque` int(11) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `port` varchar(32) DEFAULT NULL,
  `tanker` varchar(32) DEFAULT NULL,
  `terminal` varchar(128) DEFAULT NULL,
  `product_trans` varchar(32) DEFAULT NULL,
  `finalizado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_check_part`
--

CREATE TABLE `safety_list_check_part` (
  `id_check_part` int(11) NOT NULL,
  `id_safety_buque` int(11) DEFAULT NULL,
  `tanker_check` varchar(16) DEFAULT NULL,
  `terminal_check` varchar(16) DEFAULT NULL,
  `id_check_part_d` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_check_part_d`
--

CREATE TABLE `safety_list_check_part_d` (
  `id_check_part_d` int(11) NOT NULL,
  `check_part` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `safety_list_check_part_d`
--

INSERT INTO `safety_list_check_part_d` (`id_check_part_d`, `check_part`) VALUES
(1, 'Part 1A. Tanker: checks pre-arrival'),
(2, 'Part 1B. Tanker: checks pre-arrival if using an inert gas system'),
(3, 'Part 2. Terminal: checks pre-arrival'),
(4, 'Part 3. Tanker: checks after mooring'),
(5, 'Part 4. Terminal: checks after mooring'),
(6, 'Part 5A. Tanker and terminal: pre-transfer conference'),
(7, 'Part 5B. Tanker and terminal: bulk liquid chemicals. Checks pre-transfer'),
(8, 'Part 5C. Tanker and terminal: liquefied gas. Checks pre-transfer'),
(9, 'Part 6. Tanker and terminal: agreements pre-transfer'),
(10, 'Part 7A. General tanker: checks pre-transfer'),
(11, 'Part 7B. Tanker: checks pre-transfer if crude oil washing is planned'),
(12, 'Part 7C. Tanker: checks prior to tank cleaning and/or gas freeing');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_firma`
--

CREATE TABLE `safety_list_firma` (
  `id_firma` int(11) NOT NULL,
  `id_safety_buque` int(11) DEFAULT NULL,
  `name_tanker` varchar(32) DEFAULT NULL,
  `rank_tanker` varchar(16) DEFAULT NULL,
  `signature_tanker` mediumblob DEFAULT NULL,
  `date_tanker` date DEFAULT NULL,
  `time_tanker` time DEFAULT NULL,
  `name_terminal` varchar(32) DEFAULT NULL,
  `rank_terminal` varchar(16) DEFAULT NULL,
  `signature_terminal` mediumblob DEFAULT NULL,
  `date_terminal` date DEFAULT NULL,
  `time_terminal` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `safety_list_ungrouped`
--

CREATE TABLE `safety_list_ungrouped` (
  `id_7c_ungrouped` int(11) NOT NULL,
  `id_safety_buque` int(11) DEFAULT NULL,
  `interv_time_8` varchar(16) DEFAULT NULL,
  `declaration` varchar(256) DEFAULT NULL,
  `interv_time_9` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(64) NOT NULL,
  `apellidos` varchar(64) NOT NULL,
  `correo` varchar(64) NOT NULL,
  `tipo_usuario` tinyint(1) NOT NULL,
  `acceso` tinyint(1) NOT NULL,
  `clave` char(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombres`, `apellidos`, `correo`, `tipo_usuario`, `acceso`, `clave`) VALUES
(1, 'Juan Dolorier', 'Aburto Zapata', 'jaburto@anjor.com.pe', 1, 0, '$2y$10$DXwrHlncN5DQJ1Q5E0zqae3thEF0mJdCBVLV2i9YQqCJ1livtRWU2'),
(2, 'Jorge Sebastian', 'Azaldegui Garay', 'jazaldegui@anjor.com.pe', 2, 1, '$2y$10$OgJl/Cppx.fLnzMPJwYCq.PxsLnAh4sZAS11fKaBN8IYr2zZsk4oe'),
(3, 'Loading', 'Master', 'loadingmaster', 1, 1, '$2y$10$GuvSxlnRfeMS4vrpS.i/ue47ryIO1hjHQVb50A3MLd/tDSyMaRovq'),
(4, 'Supervisor', 'de Tierra', 'landinspector', 2, 1, '$2y$10$CoU/01nRcdR0hdRjf.SMKeTX.JU8V0PUcfXXGngTh6dafxgqyvE3G'),
(5, 'Administrador', 'General', 'administrator', 3, 1, '$2y$10$m.sBAUcAUQsyFfAzc4GEY.kfIbZYDZ86OVYSmGixPasrQ7LZdBV1a');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cont_trans_buque`
--
ALTER TABLE `cont_trans_buque`
  ADD PRIMARY KEY (`id_control_trans`),
  ADD KEY `num_operacion` (`num_operacion`);

--
-- Indices de la tabla `cont_trans_info`
--
ALTER TABLE `cont_trans_info`
  ADD PRIMARY KEY (`id_info`),
  ADD KEY `id_control_trans` (`id_control_trans`);

--
-- Indices de la tabla `cont_trans_regimen`
--
ALTER TABLE `cont_trans_regimen`
  ADD PRIMARY KEY (`id_regimen`),
  ADD KEY `id_control_trans` (`id_control_trans`);

--
-- Indices de la tabla `data_trans_buque`
--
ALTER TABLE `data_trans_buque`
  ADD PRIMARY KEY (`id_data_trans`),
  ADD KEY `id_buque` (`id_buque`) USING BTREE;

--
-- Indices de la tabla `data_trans_detalle`
--
ALTER TABLE `data_trans_detalle`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_data_trans` (`id_data_trans`);

--
-- Indices de la tabla `data_trans_est_hechos`
--
ALTER TABLE `data_trans_est_hechos`
  ADD PRIMARY KEY (`id_est_hechos`),
  ADD KEY `id_data_trans` (`id_data_trans`);

--
-- Indices de la tabla `data_trans_info_buque`
--
ALTER TABLE `data_trans_info_buque`
  ADD PRIMARY KEY (`id_info_buque`),
  ADD KEY `id_data_trans` (`id_data_trans`);

--
-- Indices de la tabla `data_trans_viaje`
--
ALTER TABLE `data_trans_viaje`
  ADD PRIMARY KEY (`id_viaje`),
  ADD KEY `id_data_trans` (`id_data_trans`);

--
-- Indices de la tabla `est_hec_buque`
--
ALTER TABLE `est_hec_buque`
  ADD PRIMARY KEY (`num_operacion`),
  ADD KEY `id_buque_buque` (`id_buque`);

--
-- Indices de la tabla `est_hec_embarque`
--
ALTER TABLE `est_hec_embarque`
  ADD PRIMARY KEY (`num_operacion`,`producto`);

--
-- Indices de la tabla `est_hec_eventos`
--
ALTER TABLE `est_hec_eventos`
  ADD PRIMARY KEY (`id_evento`);

--
-- Indices de la tabla `est_hec_info`
--
ALTER TABLE `est_hec_info`
  ADD PRIMARY KEY (`num_operacion`,`id_evento`),
  ADD KEY `id_evento_info` (`id_evento`);

--
-- Indices de la tabla `est_hec_nuevos_eventos`
--
ALTER TABLE `est_hec_nuevos_eventos`
  ADD PRIMARY KEY (`id_nuevo_evento`),
  ADD KEY `num_operacion` (`num_operacion`);

--
-- Indices de la tabla `ins_pre_detalles`
--
ALTER TABLE `ins_pre_detalles`
  ADD PRIMARY KEY (`id_buque`);

--
-- Indices de la tabla `ins_pre_firmas`
--
ALTER TABLE `ins_pre_firmas`
  ADD PRIMARY KEY (`id_buque`);

--
-- Indices de la tabla `ins_pre_info`
--
ALTER TABLE `ins_pre_info`
  ADD PRIMARY KEY (`detalle_inspeccion`,`id_buque`),
  ADD KEY `id_buque` (`id_buque`);

--
-- Indices de la tabla `res_trans_buque`
--
ALTER TABLE `res_trans_buque`
  ADD PRIMARY KEY (`id_term_buque`),
  ADD KEY `num_operacion` (`num_operacion`) USING BTREE;

--
-- Indices de la tabla `res_trans_car_remol`
--
ALTER TABLE `res_trans_car_remol`
  ADD PRIMARY KEY (`id_car`),
  ADD KEY `id_term_buque` (`id_term_buque`) USING BTREE;

--
-- Indices de la tabla `res_trans_data_ungrouped`
--
ALTER TABLE `res_trans_data_ungrouped`
  ADD PRIMARY KEY (`id_term_buque`),
  ADD KEY `id_term_buque` (`id_term_buque`);

--
-- Indices de la tabla `res_trans_info_amarre`
--
ALTER TABLE `res_trans_info_amarre`
  ADD PRIMARY KEY (`id_term_buque`),
  ADD KEY `id_term_buque` (`id_term_buque`);

--
-- Indices de la tabla `res_trans_info_buque`
--
ALTER TABLE `res_trans_info_buque`
  ADD PRIMARY KEY (`id_term_buque`),
  ADD KEY `id_term_buque` (`id_term_buque`);

--
-- Indices de la tabla `res_trans_info_pers_guard`
--
ALTER TABLE `res_trans_info_pers_guard`
  ADD PRIMARY KEY (`id_term_buque`),
  ADD KEY `id_term_buque` (`id_term_buque`);

--
-- Indices de la tabla `res_trans_lineas_amarre`
--
ALTER TABLE `res_trans_lineas_amarre`
  ADD PRIMARY KEY (`id_term_buque`),
  ADD KEY `id_term_buque` (`id_term_buque`);

--
-- Indices de la tabla `res_trans_perf_nave`
--
ALTER TABLE `res_trans_perf_nave`
  ADD PRIMARY KEY (`id_term_buque`),
  ADD KEY `id_term_buque` (`id_term_buque`);

--
-- Indices de la tabla `res_trans_perf_prac`
--
ALTER TABLE `res_trans_perf_prac`
  ADD PRIMARY KEY (`id_term_buque`),
  ADD KEY `id_term_buque` (`id_term_buque`) USING BTREE;

--
-- Indices de la tabla `res_trans_reg_lineas`
--
ALTER TABLE `res_trans_reg_lineas`
  ADD PRIMARY KEY (`id_reg_linea`),
  ADD KEY `id_term_buque` (`id_term_buque`) USING BTREE;

--
-- Indices de la tabla `res_trans_tipo_trans`
--
ALTER TABLE `res_trans_tipo_trans`
  ADD PRIMARY KEY (`id_tipo_trans`),
  ADD KEY `id_term_buque` (`id_term_buque`);

--
-- Indices de la tabla `safety_list_1a_tanker`
--
ALTER TABLE `safety_list_1a_tanker`
  ADD PRIMARY KEY (`id_1a_tanker`),
  ADD KEY `id_safety_buque` (`id_safety_buque`),
  ADD KEY `id_1a_tanker_d` (`id_1a_tanker_d`);

--
-- Indices de la tabla `safety_list_1a_tanker_d`
--
ALTER TABLE `safety_list_1a_tanker_d`
  ADD PRIMARY KEY (`id_1a_tanker_d`);

--
-- Indices de la tabla `safety_list_1b_tanker`
--
ALTER TABLE `safety_list_1b_tanker`
  ADD PRIMARY KEY (`id_1b_tanker`),
  ADD KEY `id_1b_tanker_d` (`id_1b_tanker_d`),
  ADD KEY `id_safety_buque` (`id_safety_buque`);

--
-- Indices de la tabla `safety_list_1b_tanker_d`
--
ALTER TABLE `safety_list_1b_tanker_d`
  ADD PRIMARY KEY (`id_1b_tanker_d`);

--
-- Indices de la tabla `safety_list_2_terminal`
--
ALTER TABLE `safety_list_2_terminal`
  ADD PRIMARY KEY (`id_2_terminal`),
  ADD KEY `id_safety_buque` (`id_safety_buque`),
  ADD KEY `id_2_terminal_d` (`id_2_terminal_d`);

--
-- Indices de la tabla `safety_list_2_terminal_d`
--
ALTER TABLE `safety_list_2_terminal_d`
  ADD PRIMARY KEY (`id_2_terminal_d`);

--
-- Indices de la tabla `safety_list_3_tanker`
--
ALTER TABLE `safety_list_3_tanker`
  ADD PRIMARY KEY (`id_3_tanker`),
  ADD KEY `id_safety_buque` (`id_safety_buque`),
  ADD KEY `id_3_tanker_d` (`id_3_tanker_d`);

--
-- Indices de la tabla `safety_list_3_tanker_d`
--
ALTER TABLE `safety_list_3_tanker_d`
  ADD PRIMARY KEY (`id_3_tanker_d`);

--
-- Indices de la tabla `safety_list_4_terminal`
--
ALTER TABLE `safety_list_4_terminal`
  ADD PRIMARY KEY (`id_4_terminal`),
  ADD KEY `id_safety_buque` (`id_safety_buque`),
  ADD KEY `id_4_terminal_d` (`id_4_terminal_d`);

--
-- Indices de la tabla `safety_list_4_terminal_d`
--
ALTER TABLE `safety_list_4_terminal_d`
  ADD PRIMARY KEY (`id_4_terminal_d`);

--
-- Indices de la tabla `safety_list_5a_tanker_terminal`
--
ALTER TABLE `safety_list_5a_tanker_terminal`
  ADD PRIMARY KEY (`id_5a_tanker`),
  ADD KEY `id_safety_buque` (`id_safety_buque`),
  ADD KEY `id_5a_tanker_terminal_d` (`id_5a_tanker_terminal_d`);

--
-- Indices de la tabla `safety_list_5a_tanker_terminal_d`
--
ALTER TABLE `safety_list_5a_tanker_terminal_d`
  ADD PRIMARY KEY (`id_5a_tanker_terminal_d`);

--
-- Indices de la tabla `safety_list_5b_tanker`
--
ALTER TABLE `safety_list_5b_tanker`
  ADD PRIMARY KEY (`id_5b_tanker`),
  ADD KEY `id_safety_buque` (`id_safety_buque`),
  ADD KEY `id_5b_tanker_d` (`id_5b_tanker_d`);

--
-- Indices de la tabla `safety_list_5b_tanker_d`
--
ALTER TABLE `safety_list_5b_tanker_d`
  ADD PRIMARY KEY (`id_5b_tanker_d`);

--
-- Indices de la tabla `safety_list_5c_tanker`
--
ALTER TABLE `safety_list_5c_tanker`
  ADD PRIMARY KEY (`id_5c_tanker`),
  ADD KEY `id_safety_buque` (`id_safety_buque`),
  ADD KEY `id_5c_tanker_d` (`id_5c_tanker_d`);

--
-- Indices de la tabla `safety_list_5c_tanker_d`
--
ALTER TABLE `safety_list_5c_tanker_d`
  ADD PRIMARY KEY (`id_5c_tanker_d`);

--
-- Indices de la tabla `safety_list_6_details`
--
ALTER TABLE `safety_list_6_details`
  ADD PRIMARY KEY (`id_details_6`),
  ADD KEY `id_safety_buque` (`id_safety_buque`);

--
-- Indices de la tabla `safety_list_6_tanker`
--
ALTER TABLE `safety_list_6_tanker`
  ADD PRIMARY KEY (`id_6_tanker`),
  ADD KEY `id_safety_buque` (`id_safety_buque`),
  ADD KEY `id_6_tanker_d` (`id_6_tanker_d`);

--
-- Indices de la tabla `safety_list_6_tanker_d`
--
ALTER TABLE `safety_list_6_tanker_d`
  ADD PRIMARY KEY (`id_6_tanker_d`);

--
-- Indices de la tabla `safety_list_7a_general`
--
ALTER TABLE `safety_list_7a_general`
  ADD PRIMARY KEY (`id_7a_general`),
  ADD KEY `id_safety_buque` (`id_safety_buque`),
  ADD KEY `id_7a_general_d` (`id_7a_general_d`);

--
-- Indices de la tabla `safety_list_7a_general_d`
--
ALTER TABLE `safety_list_7a_general_d`
  ADD PRIMARY KEY (`id_7a_general_d`);

--
-- Indices de la tabla `safety_list_7b_tanker`
--
ALTER TABLE `safety_list_7b_tanker`
  ADD PRIMARY KEY (`id_7b_tanker`),
  ADD KEY `id_safety_buque` (`id_safety_buque`),
  ADD KEY `id_7b_tanker_d` (`id_7b_tanker_d`);

--
-- Indices de la tabla `safety_list_7b_tanker_d`
--
ALTER TABLE `safety_list_7b_tanker_d`
  ADD PRIMARY KEY (`id_7b_tanker_d`);

--
-- Indices de la tabla `safety_list_7c_tanker`
--
ALTER TABLE `safety_list_7c_tanker`
  ADD PRIMARY KEY (`id_7c_tanker`),
  ADD KEY `id_safety_buque` (`id_safety_buque`),
  ADD KEY `id_7c_tanker_d` (`id_7c_tanker_d`);

--
-- Indices de la tabla `safety_list_7c_tanker_d`
--
ALTER TABLE `safety_list_7c_tanker_d`
  ADD PRIMARY KEY (`id_7c_tanker_d`);

--
-- Indices de la tabla `safety_list_8_tanker`
--
ALTER TABLE `safety_list_8_tanker`
  ADD PRIMARY KEY (`id_8_tanker`),
  ADD KEY `id_safety_buque` (`id_safety_buque`),
  ADD KEY `id_8_tanker_d` (`id_8_tanker_d`);

--
-- Indices de la tabla `safety_list_8_tanker_d`
--
ALTER TABLE `safety_list_8_tanker_d`
  ADD PRIMARY KEY (`id_8_tanker_d`);

--
-- Indices de la tabla `safety_list_9_terminal`
--
ALTER TABLE `safety_list_9_terminal`
  ADD PRIMARY KEY (`id_9_terminal`),
  ADD KEY `id_safety_buque` (`id_safety_buque`),
  ADD KEY `id_9_terminal_d` (`id_9_terminal_d`);

--
-- Indices de la tabla `safety_list_9_terminal_d`
--
ALTER TABLE `safety_list_9_terminal_d`
  ADD PRIMARY KEY (`id_9_terminal_d`);

--
-- Indices de la tabla `safety_list_buque`
--
ALTER TABLE `safety_list_buque`
  ADD PRIMARY KEY (`id_safety_buque`),
  ADD KEY `id_term_buque` (`id_term_buque`);

--
-- Indices de la tabla `safety_list_check_part`
--
ALTER TABLE `safety_list_check_part`
  ADD PRIMARY KEY (`id_check_part`),
  ADD KEY `id_safety_buque` (`id_safety_buque`),
  ADD KEY `id_check_part_d` (`id_check_part_d`);

--
-- Indices de la tabla `safety_list_check_part_d`
--
ALTER TABLE `safety_list_check_part_d`
  ADD PRIMARY KEY (`id_check_part_d`);

--
-- Indices de la tabla `safety_list_firma`
--
ALTER TABLE `safety_list_firma`
  ADD PRIMARY KEY (`id_firma`),
  ADD KEY `id_safety_buque` (`id_safety_buque`);

--
-- Indices de la tabla `safety_list_ungrouped`
--
ALTER TABLE `safety_list_ungrouped`
  ADD PRIMARY KEY (`id_7c_ungrouped`),
  ADD KEY `id_safety_buque` (`id_safety_buque`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cont_trans_buque`
--
ALTER TABLE `cont_trans_buque`
  MODIFY `id_control_trans` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cont_trans_info`
--
ALTER TABLE `cont_trans_info`
  MODIFY `id_info` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cont_trans_regimen`
--
ALTER TABLE `cont_trans_regimen`
  MODIFY `id_regimen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `data_trans_buque`
--
ALTER TABLE `data_trans_buque`
  MODIFY `id_data_trans` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `data_trans_detalle`
--
ALTER TABLE `data_trans_detalle`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `data_trans_est_hechos`
--
ALTER TABLE `data_trans_est_hechos`
  MODIFY `id_est_hechos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `data_trans_info_buque`
--
ALTER TABLE `data_trans_info_buque`
  MODIFY `id_info_buque` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `data_trans_viaje`
--
ALTER TABLE `data_trans_viaje`
  MODIFY `id_viaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `est_hec_buque`
--
ALTER TABLE `est_hec_buque`
  MODIFY `num_operacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `est_hec_eventos`
--
ALTER TABLE `est_hec_eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `est_hec_nuevos_eventos`
--
ALTER TABLE `est_hec_nuevos_eventos`
  MODIFY `id_nuevo_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ins_pre_detalles`
--
ALTER TABLE `ins_pre_detalles`
  MODIFY `id_buque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `res_trans_buque`
--
ALTER TABLE `res_trans_buque`
  MODIFY `id_term_buque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `res_trans_car_remol`
--
ALTER TABLE `res_trans_car_remol`
  MODIFY `id_car` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `res_trans_reg_lineas`
--
ALTER TABLE `res_trans_reg_lineas`
  MODIFY `id_reg_linea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `res_trans_tipo_trans`
--
ALTER TABLE `res_trans_tipo_trans`
  MODIFY `id_tipo_trans` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `safety_list_1a_tanker`
--
ALTER TABLE `safety_list_1a_tanker`
  MODIFY `id_1a_tanker` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `safety_list_1a_tanker_d`
--
ALTER TABLE `safety_list_1a_tanker_d`
  MODIFY `id_1a_tanker_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `safety_list_1b_tanker`
--
ALTER TABLE `safety_list_1b_tanker`
  MODIFY `id_1b_tanker` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `safety_list_1b_tanker_d`
--
ALTER TABLE `safety_list_1b_tanker_d`
  MODIFY `id_1b_tanker_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `safety_list_2_terminal`
--
ALTER TABLE `safety_list_2_terminal`
  MODIFY `id_2_terminal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `safety_list_2_terminal_d`
--
ALTER TABLE `safety_list_2_terminal_d`
  MODIFY `id_2_terminal_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `safety_list_3_tanker`
--
ALTER TABLE `safety_list_3_tanker`
  MODIFY `id_3_tanker` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `safety_list_3_tanker_d`
--
ALTER TABLE `safety_list_3_tanker_d`
  MODIFY `id_3_tanker_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `safety_list_4_terminal`
--
ALTER TABLE `safety_list_4_terminal`
  MODIFY `id_4_terminal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `safety_list_4_terminal_d`
--
ALTER TABLE `safety_list_4_terminal_d`
  MODIFY `id_4_terminal_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `safety_list_5a_tanker_terminal`
--
ALTER TABLE `safety_list_5a_tanker_terminal`
  MODIFY `id_5a_tanker` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `safety_list_5a_tanker_terminal_d`
--
ALTER TABLE `safety_list_5a_tanker_terminal_d`
  MODIFY `id_5a_tanker_terminal_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `safety_list_5b_tanker`
--
ALTER TABLE `safety_list_5b_tanker`
  MODIFY `id_5b_tanker` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `safety_list_5b_tanker_d`
--
ALTER TABLE `safety_list_5b_tanker_d`
  MODIFY `id_5b_tanker_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `safety_list_5c_tanker`
--
ALTER TABLE `safety_list_5c_tanker`
  MODIFY `id_5c_tanker` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `safety_list_5c_tanker_d`
--
ALTER TABLE `safety_list_5c_tanker_d`
  MODIFY `id_5c_tanker_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `safety_list_6_details`
--
ALTER TABLE `safety_list_6_details`
  MODIFY `id_details_6` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `safety_list_6_tanker`
--
ALTER TABLE `safety_list_6_tanker`
  MODIFY `id_6_tanker` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `safety_list_6_tanker_d`
--
ALTER TABLE `safety_list_6_tanker_d`
  MODIFY `id_6_tanker_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `safety_list_7a_general`
--
ALTER TABLE `safety_list_7a_general`
  MODIFY `id_7a_general` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `safety_list_7a_general_d`
--
ALTER TABLE `safety_list_7a_general_d`
  MODIFY `id_7a_general_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `safety_list_7b_tanker`
--
ALTER TABLE `safety_list_7b_tanker`
  MODIFY `id_7b_tanker` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `safety_list_7b_tanker_d`
--
ALTER TABLE `safety_list_7b_tanker_d`
  MODIFY `id_7b_tanker_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `safety_list_7c_tanker`
--
ALTER TABLE `safety_list_7c_tanker`
  MODIFY `id_7c_tanker` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `safety_list_7c_tanker_d`
--
ALTER TABLE `safety_list_7c_tanker_d`
  MODIFY `id_7c_tanker_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `safety_list_8_tanker`
--
ALTER TABLE `safety_list_8_tanker`
  MODIFY `id_8_tanker` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `safety_list_8_tanker_d`
--
ALTER TABLE `safety_list_8_tanker_d`
  MODIFY `id_8_tanker_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `safety_list_9_terminal`
--
ALTER TABLE `safety_list_9_terminal`
  MODIFY `id_9_terminal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `safety_list_9_terminal_d`
--
ALTER TABLE `safety_list_9_terminal_d`
  MODIFY `id_9_terminal_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `safety_list_buque`
--
ALTER TABLE `safety_list_buque`
  MODIFY `id_safety_buque` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `safety_list_check_part`
--
ALTER TABLE `safety_list_check_part`
  MODIFY `id_check_part` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `safety_list_check_part_d`
--
ALTER TABLE `safety_list_check_part_d`
  MODIFY `id_check_part_d` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `safety_list_firma`
--
ALTER TABLE `safety_list_firma`
  MODIFY `id_firma` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `safety_list_ungrouped`
--
ALTER TABLE `safety_list_ungrouped`
  MODIFY `id_7c_ungrouped` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cont_trans_buque`
--
ALTER TABLE `cont_trans_buque`
  ADD CONSTRAINT `cont_trans_buque_ibfk_1` FOREIGN KEY (`num_operacion`) REFERENCES `est_hec_buque` (`num_operacion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `cont_trans_info`
--
ALTER TABLE `cont_trans_info`
  ADD CONSTRAINT `cont_trans_info_ibfk_1` FOREIGN KEY (`id_control_trans`) REFERENCES `cont_trans_buque` (`id_control_trans`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `cont_trans_regimen`
--
ALTER TABLE `cont_trans_regimen`
  ADD CONSTRAINT `cont_trans_regimen_ibfk_1` FOREIGN KEY (`id_control_trans`) REFERENCES `cont_trans_buque` (`id_control_trans`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `data_trans_buque`
--
ALTER TABLE `data_trans_buque`
  ADD CONSTRAINT `data_trans_buque_ibfk_1` FOREIGN KEY (`id_buque`) REFERENCES `ins_pre_detalles` (`id_buque`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `data_trans_detalle`
--
ALTER TABLE `data_trans_detalle`
  ADD CONSTRAINT `data_trans_detalle_ibfk_1` FOREIGN KEY (`id_data_trans`) REFERENCES `data_trans_buque` (`id_data_trans`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `data_trans_est_hechos`
--
ALTER TABLE `data_trans_est_hechos`
  ADD CONSTRAINT `data_trans_est_hechos_ibfk_1` FOREIGN KEY (`id_data_trans`) REFERENCES `data_trans_buque` (`id_data_trans`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `data_trans_info_buque`
--
ALTER TABLE `data_trans_info_buque`
  ADD CONSTRAINT `data_trans_info_buque_ibfk_1` FOREIGN KEY (`id_data_trans`) REFERENCES `data_trans_buque` (`id_data_trans`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `data_trans_viaje`
--
ALTER TABLE `data_trans_viaje`
  ADD CONSTRAINT `data_trans_viaje_ibfk_1` FOREIGN KEY (`id_data_trans`) REFERENCES `data_trans_buque` (`id_data_trans`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `est_hec_buque`
--
ALTER TABLE `est_hec_buque`
  ADD CONSTRAINT `id_buque_buque` FOREIGN KEY (`id_buque`) REFERENCES `ins_pre_detalles` (`id_buque`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `est_hec_embarque`
--
ALTER TABLE `est_hec_embarque`
  ADD CONSTRAINT `num_operacion_embarque` FOREIGN KEY (`num_operacion`) REFERENCES `est_hec_buque` (`num_operacion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `est_hec_info`
--
ALTER TABLE `est_hec_info`
  ADD CONSTRAINT `id_evento_info` FOREIGN KEY (`id_evento`) REFERENCES `est_hec_eventos` (`id_evento`) ON UPDATE CASCADE,
  ADD CONSTRAINT `num_operacion_info` FOREIGN KEY (`num_operacion`) REFERENCES `est_hec_buque` (`num_operacion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `est_hec_nuevos_eventos`
--
ALTER TABLE `est_hec_nuevos_eventos`
  ADD CONSTRAINT `est_hec_nuevos_eventos_ibfk_1` FOREIGN KEY (`num_operacion`) REFERENCES `est_hec_buque` (`num_operacion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ins_pre_firmas`
--
ALTER TABLE `ins_pre_firmas`
  ADD CONSTRAINT `id_buque_firmas` FOREIGN KEY (`id_buque`) REFERENCES `ins_pre_detalles` (`id_buque`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ins_pre_info`
--
ALTER TABLE `ins_pre_info`
  ADD CONSTRAINT `id_buque_info` FOREIGN KEY (`id_buque`) REFERENCES `ins_pre_detalles` (`id_buque`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `res_trans_buque`
--
ALTER TABLE `res_trans_buque`
  ADD CONSTRAINT `res_trans_buque_ibfk_1` FOREIGN KEY (`num_operacion`) REFERENCES `est_hec_buque` (`num_operacion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `res_trans_car_remol`
--
ALTER TABLE `res_trans_car_remol`
  ADD CONSTRAINT `res_trans_car_remol_ibfk_1` FOREIGN KEY (`id_term_buque`) REFERENCES `res_trans_buque` (`id_term_buque`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `res_trans_data_ungrouped`
--
ALTER TABLE `res_trans_data_ungrouped`
  ADD CONSTRAINT `res_trans_data_ungrouped_ibfk_1` FOREIGN KEY (`id_term_buque`) REFERENCES `res_trans_buque` (`id_term_buque`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `res_trans_info_amarre`
--
ALTER TABLE `res_trans_info_amarre`
  ADD CONSTRAINT `res_trans_info_amarre_ibfk_1` FOREIGN KEY (`id_term_buque`) REFERENCES `res_trans_buque` (`id_term_buque`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `res_trans_info_buque`
--
ALTER TABLE `res_trans_info_buque`
  ADD CONSTRAINT `res_trans_info_buque_ibfk_1` FOREIGN KEY (`id_term_buque`) REFERENCES `res_trans_buque` (`id_term_buque`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `res_trans_info_pers_guard`
--
ALTER TABLE `res_trans_info_pers_guard`
  ADD CONSTRAINT `res_trans_info_pers_guard_ibfk_1` FOREIGN KEY (`id_term_buque`) REFERENCES `res_trans_buque` (`id_term_buque`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `res_trans_lineas_amarre`
--
ALTER TABLE `res_trans_lineas_amarre`
  ADD CONSTRAINT `res_trans_lineas_amarre_ibfk_1` FOREIGN KEY (`id_term_buque`) REFERENCES `res_trans_buque` (`id_term_buque`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `res_trans_perf_nave`
--
ALTER TABLE `res_trans_perf_nave`
  ADD CONSTRAINT `res_trans_perf_nave_ibfk_1` FOREIGN KEY (`id_term_buque`) REFERENCES `res_trans_buque` (`id_term_buque`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `res_trans_perf_prac`
--
ALTER TABLE `res_trans_perf_prac`
  ADD CONSTRAINT `res_trans_perf_prac_ibfk_1` FOREIGN KEY (`id_term_buque`) REFERENCES `res_trans_buque` (`id_term_buque`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `res_trans_reg_lineas`
--
ALTER TABLE `res_trans_reg_lineas`
  ADD CONSTRAINT `res_trans_reg_lineas_ibfk_1` FOREIGN KEY (`id_term_buque`) REFERENCES `res_trans_buque` (`id_term_buque`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `res_trans_tipo_trans`
--
ALTER TABLE `res_trans_tipo_trans`
  ADD CONSTRAINT `res_trans_tipo_trans_ibfk_1` FOREIGN KEY (`id_term_buque`) REFERENCES `res_trans_buque` (`id_term_buque`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `safety_list_1a_tanker`
--
ALTER TABLE `safety_list_1a_tanker`
  ADD CONSTRAINT `safety_list_1a_tanker_ibfk_1` FOREIGN KEY (`id_safety_buque`) REFERENCES `safety_list_buque` (`id_safety_buque`) ON UPDATE CASCADE,
  ADD CONSTRAINT `safety_list_1a_tanker_ibfk_2` FOREIGN KEY (`id_1a_tanker_d`) REFERENCES `safety_list_1a_tanker_d` (`id_1a_tanker_d`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `safety_list_1b_tanker`
--
ALTER TABLE `safety_list_1b_tanker`
  ADD CONSTRAINT `safety_list_1b_tanker_ibfk_1` FOREIGN KEY (`id_safety_buque`) REFERENCES `safety_list_buque` (`id_safety_buque`) ON UPDATE CASCADE,
  ADD CONSTRAINT `safety_list_1b_tanker_ibfk_2` FOREIGN KEY (`id_1b_tanker_d`) REFERENCES `safety_list_1b_tanker_d` (`id_1b_tanker_d`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `safety_list_2_terminal`
--
ALTER TABLE `safety_list_2_terminal`
  ADD CONSTRAINT `safety_list_2_terminal_ibfk_1` FOREIGN KEY (`id_safety_buque`) REFERENCES `safety_list_buque` (`id_safety_buque`) ON UPDATE CASCADE,
  ADD CONSTRAINT `safety_list_2_terminal_ibfk_2` FOREIGN KEY (`id_2_terminal_d`) REFERENCES `safety_list_2_terminal_d` (`id_2_terminal_d`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `safety_list_3_tanker`
--
ALTER TABLE `safety_list_3_tanker`
  ADD CONSTRAINT `safety_list_3_tanker_ibfk_1` FOREIGN KEY (`id_safety_buque`) REFERENCES `safety_list_buque` (`id_safety_buque`) ON UPDATE CASCADE,
  ADD CONSTRAINT `safety_list_3_tanker_ibfk_2` FOREIGN KEY (`id_3_tanker_d`) REFERENCES `safety_list_3_tanker_d` (`id_3_tanker_d`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `safety_list_4_terminal`
--
ALTER TABLE `safety_list_4_terminal`
  ADD CONSTRAINT `safety_list_4_terminal_ibfk_1` FOREIGN KEY (`id_safety_buque`) REFERENCES `safety_list_buque` (`id_safety_buque`) ON UPDATE CASCADE,
  ADD CONSTRAINT `safety_list_4_terminal_ibfk_2` FOREIGN KEY (`id_4_terminal_d`) REFERENCES `safety_list_4_terminal_d` (`id_4_terminal_d`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `safety_list_5a_tanker_terminal`
--
ALTER TABLE `safety_list_5a_tanker_terminal`
  ADD CONSTRAINT `safety_list_5a_tanker_terminal_ibfk_1` FOREIGN KEY (`id_safety_buque`) REFERENCES `safety_list_buque` (`id_safety_buque`) ON UPDATE CASCADE,
  ADD CONSTRAINT `safety_list_5a_tanker_terminal_ibfk_2` FOREIGN KEY (`id_5a_tanker_terminal_d`) REFERENCES `safety_list_5a_tanker_terminal_d` (`id_5a_tanker_terminal_d`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `safety_list_5b_tanker`
--
ALTER TABLE `safety_list_5b_tanker`
  ADD CONSTRAINT `safety_list_5b_tanker_ibfk_1` FOREIGN KEY (`id_safety_buque`) REFERENCES `safety_list_buque` (`id_safety_buque`) ON UPDATE CASCADE,
  ADD CONSTRAINT `safety_list_5b_tanker_ibfk_2` FOREIGN KEY (`id_5b_tanker_d`) REFERENCES `safety_list_5b_tanker_d` (`id_5b_tanker_d`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `safety_list_5c_tanker`
--
ALTER TABLE `safety_list_5c_tanker`
  ADD CONSTRAINT `safety_list_5c_tanker_ibfk_1` FOREIGN KEY (`id_safety_buque`) REFERENCES `safety_list_buque` (`id_safety_buque`) ON UPDATE CASCADE,
  ADD CONSTRAINT `safety_list_5c_tanker_ibfk_2` FOREIGN KEY (`id_5c_tanker_d`) REFERENCES `safety_list_5c_tanker_d` (`id_5c_tanker_d`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `safety_list_6_details`
--
ALTER TABLE `safety_list_6_details`
  ADD CONSTRAINT `safety_list_6_details_ibfk_1` FOREIGN KEY (`id_safety_buque`) REFERENCES `safety_list_buque` (`id_safety_buque`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `safety_list_6_tanker`
--
ALTER TABLE `safety_list_6_tanker`
  ADD CONSTRAINT `safety_list_6_tanker_ibfk_1` FOREIGN KEY (`id_safety_buque`) REFERENCES `safety_list_buque` (`id_safety_buque`) ON UPDATE CASCADE,
  ADD CONSTRAINT `safety_list_6_tanker_ibfk_2` FOREIGN KEY (`id_6_tanker_d`) REFERENCES `safety_list_6_tanker_d` (`id_6_tanker_d`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `safety_list_7a_general`
--
ALTER TABLE `safety_list_7a_general`
  ADD CONSTRAINT `safety_list_7a_general_ibfk_1` FOREIGN KEY (`id_safety_buque`) REFERENCES `safety_list_buque` (`id_safety_buque`) ON UPDATE CASCADE,
  ADD CONSTRAINT `safety_list_7a_general_ibfk_2` FOREIGN KEY (`id_7a_general_d`) REFERENCES `safety_list_7a_general_d` (`id_7a_general_d`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `safety_list_7b_tanker`
--
ALTER TABLE `safety_list_7b_tanker`
  ADD CONSTRAINT `safety_list_7b_tanker_ibfk_1` FOREIGN KEY (`id_safety_buque`) REFERENCES `safety_list_buque` (`id_safety_buque`) ON UPDATE CASCADE,
  ADD CONSTRAINT `safety_list_7b_tanker_ibfk_2` FOREIGN KEY (`id_7b_tanker_d`) REFERENCES `safety_list_7b_tanker_d` (`id_7b_tanker_d`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `safety_list_7c_tanker`
--
ALTER TABLE `safety_list_7c_tanker`
  ADD CONSTRAINT `safety_list_7c_tanker_ibfk_1` FOREIGN KEY (`id_safety_buque`) REFERENCES `safety_list_buque` (`id_safety_buque`) ON UPDATE CASCADE,
  ADD CONSTRAINT `safety_list_7c_tanker_ibfk_2` FOREIGN KEY (`id_7c_tanker_d`) REFERENCES `safety_list_7c_tanker_d` (`id_7c_tanker_d`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `safety_list_8_tanker`
--
ALTER TABLE `safety_list_8_tanker`
  ADD CONSTRAINT `safety_list_8_tanker_ibfk_1` FOREIGN KEY (`id_safety_buque`) REFERENCES `safety_list_buque` (`id_safety_buque`) ON UPDATE CASCADE,
  ADD CONSTRAINT `safety_list_8_tanker_ibfk_2` FOREIGN KEY (`id_8_tanker_d`) REFERENCES `safety_list_8_tanker_d` (`id_8_tanker_d`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `safety_list_9_terminal`
--
ALTER TABLE `safety_list_9_terminal`
  ADD CONSTRAINT `safety_list_9_terminal_ibfk_1` FOREIGN KEY (`id_safety_buque`) REFERENCES `safety_list_buque` (`id_safety_buque`) ON UPDATE CASCADE,
  ADD CONSTRAINT `safety_list_9_terminal_ibfk_2` FOREIGN KEY (`id_9_terminal_d`) REFERENCES `safety_list_9_terminal_d` (`id_9_terminal_d`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `safety_list_buque`
--
ALTER TABLE `safety_list_buque`
  ADD CONSTRAINT `safety_list_buque_ibfk_1` FOREIGN KEY (`id_term_buque`) REFERENCES `res_trans_buque` (`id_term_buque`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `safety_list_check_part`
--
ALTER TABLE `safety_list_check_part`
  ADD CONSTRAINT `safety_list_check_part_ibfk_1` FOREIGN KEY (`id_safety_buque`) REFERENCES `safety_list_buque` (`id_safety_buque`) ON UPDATE CASCADE,
  ADD CONSTRAINT `safety_list_check_part_ibfk_2` FOREIGN KEY (`id_check_part_d`) REFERENCES `safety_list_check_part_d` (`id_check_part_d`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `safety_list_firma`
--
ALTER TABLE `safety_list_firma`
  ADD CONSTRAINT `safety_list_firma_ibfk_1` FOREIGN KEY (`id_safety_buque`) REFERENCES `safety_list_buque` (`id_safety_buque`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `safety_list_ungrouped`
--
ALTER TABLE `safety_list_ungrouped`
  ADD CONSTRAINT `safety_list_ungrouped_ibfk_1` FOREIGN KEY (`id_safety_buque`) REFERENCES `safety_list_buque` (`id_safety_buque`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
