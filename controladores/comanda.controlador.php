<?php

// obtener el estado del pago
if ( PAGADO_SI === $detallePedido->getPagado()) {
    $estadoPagado = PAGADO; 
} else {
    $estadoPagado = DEBE;
}

$numTel = $detallePedido->getNumTelefono();
if ($numTel !== "") {
    $numTel = ' (' . $numTel . ')';
}

// impresion de la comanda en IMPRESORA DE TICKETS
// require_once "comanda_conexion.controlador.php";

// impresion de la comanda en PANTALLA
require_once "../vistas/comanda.vista(web).php";

// require_once ("../vistas/fin_pagina.vista.php");