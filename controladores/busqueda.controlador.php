<?php

session_start();

require_once "../controladores/sesion.controlador.php";
require_once "../admin/config.php";
require_once "../modelos/buscar.modelo.php";
require_once "../controladores/buscar.controlador.php";

require_once "../controladores/funciones.controlador.php";


$pedidos = new Buscar_modelo;
$mostrarUltimosPedidos = [];

$arrayPedidos = $pedidos->getUltimosPedidos();

if (isset($arrayPedidos) && (count($arrayPedidos) > 0) ) {
    
    foreach ($arrayPedidos as $key => $pedido) {
        $elemento = new Buscar_Controlador;
        if($elemento->copiarPedido($pedido)) {
            array_push($mostrarUltimosPedidos, $elemento);
        }
    }
}
    
// debugCodigo($mostrarUltimosPedidos, true, "ultimos pedidos");

require_once ("../vistas/plantilla.vista.php");

require_once "../vistas/busqueda.vista.php";

require_once ("../vistas/fin_pagina.vista.php");