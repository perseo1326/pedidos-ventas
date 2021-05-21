<?php

session_start();

require_once "../controladores/producto.controlador.php";
require_once "../controladores/elemento.controlador.php";
require_once "../controladores/plato.controlador.php";

require_once "../admin/config.php";
require_once "../controladores/funciones.controlador.php";
require_once "../modelos/ingredientes.modelo.php";

$error = "";

if (isset($_GET['error'])) {
    $error = $_GET['error'];
}

// echo $error;

$pedido = null;

//validar si la variable de sesion esta presente, sino enviar al inicio.
if (!isset($_SESSION['pedido'])) {
    header('Location: inicio.controlador.php');
} 

if ($_SESSION['pedido'] != null && gettype($_SESSION['pedido']) == "string") {
    $pedido = unserialize($_SESSION['pedido']);
}

// titulo para la pagina
$tituloPagina = "Creación del Pedido";

// constantes definidas en el archivo de configuracion (config.php)
// pagina destino a la cual desea ir el usuario
const DESTINO_BEBIDAS = BEBIDAS_PAG;
const DESTINO_PAGAR = PAGAR_PAG;

// crear un obj de la clase "Pedido_modelo" para obtener 
// los ingredientes para la vista del pedido
$ingredientes_mdl = new Ingredientes_modelo();

$saboresPedido = $ingredientes_mdl->getSaboresDetallesPedido();

// variable para "recordar" el pedido si se hizo anteriormente y pasarlo 
// al Javascript en formato JSON
$pedidoJson = null;

if(isset($pedido)) {
    $pedidoJson = convertirPedido2Json($pedido);

    $pedidoJson = "var pedidoJson = '" . $pedidoJson . "';"; 
} else {
    $pedidoJson = "var pedidoJson = '';"; 
}

// debugCodigo($_SESSION, true);

require_once ("../vistas/plantilla.vista.php");
require_once ("../vistas/pedido.vista.php");
require_once ("../vistas/fin_pagina.vista.php");
