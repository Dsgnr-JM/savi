-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 02-08-2024 a las 05:09:33
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
-- Base de datos: `SAVI`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brad`
--

CREATE TABLE `brad` (
  `id_brand` int(11) NOT NULL,
  `brad_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `brad`
--

INSERT INTO `brad` (`id_brand`, `brad_name`) VALUES
(1, 'OSTEL'),
(2, 'FARRARY');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Electrodomesticos'),
(2, 'COCINA'),
(3, 'REFRIGERACION'),
(4, 'MAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `dni` varchar(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `image` varchar(150) NOT NULL,
  `location` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`dni`, `name`, `surname`, `phone`, `image`, `location`) VALUES
('10261053', 'Maria Yolanda', 'Victora', '04247714244', '', 'Bisnaca'),
('18706617', 'Gavino', 'Mejia', '04127211012', '', 'Sur de Corea'),
('30108393', 'Yoselyn', 'Victora', '04127201010', '', 'Andres Bello'),
('31744101', 'Jhoan Antonio', 'Mejia Victora', '04247079098', '', 'Bisnaca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client_enterprise`
--

CREATE TABLE `client_enterprise` (
  `id` int(11) NOT NULL,
  `dni` varchar(40) NOT NULL,
  `enterprise_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `client_enterprise`
--

INSERT INTO `client_enterprise` (`id`, `dni`, `enterprise_name`) VALUES
(1, '10261053', 'JotaDevs');

--
-- Disparadores `client_enterprise`
--
DELIMITER $$
CREATE TRIGGER `before_insert_client_enterprise` BEFORE INSERT ON `client_enterprise` FOR EACH ROW BEGIN
    IF EXISTS (SELECT * FROM client_enterprise WHERE dni = NEW.dni) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El DNI ya existe';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `dollar_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id`, `dollar_price`) VALUES
(1, 37.04);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `models`
--

CREATE TABLE `models` (
  `model_id` int(11) NOT NULL,
  `model_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `models`
--

INSERT INTO `models` (`model_id`, `model_name`) VALUES
(1, 'PEQUEÑO'),
(2, 'MEDIANO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `selling_price` float NOT NULL,
  `purchase_price` float NOT NULL,
  `category` int(50) NOT NULL,
  `models` int(11) NOT NULL,
  `brand` int(11) NOT NULL,
  `supplier` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `stock_min` int(11) NOT NULL,
  `stock_max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`code`, `name`, `photo`, `selling_price`, `purchase_price`, `category`, `models`, `brand`, `supplier`, `stock`, `stock_min`, `stock_max`) VALUES
('ELE001', 'Tornillo', '', 5.02, 2.05, 1, 1, 1, 31744101, 50, 20, 70),
('ELE002', 'Tuerca', '', 2, 1.2, 1, 1, 1, 31744101, 20, 2, 30),
('ELE003', 'Correa', '', 3, 2.3, 1, 2, 1, 31744101, 30, 10, 40),
('ELE004', 'Cable Rojo', '', 2.04, 2, 1, 2, 2, 93174101, 30, 10, 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `role` varchar(30) NOT NULL,
  `manage_stadistics` int(11) NOT NULL,
  `manage_products` int(11) NOT NULL,
  `manage_providers` int(11) NOT NULL,
  `manage_sales` int(11) NOT NULL,
  `manage_expenses` int(11) NOT NULL,
  `manage_clients` int(11) NOT NULL,
  `manage_informs` int(11) NOT NULL,
  `manage_system` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`role`, `manage_stadistics`, `manage_products`, `manage_providers`, `manage_sales`, `manage_expenses`, `manage_clients`, `manage_informs`, `manage_system`) VALUES
('administrator', 1, 1, 1, 1, 1, 1, 1, 1),
('assistant', 1, 1, 1, 1, 1, 1, 1, 0),
('seller', 0, 0, 0, 1, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sale`
--

CREATE TABLE `sale` (
  `nro_factura` varchar(50) NOT NULL,
  `client` varchar(30) NOT NULL,
  `payment` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `sale`
--

INSERT INTO `sale` (`nro_factura`, `client`, `payment`, `date`) VALUES
('0000212', '10261053', 100.42, '2024-07-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sale_product`
--

CREATE TABLE `sale_product` (
  `nro_factura` varchar(50) NOT NULL,
  `product` varchar(20) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supliers`
--

CREATE TABLE `supliers` (
  `suplier_rif` int(11) NOT NULL,
  `suplier_name` varchar(50) NOT NULL,
  `suplier_image` varchar(100) NOT NULL,
  `suplier_phone` varchar(100) NOT NULL,
  `suplier_email` varchar(100) NOT NULL,
  `suplier_location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `supliers`
--

INSERT INTO `supliers` (`suplier_rif`, `suplier_name`, `suplier_image`, `suplier_phone`, `suplier_email`, `suplier_location`) VALUES
(31744101, 'JotaDevs', 'img', '04247079090', 'jotadevs.league@gmail.com', 'Bisnaca MotoPirueta'),
(93174101, 'Vanessa.AC', 'img', '04127021010', 'tutanga@gmail.com', 'El sochi'),
(301152112, 'NicolasMaduro.AC', 'img', '042472521212', 'teroboentucarajeje@gmail.com', 'MotoPirueta*siempre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_users`
--

CREATE TABLE `tb_users` (
  `ci` int(16) NOT NULL,
  `username` varchar(24) NOT NULL,
  `name` varchar(24) NOT NULL,
  `surname` varchar(128) NOT NULL,
  `phone` varchar(24) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` varchar(100) NOT NULL,
  `photo` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_users`
--

INSERT INTO `tb_users` (`ci`, `username`, `name`, `surname`, `phone`, `password`, `role`, `photo`) VALUES
(122, 'admin', 'Dulmary', 'Torres', '', '123', 'administrator', ''),
(12101120, 'midudev', 'Miguel Angel', 'Duran', '04127072024', 'vmidu101', 'seller', ''),
(15101055, 'dulma19', 'Dulmary', 'Torres', '04247211088', 'dulma119', 'seller', ''),
(30108393, 'vainilla', 'Vanessa Coromoto', 'Teran', '', '1234', 'seller', ''),
(31744100, 'jota', 'Jota', 'Dev', '', '31744101', 'seller', ''),
(31744101, 'jotadev0', 'Jhoan', 'Mejia', '', '31744101', 'administrator', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `brad`
--
ALTER TABLE `brad`
  ADD PRIMARY KEY (`id_brand`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `client_enterprise`
--
ALTER TABLE `client_enterprise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dni` (`dni`);

--
-- Indices de la tabla `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`model_id`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`code`),
  ADD KEY `category` (`category`),
  ADD KEY `models` (`models`,`brand`),
  ADD KEY `brad` (`brand`),
  ADD KEY `supplier` (`supplier`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role`);

--
-- Indices de la tabla `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`nro_factura`),
  ADD KEY `client` (`client`),
  ADD KEY `client_2` (`client`);

--
-- Indices de la tabla `sale_product`
--
ALTER TABLE `sale_product`
  ADD KEY `nro_factura` (`nro_factura`,`product`),
  ADD KEY `product` (`product`);

--
-- Indices de la tabla `supliers`
--
ALTER TABLE `supliers`
  ADD PRIMARY KEY (`suplier_rif`);

--
-- Indices de la tabla `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`ci`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `brad`
--
ALTER TABLE `brad`
  MODIFY `id_brand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `client_enterprise`
--
ALTER TABLE `client_enterprise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `models`
--
ALTER TABLE `models`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `client_enterprise`
--
ALTER TABLE `client_enterprise`
  ADD CONSTRAINT `client_enterprise_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `client` (`dni`) ON DELETE CASCADE;

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`brand`) REFERENCES `brad` (`id_brand`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`models`) REFERENCES `models` (`model_id`),
  ADD CONSTRAINT `product_ibfk_4` FOREIGN KEY (`supplier`) REFERENCES `supliers` (`suplier_rif`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`client`) REFERENCES `client` (`dni`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sale_product`
--
ALTER TABLE `sale_product`
  ADD CONSTRAINT `sale_product_ibfk_1` FOREIGN KEY (`nro_factura`) REFERENCES `sale` (`nro_factura`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_product_ibfk_2` FOREIGN KEY (`product`) REFERENCES `product` (`code`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tb_users`
--
ALTER TABLE `tb_users`
  ADD CONSTRAINT `tb_users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`role`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
