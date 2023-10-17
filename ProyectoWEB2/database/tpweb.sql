-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2023 a las 14:22:04
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
-- Base de datos: `tpweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actualizaciones`
--

CREATE TABLE `actualizaciones` (
  `IDActualizaciones` int(10) NOT NULL,
  `Fecha` date NOT NULL,
  `Nuevo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `actualizaciones`
--

INSERT INTO `actualizaciones` (`IDActualizaciones`, `Fecha`, `Nuevo`) VALUES
(1, '2024-03-13', 'PLAN Z'),
(2, '2024-08-13', 'PLAN X'),
(3, '2025-01-01', 'PLAN W');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inversiones`
--

CREATE TABLE `inversiones` (
  `IDInversiones` int(10) NOT NULL,
  `IDUsuario` int(10) NOT NULL,
  `IDPlan` int(10) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `inversiones`
--

INSERT INTO `inversiones` (`IDInversiones`, `IDUsuario`, `IDPlan`, `Fecha`) VALUES
(1, 1, 1, '2023-10-16'),
(2, 1, 2, '2023-03-13'),
(3, 1, 3, '2022-12-20'),
(4, 1, 4, '2023-06-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `ID` int(10) NOT NULL,
  `Plan` varchar(50) NOT NULL,
  `Duracion` int(10) NOT NULL,
  `Precio` int(10) NOT NULL,
  `Porcentaje` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`ID`, `Plan`, `Duracion`, `Precio`, `Porcentaje`) VALUES
(1, 'PLAN A', 10, 20, 10),
(2, 'PLAN B', 210, 1000, 90),
(3, 'PLAN C', 360, 10000, 100),
(4, 'PLAN D', 150, 100000, 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IDUsuario` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IDUsuario`, `UserName`, `Password`) VALUES
(1, 'webadmin', '$2y$10$mKti4TjvIAhKgwfPvdXk5Oy8AWbvPrvDb2jw4lOm0rjiNTfgbMR66');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actualizaciones`
--
ALTER TABLE `actualizaciones`
  ADD PRIMARY KEY (`IDActualizaciones`);

--
-- Indices de la tabla `inversiones`
--
ALTER TABLE `inversiones`
  ADD PRIMARY KEY (`IDInversiones`),
  ADD KEY `IDUsuario` (`IDUsuario`),
  ADD KEY `IDPlan` (`IDPlan`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IDUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actualizaciones`
--
ALTER TABLE `actualizaciones`
  MODIFY `IDActualizaciones` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `inversiones`
--
ALTER TABLE `inversiones`
  MODIFY `IDInversiones` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IDUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inversiones`
--
ALTER TABLE `inversiones`
  ADD CONSTRAINT `inversiones_ibfk_1` FOREIGN KEY (`IDPlan`) REFERENCES `planes` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inversiones_ibfk_2` FOREIGN KEY (`IDUsuario`) REFERENCES `usuarios` (`IDUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
