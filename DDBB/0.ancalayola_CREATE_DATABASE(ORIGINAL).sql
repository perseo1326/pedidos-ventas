-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema ancalayola
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `ancalayola` ;

-- -----------------------------------------------------
-- Schema ancalayola
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ancalayola` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ;
USE `ancalayola` ;

-- -----------------------------------------------------
-- Table `ancalayola`.`tipo_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ancalayola`.`tipo_usuario` ;

CREATE TABLE IF NOT EXISTS `ancalayola`.`tipo_usuario` (
  `tipousuario_id` INT NOT NULL AUTO_INCREMENT,
  `tipousuario_codigo` VARCHAR(20) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `tipousuario_nombre` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `tipousuario_notas` VARCHAR(1000) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `tipousuario_status` VARCHAR(1) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL DEFAULT 'A',
  PRIMARY KEY (`tipousuario_id`),
  UNIQUE INDEX `tipousuario_codigo` (`tipousuario_codigo` ASC) ,
  UNIQUE INDEX `tipousuario_id` (`tipousuario_id` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci
COMMENT = 'Define los  tipos de usuarios en el sistema y los perfiles que van a poseer cada uno de ellos.';


-- -----------------------------------------------------
-- Table `ancalayola`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ancalayola`.`usuarios` ;

CREATE TABLE IF NOT EXISTS `ancalayola`.`usuarios` (
  `usuarios_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuarios_nombre` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL DEFAULT '',
  `usuarios_descripcion` VARCHAR(300) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NULL DEFAULT '0',
  `usuarios_status` CHAR(1) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL DEFAULT 'A',
  `usuarios_tipousuario_id` INT NOT NULL,
  PRIMARY KEY (`usuarios_id`),
  UNIQUE INDEX `usuarios_id` (`usuarios_id` ASC) ,
  UNIQUE INDEX `usuarios_nombre` (`usuarios_nombre` ASC) ,
  INDEX `FK_usuarios_tipousuario` (`usuarios_tipousuario_id` ASC) ,
  CONSTRAINT `FK_usuarios_tipousuario`
    FOREIGN KEY (`usuarios_tipousuario_id`)
    REFERENCES `ancalayola`.`tipo_usuario` (`tipousuario_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci
COMMENT = 'contiene los diferentes usuarios del sistema, tanto los usuarios registrados (personas/perfiles) como los usuarios propios para funciones especiales del sistema.';


-- -----------------------------------------------------
-- Table `ancalayola`.`Pedidos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ancalayola`.`Pedidos` ;

CREATE TABLE IF NOT EXISTS `ancalayola`.`Pedidos` (
  `pedidos_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `pedidos_numPedido` INT UNSIGNED NOT NULL,
  `pedidos_nombre` VARCHAR(50) NOT NULL,
  `pedidos_fCreacion` DATETIME NOT NULL DEFAULT '1000-01-01 00:00:00.000000',
  `pedidos_fModificacion` DATETIME NOT NULL DEFAULT '1000-01-01 00:00:00.000000',
  `pedidos_tipo` ENUM('-', 'AQUI', 'HABLO') NOT NULL COMMENT 'tipo de pedido, si el pedido fue realizado por TELEFONO o PRESENCIAL (aqui)',
  `pedidos_numTelefono` VARCHAR(15) NULL DEFAULT NULL COMMENT 'numero de telefono en caso de haber realizado el pedido por TELEFONO.',
  `pedidos_estado` ENUM('CREACION', 'PEDIDO', 'PREPARACION', 'TERMINADO', 'ENTREGADO') NOT NULL COMMENT 'define el estado actual del pedido, EN PREPARACION, TERMINADO Y ENTREGADO.',
  `pedidos_pagado` ENUM('Y', 'N') NOT NULL DEFAULT 'N' COMMENT 'indica si el pedido esta actualmente PAGADO o aun en estado DEBE.',
  `pedidos_formaPago` ENUM('-', 'EFECTIVO', 'TRANSFERENCIA') NOT NULL COMMENT 'define si el pago se realizo en EFECTIVO o por medio de TRANSFERENCIA.',
  `pedidos_numTransfer` VARCHAR(30) NULL DEFAULT NULL COMMENT 'en caso de haberse hecho el pago por medio de transferencia, aqui estará el numero de transacción.',
  `pedidos_total` DECIMAL(10,2) NOT NULL DEFAULT 0 COMMENT 'total del costo del pedido pagado por el cliente.',
  `pedidos_destino` ENUM('-', 'AQUI', 'LLEVAR', 'MIXTO') NOT NULL COMMENT 'indica si el pedido va a ser para LLEVAR, consumir en el LOCAL, o MIXTO (llevar y consumir en el local)',
  `pedidos_fConsolidar` DATETIME NULL DEFAULT NULL COMMENT 'para efectos de contabilidad, fecha de cuando se ejecute un corte como un cierre de jornada sobre este registro.',
  `pedidos_ordenJSON` JSON NULL COMMENT 'formato JSON del pedido.',
  `pedidos_usuarioId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`pedidos_id`),
  UNIQUE INDEX `pedidos_id_UNIQUE` (`pedidos_id` ASC) ,
  UNIQUE INDEX `pedidos_numPedido_UNIQUE` (`pedidos_numPedido` ASC) ,
  INDEX `FK_pedidos_usuarios_idx` (`pedidos_usuarioId` ASC) ,
  CONSTRAINT `FK_pedidos_usuarios`
    FOREIGN KEY (`pedidos_usuarioId`)
    REFERENCES `ancalayola`.`usuarios` (`usuarios_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci;


-- -----------------------------------------------------
-- Table `ancalayola`.`categorias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ancalayola`.`categorias` ;

CREATE TABLE IF NOT EXISTS `ancalayola`.`categorias` (
  `cat_id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_codigo` VARCHAR(20) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `cat_nombre` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `cat_descripcion` VARCHAR(1000) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `cat_padre` SMALLINT UNSIGNED NULL DEFAULT NULL,
  `cat_nivel` TINYINT NOT NULL DEFAULT '0',
  `cat_status` VARCHAR(1) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL DEFAULT 'A',
  PRIMARY KEY USING BTREE (`cat_id`),
  UNIQUE INDEX `cat_id` (`cat_id` ASC) ,
  UNIQUE INDEX `cat_codigo` (`cat_codigo` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci
COMMENT = 'En esta tabla se encontraran TODAS las categorias y subcategorias que se vayan creando.  Las categorias padres tendran en su campo \"cat_padre\" un null o 0 (cero) y las demas DEBERAN  tener una referencia a una categoria dentro de la misma tabla la cual será su categoria PADRE. Tambien hay un campo \"cat_nivel\" para indicar el nivel de profundidad de la categoria en cuestion, esto para facilitar la busqueda de categorias de bajos niveles en caso de ser necesario.';


-- -----------------------------------------------------
-- Table `ancalayola`.`presentacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ancalayola`.`presentacion` ;

CREATE TABLE IF NOT EXISTS `ancalayola`.`presentacion` (
  `presentacion_id` TINYINT NOT NULL AUTO_INCREMENT,
  `presentacion_codigo` VARCHAR(20) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `presentacion_nombre` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `presentacion_descripcion` VARCHAR(300) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `presentacion_status` VARCHAR(1) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NULL DEFAULT 'A',
  PRIMARY KEY (`presentacion_id`),
  UNIQUE INDEX `presentacion_id` (`presentacion_id` ASC) ,
  UNIQUE INDEX `presentacion_codigo` (`presentacion_codigo` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci
COMMENT = 'presentacion, unidad de medida o porcion para un producto determinado. en esta tabla se definen los tipos de medidas o porciones que seran usadas por los productos. Ej: litro (lt), medio litro (500ml), 355 ml, unidad, etc.';


-- -----------------------------------------------------
-- Table `ancalayola`.`ingredientes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ancalayola`.`ingredientes` ;

CREATE TABLE IF NOT EXISTS `ancalayola`.`ingredientes` (
  `ingred_id` SMALLINT NOT NULL AUTO_INCREMENT,
  `ingred_codigo` VARCHAR(20) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `ingred_tipo` VARCHAR(20) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NULL DEFAULT NULL,
  `ingred_ingrediente` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `ingred_descripcion` VARCHAR(300) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `ingred_presentacion` TINYINT NOT NULL,
  `ingred_imagen` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NULL DEFAULT NULL,
  `ingred_status` VARCHAR(1) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL DEFAULT 'A',
  PRIMARY KEY (`ingred_id`),
  UNIQUE INDEX `ingred_id` (`ingred_id` ASC) ,
  UNIQUE INDEX `ingred_codigo` (`ingred_codigo` ASC) ,
  INDEX `FK_ingredientes_presentacion` (`ingred_presentacion` ASC) ,
  CONSTRAINT `FK_ingredientes_presentacion`
    FOREIGN KEY (`ingred_presentacion`)
    REFERENCES `ancalayola`.`presentacion` (`presentacion_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci
COMMENT = 'listado de ingredientes usados para identificar un producto (panucho).';


-- -----------------------------------------------------
-- Table `ancalayola`.`productos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ancalayola`.`productos` ;

CREATE TABLE IF NOT EXISTS `ancalayola`.`productos` (
  `prod_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `prod_codigo` VARCHAR(20) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `prod_nombre` VARCHAR(100) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL,
  `prod_categoria` SMALLINT UNSIGNED NOT NULL,
  `prod_creacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prod_precio` DECIMAL(10,2) NOT NULL DEFAULT '0.00',
  `prod_presentacion` TINYINT NOT NULL,
  `prod_ingrediente1` SMALLINT NOT NULL DEFAULT '1',
  `prod_ingrediente2` SMALLINT NOT NULL DEFAULT '1',
  `prod_ingrediente3` SMALLINT NOT NULL DEFAULT '1',
  `prod_status` VARCHAR(1) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NOT NULL DEFAULT 'A',
  `prod_imagen` VARCHAR(300) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_general_ci' NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`prod_id`),
  UNIQUE INDEX `prod_codigo` (`prod_codigo` ASC) ,
  UNIQUE INDEX `prod_id` (`prod_id` ASC) ,
  INDEX `FK_productos_categorias` USING BTREE (`prod_categoria`) ,
  INDEX `FK_productos_presentacion` USING BTREE (`prod_presentacion`) ,
  INDEX `FK_productos_ingredientes_1` (`prod_ingrediente1` ASC) ,
  INDEX `FK_productos_ingredientes_2` (`prod_ingrediente2` ASC) ,
  INDEX `FK_productos_ingredientes_3` (`prod_ingrediente3` ASC) ,
  CONSTRAINT `FK_productos_categorias`
    FOREIGN KEY (`prod_categoria`)
    REFERENCES `ancalayola`.`categorias` (`cat_id`),
  CONSTRAINT `FK_productos_ingredientes_1`
    FOREIGN KEY (`prod_ingrediente1`)
    REFERENCES `ancalayola`.`ingredientes` (`ingred_id`),
  CONSTRAINT `FK_productos_ingredientes_2`
    FOREIGN KEY (`prod_ingrediente2`)
    REFERENCES `ancalayola`.`ingredientes` (`ingred_id`),
  CONSTRAINT `FK_productos_ingredientes_3`
    FOREIGN KEY (`prod_ingrediente3`)
    REFERENCES `ancalayola`.`ingredientes` (`ingred_id`),
  CONSTRAINT `FK_productos_presentacion`
    FOREIGN KEY (`prod_presentacion`)
    REFERENCES `ancalayola`.`presentacion` (`presentacion_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci;


-- -----------------------------------------------------
-- Table `ancalayola`.`DetallePedido`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ancalayola`.`DetallePedido` ;

CREATE TABLE IF NOT EXISTS `ancalayola`.`DetallePedido` (
  `detallePedido_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `detallePedido_PedidoNum` INT UNSIGNED NOT NULL,
  `detallePedido_precioUnidad` DECIMAL(10,2) NOT NULL COMMENT 'contiene el precio con el que fue vendido el producto en su momento.',
  `detallePedido_cantidad` TINYINT NOT NULL,
  `detallePedido_ProductoId` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`detallePedido_id`),
  UNIQUE INDEX `detalle_Pedido_pedido_id_UNIQUE` (`detallePedido_id` ASC) ,
  INDEX `IDX_numPedido` (`detallePedido_PedidoNum` ASC) ,
  INDEX `IDX_Producto` (`detallePedido_ProductoId` ASC) ,
  CONSTRAINT `FK_DetallePedido_Pedidos`
    FOREIGN KEY (`detallePedido_PedidoNum`)
    REFERENCES `ancalayola`.`Pedidos` (`pedidos_id`),
  CONSTRAINT `FK_DetallePedido_productos`
    FOREIGN KEY (`detallePedido_ProductoId`)
    REFERENCES `ancalayola`.`productos` (`prod_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
