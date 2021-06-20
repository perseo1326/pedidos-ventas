SET  SQL_SAFE_UPDATES = 0;

-- ASEGURAR QUE SE USA LA BASE DE DATOS CORRECTA 
USE `ancalayola`;

-- Volcando datos para la tabla ancalayola.tipo_usuario: ~1 rows (aproximadamente)
DELETE FROM `tipo_usuario`;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;



INSERT INTO `tipo_usuario` (`tipousuario_id`, `tipousuario_codigo`, `tipousuario_nombre`, `tipousuario_notas`, `tipousuario_status`) VALUES 
(1001, 'admin', 'administrador', 'usuario general con todos los privilegios.'),
(1002, 'vendedor', 'vendedor', 'Usuario registrado para poder realizar ventas.');

/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;

INSERT INTO usuarios (usuarios_nombre, usuarios_descripcion, usuarios_status, usuarios_tipousuario_id)
VALUES 
('JWSK', 'Adminstrador', 'A', (SELECT tipousuario_id FROM tipo_usuario WHERE tipousuario_codigo = 'admin')),
('Yola', 'Adminstrador', 'A', (SELECT tipousuario_id FROM tipo_usuario WHERE tipousuario_codigo = 'vendedor'));

SET  SQL_SAFE_UPDATES = 1;
