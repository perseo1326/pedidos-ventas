SET  SQL_SAFE_UPDATES = 0;

-- ASEGURAR QUE SE USA LA BASE DE DATOS CORRECTA 
USE `ancalayola`;

-- Volcando datos para la tabla ancalayola.presentacion: ~5 rows (aproximadamente)
DELETE FROM `presentacion`;

  /*!40000 ALTER TABLE `presentacion` DISABLE KEYS */;

INSERT INTO
  `presentacion` (
    `presentacion_codigo`,
    `presentacion_nombre`,
    `presentacion_descripcion`,
    `presentacion_status`
  )
VALUES
  ('indef', 'Indefinida', 'Indefinida - desconocida', 'A'),
  ('und', 'unidad', 'Unidad minima de medida', 'A'),
  ('3Lt', '3 Lt', '3Lt - Liquidos', 'A'),
  ('lt', 'Litro', 'Litro - liquidos', 'A'),
  ('600ml', '600 ml', '600 ml - liquidos', 'A'),
  ('500ml', '500 ml - 1/2 litro', 'Medio litro - liquidos', 'A'),
  ('355ml', '355 ml', '355 ml - Liquidos', 'A'),
  ('233ml', '233 ml', '233 ml - Liquidos', 'A');

  /*!40000 ALTER TABLE `presentacion` ENABLE KEYS */;

SET SQL_SAFE_UPDATES = 1;