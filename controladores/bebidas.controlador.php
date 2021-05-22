<?php

session_start();

require_once("../admin/config.php");
require_once("../modelos/bebidas.modelo.php");

require_once "../controladores/funciones.controlador.php";

// constantes definidas en el archivo de configuracion.
// pagina destino a la cual desea ir el usuario
const DESTINO_PEDIDO = PEDIDO_PAG;
const DESTINO_PAGAR = PAGAR_PAG;

// titulo para la pagina
$tituloPagina = "Selección de Bebidas";

$bebidasPedido = unserialize($_SESSION['bebidas']);

$bebida_mdl = new Bebidas_modelo();

// variable para "recordar" el pedido si se hizo anteriormente y pasarlo 
// al Javascript en formato JSON
$bebidasJson = null;

// consulta a la ddbb por el listado de bebidas "activas" a ser mostradas
$lista1 = $bebida_mdl->get_bebidas(BEB_AGUAS_SABORES);
$lista2 = $bebida_mdl->get_bebidas(BEB_AGUAS_NORMAL);
$lista3 = $bebida_mdl->get_bebidas(BEB_COCACOLA);
$lista4 = $bebida_mdl->get_bebidas(BEB_OTROS_REFRESCOS);

$listado_bebidas = array_merge($lista1, $lista2, $lista3, $lista4);


if($bebidasPedido != null) {
    $bebidasJson = json_encode($bebidasPedido);
    $bebidasJson = "var bebidasJson = '" . $bebidasJson . "';"; 
} else {
    $bebidasJson = "var bebidasJson = '';"; 
}

// debugCodigo($bebidasJson, false);

require_once ("../vistas/plantilla.vista.php");

require_once "../vistas/bebidas.vista.php";

require_once ("../vistas/fin_pagina.vista.php");