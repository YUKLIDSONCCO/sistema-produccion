-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2025 a las 05:49:36
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
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `auditoria_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `formularios`
--
ALTER TABLE `formularios`
  ADD CONSTRAINT `formularios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `produccion`
--
ALTER TABLE `produccion`
  ADD CONSTRAINT `produccion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
  -- ========================================
-- Módulo ampliado: OVAS / PECES / INVENTARIO
-- Tablas añadidas para ampliar el sistema sin tocar las tablas existentes
-- Engine y charset coinciden con el resto del dump (InnoDB / utf8mb4)
-- ========================================

START TRANSACTION;

-- TABLAS MAESTRAS PARA ORGANIZACIÓN Y REPORTES
CREATE TABLE IF NOT EXISTS especies (
  id_especie INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  nombre_comun VARCHAR(100),
  descripcion TEXT,
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS sedes (
  id_sede INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(150) NOT NULL,
  ubicacion VARCHAR(255),
  contacto VARCHAR(150),
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS lotes (
  id_lote INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  codigo_lote VARCHAR(100) NOT NULL,
  id_especie INT,
  id_sede INT,
  fecha_inicio DATE,
  fecha_termino DATE,
  descripcion TEXT,
  estado ENUM('activo','cerrado','transferido') DEFAULT 'activo',
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX (codigo_lote),
  INDEX (id_especie),
  INDEX (id_sede),
  CONSTRAINT lotes_fk_especie FOREIGN KEY (id_especie) REFERENCES especies(id_especie),
  CONSTRAINT lotes_fk_sede FOREIGN KEY (id_sede) REFERENCES sedes(id_sede)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- ========================================
-- OVAS
-- (Se mantienen exactamente las columnas que proporcionaste; agrego id_lote opcional
--  y claves para facilitar reportes por lote/especie/sede)
-- ========================================

CREATE TABLE IF NOT EXISTS seleccion_fertilizacion_ovas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_formato VARCHAR(50) DEFAULT 'CORAQUA BPA-02',
    version VARCHAR(10) DEFAULT '2.0',
    fecha_registro DATE NOT NULL,
    ambito_aplicacion VARCHAR(100) DEFAULT 'PECES REPRODUCTORES',

    responsable VARCHAR(100),
    hora_inicio TIME,
    hora_final TIME,

    -- Datos reproductores
    cantidad_hembras_aptas INT,
    cantidad_machos_aptos INT,

    cantidad_hembras_desovadas INT,
    cantidad_machos_desovados INT,
    relacion_hembras_machos VARCHAR(50),

    volumen_ovulos_fertilizados DECIMAL(10,2),
    cantidad_ovas_fertiles INT,

    observaciones TEXT,

    -- Relación a lotes/especie/sede (opcional, no elimina el campo 'lote' si existe)
    id_lote INT NULL,
    id_especie INT NULL,
    id_sede INT NULL,

    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (id_lote),
    INDEX (id_especie),
    INDEX (id_sede),
    CONSTRAINT sel_ovas_fk_lote FOREIGN KEY (id_lote) REFERENCES lotes(id_lote),
    CONSTRAINT sel_ovas_fk_especie FOREIGN KEY (id_especie) REFERENCES especies(id_especie),
    CONSTRAINT sel_ovas_fk_sede FOREIGN KEY (id_sede) REFERENCES sedes(id_sede)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS mortalidad_diaria_ovas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_formato VARCHAR(50) DEFAULT 'CORAQUA-BPA-04',
    version VARCHAR(10) DEFAULT '2.0',
    fecha_registro DATE NOT NULL,

    encargado VARCHAR(100),
    cantidad_siembra INT,
    lote VARCHAR(50),
    sede VARCHAR(100),

    -- Relación (opcional)
    id_lote INT NULL,
    id_sede INT NULL,
    id_especie INT NULL,

    -- Datos diarios
    fecha_control DATE NOT NULL,
    bateria VARCHAR(50),
    batea VARCHAR(50),

    c1 INT DEFAULT 0,
    c2 INT DEFAULT 0,
    c3 INT DEFAULT 0,
    c4 INT DEFAULT 0,
    c5 INT DEFAULT 0,
    c6 INT DEFAULT 0,
    c7 INT DEFAULT 0,
    total INT GENERATED ALWAYS AS (c1 + c2 + c3 + c4 + c5 + c6 + c7) STORED,

    observacion TEXT,

    -- Firmas responsables
    responsable_area VARCHAR(100),
    jefe_planta VARCHAR(100),
    jefe_produccion VARCHAR(100),

    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (id_lote),
    INDEX (id_sede),
    INDEX (id_especie),
    CONSTRAINT mortalidad_ovas_fk_lote FOREIGN KEY (id_lote) REFERENCES lotes(id_lote),
    CONSTRAINT mortalidad_ovas_fk_sede FOREIGN KEY (id_sede) REFERENCES sedes(id_sede),
    CONSTRAINT mortalidad_ovas_fk_especie FOREIGN KEY (id_especie) REFERENCES especies(id_especie)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS mortalidad_diaria_larvas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_formato VARCHAR(50) DEFAULT 'CORAQUA-BPA-05',
    version VARCHAR(10) DEFAULT '2.0',
    fecha_registro DATE NOT NULL,

    encargado VARCHAR(100),
    cantidad_siembra INT,
    lote VARCHAR(50),
    sede VARCHAR(100),

    id_lote INT NULL,
    id_sede INT NULL,
    id_especie INT NULL,

    -- Conteos por categoría (C1–C7), L.M. = larvas muertas, L.D. = larvas dañadas
    c1_lm INT DEFAULT 0,
    c1_ld INT DEFAULT 0,
    c2_lm INT DEFAULT 0,
    c2_ld INT DEFAULT 0,
    c3_lm INT DEFAULT 0,
    c3_ld INT DEFAULT 0,
    c4_lm INT DEFAULT 0,
    c4_ld INT DEFAULT 0,
    c5_lm INT DEFAULT 0,
    c5_ld INT DEFAULT 0,
    c6_lm INT DEFAULT 0,
    c6_ld INT DEFAULT 0,
    c7_lm INT DEFAULT 0,
    c7_ld INT DEFAULT 0,

    total INT GENERATED ALWAYS AS (
        c1_lm + c2_lm + c3_lm + c4_lm + c5_lm + c6_lm + c7_lm +
        c1_ld + c2_ld + c3_ld + c4_ld + c5_ld + c6_ld + c7_ld
    ) STORED,

    observacion TEXT,

    -- Firmas de responsables
    responsable_area VARCHAR(100),
    jefe_planta VARCHAR(100),
    jefe_produccion VARCHAR(100),

    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (id_lote),
    INDEX (id_sede),
    INDEX (id_especie),
    CONSTRAINT mortalidad_larvas_fk_lote FOREIGN KEY (id_lote) REFERENCES lotes(id_lote),
    CONSTRAINT mortalidad_larvas_fk_sede FOREIGN KEY (id_sede) REFERENCES sedes(id_sede),
    CONSTRAINT mortalidad_larvas_fk_especie FOREIGN KEY (id_especie) REFERENCES especies(id_especie)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS control_diario_parametros_ovas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_formato VARCHAR(50) DEFAULT 'CORAQUA-BPA-12',
    version VARCHAR(10) DEFAULT '2.0',
    fecha_registro DATE NOT NULL,

    mes VARCHAR(20),
    sede VARCHAR(100),

    dia INT NOT NULL,

    -- Parámetros 6:30 a.m.
    t_0630 DECIMAL(5,2),
    o2_0630 DECIMAL(5,2),
    sat_0630 DECIMAL(5,2),
    ph_0630 DECIMAL(4,2),

    -- Parámetros 12:00 m.
    t_1200 DECIMAL(5,2),
    o2_1200 DECIMAL(5,2),
    sat_1200 DECIMAL(5,2),
    ph_1200 DECIMAL(4,2),

    -- Parámetros 3:30 p.m.
    t_1530 DECIMAL(5,2),
    o2_1530 DECIMAL(5,2),
    sat_1530 DECIMAL(5,2),
    ph_1530 DECIMAL(4,2),

    responsable VARCHAR(100),
    observacion TEXT,

    id_sede INT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (id_sede),
    CONSTRAINT ctrl_param_ovas_fk_sede FOREIGN KEY (id_sede) REFERENCES sedes(id_sede)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- ========================================
-- PECES
-- ========================================

CREATE TABLE IF NOT EXISTS mortalidad_alevines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_formato VARCHAR(20) DEFAULT 'CORAQUA BPA-6',
    version DECIMAL(3,1) DEFAULT 2.0,
    fecha_registro DATE NOT NULL,
    responsable VARCHAR(100) NOT NULL,
    sede VARCHAR(100) NOT NULL,

    -- Datos principales del registro
    up VARCHAR(50) NOT NULL,
    lote VARCHAR(50) NOT NULL,
    mortalidad INT DEFAULT 0,
    morbilidad INT DEFAULT 0,
    total INT GENERATED ALWAYS AS (mortalidad + morbilidad) STORED,
    observaciones TEXT,

    -- Relación con lotes/especies/sede
    id_lote INT NULL,
    id_especie INT NULL,
    id_sede INT NULL,

    -- Metadatos de control
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX (id_lote),
    INDEX (id_especie),
    INDEX (id_sede),
    CONSTRAINT mortalidad_alevines_fk_lote FOREIGN KEY (id_lote) REFERENCES lotes(id_lote),
    CONSTRAINT mortalidad_alevines_fk_especie FOREIGN KEY (id_especie) REFERENCES especies(id_especie),
    CONSTRAINT mortalidad_alevines_fk_sede FOREIGN KEY (id_sede) REFERENCES sedes(id_sede)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS firmas_mortalidad_alevines (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_mortalidad INT NOT NULL,
    responsable_area VARCHAR(100),
    jefe_planta VARCHAR(100),
    jefe_produccion VARCHAR(100),
    observaciones TEXT,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT firmas_mortalidad_alevines_fk FOREIGN KEY (id_mortalidad) REFERENCES mortalidad_alevines(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE IF NOT EXISTS alimentacion_diaria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_formato VARCHAR(20) DEFAULT 'CORAQUA BPA-7',
    version DECIMAL(3,1) DEFAULT 2.0,
    fecha_registro DATE NOT NULL,
    responsable VARCHAR(100) NOT NULL,
    sede VARCHAR(100) NOT NULL,

    -- Datos de alimentación
    up VARCHAR(50) NOT NULL,
    lote VARCHAR(50) NOT NULL,
    biomasa DECIMAL(10,2) DEFAULT 0.00,
    tasa_alimentacion DECIMAL(5,2) DEFAULT 0.00,
    alimento_suministrado DECIMAL(10,2) DEFAULT 0.00,
    calibre VARCHAR(50),
    observaciones TEXT,

    -- Relación
    id_lote INT NULL,
    id_especie INT NULL,
    id_sede INT NULL,

    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX (id_lote),
    INDEX (id_especie),
    INDEX (id_sede),
    CONSTRAINT alimentacion_fk_lote FOREIGN KEY (id_lote) REFERENCES lotes(id_lote),
    CONSTRAINT alimentacion_fk_especie FOREIGN KEY (id_especie) REFERENCES especies(id_especie),
    CONSTRAINT alimentacion_fk_sede FOREIGN KEY (id_sede) REFERENCES sedes(id_sede)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS firmas_alimentacion_diaria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_alimentacion INT NOT NULL,
    responsable_area VARCHAR(100),
    jefe_planta VARCHAR(100),
    jefe_produccion VARCHAR(100),
    observaciones TEXT,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT firmas_alimentacion_fk FOREIGN KEY (id_alimentacion) REFERENCES alimentacion_diaria(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE IF NOT EXISTS muestreo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_formato VARCHAR(20) DEFAULT 'CORAQUA BPA-10',
    version DECIMAL(3,1) DEFAULT 2.0,
    fecha_registro DATE NOT NULL,
    encargado VARCHAR(100) NOT NULL,
    sede VARCHAR(100) NOT NULL,
    fecha_muestreo DATE NOT NULL,
    hora_muestreo TIME NOT NULL,

    up VARCHAR(50) NOT NULL,
    lote VARCHAR(50) NOT NULL,

    peso_promedio DECIMAL(10,2) DEFAULT 0.00,
    coeficiente_variacion DECIMAL(10,2) DEFAULT 0.00,
    factor_k DECIMAL(10,2) DEFAULT 0.00,

    observaciones TEXT,

    id_lote INT NULL,
    id_especie INT NULL,
    id_sede INT NULL,

    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX (id_lote),
    INDEX (id_especie),
    INDEX (id_sede),
    CONSTRAINT muestreo_fk_lote FOREIGN KEY (id_lote) REFERENCES lotes(id_lote),
    CONSTRAINT muestreo_fk_especie FOREIGN KEY (id_especie) REFERENCES especies(id_especie),
    CONSTRAINT muestreo_fk_sede FOREIGN KEY (id_sede) REFERENCES sedes(id_sede)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS detalle_muestreo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_muestreo INT NOT NULL,
    numero_muestra INT NOT NULL,
    peso DECIMAL(10,2) DEFAULT 0.00,
    longitud DECIMAL(10,2) DEFAULT 0.00,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT detalle_muestreo_fk FOREIGN KEY (id_muestreo) REFERENCES muestreo(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS firmas_muestreo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_muestreo INT NOT NULL,
    responsable_area VARCHAR(100),
    jefe_planta VARCHAR(100),
    jefe_produccion VARCHAR(100),
    observaciones TEXT,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT firmas_muestreo_fk FOREIGN KEY (id_muestreo) REFERENCES muestreo(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE IF NOT EXISTS control_parametros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_formato VARCHAR(20) DEFAULT 'CORAQUA BPA-12',
    version DECIMAL(3,1) DEFAULT 2.0,
    fecha_registro DATE NOT NULL,
    mes VARCHAR(20) NOT NULL,
    sede VARCHAR(100) NOT NULL,
    responsable VARCHAR(100) NOT NULL,
    observaciones TEXT,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS detalle_control_parametros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_control INT NOT NULL,
    dia INT NOT NULL CHECK (dia BETWEEN 1 AND 31),

    -- Medición 6:30 a.m.
    temp_6_30 DECIMAL(5,2),
    o2_6_30 DECIMAL(5,2),
    sat_6_30 DECIMAL(5,2),
    ph_6_30 DECIMAL(5,2),

    -- Medición 12:00 m.
    temp_12_00 DECIMAL(5,2),
    o2_12_00 DECIMAL(5,2),
    sat_12_00 DECIMAL(5,2),
    ph_12_00 DECIMAL(5,2),

    -- Medición 03:30 p.m.
    temp_3_30 DECIMAL(5,2),
    o2_3_30 DECIMAL(5,2),
    sat_3_30 DECIMAL(5,2),
    ph_3_30 DECIMAL(5,2),

    -- Promedios diarios
    temp_prom DECIMAL(5,2),
    o2_prom DECIMAL(5,2),
    sat_prom DECIMAL(5,2),
    ph_prom DECIMAL(5,2),

    observaciones TEXT,

    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT detalle_ctrl_fk FOREIGN KEY (id_control) REFERENCES control_parametros(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS firmas_control_parametros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_control INT NOT NULL,
    responsable_area VARCHAR(100),
    jefe_planta VARCHAR(100),
    jefe_produccion VARCHAR(100),
    observaciones TEXT,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT firmas_ctrl_fk FOREIGN KEY (id_control) REFERENCES control_parametros(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- ========================================
-- INVENTARIO
-- (Mantengo exactamente los nombres/columnas que pediste; añado índices y vínculo opcional con sedes/especies/lotes)
-- ========================================

CREATE TABLE IF NOT EXISTS control_alimento_almacen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    sede VARCHAR(100) NOT NULL,
    encargado VARCHAR(100) NOT NULL,
    mes VARCHAR(20) NOT NULL,
    marca VARCHAR(100) NOT NULL,
    calibre VARCHAR(50),
    cantidad DECIMAL(10,2),
    nombre_alimento VARCHAR(150),
    observaciones TEXT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    id_sede INT NULL,
    id_lote INT NULL,
    id_especie INT NULL,
    INDEX (id_sede),
    INDEX (id_lote),
    INDEX (nombre_alimento),
    CONSTRAINT calm_fk_sede FOREIGN KEY (id_sede) REFERENCES sedes(id_sede),
    CONSTRAINT calm_fk_lote FOREIGN KEY (id_lote) REFERENCES lotes(id_lote),
    CONSTRAINT calm_fk_especie FOREIGN KEY (id_especie) REFERENCES especies(id_especie)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS control_sal_almacen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    sede VARCHAR(100) NOT NULL,
    encargado VARCHAR(100) NOT NULL,
    mes VARCHAR(20) NOT NULL,
    cantidad DECIMAL(10,2) NOT NULL,
    nombre_sal VARCHAR(150) NOT NULL,
    observaciones TEXT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    id_sede INT NULL,
    id_lote INT NULL,
    INDEX (id_sede),
    INDEX (id_lote),
    INDEX (nombre_sal),
    CONSTRAINT csa_fk_sede FOREIGN KEY (id_sede) REFERENCES sedes(id_sede),
    CONSTRAINT csa_fk_lote FOREIGN KEY (id_lote) REFERENCES lotes(id_lote)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS control_medicamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    sede VARCHAR(100) NOT NULL,
    encargado VARCHAR(100) NOT NULL,
    mes VARCHAR(20) NOT NULL,
    medicamento_suplemento VARCHAR(150) NOT NULL,
    cantidad DECIMAL(10,2) NOT NULL,
    nombre_empleado VARCHAR(100),
    observaciones TEXT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    id_sede INT NULL,
    id_lote INT NULL,
    INDEX (id_sede),
    INDEX (id_lote),
    INDEX (medicamento_suplemento),
    CONSTRAINT cm_fk_sede FOREIGN KEY (id_sede) REFERENCES sedes(id_sede),
    CONSTRAINT cm_fk_lote FOREIGN KEY (id_lote) REFERENCES lotes(id_lote)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT_EXISTS control_dosificacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    medicamento_suplemento VARCHAR(150) NOT NULL,
    dosis_gr DECIMAL(10,2) NOT NULL,
    dias_tratamiento INT NOT NULL,
    lote_alevines VARCHAR(100),
    sala VARCHAR(100),
    responsable VARCHAR(100) NOT NULL,
    registro_diario TEXT,
    observaciones TEXT,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    id_lote INT NULL,
    INDEX (id_lote),
    CONSTRAINT cd_fk_lote FOREIGN KEY (id_lote) REFERENCES lotes(id_lote)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Ajustes/Índices extra para consultas rápidas (reportes)
CREATE INDEX idx_mortalidad_alevines_fecha ON mortalidad_alevines(fecha_registro);
CREATE INDEX idx_alimentacion_fecha ON alimentacion_diaria(fecha_registro);
CREATE INDEX idx_muestreo_fecha ON muestreo(fecha_registro);
CREATE INDEX idx_sel_ovas_fecha ON seleccion_fertilizacion_ovas(fecha_registro);
CREATE INDEX idx_mortalidad_ovas_fecha ON mortalidad_diaria_ovas(fecha_registro);
CREATE INDEX idx_control_param_ovas_fecha ON control_diario_parametros_ovas(fecha_registro);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
