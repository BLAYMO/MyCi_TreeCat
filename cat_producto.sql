-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 11-08-2016 a las 08:50:44
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `myci_cattree`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_producto`
--

CREATE TABLE `cat_producto` (
  `id_categoria` int(11) NOT NULL,
  `id_padre` int(11) NOT NULL DEFAULT '0',
  `tiene_hijos` varchar(2) NOT NULL DEFAULT 'NO',
  `categoria` varchar(60) NOT NULL DEFAULT 'Categoria',
  `descripcion_cat` varchar(120) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL COMMENT 'Informacion complemetaria',
  `alta` datetime DEFAULT NULL COMMENT 'Fecha de ALTA',
  `baja` datetime DEFAULT NULL COMMENT 'Fecha de BAJA',
  `modificado` datetime DEFAULT NULL COMMENT 'Fecha de ultimo combio',
  `nivel` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Segundo nivel de clasificacion del catalogo';

--
-- Volcado de datos para la tabla `cat_producto`
--

INSERT INTO `cat_producto` (`id_categoria`, `id_padre`, `tiene_hijos`, `categoria`, `descripcion_cat`, `alta`, `baja`, `modificado`, `nivel`) VALUES
(1, 0, 'SI', 'Carnes', 'Prueba del programa', '2016-08-07 00:00:00', '0000-00-00 00:00:00', '2016-08-08 11:08:36', 0),
(2, 0, 'SI', 'Pescados', NULL, '2016-08-08 09:00:26', '0000-00-00 00:00:00', '2016-08-10 09:03:26', 0),
(3, 0, 'NO', 'Arroces', NULL, '2016-08-08 09:01:31', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(4, 0, 'NO', 'Sopas', NULL, '2016-08-08 09:01:42', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(5, 0, 'NO', 'Postres', NULL, '2016-08-08 09:17:35', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(6, 0, 'NO', 'Bebidas', NULL, '2016-08-08 09:19:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(7, 1, 'SI', 'Ternera', 'Prueba subcategoria', '2016-08-08 09:30:05', '0000-00-00 00:00:00', '2016-08-10 08:56:56', 1),
(8, 7, 'SI', 'Ternera asada', 'Prueba dia 10', '2016-08-08 09:31:59', '0000-00-00 00:00:00', '2016-08-10 09:01:01', 2),
(9, 1, 'NO', 'Cerdo', NULL, '2016-08-08 09:32:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(10, 8, 'NO', 'Ternera asada gallega', 'Prueba susb-subcategoria', '2016-08-08 11:25:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(11, 0, 'NO', 'Ensaladas', 'Descripcion de la categoria ensaladas', '2016-08-10 09:01:27', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(12, 2, 'NO', 'Pescado blanco', 'Descripcion de la categoria pescado blanco', '2016-08-10 09:02:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(13, 2, 'NO', 'Pescado azul', 'Descripcion de la categoria pescado azul', '2016-08-10 09:02:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cat_producto`
--
ALTER TABLE `cat_producto`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `id_padre` (`id_padre`),
  ADD KEY `nivel` (`nivel`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cat_producto`
--
ALTER TABLE `cat_producto`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
