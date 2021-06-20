SET  SQL_SAFE_UPDATES = 0;

-- ASEGURAR QUE SE USA LA BASE DE DATOS CORRECTA 
USE `ancalayola`;

-- Volcando datos para la tabla ancalayola.ingredientes: ~9 rows (aproximadamente)
DELETE FROM `ingredientes`;
/*!40000 ALTER TABLE `ingredientes` DISABLE KEYS */;

INSERT INTO
  `ingredientes` (
    `ingred_tipo`,
    `ingred_codigo`,
    `ingred_ingrediente`,
    `ingred_descripcion`,
    `ingred_presentacion`,
    `ingred_imagen`,
    `ingred_status`
  ) VALUES
  ('indef', 'indef', 'Indefinido', 'Indefinido o no conocido', (SELECT presentacion_id FROM presentacion WHERE presentacion_codigo = 'indef'), 'NULL', 'A'), 
('pedido', 'pollo', 'Pollo', 'Pollo deshebrado para rellenos de los panuchos.', (SELECT presentacion_id FROM presentacion WHERE presentacion_codigo = 'und'), 'pollo.png', 'A'), 
('pedido', 'cerdo', 'Cerdo', 'Cerdo deshebrado para rellenos de los panuchos', (SELECT presentacion_id FROM presentacion WHERE presentacion_codigo = 'und'), 'cerdo_face.png', 'A'), 
('pedido', 'res', 'Res', 'Res deshebrado para rellenos de los panuchos', (SELECT presentacion_id FROM presentacion WHERE presentacion_codigo = 'und'), 'res.png', 'A'), 
('pedido', 'queso', 'Queso', 'Queso Manchego y Hebra para relleno de panuchos', (SELECT presentacion_id FROM presentacion WHERE presentacion_codigo = 'und'), 'queso.png', 'A'), 
('pedido', 'bola', 'Q. Bola', 'Queso de Bola para rellono de panuchos', (SELECT presentacion_id FROM presentacion WHERE presentacion_codigo = 'und'), 'bola.png', 'A'), 
('pedido', 'camaron', 'Camaron', 'Camaron para relleno de panuchos', (SELECT presentacion_id FROM presentacion WHERE presentacion_codigo = 'und'), 'camaron.png', 'A'), 
('pedido', 'frijol', 'Frijol', 'Frijol refrito para relleno de panuchos', (SELECT presentacion_id FROM presentacion WHERE presentacion_codigo = 'und'), 'frijol.png', 'A'), 
('pedido', 'azucar', 'Azucar', 'Mezcla de azúcar y queso para relleno de panuchos', (SELECT presentacion_id FROM presentacion WHERE presentacion_codigo = 'und'), 'sugar_cube.png', 'A'), 
('pedido', 'manual', 'Manual', 'Pedido de edicion manual', (SELECT presentacion_id FROM presentacion WHERE presentacion_codigo = 'indef'), 'manual.png', 'N'); 

/*!40000 ALTER TABLE `ingredientes` ENABLE KEYS */;

SET SQL_SAFE_UPDATES = 1;
