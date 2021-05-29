<?php

require_once ("../controladores/producto.controlador.php");

    class Elemento_Controlador
    {
        private $cantidad;
        private $producto;

        public function __construct ($cantidad, $producto) {
            $this->producto = new Producto_controlador();
            $this->producto->copiarProducto($producto);
            $this->cantidad = $cantidad;
        }

        public function getProducto() :Producto_controlador {
            return $this->producto;
        }

        public function getCantidad() :int {
            return $this->cantidad;
        }

        public function getElementoJson () {
            $objeto = new stdClass();
            $objeto->producto = $this->producto->getProductoJson();
            $objeto->cantidad = $this->cantidad;
            return $objeto;
        }

        
    }