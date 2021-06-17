SET  SQL_SAFE_UPDATES = 0;

-- ASEGURAR QUE SE USA LA BASE DE DATOS CORRECTA 
USE `ancalayola`;

-- Volcando datos para la tabla ancalayola.tipo_usuario: ~1 rows (aproximadamente)
DELETE FROM `tipo_usuario`;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;



INSERT INTO `tipo_usuario` (`tipousuario_id`, `tipousuario_codigo`, `tipousuario_nombre`, `tipousuario_notas`, `tipousuario_status`) VALUES
	(1, 'admin', 'administrador', 'usuario general con todos los privilegios.', 'A');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;



INSERT INTO usuarios (usuarios_nombre, usuarios_descripcion, usuarios_status, usuarios_tipousuario_id)
VALUES 
  ('JWSK', '', 'A', 1);

SET  SQL_SAFE_UPDATES = 1;
