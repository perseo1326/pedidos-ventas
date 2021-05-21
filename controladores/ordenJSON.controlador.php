<?php 

class OrdenJSON {
    private $pedidoJSON;
    private $bebidasJSON;

    public function __construct($pedido = null, $bebidas = null) {
        $this->pedidoJSON = $pedido;
        $this->bebidasJSON = $bebidas;
    }

    public function getPedidoJSON() :string {
        return $this->pedidoJSON;
    }

    public function getBebidasJSON() :string {
        return $this->bebidasJSON;
    }

    public function Orden2JSON() :string {
        $objetoJSON = new stdClass();
        $objetoJSON->pedidoJSON = $this->pedidoJSON;
        $objetoJSON->bebidasJSON = $this->bebidasJSON;
        $temp = json_encode($objetoJSON);
        return $temp;
    }

    public function JSON2Orden($jsonText) :bool {
        $objeto = json_decode($jsonText);
        $error = verificarErrorJSON();
        if ($error != null) {
            return false;
        }

        $this->pedidoJSON = $objeto->pedidoJSON;
        $this->bebidasJSON = $objeto->bebidasJSON;
        return true;
    }

}