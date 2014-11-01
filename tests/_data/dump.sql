-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 31-10-2014 a las 03:52:02
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sisprocompu`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cedula` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ruc` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `actividad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `razon_social` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `razon_comercial` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE IF NOT EXISTS `equipos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `serie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `marca` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modelo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cliente_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `serie` (`serie`),
  KEY `cliente_id` (`cliente_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=83 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE IF NOT EXISTS `ordenes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entregado` tinyint(1) NOT NULL,
  `problema` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `accesorios` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `horaPrometido` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fechaPrometido` date NOT NULL DEFAULT '0000-00-00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cliente_id` int(10) unsigned NOT NULL,
  `equipo_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `tecnico` int(10) unsigned NOT NULL,
  `estado` int(1) unsigned NOT NULL,
  `Sucursal_id` int(10) unsigned NOT NULL,
  `detalle` text COLLATE utf8_unicode_ci NOT NULL,
  `informe` text COLLATE utf8_unicode_ci NOT NULL,
  `fecha_terminado` date NOT NULL DEFAULT '0000-00-00',
  `presupuestado` tinyint(1) NOT NULL DEFAULT '0',
  `subtotal` double(10,2) unsigned NOT NULL DEFAULT '0.00',
  `total` double(10,2) unsigned NOT NULL DEFAULT '0.00',
  `fecha_entregado` date NOT NULL DEFAULT '0000-00-00',
  `fecha_ingreso` date NOT NULL DEFAULT '0000-00-00',
  `vendedor` int(10) unsigned NOT NULL,
  `vendedor_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `equipo_id` (`equipo_id`),
  KEY `user_id` (`user_id`),
  KEY `tecnico` (`tecnico`),
  KEY `Sucursal_id` (`Sucursal_id`),
  KEY `vendedor` (`vendedor`),
  KEY `vendedor_id` (`vendedor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=79 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_presupuesto`
--

CREATE TABLE IF NOT EXISTS `orden_presupuesto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orden_id` int(10) unsigned NOT NULL,
  `presupuesto_id` int(10) unsigned NOT NULL,
  `valor_actual` double(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `orden_id` (`orden_id`,`presupuesto_id`),
  KEY `presupuesto_id` (`presupuesto_id`),
  KEY `orden_id_2` (`orden_id`),
  KEY `orden_id_3` (`orden_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestos`
--

CREATE TABLE IF NOT EXISTS `presupuestos` (
  `detalle` text COLLATE utf8_spanish_ci NOT NULL,
  `valor` double(10,2) unsigned NOT NULL DEFAULT '0.00',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `valor_actual` double(10,2) unsigned NOT NULL DEFAULT '0.00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE IF NOT EXISTS `sucursales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `provincia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ciudad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `empresa_id` int(10) unsigned NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empresa_id` (`empresa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cedula` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estado` tinyint(1) NOT NULL,
  `sucursal_id` int(10) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `sucursal_id` (`sucursal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `equipos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD CONSTRAINT `ordenes_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ordenes_ibfk_2` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ordenes_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ordenes_ibfk_4` FOREIGN KEY (`tecnico`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ordenes_ibfk_5` FOREIGN KEY (`Sucursal_id`) REFERENCES `sucursales` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ordenes_ibfk_6` FOREIGN KEY (`vendedor_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_presupuesto`
--
ALTER TABLE `orden_presupuesto`
  ADD CONSTRAINT `orden_presupuesto_ibfk_1` FOREIGN KEY (`orden_id`) REFERENCES `ordenes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orden_presupuesto_ibfk_2` FOREIGN KEY (`presupuesto_id`) REFERENCES `presupuestos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD CONSTRAINT `sucursales_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_sucursal_id_foreign` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

INSERT INTO `empresas`(`id`, `ruc`, `actividad`, `razon_social`, `razon_comercial`, `created_at`, `updated_at`) 
VALUES ('1','0702568130001','001','Walter Alvarado','Sispro','','');

INSERT INTO `sucursales`(`id`, `provincia`, `ciudad`, `direccion`, `telefono`, `celular`, `email`, `created_at`, `updated_at`, `empresa_id`, `estado`, `nombre`) 
VALUES ('1','Loja','Loja','Loja','585136','0979365042','difercast@hotmail.com','','','1','1','Matriz');

INSERT INTO `users`(`id`, `nombres`, `apellidos`, `direccion`, `email`, `telefono`, `celular`,
 `cedula`, `username`, `password`, `rol`, `created_at`, `updated_at`, `estado`, `sucursal_id`, `remember_token`) 
VALUES ('1','Walter','Alvarado','Balcón','df@hotmail.com','','0979365042','1104537228','admin',
  '$2y$10$f0wo8Vz56fKN3CjUYn7C.eRO9F/L7hVj3ZxrPSKpimOc88RdSxsqW','administrador','','','1','1','');
