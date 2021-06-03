<?php
session_start();

// require_once "../admin/config.php";

date_default_timezone_set("America/Merida");

$_SESSION["usuarioId"] = 1;
$_SESSION["usuarioNombre"] = "Administrador";
$_SESSION["pedido"] = null;
$_SESSION["bebidas"] = null;
$_SESSION['detallePedido'] = null;
$_SESSION['pedidoJSON'] = null;
$_SESSION['bebidasJSON'] = null;
$_SESSION['resumenPedido'] = null;
$_SESSION['numUltimoPedido'] = null;

// TODO: cuando se implemente el proceso de login cambiar de lugar la siguiente linea!!
// define si hay una sesion activa, sino vuelve al login
require_once "../controladores/sesion.controlador.php";

require_once ("../vistas/plantilla.vista.php");
require_once ("../vistas/inicio.vista.php");
require_once ("../vistas/fin_pagina.vista.php");