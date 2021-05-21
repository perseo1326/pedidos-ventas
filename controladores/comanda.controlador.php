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

require_once ("../vistas/plantilla.vista.php");

require_once "../vistas/comanda.vista.php";

require_once ("../vistas/fin_pagina.vista.php");