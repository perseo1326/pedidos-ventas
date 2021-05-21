<?php

session_start();

require_once "../admin/config.php";
require_once "../controladores/producto.controlador.php";
require_once "../controladores/elemento.controlador.php";
require_once "../controladores/plato.controlador.php";
require_once "../controladores/funciones.controlador.php";
require_once "../controladores/pagar_pedido.controlador.php";


// inicializar objeto para guardar la info del pago
if (isset($_SESSION['detallePedido']) && $_SESSION['detallePedido'] != "N;") {
    $detallePedido = unserialize($_SESSION['detallePedido']);
} else {
    $detallePedido = new PagarPedido_Controlador();
}

// inicializamos las variables para los pedidos y las bebidas para un nuevo pedido
if (isset($_GET['destino']) && ($_GET['destino'] == 'inicio')) {
    $_SESSION["pedido"] = "N;";
    $_SESSION["bebidas"] = "a:0:{}";
    $_SESSION['detallePedido'] = "N;";
    $_SESSION['pedidoJSON'] = "";
    $_SESSION['bebidasJSON'] = "";
    $_SESSION['resumenPedido'] = "";
    // $_SESSION['numUltimoPedido'] = 

    header('Location: pedido.controlador.php');
}

if (isset($_GET['destino']) && ($_GET['destino'] == 'busqueda')) {
    header('Location: busqueda.controlador.php');
}

// si hay definida la variable "PEDIDO" y "DESTINO" => el origen es "PEDIDO"
if (isset($_POST['pedido']) && isset($_POST['destino'])) {

    //verificacion de la informacion recibida en formato JSON
    // ???? TO-DO!

    // guardar el codigo JSON del pedido
    $_SESSION['pedidoJSON'] = $_POST['pedido'];
    $pedidoObjectStandard = json_decode($_POST['pedido']);
    $pedidoPlatos = convertObject2Pedido($pedidoObjectStandard);

    // serializamos la variable 'pedido' en una variable de session para poder usarla en otros scripts PHP.
    $_SESSION['pedido'] = serialize($pedidoPlatos);
}

// si hay definida la variable "BEBIDAS" y "DESTINO" => el origen es "BEBIDAS"
if (isset($_POST['bebidas']) && isset($_POST['destino'])) {

    //verificacion de la informacion recibida en formato JSON
    // ???? TO-DO!

    // guardar el codigo JSON de las bebidas
    $_SESSION['bebidasJSON'] = $_POST['bebidas'];
    
    $_SESSION['bebidas'] = json_decode($_POST['bebidas']);
    // convertir objeto bebidas en serializacion
    $_SESSION['bebidas'] = serialize($_SESSION['bebidas']);
}

// existe "nombrePedido"? => el origen es "PAGAR_PAG" y regresamos a editar un pedido
if (isset($_POST['nombrePedido']) && isset($_POST['destino'])) {
    
    $detallePedido->setNombre(limpiarDatos($_POST['nombrePedido']));
    if ($_POST['pagado'] == PAGADO) {
        $detallePedido->setPagado(PAGADO_SI);
    } else {
        $detallePedido->setPagado(PAGADO_NO);
    }

    if($_POST['tipo_pedido'] == PRESENCIAL) {
        $detallePedido->setTipoPedido(PRESENCIAL, "");
    } else {
        // pedido realizado x telefono, pedir num de telefono
        $detallePedido->setTipoPedido(VIA_TELEFONO, limpiarDatos($_POST['numtelefono']));
    }
    if ($_POST['forma-pago'] == EFECTIVO) {
        $detallePedido->setFormaPago(EFECTIVO, "");
    } else {
        // el pago se realiza con transferencia, pedir el num de transfer
        $detallePedido->setFormaPago(TRANSFERENCIA, limpiarDatos($_POST['transferNum']));
    }
    
    $_SESSION['detallePedido'] = serialize($detallePedido);
}

// *************************************************************
// **** DIRECCIONAMIENTO DEL USUARIO
// *************************************************************

// comprobar si hay un destino dirigir al usuario hacia alli
if(isset($_POST['destino'])) {
    // El usuario quiere ir al modulo...
    if ($_POST['destino'] == PEDIDO_PAG) {
        
        header('Location: pedido.controlador.php');

    } else if ($_POST['destino'] == BEBIDAS_PAG) {

        header('Location: bebidas.controlador.php');

    } else if ($_POST['destino'] == PAGAR_PAG) {

        // si "$_SESSION['pedido']" == NULL && $_SESSION['bebidas'] == NULL => No hay pedido, volver a pag PEDIDO_PAG
        if($_SESSION['pedido'] == "N;" && $_SESSION['bebidas'] == "a:0:{}") {
            header('Location: pedido.controlador.php?error=No hay pedido válido');
            // header('Location: pagar.controlador.php');
        } else {
            header('Location: pagar.controlador.php');
        }

    } else if($_POST['destino'] == DESTINO_CONFIRMAR) {
        header('Location: confirmar_pedido.controlador.php');
    } else {
        // no hay pagina de destino seleccionada => ir a inicio
        header('Location: inicio.controlador.php');
    }
}
