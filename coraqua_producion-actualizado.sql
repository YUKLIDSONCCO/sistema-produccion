-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2025 a las 17:33:37
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
-- Base de datos: `coraqua_produccion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alimentacion_diaria`
--

CREATE TABLE `alimentacion_diaria` (
  `id` int(11) NOT NULL,
  `codigo_formato` varchar(20) DEFAULT 'CORAQUA BPA-7',
  `version` decimal(3,1) DEFAULT 2.0,
  `fecha_registro` date NOT NULL,
  `responsable` varchar(100) NOT NULL,
  `sede` varchar(100) NOT NULL,
  `up` varchar(50) NOT NULL,
  `lote` varchar(50) NOT NULL,
  `biomasa` decimal(10,2) DEFAULT 0.00,
  `tasa_alimentacion` decimal(5,2) DEFAULT 0.00,
  `alimento_suministrado` decimal(10,2) DEFAULT 0.00,
  `calibre` varchar(50) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `id_lote` int(11) DEFAULT NULL,
  `id_especie` int(11) DEFAULT NULL,
  `id_sede` int(11) DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  `actualizado_en` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id_auditoria` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `accion` varchar(255) NOT NULL,
  `tabla_afectada` varchar(100) DEFAULT NULL,
  `registro_afectado` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `backups`
--

CREATE TABLE `backups` (
  `id_backup` int(11) NOT NULL,
  `archivo` varchar(255) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_alimento_almacen`
--

CREATE TABLE `control_alimento_almacen` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `sede` varchar(100) NOT NULL,
  `encargado` varchar(100) NOT NULL,
  `mes` varchar(20) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `calibre` varchar(50) DEFAULT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `nombre_alimento` varchar(150) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_sede` int(11) DEFAULT NULL,
  `id_lote` int(11) DEFAULT NULL,
  `id_especie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_diario_parametros_ovas`
--

CREATE TABLE `control_diario_parametros_ovas` (
  `id` int(11) NOT NULL,
  `codigo_formato` varchar(50) DEFAULT 'CORAQUA-BPA-12',
  `version` varchar(10) DEFAULT '2.0',
  `fecha_registro` date NOT NULL,
  `mes` varchar(20) DEFAULT NULL,
  `sede` varchar(100) DEFAULT NULL,
  `dia` int(11) NOT NULL,
  `t_0630` decimal(5,2) DEFAULT NULL,
  `o2_0630` decimal(5,2) DEFAULT NULL,
  `sat_0630` decimal(5,2) DEFAULT NULL,
  `ph_0630` decimal(4,2) DEFAULT NULL,
  `t_1200` decimal(5,2) DEFAULT NULL,
  `o2_1200` decimal(5,2) DEFAULT NULL,
  `sat_1200` decimal(5,2) DEFAULT NULL,
  `ph_1200` decimal(4,2) DEFAULT NULL,
  `t_1530` decimal(5,2) DEFAULT NULL,
  `o2_1530` decimal(5,2) DEFAULT NULL,
  `sat_1530` decimal(5,2) DEFAULT NULL,
  `ph_1530` decimal(4,2) DEFAULT NULL,
  `responsable` varchar(100) DEFAULT NULL,
  `observacion` text DEFAULT NULL,
  `id_sede` int(11) DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_dosificacion`
--

CREATE TABLE `control_dosificacion` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `medicamento_suplemento` varchar(150) NOT NULL,
  `dosis_gr` decimal(10,2) NOT NULL,
  `dias_tratamiento` int(11) NOT NULL,
  `lote_alevines` varchar(100) DEFAULT NULL,
  `sala` varchar(100) DEFAULT NULL,
  `responsable` varchar(100) NOT NULL,
  `registro_diario` text DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_lote` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_medicamento`
--

CREATE TABLE `control_medicamento` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `sede` varchar(100) NOT NULL,
  `encargado` varchar(100) NOT NULL,
  `mes` varchar(20) NOT NULL,
  `medicamento_suplemento` varchar(150) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `nombre_empleado` varchar(100) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_sede` int(11) DEFAULT NULL,
  `id_lote` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_parametros`
--

CREATE TABLE `control_parametros` (
  `id` int(11) NOT NULL,
  `codigo_formato` varchar(20) DEFAULT 'CORAQUA BPA-12',
  `version` decimal(3,1) DEFAULT 2.0,
  `fecha_registro` date NOT NULL,
  `mes` varchar(20) NOT NULL,
  `sede` varchar(100) NOT NULL,
  `responsable` varchar(100) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  `actualizado_en` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_sal_almacen`
--

CREATE TABLE `control_sal_almacen` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `sede` varchar(100) NOT NULL,
  `encargado` varchar(100) NOT NULL,
  `mes` varchar(20) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `nombre_sal` varchar(150) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_sede` int(11) DEFAULT NULL,
  `id_lote` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_control_parametros`
--

CREATE TABLE `detalle_control_parametros` (
  `id` int(11) NOT NULL,
  `id_control` int(11) NOT NULL,
  `dia` int(11) NOT NULL CHECK (`dia` between 1 and 31),
  `temp_6_30` decimal(5,2) DEFAULT NULL,
  `o2_6_30` decimal(5,2) DEFAULT NULL,
  `sat_6_30` decimal(5,2) DEFAULT NULL,
  `ph_6_30` decimal(5,2) DEFAULT NULL,
  `temp_12_00` decimal(5,2) DEFAULT NULL,
  `o2_12_00` decimal(5,2) DEFAULT NULL,
  `sat_12_00` decimal(5,2) DEFAULT NULL,
  `ph_12_00` decimal(5,2) DEFAULT NULL,
  `temp_3_30` decimal(5,2) DEFAULT NULL,
  `o2_3_30` decimal(5,2) DEFAULT NULL,
  `sat_3_30` decimal(5,2) DEFAULT NULL,
  `ph_3_30` decimal(5,2) DEFAULT NULL,
  `temp_prom` decimal(5,2) DEFAULT NULL,
  `o2_prom` decimal(5,2) DEFAULT NULL,
  `sat_prom` decimal(5,2) DEFAULT NULL,
  `ph_prom` decimal(5,2) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_muestreo`
--

CREATE TABLE `detalle_muestreo` (
  `id` int(11) NOT NULL,
  `id_muestreo` int(11) NOT NULL,
  `numero_muestra` int(11) NOT NULL,
  `peso` decimal(10,2) DEFAULT 0.00,
  `longitud` decimal(10,2) DEFAULT 0.00,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especies`
--

CREATE TABLE `especies` (
  `id_especie` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `nombre_comun` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `firmas_alimentacion_diaria`
--

CREATE TABLE `firmas_alimentacion_diaria` (
  `id` int(11) NOT NULL,
  `id_alimentacion` int(11) NOT NULL,
  `responsable_area` varchar(100) DEFAULT NULL,
  `jefe_planta` varchar(100) DEFAULT NULL,
  `jefe_produccion` varchar(100) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `firmas_control_parametros`
--

CREATE TABLE `firmas_control_parametros` (
  `id` int(11) NOT NULL,
  `id_control` int(11) NOT NULL,
  `responsable_area` varchar(100) DEFAULT NULL,
  `jefe_planta` varchar(100) DEFAULT NULL,
  `jefe_produccion` varchar(100) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `firmas_mortalidad_alevines`
--

CREATE TABLE `firmas_mortalidad_alevines` (
  `id` int(11) NOT NULL,
  `id_mortalidad` int(11) NOT NULL,
  `responsable_area` varchar(100) DEFAULT NULL,
  `jefe_planta` varchar(100) DEFAULT NULL,
  `jefe_produccion` varchar(100) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `firmas_muestreo`
--

CREATE TABLE `firmas_muestreo` (
  `id` int(11) NOT NULL,
  `id_muestreo` int(11) NOT NULL,
  `responsable_area` varchar(100) DEFAULT NULL,
  `jefe_planta` varchar(100) DEFAULT NULL,
  `jefe_produccion` varchar(100) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formularios`
--

CREATE TABLE `formularios` (
  `id_formulario` int(11) NOT NULL,
  `tipo` enum('produccion','incidencia','insumo') NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `datos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`datos`)),
  `fecha_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('pendiente','revisado','aprobado') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `id_insumo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `stock_actual` int(11) NOT NULL,
  `stock_minimo` int(11) DEFAULT 0,
  `unidad` varchar(20) DEFAULT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

CREATE TABLE `lotes` (
  `id_lote` int(11) NOT NULL,
  `codigo_lote` varchar(100) NOT NULL,
  `id_especie` int(11) DEFAULT NULL,
  `id_sede` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_termino` date DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` enum('activo','cerrado','transferido') DEFAULT 'activo',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mortalidad_alevines`
--

CREATE TABLE `mortalidad_alevines` (
  `id` int(11) NOT NULL,
  `codigo_formato` varchar(20) DEFAULT 'CORAQUA BPA-6',
  `version` decimal(3,1) DEFAULT 2.0,
  `fecha_registro` date NOT NULL,
  `responsable` varchar(100) NOT NULL,
  `sede` varchar(100) NOT NULL,
  `up` varchar(50) NOT NULL,
  `lote` varchar(50) NOT NULL,
  `mortalidad` int(11) DEFAULT 0,
  `morbilidad` int(11) DEFAULT 0,
  `total` int(11) GENERATED ALWAYS AS (`mortalidad` + `morbilidad`) STORED,
  `observaciones` text DEFAULT NULL,
  `id_lote` int(11) DEFAULT NULL,
  `id_especie` int(11) DEFAULT NULL,
  `id_sede` int(11) DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  `actualizado_en` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mortalidad_diaria_larvas`
--

CREATE TABLE `mortalidad_diaria_larvas` (
  `id` int(11) NOT NULL,
  `codigo_formato` varchar(50) DEFAULT 'CORAQUA-BPA-05',
  `version` varchar(10) DEFAULT '2.0',
  `fecha_registro` date NOT NULL,
  `encargado` varchar(100) DEFAULT NULL,
  `cantidad_siembra` int(11) DEFAULT NULL,
  `lote` varchar(50) DEFAULT NULL,
  `sede` varchar(100) DEFAULT NULL,
  `id_lote` int(11) DEFAULT NULL,
  `id_sede` int(11) DEFAULT NULL,
  `id_especie` int(11) DEFAULT NULL,
  `c1_lm` int(11) DEFAULT 0,
  `c1_ld` int(11) DEFAULT 0,
  `c2_lm` int(11) DEFAULT 0,
  `c2_ld` int(11) DEFAULT 0,
  `c3_lm` int(11) DEFAULT 0,
  `c3_ld` int(11) DEFAULT 0,
  `c4_lm` int(11) DEFAULT 0,
  `c4_ld` int(11) DEFAULT 0,
  `c5_lm` int(11) DEFAULT 0,
  `c5_ld` int(11) DEFAULT 0,
  `c6_lm` int(11) DEFAULT 0,
  `c6_ld` int(11) DEFAULT 0,
  `c7_lm` int(11) DEFAULT 0,
  `c7_ld` int(11) DEFAULT 0,
  `total` int(11) GENERATED ALWAYS AS (`c1_lm` + `c2_lm` + `c3_lm` + `c4_lm` + `c5_lm` + `c6_lm` + `c7_lm` + `c1_ld` + `c2_ld` + `c3_ld` + `c4_ld` + `c5_ld` + `c6_ld` + `c7_ld`) STORED,
  `observacion` text DEFAULT NULL,
  `responsable_area` varchar(100) DEFAULT NULL,
  `jefe_planta` varchar(100) DEFAULT NULL,
  `jefe_produccion` varchar(100) DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mortalidad_diaria_ovas`
--

CREATE TABLE `mortalidad_diaria_ovas` (
  `id` int(11) NOT NULL,
  `codigo_formato` varchar(50) DEFAULT 'CORAQUA-BPA-04',
  `version` varchar(10) DEFAULT '2.0',
  `fecha_registro` date NOT NULL,
  `encargado` varchar(100) DEFAULT NULL,
  `cantidad_siembra` int(11) DEFAULT NULL,
  `lote` varchar(50) DEFAULT NULL,
  `sede` varchar(100) DEFAULT NULL,
  `id_lote` int(11) DEFAULT NULL,
  `id_sede` int(11) DEFAULT NULL,
  `id_especie` int(11) DEFAULT NULL,
  `fecha_control` date NOT NULL,
  `bateria` varchar(50) DEFAULT NULL,
  `batea` varchar(50) DEFAULT NULL,
  `c1` int(11) DEFAULT 0,
  `c2` int(11) DEFAULT 0,
  `c3` int(11) DEFAULT 0,
  `c4` int(11) DEFAULT 0,
  `c5` int(11) DEFAULT 0,
  `c6` int(11) DEFAULT 0,
  `c7` int(11) DEFAULT 0,
  `total` int(11) GENERATED ALWAYS AS (`c1` + `c2` + `c3` + `c4` + `c5` + `c6` + `c7`) STORED,
  `observacion` text DEFAULT NULL,
  `responsable_area` varchar(100) DEFAULT NULL,
  `jefe_planta` varchar(100) DEFAULT NULL,
  `jefe_produccion` varchar(100) DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muestreo`
--

CREATE TABLE `muestreo` (
  `id` int(11) NOT NULL,
  `codigo_formato` varchar(20) DEFAULT 'CORAQUA BPA-10',
  `version` decimal(3,1) DEFAULT 2.0,
  `fecha_registro` date NOT NULL,
  `encargado` varchar(100) NOT NULL,
  `sede` varchar(100) NOT NULL,
  `fecha_muestreo` date NOT NULL,
  `hora_muestreo` time NOT NULL,
  `up` varchar(50) NOT NULL,
  `lote` varchar(50) NOT NULL,
  `peso_promedio` decimal(10,2) DEFAULT 0.00,
  `coeficiente_variacion` decimal(10,2) DEFAULT 0.00,
  `factor_k` decimal(10,2) DEFAULT 0.00,
  `observaciones` text DEFAULT NULL,
  `id_lote` int(11) DEFAULT NULL,
  `id_especie` int(11) DEFAULT NULL,
  `id_sede` int(11) DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  `actualizado_en` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificacion` int(11) NOT NULL,
  `tipo` enum('alerta','recordatorio') NOT NULL,
  `mensaje` varchar(255) NOT NULL,
  `leido` tinyint(1) DEFAULT 0,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produccion`
--

CREATE TABLE `produccion` (
  `id_produccion` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `etapa` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre`, `descripcion`, `fecha_creacion`) VALUES
(1, 'Administrador', 'Gestión global del sistema y seguridad', '2025-09-25 14:19:10'),
(2, 'JefePlanta', 'Control general de producción y gestión de personal', '2025-09-25 14:19:10'),
(3, 'Supervisor', 'Seguimiento operativo y control de insumos', '2025-09-25 14:19:10'),
(4, 'Colaborador', 'Registro de datos y ejecución de tareas operativas', '2025-09-25 14:19:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `id_sede` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `contacto` varchar(150) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seleccion_fertilizacion_ovas`
--

CREATE TABLE `seleccion_fertilizacion_ovas` (
  `id` int(11) NOT NULL,
  `codigo_formato` varchar(50) DEFAULT 'CORAQUA BPA-02',
  `version` varchar(10) DEFAULT '2.0',
  `fecha_registro` date NOT NULL,
  `ambito_aplicacion` varchar(100) DEFAULT 'PECES REPRODUCTORES',
  `responsable` varchar(100) DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_final` time DEFAULT NULL,
  `cantidad_hembras_aptas` int(11) DEFAULT NULL,
  `cantidad_machos_aptos` int(11) DEFAULT NULL,
  `cantidad_hembras_desovadas` int(11) DEFAULT NULL,
  `cantidad_machos_desovados` int(11) DEFAULT NULL,
  `relacion_hembras_machos` varchar(50) DEFAULT NULL,
  `volumen_ovulos_fertilizados` decimal(10,2) DEFAULT NULL,
  `cantidad_ovas_fertiles` int(11) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `id_lote` int(11) DEFAULT NULL,
  `id_especie` int(11) DEFAULT NULL,
  `id_sede` int(11) DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `estado` enum('activo','suspendido') DEFAULT 'activo',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `password`, `id_rol`, `estado`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'Super Administrador', 'admin@coraqua.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 'activo', '2025-09-25 14:19:11', '2025-09-25 14:19:11'),
(2, 'Jefe Planta', 'jefeplanta@coraqua.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, 'activo', '2025-09-25 14:19:11', '2025-10-15 02:12:58'),
(3, 'Supervisor 1', 'supervisor1@coraqua.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, 'suspendido', '2025-09-25 14:19:11', '2025-10-06 06:14:13'),
(4, 'Colaborador 1', 'colaborador1@coraqua.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4, 'activo', '2025-09-25 14:19:11', '2025-09-25 14:19:11'),
(5, 'pedro', 'pedro@coraqua.com', '$2y$10$lGUk9URq.KmDByO5G2fhheIB7eSW4QjTwFP1APlz2C3E3iEQgOdKy', 3, 'activo', '2025-10-06 05:13:11', '2025-10-06 06:14:16'),
(6, 'Café Americano', 'cafe@coraqua.com', '$2y$10$buJa3HAqMLEayp7aNKkCGOIOj5L3pOCwmjICjWuw5ox684dtrRKy2', 3, 'activo', '2025-10-06 05:23:57', '2025-10-06 05:26:23'),
(7, 'Niko', 'jefeplanta2@coraqua.com', '$2y$10$6MnjpvcUMEK40Js04enG7uZVk9LNCO.C7GupnWaF7SJu2kohRFRwW', 2, 'suspendido', '2025-10-06 05:33:12', '2025-10-06 05:33:12'),
(8, 'Nikopico', 'jefeplanta23@coraqua.com', '$2y$10$/G6Lt1YdWatx..eMqKuxcOcUS.wh1UQVt1HjWQA/hBULsxCbivtga', 3, 'suspendido', '2025-10-06 05:38:55', '2025-10-06 05:38:55'),
(9, 'pedro', 'jefeplanta14@coraqua.com', '$2y$10$n8mHjMi01gf.EwbwEWaJpO9OaF2uOVZ0tHHcGmnAVEEeLt3VRbZc.', 2, 'suspendido', '2025-10-06 05:42:36', '2025-10-06 05:42:36'),
(10, 'Chsmo', 'chamo@coraqua.com', '$2y$10$jcapVWSiLb8JA/XrFpd8OuwlQyQBraKrWSDaZX8esuu.WM.QObw2K', 3, 'suspendido', '2025-10-06 05:43:12', '2025-10-06 05:43:12'),
(11, 'Chsmo', 'cafela@coraqua.com', '$2y$10$3ZQO1F5bHbWFq0jzH96Q2eiodKwwT94KzEVhU8Q3TVBWVfKctFQOy', 3, 'suspendido', '2025-10-06 05:46:54', '2025-10-06 05:46:54'),
(12, 'Fffr', 'admi21n@coraqua.com', '$2y$10$Z/oISbVdXEH6LZ36H7uNA.O1f98gdAAyKDdtA1ZhwdVgzxwLk.WBK', 3, 'suspendido', '2025-10-06 05:47:40', '2025-10-06 05:47:40'),
(13, 'Csmilo', '23jefeplanta@coraqua.com', '$2y$10$fLtcuzbxtkM9Jq/aEwr4Be1NjswWjxZxEQrU56wGbwrbGSiy5EUe6', 3, 'suspendido', '2025-10-06 05:54:04', '2025-10-06 05:54:04'),
(14, 'Chsmooo', 'jtttefeplanta@coraqua.com', '$2y$10$S0Bipq7Iesm4.d/tyy5jjuWm1/BNZf6Fw076VctNdefsreaIXBrIG', 3, 'suspendido', '2025-10-06 05:54:20', '2025-10-06 05:54:20'),
(15, 'Jajakaa', 'j4efeplanta@coraqua.com', '$2y$10$.HPRFJAMHkuZCdCzgUVSVuexU4y0KNGV3XTPtHv2.peYhnabAeEFe', 4, 'suspendido', '2025-10-06 05:56:33', '2025-10-06 05:56:33'),
(16, 'Fffr', 'jtefeplanta@coraqua.com', '$2y$10$t60PSziIvR/CELNSQX2zluCPmd8i59nfKSHgk6clEyPtw7ynDvcK.', 3, 'suspendido', '2025-10-06 06:02:00', '2025-10-06 06:02:00'),
(17, 'Camaron', 'ajaa@coraqua.com', '$2y$10$PLAwTWMbmN3QdxpCIiF4P.UApHI47l3cGpQMWi7UkXbffpq/ILkAC', 3, 'suspendido', '2025-10-06 06:03:56', '2025-10-06 06:03:56'),
(18, 'Nikopico4666', 'jetttfeplanta@coraqua.com', '$2y$10$eujY44s7lGWDxtrQ9ACKauIfVtilfT4nIelpLcxPLD1BtiDPVfW8u', 3, 'suspendido', '2025-10-06 06:07:45', '2025-10-06 06:07:45'),
(19, 'Ghhgkhk', 'ffmfkffk@gmail.con', '$2y$10$CbTrg5RyITwsC0jeUPqQnuxhxyMT1cy4MCjzSZib5jT6KJNDI.m86', 4, 'suspendido', '2025-10-06 06:08:11', '2025-10-06 06:14:06');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alimentacion_diaria`
--
ALTER TABLE `alimentacion_diaria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lote` (`id_lote`),
  ADD KEY `id_especie` (`id_especie`),
  ADD KEY `id_sede` (`id_sede`),
  ADD KEY `idx_alimentacion_fecha` (`fecha_registro`);

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id_auditoria`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `backups`
--
ALTER TABLE `backups`
  ADD PRIMARY KEY (`id_backup`);

--
-- Indices de la tabla `control_alimento_almacen`
--
ALTER TABLE `control_alimento_almacen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sede` (`id_sede`),
  ADD KEY `id_lote` (`id_lote`),
  ADD KEY `nombre_alimento` (`nombre_alimento`),
  ADD KEY `calm_fk_especie` (`id_especie`);

--
-- Indices de la tabla `control_diario_parametros_ovas`
--
ALTER TABLE `control_diario_parametros_ovas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sede` (`id_sede`),
  ADD KEY `idx_control_param_ovas_fecha` (`fecha_registro`);

--
-- Indices de la tabla `control_dosificacion`
--
ALTER TABLE `control_dosificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lote` (`id_lote`);

--
-- Indices de la tabla `control_medicamento`
--
ALTER TABLE `control_medicamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sede` (`id_sede`),
  ADD KEY `id_lote` (`id_lote`),
  ADD KEY `medicamento_suplemento` (`medicamento_suplemento`);

--
-- Indices de la tabla `control_parametros`
--
ALTER TABLE `control_parametros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `control_sal_almacen`
--
ALTER TABLE `control_sal_almacen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sede` (`id_sede`),
  ADD KEY `id_lote` (`id_lote`),
  ADD KEY `nombre_sal` (`nombre_sal`);

--
-- Indices de la tabla `detalle_control_parametros`
--
ALTER TABLE `detalle_control_parametros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_ctrl_fk` (`id_control`);

--
-- Indices de la tabla `detalle_muestreo`
--
ALTER TABLE `detalle_muestreo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_muestreo_fk` (`id_muestreo`);

--
-- Indices de la tabla `especies`
--
ALTER TABLE `especies`
  ADD PRIMARY KEY (`id_especie`);

--
-- Indices de la tabla `firmas_alimentacion_diaria`
--
ALTER TABLE `firmas_alimentacion_diaria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `firmas_alimentacion_fk` (`id_alimentacion`);

--
-- Indices de la tabla `firmas_control_parametros`
--
ALTER TABLE `firmas_control_parametros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `firmas_ctrl_fk` (`id_control`);

--
-- Indices de la tabla `firmas_mortalidad_alevines`
--
ALTER TABLE `firmas_mortalidad_alevines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `firmas_mortalidad_alevines_fk` (`id_mortalidad`);

--
-- Indices de la tabla `firmas_muestreo`
--
ALTER TABLE `firmas_muestreo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `firmas_muestreo_fk` (`id_muestreo`);

--
-- Indices de la tabla `formularios`
--
ALTER TABLE `formularios`
  ADD PRIMARY KEY (`id_formulario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id_insumo`);

--
-- Indices de la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`id_lote`),
  ADD KEY `codigo_lote` (`codigo_lote`),
  ADD KEY `id_especie` (`id_especie`),
  ADD KEY `id_sede` (`id_sede`);

--
-- Indices de la tabla `mortalidad_alevines`
--
ALTER TABLE `mortalidad_alevines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lote` (`id_lote`),
  ADD KEY `id_especie` (`id_especie`),
  ADD KEY `id_sede` (`id_sede`),
  ADD KEY `idx_mortalidad_alevines_fecha` (`fecha_registro`);

--
-- Indices de la tabla `mortalidad_diaria_larvas`
--
ALTER TABLE `mortalidad_diaria_larvas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lote` (`id_lote`),
  ADD KEY `id_sede` (`id_sede`),
  ADD KEY `id_especie` (`id_especie`);

--
-- Indices de la tabla `mortalidad_diaria_ovas`
--
ALTER TABLE `mortalidad_diaria_ovas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lote` (`id_lote`),
  ADD KEY `id_sede` (`id_sede`),
  ADD KEY `id_especie` (`id_especie`),
  ADD KEY `idx_mortalidad_ovas_fecha` (`fecha_registro`);

--
-- Indices de la tabla `muestreo`
--
ALTER TABLE `muestreo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lote` (`id_lote`),
  ADD KEY `id_especie` (`id_especie`),
  ADD KEY `id_sede` (`id_sede`),
  ADD KEY `idx_muestreo_fecha` (`fecha_registro`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_notificacion`);

--
-- Indices de la tabla `produccion`
--
ALTER TABLE `produccion`
  ADD PRIMARY KEY (`id_produccion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id_sede`);

--
-- Indices de la tabla `seleccion_fertilizacion_ovas`
--
ALTER TABLE `seleccion_fertilizacion_ovas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lote` (`id_lote`),
  ADD KEY `id_especie` (`id_especie`),
  ADD KEY `id_sede` (`id_sede`),
  ADD KEY `idx_sel_ovas_fecha` (`fecha_registro`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alimentacion_diaria`
--
ALTER TABLE `alimentacion_diaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id_auditoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `backups`
--
ALTER TABLE `backups`
  MODIFY `id_backup` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `control_alimento_almacen`
--
ALTER TABLE `control_alimento_almacen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `control_diario_parametros_ovas`
--
ALTER TABLE `control_diario_parametros_ovas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `control_dosificacion`
--
ALTER TABLE `control_dosificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `control_medicamento`
--
ALTER TABLE `control_medicamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `control_parametros`
--
ALTER TABLE `control_parametros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `control_sal_almacen`
--
ALTER TABLE `control_sal_almacen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_control_parametros`
--
ALTER TABLE `detalle_control_parametros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_muestreo`
--
ALTER TABLE `detalle_muestreo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `especies`
--
ALTER TABLE `especies`
  MODIFY `id_especie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `firmas_alimentacion_diaria`
--
ALTER TABLE `firmas_alimentacion_diaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `firmas_control_parametros`
--
ALTER TABLE `firmas_control_parametros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `firmas_mortalidad_alevines`
--
ALTER TABLE `firmas_mortalidad_alevines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `firmas_muestreo`
--
ALTER TABLE `firmas_muestreo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formularios`
--
ALTER TABLE `formularios`
  MODIFY `id_formulario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id_insumo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lotes`
--
ALTER TABLE `lotes`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mortalidad_alevines`
--
ALTER TABLE `mortalidad_alevines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mortalidad_diaria_larvas`
--
ALTER TABLE `mortalidad_diaria_larvas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mortalidad_diaria_ovas`
--
ALTER TABLE `mortalidad_diaria_ovas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `muestreo`
--
ALTER TABLE `muestreo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `produccion`
--
ALTER TABLE `produccion`
  MODIFY `id_produccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `id_sede` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seleccion_fertilizacion_ovas`
--
ALTER TABLE `seleccion_fertilizacion_ovas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alimentacion_diaria`
--
ALTER TABLE `alimentacion_diaria`
  ADD CONSTRAINT `alimentacion_fk_especie` FOREIGN KEY (`id_especie`) REFERENCES `especies` (`id_especie`),
  ADD CONSTRAINT `alimentacion_fk_lote` FOREIGN KEY (`id_lote`) REFERENCES `lotes` (`id_lote`),
  ADD CONSTRAINT `alimentacion_fk_sede` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id_sede`);

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `auditoria_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `control_alimento_almacen`
--
ALTER TABLE `control_alimento_almacen`
  ADD CONSTRAINT `calm_fk_especie` FOREIGN KEY (`id_especie`) REFERENCES `especies` (`id_especie`),
  ADD CONSTRAINT `calm_fk_lote` FOREIGN KEY (`id_lote`) REFERENCES `lotes` (`id_lote`),
  ADD CONSTRAINT `calm_fk_sede` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id_sede`);

--
-- Filtros para la tabla `control_diario_parametros_ovas`
--
ALTER TABLE `control_diario_parametros_ovas`
  ADD CONSTRAINT `ctrl_param_ovas_fk_sede` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id_sede`);

--
-- Filtros para la tabla `control_dosificacion`
--
ALTER TABLE `control_dosificacion`
  ADD CONSTRAINT `cd_fk_lote` FOREIGN KEY (`id_lote`) REFERENCES `lotes` (`id_lote`);

--
-- Filtros para la tabla `control_medicamento`
--
ALTER TABLE `control_medicamento`
  ADD CONSTRAINT `cm_fk_lote` FOREIGN KEY (`id_lote`) REFERENCES `lotes` (`id_lote`),
  ADD CONSTRAINT `cm_fk_sede` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id_sede`);

--
-- Filtros para la tabla `control_sal_almacen`
--
ALTER TABLE `control_sal_almacen`
  ADD CONSTRAINT `csa_fk_lote` FOREIGN KEY (`id_lote`) REFERENCES `lotes` (`id_lote`),
  ADD CONSTRAINT `csa_fk_sede` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id_sede`);

--
-- Filtros para la tabla `detalle_control_parametros`
--
ALTER TABLE `detalle_control_parametros`
  ADD CONSTRAINT `detalle_ctrl_fk` FOREIGN KEY (`id_control`) REFERENCES `control_parametros` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_muestreo`
--
ALTER TABLE `detalle_muestreo`
  ADD CONSTRAINT `detalle_muestreo_fk` FOREIGN KEY (`id_muestreo`) REFERENCES `muestreo` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `firmas_alimentacion_diaria`
--
ALTER TABLE `firmas_alimentacion_diaria`
  ADD CONSTRAINT `firmas_alimentacion_fk` FOREIGN KEY (`id_alimentacion`) REFERENCES `alimentacion_diaria` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `firmas_control_parametros`
--
ALTER TABLE `firmas_control_parametros`
  ADD CONSTRAINT `firmas_ctrl_fk` FOREIGN KEY (`id_control`) REFERENCES `control_parametros` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `firmas_mortalidad_alevines`
--
ALTER TABLE `firmas_mortalidad_alevines`
  ADD CONSTRAINT `firmas_mortalidad_alevines_fk` FOREIGN KEY (`id_mortalidad`) REFERENCES `mortalidad_alevines` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `firmas_muestreo`
--
ALTER TABLE `firmas_muestreo`
  ADD CONSTRAINT `firmas_muestreo_fk` FOREIGN KEY (`id_muestreo`) REFERENCES `muestreo` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `formularios`
--
ALTER TABLE `formularios`
  ADD CONSTRAINT `formularios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD CONSTRAINT `lotes_fk_especie` FOREIGN KEY (`id_especie`) REFERENCES `especies` (`id_especie`),
  ADD CONSTRAINT `lotes_fk_sede` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id_sede`);

--
-- Filtros para la tabla `mortalidad_alevines`
--
ALTER TABLE `mortalidad_alevines`
  ADD CONSTRAINT `mortalidad_alevines_fk_especie` FOREIGN KEY (`id_especie`) REFERENCES `especies` (`id_especie`),
  ADD CONSTRAINT `mortalidad_alevines_fk_lote` FOREIGN KEY (`id_lote`) REFERENCES `lotes` (`id_lote`),
  ADD CONSTRAINT `mortalidad_alevines_fk_sede` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id_sede`);

--
-- Filtros para la tabla `mortalidad_diaria_larvas`
--
ALTER TABLE `mortalidad_diaria_larvas`
  ADD CONSTRAINT `mortalidad_larvas_fk_especie` FOREIGN KEY (`id_especie`) REFERENCES `especies` (`id_especie`),
  ADD CONSTRAINT `mortalidad_larvas_fk_lote` FOREIGN KEY (`id_lote`) REFERENCES `lotes` (`id_lote`),
  ADD CONSTRAINT `mortalidad_larvas_fk_sede` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id_sede`);

--
-- Filtros para la tabla `mortalidad_diaria_ovas`
--
ALTER TABLE `mortalidad_diaria_ovas`
  ADD CONSTRAINT `mortalidad_ovas_fk_especie` FOREIGN KEY (`id_especie`) REFERENCES `especies` (`id_especie`),
  ADD CONSTRAINT `mortalidad_ovas_fk_lote` FOREIGN KEY (`id_lote`) REFERENCES `lotes` (`id_lote`),
  ADD CONSTRAINT `mortalidad_ovas_fk_sede` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id_sede`);

--
-- Filtros para la tabla `muestreo`
--
ALTER TABLE `muestreo`
  ADD CONSTRAINT `muestreo_fk_especie` FOREIGN KEY (`id_especie`) REFERENCES `especies` (`id_especie`),
  ADD CONSTRAINT `muestreo_fk_lote` FOREIGN KEY (`id_lote`) REFERENCES `lotes` (`id_lote`),
  ADD CONSTRAINT `muestreo_fk_sede` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id_sede`);

--
-- Filtros para la tabla `produccion`
--
ALTER TABLE `produccion`
  ADD CONSTRAINT `produccion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `seleccion_fertilizacion_ovas`
--
ALTER TABLE `seleccion_fertilizacion_ovas`
  ADD CONSTRAINT `sel_ovas_fk_especie` FOREIGN KEY (`id_especie`) REFERENCES `especies` (`id_especie`),
  ADD CONSTRAINT `sel_ovas_fk_lote` FOREIGN KEY (`id_lote`) REFERENCES `lotes` (`id_lote`),
  ADD CONSTRAINT `sel_ovas_fk_sede` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id_sede`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
