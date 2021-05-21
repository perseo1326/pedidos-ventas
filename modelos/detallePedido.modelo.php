<?php

require_once "../controladores/producto_resumen.controlador.php";

class DetallePedido_modelo extends Producto_resumen_Controlador {
    private $conex;
    private static $numPedido;

    public function __construct ($numeroPedido){
        require_once "../modelos/conexion.php";
        $this->conex = Conexion::conectar();

        self::$numPedido = (int) $numeroPedido;
        parent::__construct();
    }

    public function insertarDetallePedidoDDBB($listadoResumenPedido) {

        // $iterador = 1;
        $statement = $this->conex->prepare(" INSERT INTO DetallePedido 
                                                (detallePedido_PedidoNum, 
                                                DetallePedido_precioUnidad, 
                                                DetallePedido_cantidad, 
                                                DetallePedido_productoId)
                                            VALUES ( :numPedido, :precioUnidad, :cantidad, :productoID) ");
        
        $statement->bindValue(':numPedido', self::$numPedido, PDO::PARAM_INT);

        foreach ($listadoResumenPedido as $key => $itemResumenPedido) {
            
            $this->copiar($itemResumenPedido);
            $statement->bindValue(':precioUnidad', $this->precioUnidad, PDO::PARAM_INT);
            $statement->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
            $statement->bindValue(':productoID', $this->productoID, PDO::PARAM_INT);
            
            $statement->execute();
            // $iterador++;
        }

        $statement = null;

        // return $iterador;
    }



}