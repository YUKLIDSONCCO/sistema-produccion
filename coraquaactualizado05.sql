-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-11-2025 a las 08:18:41
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

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
  `estado` varchar(20) DEFAULT 'pendiente',
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_sede` int(11) DEFAULT NULL,
  `id_lote` int(11) DEFAULT NULL,
  `id_especie` int(11) DEFAULT NULL,
  `revisado` tinyint(1) DEFAULT 0,
  `fecha_revision` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `control_alimento_almacen`
--

INSERT INTO `control_alimento_almacen` (`id`, `fecha`, `sede`, `encargado`, `mes`, `marca`, `calibre`, `cantidad`, `nombre_alimento`, `observaciones`, `estado`, `id_usuario`, `fecha_registro`, `id_sede`, `id_lote`, `id_especie`, `revisado`, `fecha_revision`) VALUES
(66, '2025-11-01', 'Pisco', 'Juan Carlos Mendoza', 'Noviembre', 'Nicovita', '2.0 mm', 500.00, 'Alimento Balanceado Trucha', 'Lote de producción regular', 'aprobado', NULL, '2025-11-02 04:13:17', NULL, NULL, NULL, 1, NULL),
(67, '2025-11-01', 'Pisco', 'María Elena Quispe', 'Noviembre', 'Purina', '3.0 mm', 750.50, 'Alimento Crecimiento Tilapia', 'Para estanques E-5 al E-8', 'pendiente', NULL, '2025-11-02 04:13:17', NULL, NULL, NULL, 0, NULL),
(68, '2025-11-01', 'Pisco', 'Roberto Silva López', 'Noviembre', 'Skretting', '1.5 mm', 300.25, 'Alimento Inicio Trucha', 'Alevines etapa inicial', 'aprobado', NULL, '2025-11-02 04:13:17', NULL, NULL, NULL, 1, NULL),
(69, '2025-11-01', 'Huancayo', 'Carmen Rosa Torres', 'Noviembre', 'Nicovita', '2.5 mm', 450.75, 'Alimento Engorde Tilapia', 'Temperatura controlada', 'aprobado', NULL, '2025-11-02 04:13:17', NULL, NULL, NULL, 1, NULL),
(70, '2025-11-01', 'Huancayo', 'Luis Alberto Ramos', 'Noviembre', 'Purina', '4.0 mm', 600.00, 'Alimento Final Trucha', 'Preparación para cosecha', 'pendiente', NULL, '2025-11-02 04:13:17', NULL, NULL, NULL, 0, NULL),
(71, '2025-11-01', 'Arequipa', 'Ana Cecilia Díaz', 'Noviembre', 'Skretting', '2.0 mm', 350.80, 'Alimento Balanceado Tilapia', 'Humedad óptima', 'aprobado', NULL, '2025-11-02 04:13:17', NULL, NULL, NULL, 1, NULL),
(72, '2025-11-01', 'Arequipa', 'Pedro Manuel Castillo', 'Noviembre', 'Nicovita', '3.5 mm', 480.30, 'Alimento Crecimiento Trucha', 'Lote de alta calidad', 'aprobado', NULL, '2025-11-02 04:13:17', NULL, NULL, NULL, 1, NULL),
(73, '2025-11-01', 'Pisco', 'Juan Carlos Mendoza', 'Noviembre', 'Purina', '1.8 mm', 275.90, 'Alimento Alevines Tilapia', 'Proteína 45%', 'pendiente', NULL, '2025-11-02 04:13:17', NULL, NULL, NULL, 0, NULL),
(74, '2025-11-01', 'Huancayo', 'Carmen Rosa Torres', 'Noviembre', 'Skretting', '2.8 mm', 520.60, 'Alimento Engorde Trucha', 'Con suplemento vitamínico', 'aprobado', NULL, '2025-11-02 04:13:17', NULL, NULL, NULL, 1, NULL),
(75, '2025-11-01', 'Arequipa', 'Ana Cecilia Díaz', 'Noviembre', 'Nicovita', '3.2 mm', 420.45, 'Alimento Final Tilapia', 'Última etapa', 'aprobado', NULL, '2025-11-02 04:13:17', NULL, NULL, NULL, 1, NULL),
(76, '2025-11-01', 'Pisco', 'Roberto Silva López', 'Noviembre', 'Purina', '2.2 mm', 380.70, 'Alimento Balanceado Trucha', 'Stock para 15 días', 'pendiente', NULL, '2025-11-02 04:13:17', NULL, NULL, NULL, 0, NULL),
(77, '2025-11-01', 'Huancayo', 'Luis Alberto Ramos', 'Noviembre', 'Skretting', '4.5 mm', 550.25, 'Alimento Crecimiento Tilapia', 'Para estanques nuevos', 'aprobado', NULL, '2025-11-02 04:13:17', NULL, NULL, NULL, 1, NULL),
(78, '2025-11-01', 'Arequipa', 'Pedro Manuel Castillo', 'Noviembre', 'Nicovita', '1.2 mm', 200.15, 'Alimento Inicio Tilapia', 'Alevines recién sembrados', 'aprobado', NULL, '2025-11-02 04:13:17', NULL, NULL, NULL, 1, NULL),
(79, '2025-11-01', 'Pisco', 'María Elena Quispe', 'Noviembre', 'Purina', '3.8 mm', 470.80, 'Alimento Engorde Trucha', 'Con astaxantina', 'pendiente', NULL, '2025-11-02 04:13:17', NULL, NULL, NULL, 0, NULL),
(80, '2025-11-01', 'Huancayo', 'Carmen Rosa Torres', 'Noviembre', 'Skretting', '2.5 mm', 320.95, 'Alimento Final Tilapia', 'Pre-cosecha', 'aprobado', NULL, '2025-11-02 04:13:17', NULL, NULL, NULL, 1, NULL),
(81, '2025-11-02', 'Rr', 'Cg', 'Mayo', 'Gg', 'Carlos', 3.00, 'Tt', 'Ggghh', 'pendiente', NULL, '2025-11-02 20:28:00', NULL, NULL, NULL, 0, NULL),
(82, '2025-11-02', 'Carlos', 'Pedregal', 'Junio', 'Sede', 'Tt', 5.00, 'Fg', 'Gg', 'pendiente', NULL, '2025-11-02 20:30:56', NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_alimento_proceso`
--

CREATE TABLE `control_alimento_proceso` (
  `id` int(11) NOT NULL,
  `sede` varchar(100) NOT NULL,
  `encargado` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `mes` varchar(20) NOT NULL,
  `estado` enum('Pendiente','Aprobado','Rechazado') DEFAULT 'Pendiente',
  `id_usuario` int(11) DEFAULT NULL,
  `revisado` tinyint(1) DEFAULT 0,
  `comentarios_supervisor` text DEFAULT NULL,
  `fecha_revision` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
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

--
-- Volcado de datos para la tabla `control_dosificacion`
--

INSERT INTO `control_dosificacion` (`id`, `fecha`, `medicamento_suplemento`, `dosis_gr`, `dias_tratamiento`, `lote_alevines`, `sala`, `responsable`, `registro_diario`, `observaciones`, `fecha_registro`, `id_lote`) VALUES
(1, '2025-11-02', 'Oxitetraciclina', 25.00, 5, 'Lote A-15', 'Sala 1', 'Carlos Pérez', 'Aplicación en alimento balanceado', 'Sin incidencias', '2025-11-02 14:05:10', NULL),
(2, '2025-11-02', 'Florfenicol', 30.00, 7, 'Lote B-21', 'Sala 2', 'Ana Rojas', 'Tratamiento por vía oral', 'Buena aceptación del producto', '2025-11-02 14:05:10', NULL),
(3, '2025-11-02', 'Vitamina C', 10.00, 10, 'Lote C-07', 'Sala 3', 'Luis García', 'Suplemento diario en agua', 'Mejora en comportamiento', '2025-11-02 14:05:10', NULL),
(4, '2025-11-02', 'Sal Marina', 50.00, 3, 'Lote D-10', 'Sala 4', 'Carmen Díaz', 'Baño salino profiláctico', 'Efecto positivo observado', '2025-11-02 14:05:10', NULL),
(5, '2025-11-02', 'Probiótico AquaMix', 15.00, 5, 'Lote E-12', 'Sala 5', 'Jorge Mendoza', 'Incorporado en alimento húmedo', 'Alevines activos y saludables', '2025-11-02 14:05:10', NULL),
(6, '2025-11-02', 'Metronidazol', 20.00, 4, 'Lote F-08', 'Sala 2', 'Beatriz Morales', 'Tratamiento antiparasitario', 'Sin mortalidad durante el tratamiento', '2025-11-02 14:05:10', NULL),
(7, '2025-11-02', 'Cloruro de Sodio', 40.00, 2, 'Lote G-11', 'Sala 1', 'Ricardo Gómez', 'Baño terapéutico', 'Reducción de lesiones cutáneas', '2025-11-02 14:05:10', NULL),
(8, '2025-11-02', 'Aminoácidos Líquidos', 12.50, 6, 'Lote H-05', 'Sala 3', 'Sofía Vega', 'Suplemento en mezcla diaria', 'Alevines más activos', '2025-11-02 14:05:10', NULL),
(9, '2025-11-02', 'Formaldehído', 5.00, 1, 'Lote I-09', 'Sala 4', 'María Torres', 'Desinfección preventiva', 'Sin efectos adversos', '2025-11-02 14:05:10', NULL),
(10, '2025-11-02', 'Sulfato de Cobre', 8.00, 2, 'Lote J-04', 'Sala 5', 'Pedro Silva', 'Baño terapéutico controlado', 'Se observó leve estrés inicial', '2025-11-02 14:05:10', NULL),
(11, '2025-11-03', 'Gggh', 6.00, 5, 'Fg', 'Vv', 'Cv', NULL, '', '2025-11-03 02:49:05', NULL),
(12, '2025-11-04', '3', 2.00, 2, '3', '2', '2', NULL, '', '2025-11-04 22:41:16', NULL),
(13, '2025-11-04', '2', 2.00, 2, '2', '2', '2', 'Registro diario BPA4', '', '2025-11-04 23:31:09', NULL),
(14, '2025-11-04', '2', 2.00, 2, '3', '3', '3', NULL, '3', '2025-11-04 23:51:41', NULL),
(15, '2025-11-05', '3', 3.00, 3, '3', '3', '3', NULL, '3', '2025-11-05 00:15:25', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_empaque`
--

CREATE TABLE `control_empaque` (
  `id` int(11) NOT NULL,
  `sede` varchar(100) NOT NULL,
  `encargado` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `mes` varchar(20) NOT NULL,
  `estado` enum('Pendiente','Aprobado','Rechazado') DEFAULT 'Pendiente',
  `id_usuario` int(11) DEFAULT NULL,
  `revisado` tinyint(1) DEFAULT 0,
  `comentarios_supervisor` text DEFAULT NULL,
  `fecha_revision` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
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
  `id_lote` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT 'pendiente',
  `revisado` tinyint(1) DEFAULT 0,
  `fecha_revision` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `control_medicamento`
--

INSERT INTO `control_medicamento` (`id`, `fecha`, `sede`, `encargado`, `mes`, `medicamento_suplemento`, `cantidad`, `nombre_empleado`, `observaciones`, `fecha_registro`, `id_sede`, `id_lote`, `estado`, `revisado`, `fecha_revision`) VALUES
(1, '2025-11-02', 'DDD', 'OK', 'Abril', 'GFDGD', 4545.00, 'II', 'GYU', '2025-11-02 05:17:10', NULL, NULL, 'pendiente', 0, NULL),
(2, '2025-11-02', 'Almacén Central', 'Carlos Pérez', 'Enero', 'Paracetamol 500mg', 120.00, 'María Torres', 'Ingreso por compra mensual', '2025-11-02 14:02:31', NULL, NULL, 'pendiente', 0, NULL),
(3, '2025-11-02', 'Clínica Norte', 'Ana Rojas', 'Febrero', 'Ibuprofeno 400mg', 80.00, 'Luis García', 'Reposición de stock', '2025-11-02 14:02:31', NULL, NULL, 'pendiente', 0, NULL),
(4, '2025-11-02', 'Hospital Sur', 'Jorge Mendoza', 'Marzo', 'Vitamina C 1g', 150.00, 'Carmen Díaz', 'Donación recibida', '2025-11-02 14:02:31', NULL, NULL, 'pendiente', 0, NULL),
(5, '2025-11-02', 'Almacén Central', 'Carlos Pérez', 'Abril', 'Amoxicilina 500mg', 200.00, 'Pedro Silva', 'Control de inventario', '2025-11-02 14:02:31', NULL, NULL, 'pendiente', 0, NULL),
(6, '2025-11-02', 'Clínica Norte', 'Ana Rojas', 'Mayo', 'Suplemento de Hierro', 60.00, 'Lucía Ramos', 'Distribución semanal', '2025-11-02 14:02:31', NULL, NULL, 'pendiente', 0, NULL),
(7, '2025-11-02', 'Hospital Sur', 'Jorge Mendoza', 'Junio', 'Omeprazol 20mg', 90.00, 'Diego López', 'Uso interno', '2025-11-02 14:02:31', NULL, NULL, 'pendiente', 0, NULL),
(8, '2025-11-02', 'Centro de Salud Este', 'Beatriz Morales', 'Julio', 'Calcio + Vitamina D', 75.00, 'Elena Castro', 'Recepción por proveedor', '2025-11-02 14:02:31', NULL, NULL, 'pendiente', 0, NULL),
(9, '2025-11-02', 'Centro de Salud Oeste', 'Ricardo Gómez', 'Agosto', 'Metformina 850mg', 110.00, 'Sofía Vega', 'Entrega a farmacia', '2025-11-02 14:02:31', NULL, NULL, 'pendiente', 0, NULL),
(10, '2025-11-02', 'Almacén Central', 'Carlos Pérez', 'Septiembre', 'Loratadina 10mg', 95.00, 'Mario Ruiz', 'Registro semanal', '2025-11-02 14:02:31', NULL, NULL, 'pendiente', 0, NULL),
(11, '2025-11-02', 'Hospital Sur', 'Jorge Mendoza', 'Octubre', 'Zinc 50mg', 130.00, 'Natalia Flores', 'Revisión de existencias', '2025-11-02 14:02:31', NULL, NULL, 'pendiente', 0, NULL),
(12, '2025-11-03', 'df', 'fdf', 'Enero', '45', 3.00, '-', '454', '2025-11-03 03:43:08', NULL, NULL, 'pendiente', 0, NULL),
(13, '2025-11-03', 'carlos', 'carlos', 'Enero', 'carlos', 12.00, '-', 'carlos', '2025-11-03 06:11:48', NULL, NULL, 'pendiente', 0, NULL),
(14, '2025-11-03', 'Ff', 'Ff', 'Mayo', 'Carlid', 66.00, '-', 'Calos', '2025-11-03 07:53:23', NULL, NULL, 'pendiente', 0, NULL),
(15, '2025-11-04', '123', '123', 'Mayo', 'Jajakaa ', 12.00, '-', 'Jajakaa ', '2025-11-04 21:43:38', NULL, NULL, 'pendiente', 0, NULL),
(16, '2025-11-04', 'Carlos ', 'Csrlos', 'Abril', '23', 23.00, '-', '23', '2025-11-04 21:57:48', NULL, NULL, 'pendiente', 0, NULL),
(17, '2025-11-04', 'R', 'R', 'Abril', '2', 2.00, '-', '2', '2025-11-04 22:22:16', NULL, NULL, 'pendiente', 0, NULL);

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
-- Estructura de tabla para la tabla `control_producto_terminado`
--

CREATE TABLE `control_producto_terminado` (
  `id` int(11) NOT NULL,
  `sede` varchar(100) NOT NULL,
  `encargado` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `mes` varchar(20) NOT NULL,
  `estado` enum('Pendiente','Aprobado','Rechazado') DEFAULT 'Pendiente',
  `id_usuario` int(11) DEFAULT NULL,
  `revisado` tinyint(1) DEFAULT 0,
  `comentarios_supervisor` text DEFAULT NULL,
  `fecha_revision` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
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
  `id_lote` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT 'Pendiente',
  `revisado` tinyint(1) DEFAULT 0,
  `id_usuario` int(11) DEFAULT NULL,
  `comentarios_supervisor` text DEFAULT NULL,
  `fecha_revision` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `control_sal_almacen`
--

INSERT INTO `control_sal_almacen` (`id`, `fecha`, `sede`, `encargado`, `mes`, `cantidad`, `nombre_sal`, `observaciones`, `fecha_registro`, `id_sede`, `id_lote`, `estado`, `revisado`, `id_usuario`, `comentarios_supervisor`, `fecha_revision`) VALUES
(11, '2025-01-15', 'Sede Puno', 'Carlos Mamani', 'Enero', 125.50, 'Sal marina gruesa', 'Buen control de calidad', '2025-11-02 04:19:59', NULL, NULL, 'Pendiente', 0, NULL, NULL, NULL),
(12, '2025-02-10', 'Sede Juliaca', 'Ana Quispe', 'Febrero', 98.75, 'Sal yodada fina', 'Sin observaciones', '2025-11-02 04:19:59', NULL, NULL, 'Pendiente', 0, NULL, NULL, NULL),
(13, '2025-03-05', 'Sede Arequipa', 'Luis Ramos', 'Marzo', 132.20, 'Sal rosada', 'Producto homogéneo', '2025-11-02 04:19:59', NULL, NULL, 'Pendiente', 0, NULL, NULL, NULL),
(14, '2025-04-22', 'Sede Puno', 'María Flores', 'Abril', 110.00, 'Sal industrial', 'Verificar humedad', '2025-11-02 04:19:59', NULL, NULL, 'Pendiente', 0, NULL, NULL, NULL),
(15, '2025-05-18', 'Sede Tacna', 'José Choque', 'Mayo', 89.60, 'Sal para consumo animal', 'Revisión aprobada', '2025-11-02 04:19:59', NULL, NULL, 'Pendiente', 0, NULL, NULL, NULL),
(16, '2025-06-09', 'Sede Moquegua', 'Rosa Apaza', 'Junio', 147.30, 'Sal gourmet', 'Excelente presentación', '2025-11-02 04:19:59', NULL, NULL, 'Pendiente', 0, NULL, NULL, NULL),
(17, '2025-07-12', 'Sede Puno', 'Carlos Mamani', 'Julio', 100.00, 'Sal marina fina', 'Nivel de sodio dentro del rango', '2025-11-02 04:19:59', NULL, NULL, 'Pendiente', 0, NULL, NULL, NULL),
(18, '2025-08-25', 'Sede Arequipa', 'Luis Ramos', 'Agosto', 118.90, 'Sal yodada gruesa', 'Revisión técnica favorable', '2025-11-02 04:19:59', NULL, NULL, 'Pendiente', 0, NULL, NULL, NULL),
(19, '2025-09-30', 'Sede Juliaca', 'Ana Quispe', 'Septiembre', 140.00, 'Sal rosada premium', 'Sin anomalías detectadas', '2025-11-02 04:19:59', NULL, NULL, 'Pendiente', 0, NULL, NULL, NULL),
(20, '2025-10-21', 'Sede Tacna', 'José Choque', 'Octubre', 155.80, 'Sal industrial refinada', 'Producto final listo', '2025-11-02 04:19:59', NULL, NULL, 'Pendiente', 0, NULL, NULL, NULL),
(21, '2025-11-02', 'ffdhd', 'gfg', 'Marzo', 0.00, 'htfdh', '', '2025-11-02 04:20:53', NULL, NULL, 'Pendiente', 0, NULL, NULL, NULL),
(22, '2025-11-02', '55', '55', 'Marzo', 0.00, 'gg', '', '2025-11-02 04:53:35', NULL, NULL, 'Pendiente', 0, NULL, NULL, NULL),
(23, '2025-11-02', '544', '55', 'Abril', 0.00, 'Array', 'Array', '2025-11-02 05:00:43', NULL, NULL, 'Pendiente', 0, NULL, NULL, NULL),
(24, '2025-11-02', 'R5R', '66', 'Febrero', 5.00, 'UYG', 'UGGG', '2025-11-02 05:07:48', NULL, NULL, 'Pendiente', 0, NULL, NULL, NULL),
(25, '2025-11-03', 'yygbv', 'huh', 'Febrero', 47.00, '44', '44', '2025-11-03 00:28:12', NULL, NULL, 'Pendiente', 0, NULL, NULL, NULL),
(26, '2025-11-02', 'Fg', 'Ff', 'Junio', 2.00, 'Tt', 'Gg', '2025-11-03 02:52:22', NULL, NULL, 'Pendiente', 0, NULL, NULL, NULL),
(27, '2025-11-02', 'Rr', 'Ff', 'Junio', 3.00, 'G', 'Cslo', '2025-11-03 03:02:02', NULL, NULL, 'Pendiente', 0, NULL, NULL, NULL),
(28, '2025-11-02', 'Carl9d', 'Carlos', 'Junio', 1.00, 'Carlos', 'Csrlos', '2025-11-03 03:03:01', NULL, NULL, 'Pendiente', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_alimento_almacen`
--

CREATE TABLE `detalle_alimento_almacen` (
  `id` int(11) NOT NULL,
  `id_reporte` int(11) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `calibre` varchar(100) DEFAULT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `observacion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_alimento_proceso`
--

CREATE TABLE `detalle_alimento_proceso` (
  `id` int(11) NOT NULL,
  `id_reporte` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `unidad` varchar(50) DEFAULT NULL,
  `observacion` text DEFAULT NULL
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
-- Estructura de tabla para la tabla `detalle_empaque`
--

CREATE TABLE `detalle_empaque` (
  `id` int(11) NOT NULL,
  `id_reporte` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `unidad` varchar(50) DEFAULT NULL,
  `observacion` text DEFAULT NULL
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
-- Estructura de tabla para la tabla `detalle_producto_terminado`
--

CREATE TABLE `detalle_producto_terminado` (
  `id` int(11) NOT NULL,
  `id_reporte` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `unidad` varchar(50) DEFAULT NULL,
  `observacion` text DEFAULT NULL
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

--
-- Volcado de datos para la tabla `mortalidad_diaria_ovas`
--

INSERT INTO `mortalidad_diaria_ovas` (`id`, `codigo_formato`, `version`, `fecha_registro`, `encargado`, `cantidad_siembra`, `lote`, `sede`, `id_lote`, `id_sede`, `id_especie`, `fecha_control`, `bateria`, `batea`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`, `c7`, `observacion`, `responsable_area`, `jefe_planta`, `jefe_produccion`, `creado_en`) VALUES
(54, 'CORAQUA-BPA2', '2.0', '2025-11-05', '4', 4, '4', '4', NULL, NULL, NULL, '2025-11-04', '4', '1', -1, 4, 4, 4, 4, 4, 4, '4', '', '', '', '2025-11-05 13:16:25'),
(55, 'CORAQUA-BPA2', '2.0', '2025-11-05', '4', 4, '4', '4', NULL, NULL, NULL, '0000-00-00', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '2025-11-05 13:16:25'),
(56, 'CORAQUA-BPA2', '2.0', '2025-11-05', '4', 4, '4', '4', NULL, NULL, NULL, '0000-00-00', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '2025-11-05 13:16:25'),
(57, 'CORAQUA-BPA2', '2.0', '2025-11-05', '4', 4, '4', '4', NULL, NULL, NULL, '0000-00-00', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '2025-11-05 13:16:25'),
(58, 'CORAQUA-BPA2', '2.0', '2025-11-05', '4', 4, '4', '4', NULL, NULL, NULL, '0000-00-00', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '2025-11-05 13:16:25'),
(59, 'CORAQUA-BPA2', '2.0', '2025-11-05', '4', 4, '4', '4', NULL, NULL, NULL, '2025-11-04', '4', '1', -1, 4, 4, 4, 4, 4, 4, '4', '', '', '', '2025-11-05 13:16:25'),
(60, 'CORAQUA-BPA2', '2.0', '2025-11-05', '4', 4, '4', '4', NULL, NULL, NULL, '0000-00-00', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '2025-11-05 13:16:25'),
(61, 'CORAQUA-BPA2', '2.0', '2025-11-05', '4', 4, '4', '4', NULL, NULL, NULL, '0000-00-00', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '2025-11-05 13:16:25'),
(62, 'CORAQUA-BPA2', '2.0', '2025-11-05', '4', 4, '4', '4', NULL, NULL, NULL, '0000-00-00', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '2025-11-05 13:16:26'),
(63, 'CORAQUA-BPA2', '2.0', '2025-11-05', '4', 4, '4', '4', NULL, NULL, NULL, '0000-00-00', '', '', 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '2025-11-05 13:16:26');

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
-- Estructura de tabla para la tabla `revisiones_bpa1`
--

CREATE TABLE `revisiones_bpa1` (
  `id` int(11) NOT NULL,
  `estado` enum('Aprobado','Rechazado') NOT NULL,
  `comentarios` text DEFAULT NULL,
  `fecha_revision` datetime NOT NULL DEFAULT current_timestamp()
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

--
-- Volcado de datos para la tabla `seleccion_fertilizacion_ovas`
--

INSERT INTO `seleccion_fertilizacion_ovas` (`id`, `codigo_formato`, `version`, `fecha_registro`, `ambito_aplicacion`, `responsable`, `hora_inicio`, `hora_final`, `cantidad_hembras_aptas`, `cantidad_machos_aptos`, `cantidad_hembras_desovadas`, `cantidad_machos_desovados`, `relacion_hembras_machos`, `volumen_ovulos_fertilizados`, `cantidad_ovas_fertiles`, `observaciones`, `id_lote`, `id_especie`, `id_sede`, `creado_en`) VALUES
(2, 'CORAQUA BPA-02', '2.0', '2025-11-05', 'PECES REPRODUCTORES', '434', '11:54:00', '11:54:00', 2, 23, 23, 23, '23', 23.00, 23, '43242', NULL, NULL, NULL, '2025-11-05 03:58:30'),
(3, 'CORAQUA BPA-02', '2.0', '2025-11-05', 'PECES REPRODUCTORES', '', '00:00:00', '00:00:00', 0, 0, 0, 0, '', 0.00, 0, '', NULL, NULL, NULL, '2025-11-05 05:15:32');

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
  `foto` varchar(255) DEFAULT NULL,
  `estado` enum('activo','suspendido') DEFAULT 'activo',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `password`, `id_rol`, `foto`, `estado`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(1, 'Super Administrador', 'admin@coraqua.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, NULL, 'activo', '2025-09-25 14:19:11', '2025-09-25 14:19:11'),
(2, 'Jefe Planta', 'jefeplanta@coraqua.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, NULL, 'activo', '2025-09-25 14:19:11', '2025-10-15 02:12:58'),
(3, 'Supervisor 1', 'supervisor1@coraqua.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3, NULL, 'activo', '2025-09-25 14:19:11', '2025-10-29 21:00:48'),
(4, 'Colaborador 1', 'colaborador1@coraqua.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 4, NULL, 'activo', '2025-09-25 14:19:11', '2025-09-25 14:19:11'),
(5, 'pedro', 'pedro@coraqua.com', '$2y$10$lGUk9URq.KmDByO5G2fhheIB7eSW4QjTwFP1APlz2C3E3iEQgOdKy', 3, NULL, 'activo', '2025-10-06 05:13:11', '2025-10-06 06:14:16'),
(6, 'Café Americano', 'cafe@coraqua.com', '$2y$10$buJa3HAqMLEayp7aNKkCGOIOj5L3pOCwmjICjWuw5ox684dtrRKy2', 3, NULL, 'activo', '2025-10-06 05:23:57', '2025-10-06 05:26:23'),
(7, 'Niko', 'jefeplanta2@coraqua.com', '$2y$10$6MnjpvcUMEK40Js04enG7uZVk9LNCO.C7GupnWaF7SJu2kohRFRwW', 2, NULL, 'suspendido', '2025-10-06 05:33:12', '2025-10-06 05:33:12'),
(8, 'Nikopico', 'jefeplanta23@coraqua.com', '$2y$10$/G6Lt1YdWatx..eMqKuxcOcUS.wh1UQVt1HjWQA/hBULsxCbivtga', 3, NULL, 'suspendido', '2025-10-06 05:38:55', '2025-10-06 05:38:55'),
(9, 'pedro', 'jefeplanta14@coraqua.com', '$2y$10$n8mHjMi01gf.EwbwEWaJpO9OaF2uOVZ0tHHcGmnAVEEeLt3VRbZc.', 2, NULL, 'suspendido', '2025-10-06 05:42:36', '2025-10-06 05:42:36'),
(10, 'Chsmo', 'chamo@coraqua.com', '$2y$10$jcapVWSiLb8JA/XrFpd8OuwlQyQBraKrWSDaZX8esuu.WM.QObw2K', 3, NULL, 'suspendido', '2025-10-06 05:43:12', '2025-10-06 05:43:12'),
(11, 'Chsmo', 'cafela@coraqua.com', '$2y$10$3ZQO1F5bHbWFq0jzH96Q2eiodKwwT94KzEVhU8Q3TVBWVfKctFQOy', 3, NULL, 'suspendido', '2025-10-06 05:46:54', '2025-10-06 05:46:54'),
(12, 'Fffr', 'admi21n@coraqua.com', '$2y$10$Z/oISbVdXEH6LZ36H7uNA.O1f98gdAAyKDdtA1ZhwdVgzxwLk.WBK', 3, NULL, 'suspendido', '2025-10-06 05:47:40', '2025-10-06 05:47:40'),
(13, 'Csmilo', '23jefeplanta@coraqua.com', '$2y$10$fLtcuzbxtkM9Jq/aEwr4Be1NjswWjxZxEQrU56wGbwrbGSiy5EUe6', 3, NULL, 'suspendido', '2025-10-06 05:54:04', '2025-10-06 05:54:04'),
(14, 'Chsmooo', 'jtttefeplanta@coraqua.com', '$2y$10$S0Bipq7Iesm4.d/tyy5jjuWm1/BNZf6Fw076VctNdefsreaIXBrIG', 3, NULL, 'suspendido', '2025-10-06 05:54:20', '2025-10-06 05:54:20'),
(15, 'Jajakaa', 'j4efeplanta@coraqua.com', '$2y$10$.HPRFJAMHkuZCdCzgUVSVuexU4y0KNGV3XTPtHv2.peYhnabAeEFe', 4, NULL, 'suspendido', '2025-10-06 05:56:33', '2025-10-06 05:56:33'),
(16, 'Fffr', 'jtefeplanta@coraqua.com', '$2y$10$t60PSziIvR/CELNSQX2zluCPmd8i59nfKSHgk6clEyPtw7ynDvcK.', 3, NULL, 'suspendido', '2025-10-06 06:02:00', '2025-10-06 06:02:00'),
(17, 'Camaron', 'ajaa@coraqua.com', '$2y$10$PLAwTWMbmN3QdxpCIiF4P.UApHI47l3cGpQMWi7UkXbffpq/ILkAC', 3, NULL, 'activo', '2025-10-06 06:03:56', '2025-10-29 22:29:31'),
(18, 'Nikopico4666', 'jetttfeplanta@coraqua.com', '$2y$10$eujY44s7lGWDxtrQ9ACKauIfVtilfT4nIelpLcxPLD1BtiDPVfW8u', 3, NULL, 'suspendido', '2025-10-06 06:07:45', '2025-10-06 06:07:45'),
(19, 'Ghhgkhk', 'ffmfkffk@gmail.con', '$2y$10$CbTrg5RyITwsC0jeUPqQnuxhxyMT1cy4MCjzSZib5jT6KJNDI.m86', 4, NULL, 'suspendido', '2025-10-06 06:08:11', '2025-10-06 06:14:06'),
(20, 'Carlos', 'administradores@coraqua.com', '$2y$10$t126h/WzokbKKaWnhpZ6r.8IeSssCQzr0TnEYc9q5es2XeNbH8wIy', 2, '/sistema-produccion/public/uploads/rostros/rostro_69029203385d8.webp', 'suspendido', '2025-10-29 22:15:31', '2025-10-29 22:15:31');

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
  ADD KEY `calm_fk_especie` (`id_especie`),
  ADD KEY `fk_alimento_usuario` (`id_usuario`);

--
-- Indices de la tabla `control_alimento_proceso`
--
ALTER TABLE `control_alimento_proceso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_proceso_usuario` (`id_usuario`);

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
-- Indices de la tabla `control_empaque`
--
ALTER TABLE `control_empaque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_empaque_usuario` (`id_usuario`);

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
-- Indices de la tabla `control_producto_terminado`
--
ALTER TABLE `control_producto_terminado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_producto_usuario` (`id_usuario`);

--
-- Indices de la tabla `control_sal_almacen`
--
ALTER TABLE `control_sal_almacen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sede` (`id_sede`),
  ADD KEY `id_lote` (`id_lote`),
  ADD KEY `nombre_sal` (`nombre_sal`);

--
-- Indices de la tabla `detalle_alimento_almacen`
--
ALTER TABLE `detalle_alimento_almacen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_reporte` (`id_reporte`);

--
-- Indices de la tabla `detalle_alimento_proceso`
--
ALTER TABLE `detalle_alimento_proceso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_reporte` (`id_reporte`);

--
-- Indices de la tabla `detalle_control_parametros`
--
ALTER TABLE `detalle_control_parametros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_ctrl_fk` (`id_control`);

--
-- Indices de la tabla `detalle_empaque`
--
ALTER TABLE `detalle_empaque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_reporte` (`id_reporte`);

--
-- Indices de la tabla `detalle_muestreo`
--
ALTER TABLE `detalle_muestreo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_muestreo_fk` (`id_muestreo`);

--
-- Indices de la tabla `detalle_producto_terminado`
--
ALTER TABLE `detalle_producto_terminado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_reporte` (`id_reporte`);

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
-- Indices de la tabla `revisiones_bpa1`
--
ALTER TABLE `revisiones_bpa1`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `control_alimento_proceso`
--
ALTER TABLE `control_alimento_proceso`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `control_empaque`
--
ALTER TABLE `control_empaque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `control_medicamento`
--
ALTER TABLE `control_medicamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `control_parametros`
--
ALTER TABLE `control_parametros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `control_producto_terminado`
--
ALTER TABLE `control_producto_terminado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `control_sal_almacen`
--
ALTER TABLE `control_sal_almacen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `detalle_alimento_almacen`
--
ALTER TABLE `detalle_alimento_almacen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_alimento_proceso`
--
ALTER TABLE `detalle_alimento_proceso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_control_parametros`
--
ALTER TABLE `detalle_control_parametros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_empaque`
--
ALTER TABLE `detalle_empaque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_muestreo`
--
ALTER TABLE `detalle_muestreo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_producto_terminado`
--
ALTER TABLE `detalle_producto_terminado`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

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
-- AUTO_INCREMENT de la tabla `revisiones_bpa1`
--
ALTER TABLE `revisiones_bpa1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  ADD CONSTRAINT `calm_fk_sede` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id_sede`),
  ADD CONSTRAINT `fk_alimento_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `control_alimento_proceso`
--
ALTER TABLE `control_alimento_proceso`
  ADD CONSTRAINT `fk_proceso_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE;

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
-- Filtros para la tabla `control_empaque`
--
ALTER TABLE `control_empaque`
  ADD CONSTRAINT `fk_empaque_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `control_medicamento`
--
ALTER TABLE `control_medicamento`
  ADD CONSTRAINT `cm_fk_lote` FOREIGN KEY (`id_lote`) REFERENCES `lotes` (`id_lote`),
  ADD CONSTRAINT `cm_fk_sede` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id_sede`);

--
-- Filtros para la tabla `control_producto_terminado`
--
ALTER TABLE `control_producto_terminado`
  ADD CONSTRAINT `fk_producto_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `control_sal_almacen`
--
ALTER TABLE `control_sal_almacen`
  ADD CONSTRAINT `csa_fk_lote` FOREIGN KEY (`id_lote`) REFERENCES `lotes` (`id_lote`),
  ADD CONSTRAINT `csa_fk_sede` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id_sede`);

--
-- Filtros para la tabla `detalle_alimento_almacen`
--
ALTER TABLE `detalle_alimento_almacen`
  ADD CONSTRAINT `detalle_alimento_almacen_ibfk_1` FOREIGN KEY (`id_reporte`) REFERENCES `control_alimento_almacen` (`id`);

--
-- Filtros para la tabla `detalle_alimento_proceso`
--
ALTER TABLE `detalle_alimento_proceso`
  ADD CONSTRAINT `detalle_alimento_proceso_ibfk_1` FOREIGN KEY (`id_reporte`) REFERENCES `control_alimento_proceso` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_control_parametros`
--
ALTER TABLE `detalle_control_parametros`
  ADD CONSTRAINT `detalle_ctrl_fk` FOREIGN KEY (`id_control`) REFERENCES `control_parametros` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_empaque`
--
ALTER TABLE `detalle_empaque`
  ADD CONSTRAINT `detalle_empaque_ibfk_1` FOREIGN KEY (`id_reporte`) REFERENCES `control_empaque` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_muestreo`
--
ALTER TABLE `detalle_muestreo`
  ADD CONSTRAINT `detalle_muestreo_fk` FOREIGN KEY (`id_muestreo`) REFERENCES `muestreo` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_producto_terminado`
--
ALTER TABLE `detalle_producto_terminado`
  ADD CONSTRAINT `detalle_producto_terminado_ibfk_1` FOREIGN KEY (`id_reporte`) REFERENCES `control_producto_terminado` (`id`) ON DELETE CASCADE;

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
