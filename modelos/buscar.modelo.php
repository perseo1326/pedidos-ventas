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

    // public function getPedido($indice) {
    //     if (isset($this->pedidos[$indice])) {
    //         return $this->pedidos[$indice];
    //     } else {
    //         return null;
    //     }
    // }
}