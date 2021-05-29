

SELECT * FROM Pedidos;

SELECT pedidos_numPedido AS pedido, pedidos_nombre AS nombre, pedidos_fmodificacion AS fecha, pedidos_tipo AS tipo, pedidos_numtelefono AS telefono, pedidos_estado AS estado,
pedidos_pagado AS pagado, pedidos_total AS total, pedidos_ordenJSON AS orden, pedidos_notas AS notas
FROM Pedidos
WHERE pedidos_numPedido LIKE(2)
LIMIT 100;







SELECT prod_id AS id, prod_codigo AS codigo, prod_precio AS precio 
                FROM productos  
                JOIN categorias ON prod_categoria = cat_id
                WHERE cat_codigo = 'P' 
                AND prod_status = 'A' 
                AND prod_ingrediente1 = (SELECT ingred_id FROM ingredientes WHERE ingred_status = 'A' AND ingred_codigo = 'cerdo')
                AND prod_ingrediente2 = (SELECT ingred_id FROM ingredientes WHERE ingred_status = 'A' AND ingred_codigo = 'indef')
                AND prod_ingrediente3 = (SELECT ingred_id FROM ingredientes WHERE ingred_status = 'A' AND ingred_codigo = 'indef'); 


SELECT ingred_id AS id, ingred_codigo AS codigo, ingred_ingrediente AS ingrediente FROM ingredientes
WHERE ingred_status = 'A'
AND ingred_tipo = 'indef' 
OR ingred_tipo = 'pedido';


SELECT ingred_codigo AS cod_ingrediente, ingred_ingrediente AS nombre, ingred_imagen AS imagen FROM ingredientes
            WHERE ingred_tipo = 'pedido' AND 
            ingred_status = 'A';
            
 
SELECT prod_id as id, prod_codigo AS codigo, prod_nombre AS nombre, prod_precio AS precio, prod_imagen AS imagen 
                FROM productos;
                
                        
SELECT * FROM productos;

SELECT * FROM ingredientes;

SELECT * FROM categorias; 

ancalayola

SELECT LAST_INSERT_ID();



