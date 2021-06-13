<?php

session_start();

require_once "../controladores/sesion.controlador.php";
require_once "../admin/config.php";
require_once "../modelos/buscar.modelo.php";
require_once "../controladores/buscar.controlador.php";

require_once "../controladores/funciones.controlador.php";

// variable para visualizar errores
$error = "";

// objeto para la busqueda de la informacion
$busqueda = new Buscar_modelo;

// array para guardar el listado de pedidos de la busqueda
$mostrarUltimosPedidos = [];

// "arrayPedidos" array temporal
$arrayPedidos = [];

// variable que define el tipo de busqueda
$elemento = "";
// variable con el valor de busqueda
$valor = "";

if (isset($_POST['numPedido'])) {
    
    // TODO limpiar datos!
    $numPedido      = (int) $_POST['numPedido'];
    $nombre         = $_POST['nombre'];
    $total          = $_POST['total'];
    $numTelefono    = $_POST['numTelefono'];
    $fecha          = $_POST['fecha'];


    // seleccionar el campo por el cual se va a desarrollar la busqueda
    // si != "" o Cero, => buscar por numero de pedido
    if ($numPedido > 0) {
        $elemento = ELEMENTOS['numPedido'];
        $valor = $numPedido;
    } else if ($nombre != "") {
        $elemento = ELEMENTOS['nombre'];
        $valor = $nombre;
    } else if ($total > 0) {
        $elemento = ELEMENTOS['total'];
        $valor = $total;
    } else if ($numTelefono != "") {
        $elemento = ELEMENTOS['numTelefono'];
        $valor = $numTelefono;
    } else if ($fecha != "") {
        $elemento = ELEMENTOS['fecha'];
        $valor = $fecha;
    } else {
        $error .= "No se definio un criterio de búsqueda.<br>";
    }

    // realizar la busqueda
    $arrayPedidos = $busqueda->buscarElemento($elemento, $valor);
    
} else {
    // carga de los ultimos pedidos realizados.    
    $arrayPedidos = $busqueda->getUltimosPedidos();
}

// prepara un array de objetos "Buscar_Controlador" para poder visualizarlos luego
if (isset($arrayPedidos) && (count($arrayPedidos) > 0) ) {
    
    foreach ($arrayPedidos as $key => $pedido) {
        $elemento = new Buscar_Controlador;
        if($elemento->copiarPedido($pedido)) {
            array_push($mostrarUltimosPedidos, $elemento);
        }
    }
}

// debugCodigo($mostrarUltimosPedidos[0], false, "pedidos");

require_once ("../vistas/plantilla.vista.php");

require_once "../vistas/busqueda.vista.php";

require_once ("../vistas/fin_pagina.vista.php");