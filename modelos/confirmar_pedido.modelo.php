<?php

require_once "../controladores/pagar_pedido.controlador.php";

class ConfirmarPedido_modelo extends PagarPedido_Controlador {
    private $conex;
    private static $numPedido;

    private $estadoPedido;
    private $destinoPedido;
    private $ordenJSONText;
    private $usuarioId;

    public function __construct($usuarioId){
        require_once "../modelos/conexion.php";
        $this->conex = Conexion::conectar();
        parent::__construct();
        self::$numPedido = 0;
        $this->estadoPedido = null;
        $this->destinoPedido = null;
        $this->ordenJSONText = '';
        $this->usuarioId = $usuarioId;
    }

    private function getNumUltimoPedido() {
        $statement = $this->conex->prepare(" SELECT pedidos_numPedido AS numPedido 
        FROM Pedidos 
        ORDER BY numPedido DESC 
        LIMIT 1; "); 
        $statement->execute();
        
        $temp = $statement->fetch();

        // en caso que no hayan registros, el valor de "$temp" sera NULL(false);
        if ($temp === false) {
            $temp = ['numPedido' => (int) 0 ];
        }
        $statement = null;
        return $temp;
    }

    // obtiene el ultimo numero de pedido en la ddbb y le suma una unidad para el "nuevo numero de pedido".
    public function getNumPedido () {
        $temp = self::getNumUltimoPedido();
        // $this->numPedido = $temp['numPedido'];
        self::$numPedido = $temp['numPedido'];
        self::$numPedido++;
        self::setNumPedido();

        return self::$numPedido;
    }

    // devuelve el numero de pedido actual, sobre el cual se esta haciendo las operaciones.
    public function showNumPedido () :int {
        return self::$numPedido;
    }

    // el valor del usuarioId YA DEBE estar en la propiedad "$this->usuarioId"
    private function setNumPedido( ) {
        $statement = $this->conex->prepare(" INSERT INTO Pedidos 
        (Pedidos_numPedido, Pedidos_nombre, Pedidos_tipo, Pedidos_numTelefono, Pedidos_estado, Pedidos_formaPago, 
        Pedidos_numTransfer, Pedidos_destino, Pedidos_ordenJSON, Pedidos_usuarioId)
        VALUES (:numPedido, '', '-', '', :estadoPedido, '-', '', '-', '[]', :usuarioId); ");
        
        $statement->bindValue(':numPedido', self::$numPedido, PDO::PARAM_INT);
        $statement->bindValue(':estadoPedido', ESTADO_PEDIDO['CREACION'], PDO::PARAM_STR);
        $statement->bindValue(':usuarioId', $this->usuarioId, PDO::PARAM_INT);
        $statement->execute();
        $statement = null;
    }

    public function setEstadoPedido ($estadoPedido) {
        $this->estadoPedido = $estadoPedido;
    }

    public function setDestinoPedido ($destinoPedido) {
        $this->destinoPedido = $destinoPedido;
    }

    public function setOrdenJSON ($textoJSON) {
        $this->ordenJSONText = $textoJSON;
    }

    public function confirmarPedidoDDBB() {

        $statement = $this->conex->prepare(" UPDATE Pedidos 
            SET Pedidos_nombre = :nombrePedido,
                pedidos_fCreacion = :fCreacion,
                pedidos_fModificacion = :fModificacion,
                Pedidos_tipo = :tipoPedido, 
                Pedidos_numTelefono = :numTelefono, 
                Pedidos_estado = :estadoPedido, 
                Pedidos_pagado = :pedidoPagado, 
                Pedidos_formaPago = :formaDePago, 
                Pedidos_numTransfer = :numTransfer, 
                Pedidos_total = :total, 
                Pedidos_destino = :pedidoDestino, 
                Pedidos_ordenJSON = :ordenJSONText 
            WHERE Pedidos_numPedido = :numPedido
            AND Pedidos_usuarioId = :usuarioId ;" );

        $statement->bindValue(':numPedido', self::$numPedido, PDO::PARAM_INT);
        $statement->bindValue(':nombrePedido', $this->nombrePedido, PDO::PARAM_STR);
        $statement->bindValue(':fCreacion', date('Y-m-d H:i:s'), PDO::PARAM_STR);
        $statement->bindValue(':fModificacion', date('Y-m-d H:i:s'), PDO::PARAM_STR );
        $statement->bindValue(':tipoPedido', $this->tipoPedido, PDO::PARAM_STR);
        $statement->bindValue(':numTelefono', $this->tipoPedido_numTelefono, PDO::PARAM_STR);
        $statement->bindValue(':estadoPedido', $this->estadoPedido, PDO::PARAM_STR);
        $statement->bindValue(':pedidoPagado', $this->pagado, PDO::PARAM_STR);
        $statement->bindValue(':formaDePago', $this->formaDePago, PDO::PARAM_STR);
        $statement->bindValue(':numTransfer', $this->formaDePago_numTransfer, PDO::PARAM_STR);
        $statement->bindValue(':total', $this->total, PDO::PARAM_STR);
        $statement->bindValue(':pedidoDestino', $this->destinoPedido, PDO::PARAM_STR);
        $statement->bindValue(':ordenJSONText', $this->ordenJSONText, PDO::PARAM_STR);
        $statement->bindValue(':usuarioId', $this->usuarioId, PDO::PARAM_INT);

        $statement->execute();

        $temp = $statement->rowCount();

        $statement = null;

        return $temp;
    }

    public function actualizarEstadoPedido () {
        $statement = $this->conex->prepare(" UPDATE Pedidos 
            SET Pedidos_estado = :estadoPedido
            WHERE Pedidos_numPedido = :numPedido
            AND Pedidos_usuarioId = :usuarioId ;" );

        $statement->bindValue(':numPedido', self::$numPedido, PDO::PARAM_INT);
        $statement->bindValue(':estadoPedido', $this->estadoPedido, PDO::PARAM_STR);
        $statement->bindValue(':usuarioId', $this->usuarioId, PDO::PARAM_INT);

        $statement->execute();
        $temp = $statement->rowCount();
        $statement = null;
        return $temp;
    }

}