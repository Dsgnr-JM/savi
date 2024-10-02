-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-09-2024 a las 11:36:57
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `savi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brad`
--

CREATE TABLE `brad` (
  `id_brand` int(11) NOT NULL,
  `brad_name` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `brad`
--

INSERT INTO `brad` (`id_brand`, `brad_name`) VALUES
(1, 'OSTEL'),
(2, 'FARRARY'),
(3, 'OTROS'),
(4, 'MEWIN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Electrodomesticos'),
(2, 'COCINA'),
(3, 'REFRIGERACION'),
(4, 'MAS'),
(5, 'Toshiba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `dni` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `surname` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `image` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `location` varchar(120) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`dni`, `name`, `surname`, `phone`, `image`, `location`) VALUES
('10202010', 'Marc', 'Zuckemberg', '04121011010', '', 'Indiana'),
('10206100', 'Cristiano Ronaldo', 'Dos Santos', '04127217070', '', 'Portugal'),
('10222222', 'Jose', 'Martinez', '04127213331', '', 'Zona Alta'),
('10261053', 'Maria Yolanda', 'Victora', '04247714244', '', 'Bisnaca'),
('102864231', 'Colo', 'kas', '217648721', '', ''),
('111', 'Gojo', 'Satoru', '04125555555', '', 'Shiga'),
('12101901', 'Jose', 'de la Hoz', '04127214412', '', 'Colombia Cartajena'),
('12114703', 'Gareth', 'Bale', '93317241', '', ''),
('12114721', 'MisterS', 'Collo', '29187', '', '21987'),
('12242111', 'Roy Minzo', 'Crunch', '04247079092', '', 'California'),
('12242112', 'Roler Minz', 'Crunch', '04247079091', '', 'California'),
('12732101', 'Mocomu', '21', '124124', '', ''),
('12808110', 'Gojo', 'Mico', '04127211010', '', ''),
('12871', 'Goku', 'hjjak', '41234', '', '12'),
('17441222', 'Jose Gregorio', 'Pausides', '04122021707', '', 'Sochi'),
('18700100', 'Messi', 'Dos Santos', '04127211010', '', ''),
('18706617', 'Gavino', 'Mejia', '04127211012', '', 'Sur de Corea'),
('30108393', 'Yoselyn', 'Victora', '04127201010', '', 'Andres Bello'),
('31744100', 'Jota', 'Dev', '04247079090', '', 'CDI'),
('31744101', 'Jhoan Antonio', 'Mejia Victora', '04247079098', '', 'Bisnaca'),
('321879y63', 'Mister', 'Satoru', '78261', '', ''),
('331', 'Gojo', 'Storu', '124124', '', ''),
('3312', 'Colo', 'kmjn', '124124', '', ''),
('73311232', 'Gaby Yoselyn', 'Mejia Victora', '04127071111', '', 'Bisnaca'),
('9112393', 'Cris', 'Jnr', '9312101', '', ''),
('93714255', 'Messi', 'Astro', '04212211012', '', ''),
('987', 'Gojo', 'kmjn', '7987', '', '987');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client_enterprise`
--

CREATE TABLE `client_enterprise` (
  `id` int(11) NOT NULL,
  `dni` varchar(40) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `enterprise_name` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `client_enterprise`
--

INSERT INTO `client_enterprise` (`id`, `dni`, `enterprise_name`) VALUES
(1, '10261053', 'JotaDevs'),
(8, '12242111', 'Roles'),
(9, '10202010', 'Tesla'),
(10, '31744100', 'BellJS'),
(11, '12101901', 'JDOXX'),
(12, '17441222', 'Playgrounnd'),
(13, '73311232', 'Rollbay'),
(14, '10206100', 'CR7'),
(15, '12871', 'Milk');

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
  `dollar_price` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id`, `dollar_price`, `date`) VALUES
(1, 37, '2024-09-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `models`
--

CREATE TABLE `models` (
  `model_id` int(11) NOT NULL,
  `model_name` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `models`
--

INSERT INTO `models` (`model_id`, `model_name`) VALUES
(1, 'PEQUEÑO'),
(2, 'MEDIANO'),
(3, 'OTROS'),
(4, 'X12'),
(5, 'FIJO'),
(6, 'Bono'),
(7, 'FIJO'),
(8, 'Chimbo'),
(9, '217712');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `code` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `photo` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
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
('COC001', 'Hornilla doble', '', 2.3, 1, 2, 2, 1, 30152112, 19, 2, 12),
('COC002', 'Correa metalica', '', 1.2, 0.5, 2, 2, 1, 30152112, 19, 3, 12),
('ELE001', 'Tornillo', '', 5.02, 2.05, 1, 1, 1, 31744101, 19, 20, 70),
('ELE0011', 'Termometro analogo', '../assets/img/66ae8e0eeb996.png', 1, 0.2, 1, 1, 3, 93174101, 19, 1, 2),
('ELE002', 'Tuerca', '', 2, 1.2, 1, 1, 1, 31744101, 19, 2, 30),
('ELE003', 'Correa', '', 3, 2.3, 1, 2, 1, 31744101, 19, 10, 40),
('ELE004', 'Cable Rojo', '', 2.04, 2, 1, 2, 2, 93174101, 19, 10, 60),
('ELE005', 'Antena direccional', '', 5.23, 2.05, 1, 2, 1, 30152112, 19, 10, 50),
('ELE006', 'Cuchilla de licuadora', '', 2.1, 1.1, 1, 1, 1, 30152112, 19, 10, 50),
('ELE007', 'Conector punta fina', '../assets/img/66add8a626bc8', 12.2, 1, 1, 1, 1, 30152112, 19, 1, 10),
('ELE008', 'Conector punta fina', '../assets/img/66add8d0328dd.jpeg', 12.2, 1, 1, 1, 1, 30152112, 19, 1, 10),
('ELE009', 'Conector macho', '../assets/img/66add91aed252.png', 3.21, 2.1, 3, 2, 3, 93174101, 19, 3, 30),
('ELE010', 'Motor de lavadora', '../assets/img/66ae88ec07c3c.png', 12, 5.5, 1, 2, 3, 30152112, 19, 10, 50),
('ELE012', 'Termometro digital', '', 2.1, 2, 3, 1, 3, 30152112, 19, 1, 4),
('ELE013', 'Mecanismo Doble', '', 30, 12, 1, 2, 3, 31744101, 19, 1, 5),
('ELE014', 'Mancilla', '', 21, 20, 4, 4, 4, 31744101, 19, 4, 12),
('MAS001', 'Laton de aluminio', '', 10.2, 0.5, 4, 3, 3, 30152112, 19, 1, 40),
('MAS002', 'Arandela', '', 0.2, 0.1, 4, 1, 3, 31744101, 19, 10, 80),
('MAS003', 'Tuerca fina', '', 0.4, 0.2, 4, 1, 3, 93174101, 19, 10, 80),
('MAS004', 'Rosca gruesa', '../assets/img/66ae8477ef28d.jpeg', 10, 2, 1, 1, 1, 30152112, 19, 1, 30),
('MAS005', 'Bombilla led roja', '', 2, 1.2, 4, 1, 3, 30152112, 19, 1, 5),
('MAS007', 'Bateria de litio', '', 0.42, 0.12, 4, 1, 3, 93174101, 19, 10, 55);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `role` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
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
  `nro_factura` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `client` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `payment` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `sale`
--

INSERT INTO `sale` (`nro_factura`, `client`, `payment`, `date`) VALUES
('000001', '31744101', 2.7027, '2024-09-12'),
('000002', '31744101', 0.1892, '2024-09-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sale_product`
--

CREATE TABLE `sale_product` (
  `nro_factura` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `product` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `sale_product`
--

INSERT INTO `sale_product` (`nro_factura`, `product`, `amount`) VALUES
('000001', 'ELE001', 1),
('000001', 'ELE002', 1),
('000002', 'ELE002', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supliers`
--

CREATE TABLE `supliers` (
  `rif` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `location` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `supliers`
--

INSERT INTO `supliers` (`rif`, `name`, `image`, `phone`, `email`, `location`) VALUES
(30152112, 'Fisic.AC', '', '042472521212', 'teroboentucarajeje@gmail.com', 'Trujillo'),
(31744101, 'JotaDevs', '', '04247079090', 'jotadevs.league@gmail.com', 'Bisnaca'),
(93174101, 'Vanessa.AC', '', '04127021010', 'tutanga@gmail.com', 'El sochi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_users`
--

CREATE TABLE `tb_users` (
  `ci` int(16) NOT NULL,
  `username` varchar(24) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `name` varchar(24) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `surname` varchar(128) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `phone` varchar(24) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `role` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `photo` varchar(256) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tb_users`
--

INSERT INTO `tb_users` (`ci`, `username`, `name`, `surname`, `phone`, `password`, `role`, `photo`) VALUES
(122, 'admin', 'Dulmary', 'Torres', '', '123', 'administrator', ''),
(1210112, 'mkolo', 'Mkolo', 'Muani', '97247711220', 'muani', 'seller', ''),
(12101120, 'midudev', 'Miguel Angel', 'Duran', '04127072024', 'vmidu101', 'seller', '../assets/img/66ad53c5a86bb.png'),
(15101055, 'dulma19', 'Dulmary', 'Torres', '04247211088', 'dulma119', 'seller', ''),
(21744102, 'cucurella', 'Marc', 'Cucurella', '04217321010', 'j1234', 'seller', ''),
(30108393, 'vainilla', 'Vanessa Coromoto', 'Teran', '', '1234', 'seller', ''),
(31744100, 'jota', 'Jota', 'Dev', '', '31744101', 'seller', ''),
(31744101, 'jotadev0', 'Jhoan Antonio', 'Mejia Victora', '04247079098', 'jotadev0', 'administrator', '../assets/img/66ad2c431ffdc.png'),
(32101121, 'tato', 'Jesus', 'Dyran', '91210412889', 'tato3', 'seller', '');

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
  ADD PRIMARY KEY (`rif`);

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
  MODIFY `id_brand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `client_enterprise`
--
ALTER TABLE `client_enterprise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `models`
--
ALTER TABLE `models`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `product_ibfk_4` FOREIGN KEY (`supplier`) REFERENCES `supliers` (`rif`) ON DELETE CASCADE ON UPDATE CASCADE;

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
