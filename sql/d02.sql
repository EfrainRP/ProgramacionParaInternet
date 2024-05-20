-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2024 a las 04:44:10
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
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `correo` varchar(128) NOT NULL,
  `pass` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `correo`, `pass`) VALUES
(1, 'Efrain', 'efrain.robles@gmail.com', '902e756b0329c9f938111643ae5f1425'),
(2, 'marco', 'marco@mail.com', 'f5888d0bb58d611107e11f7cbc41c97a'),
(3, 'mariana', 'mariana@mail.com', 'e60408e9a55027070e3caf0550d2b4df'),
(4, 'miguel', 'miguel@mail.com', '9eb0c9605dc81a68731f61b3e0838937'),
(5, 'Oliver', 'oliver@mail.com', 'acae273a5a5c88b46b36d65a25f5f435'),
(6, 'Pepe', 'pepe@mail.com', '926e27eecdbc7a18858b3798ba99bddd');

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
(1, 'Efrain', 'Robles Pulido', 'efrain.robles@gmail.com', '902e756b0329c9f938111643ae5f1425', 1, 'Efrain.png', '99e3524a2987766ac65a1ec10ab52ceb.png', 1, 0),
(2, 'Juan', 'Gutierrez Ramos', 'juan@gmail.com', 'Abc123', 2, '', '', 1, 0),
(3, 'Miguel', 'Gonzales Gallo', 'miguel@mail.com', 'miguel123', 2, '', '', 1, 0),
(4, 'Marco', 'Polo Madrid', 'marco@gmail.com', 'marco456', 1, '', '', 1, 0),
(5, 'Andrea', 'Perez Rubio', 'andrea@alumnos.udg', 'andre789', 2, 'Andrea.png', '66b013bd0d4f0de371b32fff5639c499.png', 1, 0),
(6, 'Saul', 'Palacios Villa', 'saul@mail.mx', 'saul012', 1, '', '', 1, 0),
(7, 'Oliver', 'Sanchez', 'oliver@mail.com', 'e99a18c428cb38d5f260853678922e03', 2, '', '', 1, 0),
(8, 'Estefania', 'Lopez', 'lopez@mail.com', 'f9ffc9631679d3ff03da5a93cfcf1433', 1, 'Estefania.png', '3844edcac1d74d900cf0fa30d56764f5.png', 1, 0),
(9, 'Pepe', 'Gomez Diaz', 'pepe@mail.com', '5e783f68bbe280088d77a82cbd235a0d', 1, 'Pepe.png', 'fa01e38d3a6e74a79175ae8152fb30f6.png', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `fecha`, `id_usuario`, `status`) VALUES
(1, '2024-05-19 20:01:10', 6, 1),
(2, '2024-05-19 20:06:49', 5, 1),
(3, '2024-05-19 20:07:53', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_productos`
--

CREATE TABLE `pedidos_productos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos_productos`
--

INSERT INTO `pedidos_productos` (`id`, `id_pedido`, `id_producto`, `cantidad`, `precio`) VALUES
(1, 1, 4, 2, 4595),
(2, 1, 5, 2, 10000),
(3, 2, 3, 1, 4567),
(4, 2, 2, 2, 15000),
(5, 3, 2, 6, 15000),
(6, 3, 1, 1, 13500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `codigo` varchar(32) NOT NULL,
  `descripcion` text NOT NULL,
  `costo` double NOT NULL,
  `stock` int(11) NOT NULL,
  `archivo_n` varchar(255) NOT NULL,
  `archivo` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `codigo`, `descripcion`, `costo`, `stock`, `archivo_n`, `archivo`, `status`, `eliminado`) VALUES
(1, 'Iphone 12', '123', 'celular', 13500, 7, 'iphone.jpg', 'a7a8b65af751b37d22608d5ccb214552.jpg', 1, 0),
(2, 'Samsung', '1234', 'Celular samsung', 15000, 4, 'samsung.jpg', 'e1947a45f82c8b42cd671e530bc54507.jpg', 1, 0),
(3, 'xiomi', '12345', 'celular', 4567, 6, 'xiaomi.jpg', 'b7925ff42e233e032e256fe76bd1c3b6.jpg', 1, 0),
(4, 'Tablet', '3477', 'tablet', 4595, 3, 'TB.webp', '01ed7727f53d5f05dc02d7604a3856d5.webp', 1, 0),
(5, 'iPad 10', '9876', 'Ipad ultima generacion', 10000, 7, 'ipad.jpg', '6f2a15736fe0e76333f639798b28dd96.jpg', 1, 0),
(6, 'Laptop Lenovo', '45673', 'Laptop lenovo de 16 gb de ram', 20000, 5, 'lenovo.jpg', '3da3e24ab6639ea0285b0351dfd175bf.jpg', 1, 0),
(7, 'Laptop Dell', '34573', 'Laptop Dell modelo xxxx', 40544, 5, 'dell.jpeg', '7084599dcea2ac874a7ee87cf128de4d.jpeg', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `archivo` varchar(64) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`id`, `nombre`, `archivo`, `status`, `eliminado`) VALUES
(1, '50%', '2ef3703e52088088c2d0eb8acfff38b8.jpg', 1, 0),
(2, 'Xbox', '8589e9e3041ab8e4c3bbb2ed921fb037.png', 1, 0),
(3, 'Promocion', '3841ee0af7bd8472489a70b43c8d820f.png', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
