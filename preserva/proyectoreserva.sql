
-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-07-2020 a las 07:16:03
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectoreserva`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE `laboratorio` (
  `Codigo_laboratorio` int(11) NOT NULL,
  `Capacidad` int(11) NOT NULL,
  `Carrera` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `Codigo_Reserva` int(11) NOT NULL,
  `Rut` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Rut_Encargado` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Bloques` int(11) NOT NULL,
  `Codigo_Laboratorio` int(11) NOT NULL,
  `Capacidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_de_reserva`
--

CREATE TABLE `solicitud_de_reserva` (
  `Codigo_solicitud` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Rut` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Capacidad` int(11) NOT NULL,
  `Bloques` int(11) NOT NULL,
  `Correo_Electronico` varchar(30) NOT NULL,
  `Telefono` int(11) NOT NULL,
  `Estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `users` (
  `Rut` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Apellido` varchar(30) NOT NULL,
  `Tipo_usuario` varchar(30) NOT NULL,
  `Estado` varchar(30) NOT NULL,
  `Ciudad` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`Codigo_laboratorio`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`Codigo_Reserva`),
  ADD KEY `Rut` (`Rut`),
  ADD KEY `Rut_Encargado` (`Rut_Encargado`),
  ADD KEY `Codigo_Laboratorio` (`Codigo_Laboratorio`),
  ADD KEY `Nombre` (`Nombre`);

--
-- Indices de la tabla `solicitud_de_reserva`
--
ALTER TABLE `solicitud_de_reserva`
  ADD PRIMARY KEY (`Codigo_solicitud`),
  ADD KEY `Rut` (`Rut`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Rut`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `Codigo_laboratorio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `Codigo_Reserva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_de_reserva`
--
ALTER TABLE `solicitud_de_reserva`
  MODIFY `Codigo_solicitud` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`Codigo_Laboratorio`) REFERENCES `laboratorio` (`Codigo_laboratorio`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`Rut`) REFERENCES `users` (`Rut`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservas_ibfk_3` FOREIGN KEY (`Rut_Encargado`) REFERENCES `users` (`Rut`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud_de_reserva`
--
ALTER TABLE `solicitud_de_reserva`
  ADD CONSTRAINT `solicitud_de_reserva_ibfk_1` FOREIGN KEY (`Rut`) REFERENCES `users` (`Rut`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
