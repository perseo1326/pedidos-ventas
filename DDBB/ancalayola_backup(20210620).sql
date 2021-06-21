-- --------------------------------------------------------
-- Host:                         192.168.1.101
-- Versión del servidor:         8.0.25-0ubuntu0.20.04.1 - (Ubuntu)
-- SO del servidor:              Linux
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para ancalayola
DROP DATABASE IF EXISTS `ancalayola`;
CREATE DATABASE IF NOT EXISTS `ancalayola` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ancalayola`;

-- Volcando estructura para tabla ancalayola.categorias
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `cat_id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `cat_codigo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cat_nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cat_descripcion` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cat_padre` smallint unsigned DEFAULT NULL,
  `cat_nivel` tinyint NOT NULL DEFAULT '0',
  `cat_status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'A',
  UNIQUE KEY `cat_id` (`cat_id`),
  UNIQUE KEY `cat_codigo` (`cat_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='En esta tabla se encontraran TODAS las categorias y subcategorias que se vayan creando.  Las categorias padres tendran en su campo "cat_padre" un null o 0 (cero) y las demas DEBERAN  tener una referencia a una categoria dentro de la misma tabla la cual será su categoria PADRE. Tambien hay un campo "cat_nivel" para indicar el nivel de profundidad de la categoria en cuestion, esto para facilitar la busqueda de categorias de bajos niveles en caso de ser necesario.';

-- Volcando datos para la tabla ancalayola.categorias: ~8 rows (aproximadamente)
DELETE FROM `categorias`;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`cat_id`, `cat_codigo`, `cat_nombre`, `cat_descripcion`, `cat_padre`, `cat_nivel`, `cat_status`) VALUES
	(1, 'B', 'bebidas', 'bebidas', NULL, 0, 'A'),
	(2, 'P', 'panuchos', 'productos ventas primarias', NULL, 0, 'A'),
	(3, 'extra', 'extras', 'Productos extras como dulces, salsas, acompañantes (zanahoria), panques, etc', NULL, 0, 'A'),
	(4, 'Refr', 'refrescos', 'refrescos embotellados', 1, 1, 'A'),
	(5, 'AgS', 'aguas_sabores', 'Aguas de sabores preparadas artesanales', 1, 1, 'A'),
	(6, 'AgB', 'agua', 'agua embotellada', 1, 1, 'A'),
	(7, 'coca', 'coca-cola', 'productos coca-cola ', 3, 2, 'A'),
	(8, 'ORefr', 'refrescos-varios', 'otros refrescos embotellados', 3, 2, 'A');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla ancalayola.DetallePedido
DROP TABLE IF EXISTS `DetallePedido`;
CREATE TABLE IF NOT EXISTS `DetallePedido` (
  `detallePedido_id` int unsigned NOT NULL AUTO_INCREMENT,
  `detallePedido_PedidoNum` int unsigned NOT NULL,
  `detallePedido_precioUnidad` decimal(10,2) NOT NULL COMMENT 'contiene el precio con el que fue vendido el producto en su momento.',
  `detallePedido_cantidad` tinyint NOT NULL,
  `detallePedido_ProductoId` int unsigned NOT NULL,
  PRIMARY KEY (`detallePedido_id`),
  KEY `IDX_numPedido` (`detallePedido_PedidoNum`),
  KEY `IDX_Producto` (`detallePedido_ProductoId`),
  CONSTRAINT `FK_DetallePedido_Pedidos` FOREIGN KEY (`detallePedido_PedidoNum`) REFERENCES `Pedidos` (`pedidos_numPedido`),
  CONSTRAINT `FK_DetallePedido_productos` FOREIGN KEY (`detallePedido_ProductoId`) REFERENCES `productos` (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=319 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla ancalayola.DetallePedido: ~148 rows (aproximadamente)
DELETE FROM `DetallePedido`;
/*!40000 ALTER TABLE `DetallePedido` DISABLE KEYS */;
INSERT INTO `DetallePedido` (`detallePedido_id`, `detallePedido_PedidoNum`, `detallePedido_precioUnidad`, `detallePedido_cantidad`, `detallePedido_ProductoId`) VALUES
	(156, 1, 35.00, 2, 17),
	(157, 1, 25.00, 1, 13),
	(158, 1, 40.00, 1, 26),
	(159, 1, 60.00, 3, 35),
	(160, 1, 30.00, 2, 14),
	(161, 1, 45.00, 1, 1),
	(162, 1, 23.00, 1, 2),
	(163, 1, 45.00, 1, 3),
	(164, 1, 20.00, 2, 39),
	(165, 1, 20.00, 1, 40),
	(166, 1, 20.00, 3, 41),
	(167, 1, 50.00, 1, 44),
	(168, 2, 30.00, 2, 21),
	(169, 2, 40.00, 2, 24),
	(170, 2, 25.00, 4, 7),
	(171, 2, 35.00, 2, 17),
	(172, 2, 40.00, 2, 26),
	(173, 2, 30.00, 3, 9),
	(174, 2, 40.00, 1, 20),
	(175, 2, 30.00, 3, 23),
	(176, 2, 35.00, 1, 15),
	(185, 3, 35.00, 2, 17),
	(186, 3, 30.00, 1, 14),
	(187, 3, 30.00, 1, 10),
	(188, 3, 23.00, 1, 6),
	(189, 3, 20.00, 2, 41),
	(197, 4, 40.00, 2, 26),
	(198, 4, 30.00, 1, 14),
	(199, 4, 60.00, 1, 35),
	(200, 4, 50.00, 2, 44),
	(201, 4, 20.00, 1, 45),
	(202, 4, 20.00, 2, 46),
	(203, 4, 20.00, 1, 47),
	(204, 5, 25.00, 1, 8),
	(205, 5, 30.00, 1, 10),
	(206, 6, 40.00, 10, 26),
	(207, 7, 25.00, 1, 8),
	(208, 7, 45.00, 1, 3),
	(209, 7, 23.00, 2, 6),
	(210, 8, 35.00, 1, 17),
	(211, 8, 45.00, 2, 27),
	(212, 8, 35.00, 2, 28),
	(213, 8, 45.00, 1, 3),
	(214, 8, 23.00, 1, 6),
	(215, 8, 10.00, 1, 43),
	(216, 9, 50.00, 1, 32),
	(217, 9, 45.00, 1, 3),
	(218, 9, 23.00, 1, 6),
	(219, 10, 40.00, 15, 26),
	(220, 10, 45.00, 3, 38),
	(221, 10, 30.00, 4, 33),
	(222, 10, 23.00, 1, 2),
	(223, 10, 45.00, 2, 3),
	(224, 11, 45.00, 1, 38),
	(225, 11, 25.00, 1, 8),
	(226, 12, 25.00, 1, 8),
	(227, 12, 30.00, 8, 21),
	(228, 12, 25.00, 1, 7),
	(229, 12, 45.00, 1, 1),
	(230, 12, 23.00, 1, 4),
	(231, 13, 30.00, 1, 14),
	(232, 13, 25.00, 2, 8),
	(233, 13, 23.00, 1, 6),
	(234, 14, 30.00, 1, 14),
	(235, 14, 25.00, 2, 8),
	(236, 14, 23.00, 1, 6),
	(237, 15, 30.00, 1, 14),
	(238, 15, 25.00, 2, 8),
	(239, 15, 23.00, 1, 6),
	(240, 16, 30.00, 1, 14),
	(241, 16, 25.00, 2, 8),
	(242, 16, 23.00, 1, 6),
	(243, 17, 30.00, 1, 14),
	(244, 17, 25.00, 2, 8),
	(245, 17, 23.00, 1, 6),
	(246, 18, 30.00, 1, 14),
	(247, 18, 25.00, 2, 8),
	(248, 18, 23.00, 1, 6),
	(249, 19, 30.00, 1, 14),
	(250, 19, 25.00, 2, 8),
	(251, 19, 23.00, 1, 6),
	(252, 20, 30.00, 1, 14),
	(253, 20, 25.00, 2, 8),
	(254, 20, 23.00, 1, 6),
	(255, 21, 30.00, 1, 14),
	(256, 21, 25.00, 2, 8),
	(257, 21, 23.00, 1, 6),
	(258, 22, 30.00, 1, 14),
	(259, 22, 25.00, 2, 8),
	(260, 22, 23.00, 1, 6),
	(261, 23, 30.00, 1, 14),
	(262, 23, 25.00, 2, 8),
	(263, 23, 23.00, 1, 6),
	(264, 24, 30.00, 1, 14),
	(265, 24, 25.00, 2, 8),
	(266, 24, 23.00, 1, 6),
	(267, 25, 45.00, 2, 18),
	(268, 25, 55.00, 1, 34),
	(269, 25, 30.00, 1, 21),
	(270, 25, 45.00, 1, 38),
	(271, 25, 45.00, 1, 1),
	(272, 25, 10.00, 1, 43),
	(273, 25, 20.00, 1, 46),
	(274, 26, 45.00, 2, 18),
	(275, 26, 55.00, 1, 34),
	(276, 26, 30.00, 1, 21),
	(277, 26, 45.00, 1, 38),
	(278, 26, 45.00, 1, 1),
	(279, 26, 10.00, 1, 43),
	(280, 26, 20.00, 1, 46),
	(281, 27, 45.00, 2, 18),
	(282, 27, 55.00, 1, 34),
	(283, 27, 30.00, 1, 21),
	(284, 27, 45.00, 1, 38),
	(285, 27, 45.00, 1, 1),
	(286, 27, 10.00, 1, 43),
	(287, 27, 20.00, 1, 46),
	(288, 28, 35.00, 15, 17),
	(289, 28, 30.00, 1, 14),
	(290, 28, 30.00, 1, 33),
	(291, 28, 23.00, 1, 4),
	(292, 28, 23.00, 1, 6),
	(293, 28, 20.00, 1, 40),
	(294, 29, 35.00, 4, 17),
	(295, 29, 30.00, 1, 14),
	(296, 29, 25.00, 3, 13),
	(297, 29, 30.00, 1, 9),
	(298, 29, 23.00, 1, 2),
	(299, 30, 35.00, 4, 17),
	(300, 30, 30.00, 1, 14),
	(301, 30, 25.00, 3, 13),
	(302, 30, 30.00, 1, 9),
	(303, 30, 23.00, 1, 2),
	(304, 31, 40.00, 2, 12),
	(305, 32, 40.00, 2, 12),
	(306, 33, 25.00, 1, 13),
	(307, 34, 30.00, 2, 14),
	(308, 34, 40.00, 2, 26),
	(309, 34, 45.00, 1, 18),
	(310, 35, 25.00, 1, 13),
	(311, 36, 25.00, 1, 13),
	(312, 37, 30.00, 1, 21),
	(313, 37, 25.00, 1, 13),
	(314, 37, 40.00, 1, 12),
	(315, 37, 50.00, 1, 22),
	(316, 37, 30.00, 1, 10),
	(317, 37, 25.00, 1, 7),
	(318, 38, 25.00, 1, 13);
/*!40000 ALTER TABLE `DetallePedido` ENABLE KEYS */;

-- Volcando estructura para tabla ancalayola.ingredientes
DROP TABLE IF EXISTS `ingredientes`;
CREATE TABLE IF NOT EXISTS `ingredientes` (
  `ingred_id` smallint NOT NULL AUTO_INCREMENT,
  `ingred_codigo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ingred_tipo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ingred_ingrediente` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ingred_descripcion` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ingred_presentacion` tinyint NOT NULL,
  `ingred_imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ingred_status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`ingred_id`),
  UNIQUE KEY `ingred_id` (`ingred_id`),
  UNIQUE KEY `ingred_codigo` (`ingred_codigo`),
  KEY `FK_ingredientes_presentacion` (`ingred_presentacion`),
  CONSTRAINT `FK_ingredientes_presentacion` FOREIGN KEY (`ingred_presentacion`) REFERENCES `presentacion` (`presentacion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='listado de ingredientes usados para identificar un producto (panucho).';

-- Volcando datos para la tabla ancalayola.ingredientes: ~10 rows (aproximadamente)
DELETE FROM `ingredientes`;
/*!40000 ALTER TABLE `ingredientes` DISABLE KEYS */;
INSERT INTO `ingredientes` (`ingred_id`, `ingred_codigo`, `ingred_tipo`, `ingred_ingrediente`, `ingred_descripcion`, `ingred_presentacion`, `ingred_imagen`, `ingred_status`) VALUES
	(1, 'indef', 'indef', 'Indefinido', 'Indefinido o no conocido', 1, 'NULL', 'A'),
	(2, 'pollo', 'pedido', 'Pollo', 'Pollo deshebrado para rellenos de los panuchos.', 2, 'pollo.png', 'A'),
	(3, 'cerdo', 'pedido', 'Cerdo', 'Cerdo deshebrado para rellenos de los panuchos', 2, 'cerdo_face.png', 'A'),
	(4, 'res', 'pedido', 'Res', 'Res deshebrado para rellenos de los panuchos', 2, 'res.png', 'A'),
	(5, 'queso', 'pedido', 'Queso', 'Queso Manchego y Hebra para relleno de panuchos', 2, 'queso.png', 'A'),
	(6, 'bola', 'pedido', 'Q. Bola', 'Queso de Bola para rellono de panuchos', 2, 'bola.png', 'A'),
	(7, 'camaron', 'pedido', 'Camarón', 'Camaron para relleno de panuchos', 2, 'camaron.png', 'A'),
	(8, 'frijol', 'pedido', 'Frijol', 'Frijol refrito para relleno de panuchos', 2, 'frijol.png', 'A'),
	(9, 'azucar', 'pedido', 'Azúcar', 'Mezcla de azúcar y queso para relleno de panuchos', 2, 'sugar_cube.png', 'A'),
	(10, 'manual', 'pedido', 'Manual', 'Pedido de edicion manual', 1, 'manual.png', 'N');
/*!40000 ALTER TABLE `ingredientes` ENABLE KEYS */;

-- Volcando estructura para tabla ancalayola.Pedidos
DROP TABLE IF EXISTS `Pedidos`;
CREATE TABLE IF NOT EXISTS `Pedidos` (
  `pedidos_id` int unsigned NOT NULL AUTO_INCREMENT,
  `pedidos_numPedido` int unsigned NOT NULL,
  `pedidos_nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `pedidos_fCreacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `pedidos_fModificacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `pedidos_tipo` enum('-','AQUI','HABLO') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'tipo de pedido, si el pedido fue realizado por TELEFONO o PRESENCIAL (aqui)',
  `pedidos_numTelefono` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'numero de telefono en caso de haber realizado el pedido por TELEFONO.',
  `pedidos_estado` enum('CREACION','PEDIDO','PREPARACION','TERMINADO','ENTREGADO') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'define el estado actual del pedido, EN PROCESO, TERMINADO Y ENTREGADO.',
  `pedidos_pagado` enum('Y','N') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'N' COMMENT 'indica si el pedido esta actualmente PAGADO o aun en estado DEBE.',
  `pedidos_formaPago` enum('-','EFECTIVO','TRANSFERENCIA') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'define si el pago se realizo en EFECTIVO o por medio de TRANSFERENCIA.',
  `pedidos_numTransfer` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'en caso de haberse hecho el pago por medio de transferencia, aqui estará el numero de transacción.',
  `pedidos_total` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'total del costo del pedido pagado por el cliente.',
  `pedidos_destino` enum('-','AQUI','LLEVAR','MIXTO') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'indica si el pedido va a ser para LLEVAR, consumir en el LOCAL, o MIXTO (llevar y consumir en el local)',
  `pedidos_fConsolidar` datetime DEFAULT NULL COMMENT 'para efectos de contabilidad, fecha de cuando se ejecute un corte como un cierre de jornada sobre este registro.',
  `pedidos_ordenJSON` json NOT NULL COMMENT 'formato JSON del pedido.',
  `pedidos_usuarioId` int unsigned NOT NULL,
  `pedidos_notas` varchar(3000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'espacio reservado para notas acerca del pedido',
  PRIMARY KEY (`pedidos_id`),
  UNIQUE KEY `pedidos_id_UNIQUE` (`pedidos_id`),
  UNIQUE KEY `pedidos_numPedido_UNIQUE` (`pedidos_numPedido`),
  KEY `FK_pedidos_usuarios_idx` (`pedidos_usuarioId`),
  CONSTRAINT `FK_pedidos_usuarios` FOREIGN KEY (`pedidos_usuarioId`) REFERENCES `usuarios` (`usuarios_id`)
) ENGINE=InnoDB AUTO_INCREMENT=210 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla ancalayola.Pedidos: ~38 rows (aproximadamente)
DELETE FROM `Pedidos`;
/*!40000 ALTER TABLE `Pedidos` DISABLE KEYS */;
INSERT INTO `Pedidos` (`pedidos_id`, `pedidos_numPedido`, `pedidos_nombre`, `pedidos_fCreacion`, `pedidos_fModificacion`, `pedidos_tipo`, `pedidos_numTelefono`, `pedidos_estado`, `pedidos_pagado`, `pedidos_formaPago`, `pedidos_numTransfer`, `pedidos_total`, `pedidos_destino`, `pedidos_fConsolidar`, `pedidos_ordenJSON`, `pedidos_usuarioId`, `pedidos_notas`) VALUES
	(121, 1, 'pedro', '2021-05-01 16:30:35', '2021-05-01 16:30:35', 'HABLO', '9932520949', 'CREACION', 'Y', 'TRANSFERENCIA', 'asdf123', 658.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "ABIERTO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "35", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 17, "saborTexto": ["Pollo", "Queso"], "descripcion": "Pollo / Queso", "saborCodigo": ["pollo", "queso"], "codigoProducto": "p-pq"}}], "nombrePlato": "ceci"}, {"status": "CERRADO", "cantTotal": 3, "elementos": [{"cantidad": 1, "producto": {"precio": "35", "tomate": true, "cebolla": false, "qRayado": true, "verdura": false, "frijolTop": true, "productoID": 17, "saborTexto": ["Pollo", "Queso"], "descripcion": "Pollo / Queso", "saborCodigo": ["pollo", "queso"], "codigoProducto": "p-pq"}}, {"cantidad": 1, "producto": {"precio": "25", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": false, "productoID": 13, "saborTexto": ["Frijol"], "descripcion": "Frijol", "saborCodigo": ["frijol"], "codigoProducto": "p-f"}}, {"cantidad": 1, "producto": {"precio": "40", "tomate": false, "cebolla": false, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 26, "saborTexto": ["Res", "Queso"], "descripcion": "Res / Queso", "saborCodigo": ["res", "queso"], "codigoProducto": "p-rq"}}], "nombrePlato": "john"}, {"status": "CERRADO", "cantTotal": 3, "elementos": [{"cantidad": 3, "producto": {"precio": "60", "tomate": false, "cebolla": false, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 35, "saborTexto": ["Q. Bola", "Camarón"], "descripcion": "Q. Bola / Camarón", "saborCodigo": ["bola", "camaron"], "codigoProducto": "p-bk"}}], "nombrePlato": "pedro"}, {"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "30", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": false, "productoID": 14, "saborTexto": ["Azúcar"], "descripcion": "Azúcar", "saborCodigo": ["azucar"], "codigoProducto": "p-a"}}], "nombrePlato": ""}], "bebidasJSON": [{"id": 1, "codigo": "hor1lt", "nombre": "Horchata Litro", "precio": 45, "cantidad": 1}, {"id": 2, "codigo": "hor05lt", "nombre": "Horchata 500ml", "precio": 23, "cantidad": 1}, {"id": 3, "codigo": "jam1lt", "nombre": "Jamaica Litro", "precio": 45, "cantidad": 1}, {"id": 39, "codigo": "cc-coca06", "nombre": "Coca-Cola 600ml", "precio": 20, "cantidad": 2}, {"id": 40, "codigo": "cc-light06", "nombre": "Coca Light 600ml", "precio": 20, "cantidad": 1}, {"id": 41, "codigo": "cc-zero06", "nombre": "Coca Sin Azucar 600ml", "precio": 20, "cantidad": 3}, {"id": 44, "codigo": "cc-fam3", "nombre": "Coca 3Lt", "precio": 50, "cantidad": 1}]}', 1, NULL),
	(122, 2, 'lic carlos omar huerta', '2021-05-08 16:48:58', '2021-05-08 16:48:58', 'HABLO', '9931525433', 'CREACION', 'N', 'EFECTIVO', '', 645.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 2, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 21, "saborTexto": ["Cerdo", "Queso"], "descripcion": "Cerdo / Queso", "saborCodigo": ["cerdo", "queso"], "codigoProducto": "p-cq"}}, {"cantidad": 1, "producto": {"precio": "40", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 24, "saborTexto": ["Cerdo", "Queso", "Frijol"], "descripcion": "Cerdo / Queso / Frijol", "saborCodigo": ["cerdo", "queso", "frijol"], "codigoProducto": "p-cqf"}}], "nombrePlato": "Angelica"}, {"status": "CERRADO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "25", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 7, "saborTexto": ["Pollo"], "descripcion": "Pollo", "saborCodigo": ["pollo"], "codigoProducto": "p-p"}}], "nombrePlato": "Omar"}, {"status": "CERRADO", "cantTotal": 2, "elementos": [{"cantidad": 1, "producto": {"precio": "35", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 17, "saborTexto": ["Pollo", "Queso"], "descripcion": "Pollo / Queso", "saborCodigo": ["pollo", "queso"], "codigoProducto": "p-pq"}}, {"cantidad": 1, "producto": {"precio": "40", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 26, "saborTexto": ["Res", "Queso"], "descripcion": "Res / Queso", "saborCodigo": ["res", "queso"], "codigoProducto": "p-rq"}}], "nombrePlato": "Lucero"}, {"status": "CERRADO", "cantTotal": 2, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 9, "saborTexto": ["Res"], "descripcion": "Res", "saborCodigo": ["res"], "codigoProducto": "p-r"}}, {"cantidad": 1, "producto": {"precio": "40", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 26, "saborTexto": ["Res", "Queso"], "descripcion": "Res / Queso", "saborCodigo": ["res", "queso"], "codigoProducto": "p-rq"}}], "nombrePlato": "Candy"}, {"status": "CERRADO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "40", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 20, "saborTexto": ["Pollo", "Queso", "Frijol"], "descripcion": "Pollo / Queso / Frijol", "saborCodigo": ["pollo", "queso", "frijol"], "codigoProducto": "p-pqf"}}], "nombrePlato": "Jorge"}, {"status": "CERRADO", "cantTotal": 2, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 21, "saborTexto": ["Cerdo", "Queso"], "descripcion": "Cerdo / Queso", "saborCodigo": ["cerdo", "queso"], "codigoProducto": "p-cq"}}, {"cantidad": 1, "producto": {"precio": "30", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 23, "saborTexto": ["Cerdo", "Frijol"], "descripcion": "Cerdo / Frijol", "saborCodigo": ["cerdo", "frijol"], "codigoProducto": "p-cf"}}], "nombrePlato": "Alvaro"}, {"status": "CERRADO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 23, "saborTexto": ["Cerdo", "Frijol"], "descripcion": "Cerdo / Frijol", "saborCodigo": ["cerdo", "frijol"], "codigoProducto": "p-cf"}}], "nombrePlato": "Valente"}, {"status": "CERRADO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "30", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 9, "saborTexto": ["Res"], "descripcion": "Res", "saborCodigo": ["res"], "codigoProducto": "p-r"}}], "nombrePlato": "Vergel"}, {"status": "CERRADO", "cantTotal": 2, "elementos": [{"cantidad": 1, "producto": {"precio": "35", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 17, "saborTexto": ["Pollo", "Queso"], "descripcion": "Pollo / Queso", "saborCodigo": ["pollo", "queso"], "codigoProducto": "p-pq"}}, {"cantidad": 1, "producto": {"precio": "40", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 24, "saborTexto": ["Cerdo", "Queso", "Frijol"], "descripcion": "Cerdo / Queso / Frijol", "saborCodigo": ["cerdo", "queso", "frijol"], "codigoProducto": "p-cqf"}}], "nombrePlato": "Celia"}, {"status": "CERRADO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 23, "saborTexto": ["Cerdo", "Frijol"], "descripcion": "Cerdo / Frijol", "saborCodigo": ["cerdo", "frijol"], "codigoProducto": "p-cf"}}], "nombrePlato": "Tilo"}, {"status": "CERRADO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "35", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 15, "saborTexto": ["Pollo", "Cerdo"], "descripcion": "Pollo / Cerdo", "saborCodigo": ["pollo", "cerdo"], "codigoProducto": "p-pc"}}], "nombrePlato": "Toño"}, {"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "25", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 7, "saborTexto": ["Pollo"], "descripcion": "Pollo", "saborCodigo": ["pollo"], "codigoProducto": "p-p"}}], "nombrePlato": "Lic damian"}], "bebidasJSON": null}', 1, 'esta es una nota tomada para mostrar el funcionamiento de las notas en los diferentes pe3didos.'),
	(166, 3, 'juan', '2021-05-18 17:53:37', '2021-05-18 17:53:37', 'AQUI', '', 'PREPARACION', 'Y', 'EFECTIVO', '', 193.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 3, "elementos": [{"cantidad": 2, "producto": {"precio": "35", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 17, "saborTexto": ["Pollo", "Queso"], "descripcion": "Pollo / Queso", "saborCodigo": ["pollo", "queso"], "codigoProducto": "p-pq"}}, {"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": false, "productoID": 14, "saborTexto": ["Azúcar"], "descripcion": "Azúcar", "saborCodigo": ["azucar"], "codigoProducto": "p-a"}}], "nombrePlato": ""}, {"status": "ABIERTO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 10, "saborTexto": ["Queso"], "descripcion": "Queso", "saborCodigo": ["queso"], "codigoProducto": "p-q"}}], "nombrePlato": "juan"}], "bebidasJSON": [{"id": 6, "codigo": "choco05ml", "nombre": "Chocomilk 500ml", "precio": 23, "cantidad": 1}, {"id": 41, "codigo": "cc-zero06", "nombre": "Coca Sin Azucar 600ml", "precio": 20, "cantidad": 2}]}', 1, NULL),
	(174, 4, 'pedro', '2021-05-18 18:28:30', '2021-05-18 18:28:30', 'AQUI', '', 'PREPARACION', 'N', 'EFECTIVO', '', 350.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 3, "elementos": [{"cantidad": 2, "producto": {"precio": "40", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 26, "saborTexto": ["Res", "Queso"], "descripcion": "Res / Queso", "saborCodigo": ["res", "queso"], "codigoProducto": "p-rq"}}, {"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": false, "productoID": 14, "saborTexto": ["Azúcar"], "descripcion": "Azúcar", "saborCodigo": ["azucar"], "codigoProducto": "p-a"}}], "nombrePlato": "pedro"}, {"status": "ABIERTO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "60", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 35, "saborTexto": ["Q. Bola", "Camarón"], "descripcion": "Q. Bola / Camarón", "saborCodigo": ["bola", "camaron"], "codigoProducto": "p-bk"}}], "nombrePlato": "maria"}], "bebidasJSON": [{"id": 44, "codigo": "cc-fam3", "nombre": "Coca 3Lt", "precio": 50, "cantidad": 2}, {"id": 45, "codigo": "r-fannar06", "nombre": "Fanta Naranja 600ml", "precio": 20, "cantidad": 1}, {"id": 46, "codigo": "r-fanfre06", "nombre": "Fanta Fresa 600ml", "precio": 20, "cantidad": 2}, {"id": 47, "codigo": "r-sen06", "nombre": "Sensao 600ml", "precio": 20, "cantidad": 1}]}', 1, NULL),
	(175, 5, 'jair', '2021-05-18 18:29:51', '2021-05-18 18:29:51', 'AQUI', '', 'PREPARACION', 'Y', 'TRANSFERENCIA', '123456', 55.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "25", "tomate": false, "cebolla": false, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 8, "saborTexto": ["Cerdo"], "descripcion": "Cerdo", "saborCodigo": ["cerdo"], "codigoProducto": "p-c"}}], "nombrePlato": ""}, {"status": "ABIERTO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": false, "productoID": 10, "saborTexto": ["Queso"], "descripcion": "Queso", "saborCodigo": ["queso"], "codigoProducto": "p-q"}}], "nombrePlato": ""}], "bebidasJSON": null}', 1, NULL),
	(176, 6, 'rosa', '2021-05-18 18:31:14', '2021-05-18 18:31:14', 'AQUI', '', 'PREPARACION', 'Y', 'EFECTIVO', '', 400.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 10, "elementos": [{"cantidad": 10, "producto": {"precio": "40", "tomate": false, "cebolla": false, "qRayado": false, "verdura": true, "frijolTop": true, "productoID": 26, "saborTexto": ["Res", "Queso"], "descripcion": "Res / Queso", "saborCodigo": ["res", "queso"], "codigoProducto": "p-rq"}}], "nombrePlato": ""}], "bebidasJSON": null}', 1, NULL),
	(177, 7, 'john', '2021-05-25 17:33:57', '2021-05-25 17:33:57', 'HABLO', '123', 'PREPARACION', 'Y', 'TRANSFERENCIA', '456', 116.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "ABIERTO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "25", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 8, "saborTexto": ["Cerdo"], "descripcion": "Cerdo", "saborCodigo": ["cerdo"], "codigoProducto": "p-c"}}], "nombrePlato": ""}], "bebidasJSON": [{"id": 3, "codigo": "jam1lt", "nombre": "Jamaica Litro", "precio": 45, "cantidad": 1}, {"id": 6, "codigo": "choco05ml", "nombre": "Chocomilk 500ml", "precio": 23, "cantidad": 2}]}', 1, NULL),
	(178, 8, 'john', '2021-06-03 10:35:59', '2021-06-03 10:35:59', 'AQUI', '', 'PREPARACION', 'Y', 'EFECTIVO', '', 273.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 3, "elementos": [{"cantidad": 1, "producto": {"precio": "35", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 17, "saborTexto": ["Pollo", "Queso"], "descripcion": "Pollo / Queso", "saborCodigo": ["pollo", "queso"], "codigoProducto": "p-pq"}}, {"cantidad": 2, "producto": {"precio": "45", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 27, "saborTexto": ["Res", "Q. Bola"], "descripcion": "Res / Q. Bola", "saborCodigo": ["res", "bola"], "codigoProducto": "p-rb"}}], "nombrePlato": ""}, {"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "35", "tomate": false, "cebolla": false, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 28, "saborTexto": ["Res", "Frijol"], "descripcion": "Res / Frijol", "saborCodigo": ["res", "frijol"], "codigoProducto": "p-rf "}}], "nombrePlato": "john"}], "bebidasJSON": [{"id": 3, "codigo": "jam1lt", "nombre": "Jamaica Litro", "precio": 45, "cantidad": 1}, {"id": 6, "codigo": "choco05ml", "nombre": "Chocomilk 500ml", "precio": 23, "cantidad": 1}, {"id": 43, "codigo": "cc-vidrio023", "nombre": "Coca Botellita 233ml", "precio": 10, "cantidad": 1}]}', 1, NULL),
	(179, 9, 'yola', '2021-06-03 17:56:38', '2021-06-03 17:56:38', 'HABLO', '9932777878', 'PREPARACION', 'Y', 'EFECTIVO', '', 118.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "ABIERTO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "50", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 32, "saborTexto": ["Queso", "Camarón"], "descripcion": "Queso / Camarón", "saborCodigo": ["queso", "camaron"], "codigoProducto": "p-qk"}}], "nombrePlato": ""}], "bebidasJSON": [{"id": 3, "codigo": "jam1lt", "nombre": "Jamaica Litro", "precio": 45, "cantidad": 1}, {"id": 6, "codigo": "choco05ml", "nombre": "Chocomilk 500ml", "precio": 23, "cantidad": 1}]}', 1, NULL),
	(180, 10, 'carlos', '2021-06-07 09:42:29', '2021-06-07 09:42:29', 'HABLO', '9932777878', 'PREPARACION', 'N', 'TRANSFERENCIA', 'k', 968.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 15, "elementos": [{"cantidad": 15, "producto": {"precio": "40", "tomate": false, "cebolla": false, "qRayado": true, "verdura": false, "frijolTop": true, "productoID": 26, "saborTexto": ["Res", "Queso"], "descripcion": "Res / Queso", "saborCodigo": ["res", "queso"], "codigoProducto": "p-rq"}}], "nombrePlato": ""}, {"status": "CERRADO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "45", "tomate": true, "cebolla": false, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 38, "saborTexto": ["Camarón", "Frijol"], "descripcion": "Camarón / Frijol", "saborCodigo": ["camaron", "frijol"], "codigoProducto": "p-kf"}}], "nombrePlato": "Juan"}, {"status": "CERRADO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "45", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 38, "saborTexto": ["Camarón", "Frijol"], "descripcion": "Camarón / Frijol", "saborCodigo": ["camaron", "frijol"], "codigoProducto": "p-kf"}}], "nombrePlato": ""}, {"status": "CERRADO", "cantTotal": 4, "elementos": [{"cantidad": 4, "producto": {"precio": "30", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 33, "saborTexto": ["Queso", "Frijol"], "descripcion": "Queso / Frijol", "saborCodigo": ["queso", "frijol"], "codigoProducto": "p-qf"}}], "nombrePlato": ""}], "bebidasJSON": [{"id": 2, "codigo": "hor05lt", "nombre": "Horchata 500ml", "precio": 23, "cantidad": 1}, {"id": 3, "codigo": "jam1lt", "nombre": "Jamaica Litro", "precio": 45, "cantidad": 2}]}', 1, NULL),
	(181, 11, 'lic carlos omar huerta', '2021-06-07 09:48:09', '2021-06-07 09:48:09', 'AQUI', '', 'PREPARACION', 'Y', 'EFECTIVO', '', 70.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 1, "producto": {"precio": "45", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 38, "saborTexto": ["Camarón", "Frijol"], "descripcion": "Camarón / Frijol", "saborCodigo": ["camaron", "frijol"], "codigoProducto": "p-kf"}}, {"cantidad": 1, "producto": {"precio": "25", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 8, "saborTexto": ["Cerdo"], "descripcion": "Cerdo", "saborCodigo": ["cerdo"], "codigoProducto": "p-c"}}], "nombrePlato": ""}], "bebidasJSON": null}', 1, NULL),
	(182, 12, 'jorge', '2021-06-07 10:04:33', '2021-06-07 10:04:33', 'AQUI', '', 'PREPARACION', 'Y', 'EFECTIVO', '', 358.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 2, "elementos": [{"cantidad": 1, "producto": {"precio": "25", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 8, "saborTexto": ["Cerdo"], "descripcion": "Cerdo", "saborCodigo": ["cerdo"], "codigoProducto": "p-c"}}, {"cantidad": 1, "producto": {"precio": "30", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 21, "saborTexto": ["Cerdo", "Queso"], "descripcion": "Cerdo / Queso", "saborCodigo": ["cerdo", "queso"], "codigoProducto": "p-cq"}}], "nombrePlato": "Lezama"}, {"status": "CERRADO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 21, "saborTexto": ["Cerdo", "Queso"], "descripcion": "Cerdo / Queso", "saborCodigo": ["cerdo", "queso"], "codigoProducto": "p-cq"}}], "nombrePlato": "Bertha"}, {"status": "CERRADO", "cantTotal": 3, "elementos": [{"cantidad": 3, "producto": {"precio": "30", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 21, "saborTexto": ["Cerdo", "Queso"], "descripcion": "Cerdo / Queso", "saborCodigo": ["cerdo", "queso"], "codigoProducto": "p-cq"}}], "nombrePlato": "Chely"}, {"status": "CERRADO", "cantTotal": 3, "elementos": [{"cantidad": 3, "producto": {"precio": "30", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 21, "saborTexto": ["Cerdo", "Queso"], "descripcion": "Cerdo / Queso", "saborCodigo": ["cerdo", "queso"], "codigoProducto": "p-cq"}}], "nombrePlato": "Dagoberto"}, {"status": "ABIERTO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "25", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 7, "saborTexto": ["Pollo"], "descripcion": "Pollo", "saborCodigo": ["pollo"], "codigoProducto": "p-p"}}], "nombrePlato": "Dagoberto"}], "bebidasJSON": [{"id": 1, "codigo": "hor1lt", "nombre": "Horchata Litro", "precio": 45, "cantidad": 1}, {"id": 4, "codigo": "jam05lt", "nombre": "Jamaica 500ml", "precio": 23, "cantidad": 1}]}', 1, NULL),
	(183, 13, 'john', '2021-06-13 12:49:55', '2021-06-13 12:49:55', 'AQUI', '', 'CREACION', 'Y', 'EFECTIVO', '', 103.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": false, "productoID": 14, "saborTexto": ["Azúcar"], "descripcion": "Azúcar", "saborCodigo": ["azucar"], "codigoProducto": "p-a"}}], "nombrePlato": ""}, {"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "25", "tomate": false, "cebolla": false, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 8, "saborTexto": ["Cerdo"], "descripcion": "Cerdo", "saborCodigo": ["cerdo"], "codigoProducto": "p-c"}}], "nombrePlato": "john"}], "bebidasJSON": [{"id": 6, "codigo": "choco05ml", "nombre": "Chocomilk 500ml", "precio": 23, "cantidad": 1}]}', 1, NULL),
	(184, 14, 'john', '2021-06-13 12:52:18', '2021-06-13 12:52:18', 'AQUI', '', 'CREACION', 'Y', 'EFECTIVO', '', 103.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": false, "productoID": 14, "saborTexto": ["Azúcar"], "descripcion": "Azúcar", "saborCodigo": ["azucar"], "codigoProducto": "p-a"}}], "nombrePlato": ""}, {"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "25", "tomate": false, "cebolla": false, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 8, "saborTexto": ["Cerdo"], "descripcion": "Cerdo", "saborCodigo": ["cerdo"], "codigoProducto": "p-c"}}], "nombrePlato": "john"}], "bebidasJSON": [{"id": 6, "codigo": "choco05ml", "nombre": "Chocomilk 500ml", "precio": 23, "cantidad": 1}]}', 1, NULL),
	(185, 15, 'john', '2021-06-13 12:52:56', '2021-06-13 12:52:56', 'AQUI', '', 'PREPARACION', 'Y', 'EFECTIVO', '', 103.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": false, "productoID": 14, "saborTexto": ["Azúcar"], "descripcion": "Azúcar", "saborCodigo": ["azucar"], "codigoProducto": "p-a"}}], "nombrePlato": ""}, {"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "25", "tomate": false, "cebolla": false, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 8, "saborTexto": ["Cerdo"], "descripcion": "Cerdo", "saborCodigo": ["cerdo"], "codigoProducto": "p-c"}}], "nombrePlato": "john"}], "bebidasJSON": [{"id": 6, "codigo": "choco05ml", "nombre": "Chocomilk 500ml", "precio": 23, "cantidad": 1}]}', 1, NULL),
	(186, 16, 'john', '2021-06-13 12:54:43', '2021-06-13 12:54:43', 'AQUI', '', 'PREPARACION', 'N', 'EFECTIVO', '', 103.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": false, "productoID": 14, "saborTexto": ["Azúcar"], "descripcion": "Azúcar", "saborCodigo": ["azucar"], "codigoProducto": "p-a"}}], "nombrePlato": ""}, {"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "25", "tomate": false, "cebolla": false, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 8, "saborTexto": ["Cerdo"], "descripcion": "Cerdo", "saborCodigo": ["cerdo"], "codigoProducto": "p-c"}}], "nombrePlato": "john"}], "bebidasJSON": [{"id": 6, "codigo": "choco05ml", "nombre": "Chocomilk 500ml", "precio": 23, "cantidad": 1}]}', 1, NULL),
	(187, 17, 'john', '2021-06-13 12:55:34', '2021-06-13 12:55:34', 'AQUI', '', 'PREPARACION', 'Y', 'EFECTIVO', '', 103.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": false, "productoID": 14, "saborTexto": ["Azúcar"], "descripcion": "Azúcar", "saborCodigo": ["azucar"], "codigoProducto": "p-a"}}], "nombrePlato": ""}, {"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "25", "tomate": false, "cebolla": false, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 8, "saborTexto": ["Cerdo"], "descripcion": "Cerdo", "saborCodigo": ["cerdo"], "codigoProducto": "p-c"}}], "nombrePlato": "john"}], "bebidasJSON": [{"id": 6, "codigo": "choco05ml", "nombre": "Chocomilk 500ml", "precio": 23, "cantidad": 1}]}', 1, NULL),
	(188, 18, 'john', '2021-06-13 12:57:20', '2021-06-13 12:57:20', 'AQUI', '', 'PREPARACION', 'Y', 'EFECTIVO', '', 103.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": false, "productoID": 14, "saborTexto": ["Azúcar"], "descripcion": "Azúcar", "saborCodigo": ["azucar"], "codigoProducto": "p-a"}}], "nombrePlato": ""}, {"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "25", "tomate": false, "cebolla": false, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 8, "saborTexto": ["Cerdo"], "descripcion": "Cerdo", "saborCodigo": ["cerdo"], "codigoProducto": "p-c"}}], "nombrePlato": "john"}], "bebidasJSON": [{"id": 6, "codigo": "choco05ml", "nombre": "Chocomilk 500ml", "precio": 23, "cantidad": 1}]}', 1, NULL),
	(189, 19, 'john', '2021-06-13 12:57:44', '2021-06-13 12:57:44', 'AQUI', '', 'PREPARACION', 'N', 'EFECTIVO', '', 103.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": false, "productoID": 14, "saborTexto": ["Azúcar"], "descripcion": "Azúcar", "saborCodigo": ["azucar"], "codigoProducto": "p-a"}}], "nombrePlato": ""}, {"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "25", "tomate": false, "cebolla": false, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 8, "saborTexto": ["Cerdo"], "descripcion": "Cerdo", "saborCodigo": ["cerdo"], "codigoProducto": "p-c"}}], "nombrePlato": "john"}], "bebidasJSON": [{"id": 6, "codigo": "choco05ml", "nombre": "Chocomilk 500ml", "precio": 23, "cantidad": 1}]}', 1, NULL),
	(190, 20, 'john', '2021-06-13 13:00:06', '2021-06-13 13:00:06', 'AQUI', '', 'CREACION', 'Y', 'EFECTIVO', '', 103.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": false, "productoID": 14, "saborTexto": ["Azúcar"], "descripcion": "Azúcar", "saborCodigo": ["azucar"], "codigoProducto": "p-a"}}], "nombrePlato": ""}, {"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "25", "tomate": false, "cebolla": false, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 8, "saborTexto": ["Cerdo"], "descripcion": "Cerdo", "saborCodigo": ["cerdo"], "codigoProducto": "p-c"}}], "nombrePlato": "john"}], "bebidasJSON": [{"id": 6, "codigo": "choco05ml", "nombre": "Chocomilk 500ml", "precio": 23, "cantidad": 1}]}', 1, NULL),
	(191, 21, 'john', '2021-06-13 13:02:20', '2021-06-13 13:02:20', 'AQUI', '', 'PREPARACION', 'N', 'EFECTIVO', '', 103.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": false, "productoID": 14, "saborTexto": ["Azúcar"], "descripcion": "Azúcar", "saborCodigo": ["azucar"], "codigoProducto": "p-a"}}], "nombrePlato": ""}, {"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "25", "tomate": false, "cebolla": false, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 8, "saborTexto": ["Cerdo"], "descripcion": "Cerdo", "saborCodigo": ["cerdo"], "codigoProducto": "p-c"}}], "nombrePlato": "john"}], "bebidasJSON": [{"id": 6, "codigo": "choco05ml", "nombre": "Chocomilk 500ml", "precio": 23, "cantidad": 1}]}', 1, NULL),
	(192, 22, 'john', '2021-06-13 13:03:32', '2021-06-13 13:03:32', 'AQUI', '', 'PREPARACION', 'N', 'EFECTIVO', '', 103.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": false, "productoID": 14, "saborTexto": ["Azúcar"], "descripcion": "Azúcar", "saborCodigo": ["azucar"], "codigoProducto": "p-a"}}], "nombrePlato": ""}, {"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "25", "tomate": false, "cebolla": false, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 8, "saborTexto": ["Cerdo"], "descripcion": "Cerdo", "saborCodigo": ["cerdo"], "codigoProducto": "p-c"}}], "nombrePlato": "john"}], "bebidasJSON": [{"id": 6, "codigo": "choco05ml", "nombre": "Chocomilk 500ml", "precio": 23, "cantidad": 1}]}', 1, NULL),
	(193, 23, 'john', '2021-06-13 13:04:29', '2021-06-13 13:04:29', 'AQUI', '', 'PREPARACION', 'N', 'EFECTIVO', '', 103.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": false, "productoID": 14, "saborTexto": ["Azúcar"], "descripcion": "Azúcar", "saborCodigo": ["azucar"], "codigoProducto": "p-a"}}], "nombrePlato": ""}, {"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "25", "tomate": false, "cebolla": false, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 8, "saborTexto": ["Cerdo"], "descripcion": "Cerdo", "saborCodigo": ["cerdo"], "codigoProducto": "p-c"}}], "nombrePlato": "john"}], "bebidasJSON": [{"id": 6, "codigo": "choco05ml", "nombre": "Chocomilk 500ml", "precio": 23, "cantidad": 1}]}', 1, NULL),
	(194, 24, 'john', '2021-06-13 13:05:02', '2021-06-13 13:05:02', 'AQUI', '', 'PREPARACION', 'Y', 'EFECTIVO', '', 103.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": false, "productoID": 14, "saborTexto": ["Azúcar"], "descripcion": "Azúcar", "saborCodigo": ["azucar"], "codigoProducto": "p-a"}}], "nombrePlato": ""}, {"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "25", "tomate": false, "cebolla": false, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 8, "saborTexto": ["Cerdo"], "descripcion": "Cerdo", "saborCodigo": ["cerdo"], "codigoProducto": "p-c"}}], "nombrePlato": "john"}], "bebidasJSON": [{"id": 6, "codigo": "choco05ml", "nombre": "Chocomilk 500ml", "precio": 23, "cantidad": 1}]}', 1, NULL),
	(195, 25, 'pepe', '2021-06-14 12:35:45', '2021-06-14 12:35:45', 'HABLO', '2711601', 'CREACION', 'N', 'EFECTIVO', '', 295.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 3, "elementos": [{"cantidad": 2, "producto": {"precio": "45", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 18, "saborTexto": ["Pollo", "Q. Bola"], "descripcion": "Pollo / Q. Bola", "saborCodigo": ["pollo", "bola"], "codigoProducto": "p-pb"}}, {"cantidad": 1, "producto": {"precio": "55", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": true, "productoID": 34, "saborTexto": ["Queso", "Camarón", "Frijol"], "descripcion": "Queso / Camarón / Frijol", "saborCodigo": ["queso", "camaron", "frijol"], "codigoProducto": "p-qkf"}}], "nombrePlato": "john"}, {"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": false, "productoID": 21, "saborTexto": ["Cerdo", "Queso"], "descripcion": "Cerdo / Queso", "saborCodigo": ["cerdo", "queso"], "codigoProducto": "p-cq"}}, {"cantidad": 1, "producto": {"precio": "45", "tomate": false, "cebolla": true, "qRayado": false, "verdura": true, "frijolTop": true, "productoID": 38, "saborTexto": ["Camarón", "Frijol"], "descripcion": "Camarón / Frijol", "saborCodigo": ["camaron", "frijol"], "codigoProducto": "p-kf"}}], "nombrePlato": "pepe"}], "bebidasJSON": [{"id": 1, "codigo": "hor1lt", "nombre": "Horchata Litro", "precio": 45, "cantidad": 1}, {"id": 43, "codigo": "cc-vidrio023", "nombre": "Coca Botellita 233ml", "precio": 10, "cantidad": 1}, {"id": 46, "codigo": "r-fanfre06", "nombre": "Fanta Fresa 600ml", "precio": 20, "cantidad": 1}]}', 1, NULL),
	(196, 26, 'pepe', '2021-06-14 12:36:34', '2021-06-14 12:36:34', 'HABLO', '2711601', 'CREACION', 'N', 'EFECTIVO', '', 295.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 3, "elementos": [{"cantidad": 2, "producto": {"precio": "45", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 18, "saborTexto": ["Pollo", "Q. Bola"], "descripcion": "Pollo / Q. Bola", "saborCodigo": ["pollo", "bola"], "codigoProducto": "p-pb"}}, {"cantidad": 1, "producto": {"precio": "55", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": true, "productoID": 34, "saborTexto": ["Queso", "Camarón", "Frijol"], "descripcion": "Queso / Camarón / Frijol", "saborCodigo": ["queso", "camaron", "frijol"], "codigoProducto": "p-qkf"}}], "nombrePlato": "john"}, {"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": false, "productoID": 21, "saborTexto": ["Cerdo", "Queso"], "descripcion": "Cerdo / Queso", "saborCodigo": ["cerdo", "queso"], "codigoProducto": "p-cq"}}, {"cantidad": 1, "producto": {"precio": "45", "tomate": false, "cebolla": true, "qRayado": false, "verdura": true, "frijolTop": true, "productoID": 38, "saborTexto": ["Camarón", "Frijol"], "descripcion": "Camarón / Frijol", "saborCodigo": ["camaron", "frijol"], "codigoProducto": "p-kf"}}], "nombrePlato": "pepe"}], "bebidasJSON": [{"id": 1, "codigo": "hor1lt", "nombre": "Horchata Litro", "precio": 45, "cantidad": 1}, {"id": 43, "codigo": "cc-vidrio023", "nombre": "Coca Botellita 233ml", "precio": 10, "cantidad": 1}, {"id": 46, "codigo": "r-fanfre06", "nombre": "Fanta Fresa 600ml", "precio": 20, "cantidad": 1}]}', 1, NULL),
	(197, 27, 'pepe', '2021-06-14 12:38:14', '2021-06-14 12:38:14', 'HABLO', '2711601', 'PREPARACION', 'N', 'EFECTIVO', '', 295.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 3, "elementos": [{"cantidad": 2, "producto": {"precio": "45", "tomate": true, "cebolla": true, "qRayado": true, "verdura": true, "frijolTop": true, "productoID": 18, "saborTexto": ["Pollo", "Q. Bola"], "descripcion": "Pollo / Q. Bola", "saborCodigo": ["pollo", "bola"], "codigoProducto": "p-pb"}}, {"cantidad": 1, "producto": {"precio": "55", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": true, "productoID": 34, "saborTexto": ["Queso", "Camarón", "Frijol"], "descripcion": "Queso / Camarón / Frijol", "saborCodigo": ["queso", "camaron", "frijol"], "codigoProducto": "p-qkf"}}], "nombrePlato": "john"}, {"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "qRayado": false, "verdura": false, "frijolTop": false, "productoID": 21, "saborTexto": ["Cerdo", "Queso"], "descripcion": "Cerdo / Queso", "saborCodigo": ["cerdo", "queso"], "codigoProducto": "p-cq"}}, {"cantidad": 1, "producto": {"precio": "45", "tomate": false, "cebolla": true, "qRayado": false, "verdura": true, "frijolTop": true, "productoID": 38, "saborTexto": ["Camarón", "Frijol"], "descripcion": "Camarón / Frijol", "saborCodigo": ["camaron", "frijol"], "codigoProducto": "p-kf"}}], "nombrePlato": "pepe"}], "bebidasJSON": [{"id": 1, "codigo": "hor1lt", "nombre": "Horchata Litro", "precio": 45, "cantidad": 1}, {"id": 43, "codigo": "cc-vidrio023", "nombre": "Coca Botellita 233ml", "precio": 10, "cantidad": 1}, {"id": 46, "codigo": "r-fanfre06", "nombre": "Fanta Fresa 600ml", "precio": 20, "cantidad": 1}]}', 1, NULL),
	(198, 28, 'maria', '2021-06-14 12:49:25', '2021-06-14 12:49:25', 'AQUI', '', 'PREPARACION', 'Y', 'EFECTIVO', '', 651.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 15, "elementos": [{"cantidad": 15, "producto": {"precio": "35", "tomate": true, "cebolla": true, "verdura": true, "qRallado": true, "frijolTop": true, "productoID": 17, "saborTexto": ["Pollo", "Queso"], "descripcion": "Pollo / Queso", "saborCodigo": ["pollo", "queso"], "codigoProducto": "p-pq"}}], "nombrePlato": ""}, {"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "verdura": false, "qRallado": true, "frijolTop": false, "productoID": 14, "saborTexto": ["Azúcar"], "descripcion": "Azúcar", "saborCodigo": ["azucar"], "codigoProducto": "p-a"}}, {"cantidad": 1, "producto": {"precio": "30", "tomate": true, "cebolla": true, "verdura": true, "qRallado": false, "frijolTop": true, "productoID": 33, "saborTexto": ["Queso", "Frijol"], "descripcion": "Queso / Frijol", "saborCodigo": ["queso", "frijol"], "codigoProducto": "p-qf"}}], "nombrePlato": ""}], "bebidasJSON": [{"id": 4, "codigo": "jam05lt", "nombre": "Jamaica 500ml", "precio": 23, "cantidad": 1}, {"id": 6, "codigo": "choco05ml", "nombre": "Chocomilk 500ml", "precio": 23, "cantidad": 1}, {"id": 40, "codigo": "cc-light06", "nombre": "Coca Light 600ml", "precio": 20, "cantidad": 1}]}', 1, NULL),
	(199, 29, 'carlos', '2021-06-14 16:47:33', '2021-06-14 16:47:33', 'AQUI', '', 'PREPARACION', 'Y', 'TRANSFERENCIA', '5asd', 298.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 4, "elementos": [{"cantidad": 4, "producto": {"precio": "35", "tomate": true, "cebolla": true, "verdura": true, "qRallado": true, "frijolTop": true, "productoID": 17, "saborTexto": ["Pollo", "Queso"], "descripcion": "Pollo / Queso", "saborCodigo": ["pollo", "queso"], "codigoProducto": "p-pq"}}], "nombrePlato": "john"}, {"status": "CERRADO", "cantTotal": 2, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "verdura": false, "qRallado": true, "frijolTop": true, "productoID": 14, "saborTexto": ["Azúcar"], "descripcion": "Azúcar", "saborCodigo": ["azucar"], "codigoProducto": "p-a"}}, {"cantidad": 1, "producto": {"precio": "25", "tomate": false, "cebolla": false, "verdura": true, "qRallado": true, "frijolTop": true, "productoID": 13, "saborTexto": ["Frijol"], "descripcion": "Frijol", "saborCodigo": ["frijol"], "codigoProducto": "p-f"}}], "nombrePlato": ""}, {"status": "CERRADO", "cantTotal": 3, "elementos": [{"cantidad": 2, "producto": {"precio": "25", "tomate": true, "cebolla": true, "verdura": true, "qRallado": true, "frijolTop": true, "productoID": 13, "saborTexto": ["Frijol"], "descripcion": "Frijol", "saborCodigo": ["frijol"], "codigoProducto": "p-f"}}, {"cantidad": 1, "producto": {"precio": "30", "tomate": true, "cebolla": true, "verdura": true, "qRallado": true, "frijolTop": true, "productoID": 9, "saborTexto": ["Res"], "descripcion": "Res", "saborCodigo": ["res"], "codigoProducto": "p-r"}}], "nombrePlato": "tt"}], "bebidasJSON": [{"id": 2, "codigo": "hor05lt", "nombre": "Horchata 500ml", "precio": 23, "cantidad": 1}]}', 1, NULL),
	(200, 30, 'carlos', '2021-06-14 17:00:21', '2021-06-14 17:00:21', 'AQUI', '', 'PREPARACION', 'Y', 'TRANSFERENCIA', '5asd', 298.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 4, "elementos": [{"cantidad": 4, "producto": {"precio": "35", "tomate": true, "cebolla": true, "verdura": true, "qRallado": true, "frijolTop": true, "productoID": 17, "saborTexto": ["Pollo", "Queso"], "descripcion": "Pollo / Queso", "saborCodigo": ["pollo", "queso"], "codigoProducto": "p-pq"}}], "nombrePlato": "john"}, {"status": "CERRADO", "cantTotal": 2, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "verdura": false, "qRallado": true, "frijolTop": true, "productoID": 14, "saborTexto": ["Azúcar"], "descripcion": "Azúcar", "saborCodigo": ["azucar"], "codigoProducto": "p-a"}}, {"cantidad": 1, "producto": {"precio": "25", "tomate": false, "cebolla": false, "verdura": true, "qRallado": true, "frijolTop": true, "productoID": 13, "saborTexto": ["Frijol"], "descripcion": "Frijol", "saborCodigo": ["frijol"], "codigoProducto": "p-f"}}], "nombrePlato": ""}, {"status": "CERRADO", "cantTotal": 3, "elementos": [{"cantidad": 2, "producto": {"precio": "25", "tomate": true, "cebolla": true, "verdura": true, "qRallado": true, "frijolTop": true, "productoID": 13, "saborTexto": ["Frijol"], "descripcion": "Frijol", "saborCodigo": ["frijol"], "codigoProducto": "p-f"}}, {"cantidad": 1, "producto": {"precio": "30", "tomate": true, "cebolla": true, "verdura": true, "qRallado": true, "frijolTop": true, "productoID": 9, "saborTexto": ["Res"], "descripcion": "Res", "saborCodigo": ["res"], "codigoProducto": "p-r"}}], "nombrePlato": "tt"}], "bebidasJSON": [{"id": 2, "codigo": "hor05lt", "nombre": "Horchata 500ml", "precio": 23, "cantidad": 1}]}', 1, NULL),
	(202, 31, 'carlos', '2021-06-20 13:55:26', '2021-06-20 13:55:26', 'AQUI', '', 'PREPARACION', 'Y', 'EFECTIVO', '', 80.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "40", "tomate": true, "cebolla": true, "verdura": true, "qRallado": true, "frijolTop": true, "productoID": 12, "saborTexto": ["Camarón"], "descripcion": "Camarón", "saborCodigo": ["camaron"], "codigoProducto": "p-k"}}], "nombrePlato": "carlos"}], "bebidasJSON": null}', 1, NULL),
	(203, 32, 'carlos', '2021-06-20 13:57:55', '2021-06-20 13:57:55', 'AQUI', '', 'PREPARACION', 'Y', 'EFECTIVO', '', 80.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "ABIERTO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "40", "tomate": true, "cebolla": true, "verdura": true, "qRallado": true, "frijolTop": true, "productoID": 12, "saborTexto": ["Camarón"], "descripcion": "Camarón", "saborCodigo": ["camaron"], "codigoProducto": "p-k"}}], "nombrePlato": "carlos"}], "bebidasJSON": null}', 1, NULL),
	(204, 33, 'e', '2021-06-20 18:48:06', '2021-06-20 18:48:06', 'AQUI', '', 'PREPARACION', 'N', 'EFECTIVO', '', 25.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "ABIERTO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "25", "tomate": false, "cebolla": false, "verdura": false, "qRallado": false, "frijolTop": false, "productoID": 13, "saborTexto": ["Frijol"], "descripcion": "Frijol", "saborCodigo": ["frijol"], "codigoProducto": "p-f"}}], "nombrePlato": ""}], "bebidasJSON": null}', 1, NULL),
	(205, 34, 'viri', '2021-06-20 18:54:43', '2021-06-20 18:54:43', 'AQUI', '', 'PREPARACION', 'Y', 'EFECTIVO', '', 185.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 2, "elementos": [{"cantidad": 2, "producto": {"precio": "30", "tomate": false, "cebolla": false, "verdura": false, "qRallado": false, "frijolTop": false, "productoID": 14, "saborTexto": ["Azúcar"], "descripcion": "Azúcar", "saborCodigo": ["azucar"], "codigoProducto": "p-a"}}], "nombrePlato": "edu"}, {"status": "CERRADO", "cantTotal": 3, "elementos": [{"cantidad": 2, "producto": {"precio": "40", "tomate": false, "cebolla": false, "verdura": true, "qRallado": false, "frijolTop": false, "productoID": 26, "saborTexto": ["Res", "Queso"], "descripcion": "Res / Queso", "saborCodigo": ["res", "queso"], "codigoProducto": "p-rq"}}, {"cantidad": 1, "producto": {"precio": "45", "tomate": false, "cebolla": false, "verdura": false, "qRallado": false, "frijolTop": false, "productoID": 18, "saborTexto": ["Pollo", "Q. Bola"], "descripcion": "Pollo / Q. Bola", "saborCodigo": ["pollo", "bola"], "codigoProducto": "p-pb"}}], "nombrePlato": "viri"}], "bebidasJSON": null}', 1, NULL),
	(206, 35, '12', '2021-06-20 18:57:17', '2021-06-20 18:57:17', 'AQUI', '', 'PREPARACION', 'Y', 'EFECTIVO', '', 25.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "ABIERTO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "25", "tomate": false, "cebolla": false, "verdura": false, "qRallado": false, "frijolTop": false, "productoID": 13, "saborTexto": ["Frijol"], "descripcion": "Frijol", "saborCodigo": ["frijol"], "codigoProducto": "p-f"}}], "nombrePlato": ""}], "bebidasJSON": null}', 1, NULL),
	(207, 36, '12', '2021-06-20 19:02:02', '2021-06-20 19:02:02', 'AQUI', '', 'PREPARACION', 'Y', 'EFECTIVO', '', 25.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "ABIERTO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "25", "tomate": false, "cebolla": false, "verdura": false, "qRallado": false, "frijolTop": false, "productoID": 13, "saborTexto": ["Frijol"], "descripcion": "Frijol", "saborCodigo": ["frijol"], "codigoProducto": "p-f"}}], "nombrePlato": ""}], "bebidasJSON": null}', 1, NULL),
	(208, 37, 'edu', '2021-06-20 19:03:58', '2021-06-20 19:03:58', 'AQUI', '', 'PREPARACION', 'N', 'EFECTIVO', '', 200.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "CERRADO", "cantTotal": 3, "elementos": [{"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": false, "verdura": false, "qRallado": false, "frijolTop": false, "productoID": 21, "saborTexto": ["Cerdo", "Queso"], "descripcion": "Cerdo / Queso", "saborCodigo": ["cerdo", "queso"], "codigoProducto": "p-cq"}}, {"cantidad": 1, "producto": {"precio": "25", "tomate": false, "cebolla": false, "verdura": false, "qRallado": false, "frijolTop": true, "productoID": 13, "saborTexto": ["Frijol"], "descripcion": "Frijol", "saborCodigo": ["frijol"], "codigoProducto": "p-f"}}, {"cantidad": 1, "producto": {"precio": "40", "tomate": false, "cebolla": false, "verdura": true, "qRallado": false, "frijolTop": false, "productoID": 12, "saborTexto": ["Camarón"], "descripcion": "Camarón", "saborCodigo": ["camaron"], "codigoProducto": "p-k"}}], "nombrePlato": "edu"}, {"status": "CERRADO", "cantTotal": 3, "elementos": [{"cantidad": 1, "producto": {"precio": "50", "tomate": false, "cebolla": false, "verdura": false, "qRallado": true, "frijolTop": false, "productoID": 22, "saborTexto": ["Cerdo", "Q. Bola"], "descripcion": "Cerdo / Q. Bola", "saborCodigo": ["cerdo", "bola"], "codigoProducto": "p-cb"}}, {"cantidad": 1, "producto": {"precio": "30", "tomate": false, "cebolla": true, "verdura": false, "qRallado": false, "frijolTop": false, "productoID": 10, "saborTexto": ["Queso"], "descripcion": "Queso", "saborCodigo": ["queso"], "codigoProducto": "p-q"}}, {"cantidad": 1, "producto": {"precio": "25", "tomate": true, "cebolla": false, "verdura": false, "qRallado": false, "frijolTop": false, "productoID": 7, "saborTexto": ["Pollo"], "descripcion": "Pollo", "saborCodigo": ["pollo"], "codigoProducto": "p-p"}}], "nombrePlato": ""}], "bebidasJSON": null}', 1, NULL),
	(209, 38, 'qwer', '2021-06-20 19:12:26', '2021-06-20 19:12:26', 'AQUI', '', 'PREPARACION', 'N', 'EFECTIVO', '', 25.00, 'LLEVAR', NULL, '{"pedidoJSON": [{"status": "ABIERTO", "cantTotal": 1, "elementos": [{"cantidad": 1, "producto": {"precio": "25", "tomate": false, "cebolla": false, "verdura": false, "qRallado": false, "frijolTop": false, "productoID": 13, "saborTexto": ["Frijol"], "descripcion": "Frijol", "saborCodigo": ["frijol"], "codigoProducto": "p-f"}}], "nombrePlato": ""}], "bebidasJSON": null}', 1, NULL);
/*!40000 ALTER TABLE `Pedidos` ENABLE KEYS */;

-- Volcando estructura para tabla ancalayola.presentacion
DROP TABLE IF EXISTS `presentacion`;
CREATE TABLE IF NOT EXISTS `presentacion` (
  `presentacion_id` tinyint NOT NULL AUTO_INCREMENT,
  `presentacion_codigo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `presentacion_nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `presentacion_descripcion` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `presentacion_status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'A',
  PRIMARY KEY (`presentacion_id`),
  UNIQUE KEY `presentacion_id` (`presentacion_id`),
  UNIQUE KEY `presentacion_codigo` (`presentacion_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='presentacion, unidad de medida o porcion para un producto determinado. en esta tabla se definen los tipos de medidas o porciones que seran usadas por los productos. Ej: litro (lt), medio litro (500ml), 355 ml, unidad, etc.';

-- Volcando datos para la tabla ancalayola.presentacion: ~8 rows (aproximadamente)
DELETE FROM `presentacion`;
/*!40000 ALTER TABLE `presentacion` DISABLE KEYS */;
INSERT INTO `presentacion` (`presentacion_id`, `presentacion_codigo`, `presentacion_nombre`, `presentacion_descripcion`, `presentacion_status`) VALUES
	(1, 'indef', 'Indefinida', 'Indefinida - desconocida', 'A'),
	(2, 'und', 'unidad', 'Unidad minima de medida', 'A'),
	(3, '3Lt', '3 Lt', '3Lt - Liquidos', 'A'),
	(4, 'lt', 'Litro', 'Litro - liquidos', 'A'),
	(5, '600ml', '600 ml', '600 ml - liquidos', 'A'),
	(6, '500ml', '500 ml - 1/2 lt', 'Medio litro - liquidos', 'A'),
	(7, '355ml', '355 ml', '355 ml - Liquidos', 'A'),
	(8, '233ml', '233 ml', '233 ml - Liquidos', 'A');
/*!40000 ALTER TABLE `presentacion` ENABLE KEYS */;

-- Volcando estructura para tabla ancalayola.productos
DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `prod_id` int unsigned NOT NULL AUTO_INCREMENT,
  `prod_codigo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prod_nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prod_categoria` smallint unsigned NOT NULL,
  `prod_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prod_precio` decimal(10,2) NOT NULL DEFAULT '0.00',
  `prod_presentacion` tinyint NOT NULL,
  `prod_ingrediente1` smallint NOT NULL DEFAULT '1',
  `prod_ingrediente2` smallint NOT NULL DEFAULT '1',
  `prod_ingrediente3` smallint NOT NULL DEFAULT '1',
  `prod_status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'A',
  `prod_imagen` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`prod_id`) USING BTREE,
  UNIQUE KEY `prod_codigo` (`prod_codigo`),
  UNIQUE KEY `prod_id` (`prod_id`),
  KEY `FK_productos_categorias` (`prod_categoria`) USING BTREE,
  KEY `FK_productos_presentacion` (`prod_presentacion`) USING BTREE,
  KEY `FK_productos_ingredientes_1` (`prod_ingrediente1`),
  KEY `FK_productos_ingredientes_2` (`prod_ingrediente2`),
  KEY `FK_productos_ingredientes_3` (`prod_ingrediente3`),
  CONSTRAINT `FK_productos_categorias` FOREIGN KEY (`prod_categoria`) REFERENCES `categorias` (`cat_id`),
  CONSTRAINT `FK_productos_ingredientes_1` FOREIGN KEY (`prod_ingrediente1`) REFERENCES `ingredientes` (`ingred_id`),
  CONSTRAINT `FK_productos_ingredientes_2` FOREIGN KEY (`prod_ingrediente2`) REFERENCES `ingredientes` (`ingred_id`),
  CONSTRAINT `FK_productos_ingredientes_3` FOREIGN KEY (`prod_ingrediente3`) REFERENCES `ingredientes` (`ingred_id`),
  CONSTRAINT `FK_productos_presentacion` FOREIGN KEY (`prod_presentacion`) REFERENCES `presentacion` (`presentacion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla ancalayola.productos: ~47 rows (aproximadamente)
DELETE FROM `productos`;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`prod_id`, `prod_codigo`, `prod_nombre`, `prod_categoria`, `prod_creacion`, `prod_precio`, `prod_presentacion`, `prod_ingrediente1`, `prod_ingrediente2`, `prod_ingrediente3`, `prod_status`, `prod_imagen`) VALUES
	(1, 'hor1lt', 'Horchata Litro', 5, '2021-04-13 17:04:27', 45.00, 4, 1, 1, 1, 'A', 'horchata-1.png'),
	(2, 'hor05lt', 'Horchata 500ml', 5, '2021-04-13 17:04:27', 23.00, 6, 1, 1, 1, 'A', 'horchata-1-2.png'),
	(3, 'jam1lt', 'Jamaica Litro', 5, '2021-04-13 17:04:27', 45.00, 4, 1, 1, 1, 'A', 'jamaica1.png'),
	(4, 'jam05lt', 'Jamaica 500ml', 5, '2021-04-13 17:04:27', 23.00, 6, 1, 1, 1, 'A', 'jamaica1-2.png'),
	(5, 'choco1lt', 'Chocomilk Litro', 5, '2021-04-13 17:04:27', 45.00, 4, 1, 1, 1, 'A', 'choco1.png'),
	(6, 'choco05ml', 'Chocomilk 500ml', 5, '2021-04-13 17:04:27', 23.00, 6, 1, 1, 1, 'A', 'choco1-2.png'),
	(7, 'p-p', 'P-Pollo', 2, '2021-04-13 17:04:27', 25.00, 2, 2, 1, 1, 'A', ''),
	(8, 'p-c', 'P-Pierna', 2, '2021-04-13 17:04:27', 25.00, 2, 3, 1, 1, 'A', ''),
	(9, 'p-r', 'P-Res', 2, '2021-04-13 17:04:27', 30.00, 2, 4, 1, 1, 'A', ''),
	(10, 'p-q', 'P-Queso  ', 2, '2021-04-13 17:04:27', 30.00, 2, 5, 1, 1, 'A', ''),
	(11, 'p-b', 'P-Bola', 2, '2021-04-13 17:04:27', 40.00, 2, 6, 1, 1, 'A', ''),
	(12, 'p-k', 'P-Camarón', 2, '2021-04-13 17:04:27', 40.00, 2, 7, 1, 1, 'A', ''),
	(13, 'p-f', 'P-Frijol', 2, '2021-04-13 17:04:27', 25.00, 2, 8, 1, 1, 'A', ''),
	(14, 'p-a', 'P-Azúcar', 2, '2021-04-13 17:04:27', 30.00, 2, 9, 1, 1, 'A', ''),
	(15, 'p-pc', 'P-Pollo-Pierna', 2, '2021-04-13 17:04:27', 35.00, 2, 2, 3, 1, 'A', ''),
	(16, 'p-pr', 'P-Pollo-Res', 2, '2021-04-13 17:04:27', 0.00, 2, 2, 4, 1, 'N', ''),
	(17, 'p-pq', 'P-Pollo-Queso', 2, '2021-04-13 17:04:27', 35.00, 2, 2, 5, 1, 'A', ''),
	(18, 'p-pb', 'P-Pollo-Bola', 2, '2021-04-13 17:04:27', 45.00, 2, 2, 6, 1, 'A', ''),
	(19, 'p-pf', 'P-Pollo-Frijol', 2, '2021-04-13 17:04:27', 35.00, 2, 2, 8, 1, 'A', ''),
	(20, 'p-pqf', 'P-Pollo-Queso-Frijol', 2, '2021-04-13 17:04:27', 40.00, 2, 2, 5, 8, 'A', ''),
	(21, 'p-cq', 'P-Pierna-Queso', 2, '2021-04-13 17:04:27', 30.00, 2, 3, 5, 1, 'A', ''),
	(22, 'p-cb', 'P-Pierna-Bola', 2, '2021-04-13 17:04:27', 50.00, 2, 3, 6, 1, 'A', ''),
	(23, 'p-cf', 'P-Pierna-Frijol', 2, '2021-04-13 17:04:27', 30.00, 2, 3, 8, 1, 'A', ''),
	(24, 'p-cqf', 'P-Pierna-Queso-Frijol', 2, '2021-04-13 17:04:27', 40.00, 2, 3, 5, 8, 'A', ''),
	(25, 'p-cbf', 'P-Pierna-Bola-Frijol', 2, '2021-04-13 17:04:27', 45.00, 2, 3, 6, 8, 'A', ''),
	(26, 'p-rq', 'P-Res-Queso', 2, '2021-04-13 17:04:27', 40.00, 2, 4, 5, 1, 'A', ''),
	(27, 'p-rb', 'P-Res-Bola', 2, '2021-04-13 17:04:27', 45.00, 2, 4, 6, 1, 'A', ''),
	(28, 'p-rf ', 'P-Res-Frijol ', 2, '2021-04-13 17:04:27', 35.00, 2, 4, 8, 1, 'A', ''),
	(29, 'p-rqf', 'P-Res-Queso-Frijol', 2, '2021-04-13 17:04:27', 45.00, 2, 4, 5, 8, 'A', ''),
	(30, 'p-rbf', 'P-Res-Bola-Frijol', 2, '2021-04-13 17:04:27', 50.00, 2, 4, 6, 8, 'A', ''),
	(31, 'p-qb', 'P-3 Quesos', 2, '2021-04-13 17:04:27', 45.00, 2, 5, 6, 1, 'A', ''),
	(32, 'p-qk', 'P-Queso-Camarón', 2, '2021-04-13 17:04:27', 50.00, 2, 5, 7, 1, 'A', ''),
	(33, 'p-qf', 'P-Queso-Frijol', 2, '2021-04-13 17:04:27', 30.00, 2, 5, 8, 1, 'A', ''),
	(34, 'p-qkf', 'P-Queso-Camarón-Frijol', 2, '2021-04-13 17:04:27', 55.00, 2, 5, 7, 8, 'A', ''),
	(35, 'p-bk', 'P-Bola-Camarón', 2, '2021-04-13 17:04:27', 60.00, 2, 6, 7, 1, 'A', ''),
	(36, 'p-bf', 'P-Bola-Frijol', 2, '2021-04-13 17:04:27', 45.00, 2, 6, 8, 1, 'A', ''),
	(37, 'p-bkf', 'P-Bola-Camarón-Frijol', 2, '2021-04-13 17:04:27', 60.00, 2, 6, 7, 8, 'A', ''),
	(38, 'p-kf', 'P-Camarón-Frijol', 2, '2021-04-13 17:04:27', 45.00, 2, 7, 8, 1, 'A', ''),
	(39, 'cc-coca06', 'Coca-Cola 600ml', 7, '2021-04-13 17:04:27', 20.00, 5, 1, 1, 1, 'A', 'cocacola.jpg'),
	(40, 'cc-light06', 'Coca Light 600ml', 7, '2021-04-13 17:04:27', 20.00, 5, 1, 1, 1, 'A', 'Coca-Cola_Light.png'),
	(41, 'cc-zero06', 'Coca Sin Azucar 600ml', 7, '2021-04-13 17:04:27', 20.00, 5, 1, 1, 1, 'A', 'coca-cola-zero.png'),
	(42, 'cc-lata035', 'Coca Lata 355ml', 7, '2021-04-13 17:04:27', 15.00, 7, 1, 1, 1, 'A', 'coca-cola-lata-355.png'),
	(43, 'cc-vidrio023', 'Coca Botellita 233ml', 7, '2021-04-13 17:04:27', 10.00, 8, 1, 1, 1, 'A', 'coca-cola-botellita.png'),
	(44, 'cc-fam3', 'Coca 3Lt', 7, '2021-04-13 17:04:27', 50.00, 3, 1, 1, 1, 'A', 'Coca-cola-3lt.png'),
	(45, 'r-fannar06', 'Fanta Naranja 600ml', 8, '2021-04-13 17:04:27', 20.00, 5, 1, 1, 1, 'A', 'fanta-naranja.jpg'),
	(46, 'r-fanfre06', 'Fanta Fresa 600ml', 8, '2021-04-13 17:04:27', 20.00, 5, 1, 1, 1, 'A', 'fanta-fresa.png'),
	(47, 'r-sen06', 'Sensao 600ml', 8, '2021-04-13 17:04:27', 20.00, 5, 1, 1, 1, 'A', 'senzao.png');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

-- Volcando estructura para tabla ancalayola.timestamps
DROP TABLE IF EXISTS `timestamps`;
CREATE TABLE IF NOT EXISTS `timestamps` (
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla ancalayola.timestamps: ~0 rows (aproximadamente)
DELETE FROM `timestamps`;
/*!40000 ALTER TABLE `timestamps` DISABLE KEYS */;
/*!40000 ALTER TABLE `timestamps` ENABLE KEYS */;

-- Volcando estructura para tabla ancalayola.tipo_usuario
DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `tipousuario_id` int NOT NULL AUTO_INCREMENT,
  `tipousuario_codigo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipousuario_nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipousuario_notas` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipousuario_status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'A',
  PRIMARY KEY (`tipousuario_id`),
  UNIQUE KEY `tipousuario_codigo` (`tipousuario_codigo`),
  UNIQUE KEY `tipousuario_id` (`tipousuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Define los  tipos de usuarios en el sistema y los perfiles que van a poseer cada uno de ellos.';

-- Volcando datos para la tabla ancalayola.tipo_usuario: ~0 rows (aproximadamente)
DELETE FROM `tipo_usuario`;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` (`tipousuario_id`, `tipousuario_codigo`, `tipousuario_nombre`, `tipousuario_notas`, `tipousuario_status`) VALUES
	(1, 'admin', 'administrador', 'usuario general con todos los privilegios.', 'A');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;

-- Volcando estructura para tabla ancalayola.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuarios_id` int unsigned NOT NULL AUTO_INCREMENT,
  `usuarios_nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `usuarios_descripcion` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `usuarios_status` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'A',
  `usuarios_tipousuario_id` int NOT NULL,
  PRIMARY KEY (`usuarios_id`),
  UNIQUE KEY `usuarios_id` (`usuarios_id`),
  UNIQUE KEY `usuarios_nombre` (`usuarios_nombre`),
  KEY `FK_usuarios_tipousuario` (`usuarios_tipousuario_id`),
  CONSTRAINT `FK_usuarios_tipousuario` FOREIGN KEY (`usuarios_tipousuario_id`) REFERENCES `tipo_usuario` (`tipousuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='contiene los diferentes usuarios del sistema, tanto los usuarios registrados (personas/perfiles) como los usuarios propios para funciones especiales del sistema.';

-- Volcando datos para la tabla ancalayola.usuarios: ~0 rows (aproximadamente)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`usuarios_id`, `usuarios_nombre`, `usuarios_descripcion`, `usuarios_status`, `usuarios_tipousuario_id`) VALUES
	(1, 'JWSK', '', 'A', 1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
