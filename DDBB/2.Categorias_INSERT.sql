
SET SQL_SAFE_UPDATES = 0;

-- ASEGURAR QUE SE USA LA BASE DE DATOS CORRECTA
USE `ancalayola`;

-- Volcando datos para la tabla ancalayola.categorias: ~7 rows (aproximadamente)
DELETE FROM `categorias`;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;

INSERT INTO
  `categorias` (
    cat_nombre,
    cat_codigo,
    cat_descripcion,
    cat_padre,
    cat_nivel,
    cat_status
  )
VALUES('bebidas', 'B', 'bebidas', NULL, 0, 'A'), 
('panuchos', 'P', 'productos ventas primarias', NULL, 0, 'A'), 
('extras', 'extra', 'Productos extras como dulces, salsas, acompañantes (zanahoria), panques, etc', NULL, 0, 'A'), 
('refrescos', 'Refr', 'refrescos embotellados', 1, 1, 'A'), 
('aguas_sabores', 'AgS', 'Aguas de sabores preparadas artesanales', 1, 1, 'A'), 
('agua', 'AgB', 'agua embotellada', 1, 1, 'A'), 
('coca-cola', 'coca', 'productos coca-cola ', 3, 2, 'A'), 
('refrescos-varios', 'ORefr', 'otros refrescos embotellados', 3, 2, 'A'); 

/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

SET SQL_SAFE_UPDATES = 1;