<?php

class Buscar_modelo {
    
    private $conex;
    private $pedidos;
    
    public function __construct(){
        require_once "../modelos/conexion.php";
        $this->conex = Conexion::conectar();
        $pedidos = array();
    }

    public function getUltimosPedidos() {
        $this->pedidos = [];
        $statement = $this->conex->prepare(" SELECT pedidos_numPedido AS pedido, 
                                                    pedidos_nombre AS nombre, 
                                                    pedidos_fcreacion AS fecha, 
                                                    pedidos_tipo AS tipo, 
                                                    pedidos_numtelefono AS telefono, 
                                                    pedidos_estado AS estado, 
                                                    pedidos_pagado AS pagado, 
                                                    pedidos_total AS total, 
                                                    pedidos_ordenJSON AS orden, 
                                                    pedidos_notas AS notas 
                                            FROM Pedidos
                                            LIMIT 100; ");

        $statement->execute();

        while($registro = $statement->fetch()) {
            $registro['fecha'] = date_create( $registro['fecha']);
            $this->pedidos[] = ($registro);
        }

        $statement = null;
        
        return $this->pedidos;
    }

    public function countResultadosBusqueda() {
        return count($this->pedidos);
    }

    // funcion para buscar un VALOR dependiendo del ELEMENTO a buscar
    public function buscarElemento($elemento, $valor) {

        // debugCodigo($elemento, true, "elemento");
        // debugCodigo($valor, true, "valor");

        $this->pedidos = [];
        $query = " SELECT pedidos_numPedido AS pedido, 
                            pedidos_nombre AS nombre, 
                            pedidos_fcreacion AS fecha, 
                            pedidos_tipo AS tipo, 
                            pedidos_numtelefono AS telefono, 
                            pedidos_estado AS estado, 
                            pedidos_pagado AS pagado, 
                            pedidos_total AS total, 
                            pedidos_ordenJSON AS orden, 
                            pedidos_notas AS notas 
                    FROM Pedidos \n";


        if ($elemento === ELEMENTOS['numPedido']) {
            // busqueda por numero de pedido
            $query = $query . "WHERE " . $elemento . " = :valor ";

        } else if ($elemento === ELEMENTOS['nombre'] || $elemento === ELEMENTOS['numTelefono']) {
            // busqueda por nombre OR numero de telefono
            $valor = "%" . $valor . "%"; 
            $query = $query . "WHERE " . $elemento . " LIKE (:valor) ";
            
        } elseif ($elemento === ELEMENTOS['total']) {
            // busqueda por valor total MENOR al indicado
            $query = $query . "WHERE " . $elemento . " <= :valor ";
        }
        
        $statement = $this->conex->prepare($query);
        $statement->bindValue(':valor', $valor);
        
        $statement->execute();

        while($registro = $statement->fetch()) {
            $registro['fecha'] = date_create( $registro['fecha']);
            $this->pedidos[] = ($registro);
        }

        // debugCodigo($this->pedidos, true);

        $statement = null;
        
        return $this->pedidos;
    } 

}