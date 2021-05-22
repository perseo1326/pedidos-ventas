<?php
session_start();

$_SESSION["usuarioId"] = 1;
$_SESSION["pedido"] = null;
$_SESSION["bebidas"] = null;
$_SESSION['detallePedido'] = null;
$_SESSION['pedidoJSON'] = null;
$_SESSION['bebidasJSON'] = null;
$_SESSION['resumenPedido'] = null;
$_SESSION['numUltimoPedido'] = null;

require_once ("../vistas/plantilla.vista.php");
require_once ("../vistas/inicio.vista.php");
require_once ("../vistas/fin_pagina.vista.php");