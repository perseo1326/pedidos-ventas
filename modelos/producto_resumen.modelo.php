<?php


require_once "../controladores/producto_resumen.controlador.php";

// class ProductoResumen_modelo extends Producto_Resumen_Controlador {
//     private $conex;
//     private static $numPedido;

    // private $productoID;
	// private $codigoProd;
	// private $descripcion;
	// private $cantidad;
	// private $precioUnidad;

//     public function __construct(valores prod res contr){
//         require_once "../modelos/conexion.php";
//         $this->conex = Conexion::conectar();

//         parent::__construct();


//     }

//     public static setNumeroPedido ($numPedido) {
//         self::$numPedido = $numPedido;
//     }

//     public static getNumeroPedido () :int {
//         return self::$numPedido;
//     }

//     // el valor del usuarioId YA DEBE estar en la propiedad "$this->usuarioId"
//     private function setNumPedido( ) {
//         $statement = $this->conex->prepare(" INSERT INTO DetallePedido (detallePedido_PedidoNum, DetallePedido_precioUnidad, DetallePedido_cantidad, DetallePedido_productoId)  
//         VALUES ( 1, 20, 3, 2)
        
//         ");
        
//         $statement->bindValue(':numPedido', $this->numPedido, PDO::PARAM_INT);
//         $statement->bindValue(':estadoPedido', ESTADO_PEDIDO['CREACION'], PDO::PARAM_STR);
//         $statement->bindValue(':usuarioId', $this->usuarioId, PDO::PARAM_INT);
//         $statement->execute();
//         $statement = null;
//     }

// }