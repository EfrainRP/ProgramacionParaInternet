-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2024 a las 07:07:58
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
-- Base de datos: `d02`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `apellidos` varchar(128) NOT NULL,
  `correo` varchar(128) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `rol` int(1) NOT NULL,
  `archivo_n` varchar(255) NOT NULL,
  `archivo` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `apellidos`, `correo`, `pass`, `rol`, `archivo_n`, `archivo`, `status`, `eliminado`) VALUES
(1, 'Efrain', 'Robles Pulido', 'efrain.robles@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 'efra.png', '99e3524a2987766ac65a1ec10ab52ceb.png', 1, 0),
(2, 'Pedro', 'Lomeli Gaspar', 'pedro123@mail.com', 'd3ce9efea6244baa7bf718f12dd0c331', 1, '', '', 1, 0),
(3, 'Miguel', 'Gonzales Gallo', 'miguel@mail.com', 'miguel123', 2, '', '', 1, 0),
(4, 'Marco', 'Polo Madrid', 'marco@gmail.com', 'marco456', 1, '', '', 1, 0),
(5, 'Andrea', 'Perez Rubio', 'andrea@alumnos.udg', 'andre789', 2, '', '', 1, 0),
(6, 'Saul', 'Palacios Villa', 'saul@mail.mx', 'saul012', 1, '', '', 1, 0),
(7, 'Oliver', 'Sanchez', 'oliver@mail.com', 'e99a18c428cb38d5f260853678922e03', 2, '', '', 1, 0),
(8, 'Estefania', 'Lopez', 'lopez@mail.com', 'f9ffc9631679d3ff03da5a93cfcf1433', 1, '', '', 1, 0),
(9, 'Pepe', 'Gomez Diaz', 'pepe@mail.com', '5e783f68bbe280088d77a82cbd235a0d', 1, '', '', 1, 0),
(10, 'Lola', 'Arias Dominguez', 'paola@mail.com', 'e3c7ea9fe0fe7b6cca63a58d4ce990b0', 2, 'Alicia.png', '3844edcac1d74d900cf0fa30d56764f5.png', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
