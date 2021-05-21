<?php

    session_start();

    require_once "../admin/config.php";
    require_once "../controladores/producto.controlador.php";
    require_once "../controladores/elemento.controlador.php";
    require_once "../controladores/plato.controlador.php";
    require_once "../controladores/producto_resumen.controlador.php";
    require_once "../controladores/pagar_pedido.controlador.php";

    require_once("../controladores/funciones.controlador.php");
    require_once("../modelos/producto.modelo.php");

    // validar si la variable de sesion esta presente, sino enviar al inicio.
    if (!isset($_SESSION['pedido'])) {
        header('Location: inicio.controlador.php');
    } 

    
    // constantes definidas en el archivo de configuracion (config.php).
    // pagina destino a la cual desea ir el usuario
    const DESTINO_PEDIDO = PEDIDO_PAG;
    const DESTINO_BEBIDAS = BEBIDAS_PAG;

    // constante para indicar un codigo "DESCONOCIDO"
    const DESCONOCIDO = UNKNOWN;

    // titulo para la pagina
    $tituloPagina = "Modulo de Pago";

    // valores json para Javascript
    $pedidoJson = null;

    // objeto para el acceso a la ddbb de un producto (panucho)
    $producto_mdl = new Producto_modelo();

    // objeto para guardar la info del pago
    $detallePedido = new PagarPedido_Controlador();
    
    // deserializar el contenido de la variable "$_SESSION['pedido']" para convertirlo en un 
    // ObjectStandard y luego en un objeto "PEDIDO-Platos".
    $pedido = unserialize($_SESSION['pedido']);

    $bebidas = unserialize($_SESSION['bebidas']);

    // si ya existen datos del pago del pedido, cargarlos!!
    if (isset($_SESSION['detallePedido']) && $_SESSION['detallePedido'] != "N;") {
        // echo "serializando detalle pedido<br>";
        $detallePedido = unserialize($_SESSION['detallePedido']);
    } 

    // variable con los detalles de precio y codigo desde la ddbb
    $prodDetalle = array();
    // getProductoDetalle_mdl

    // array de "Producto_resumen_Controlador (class)" para mostrar el resumen del pedido 
    $resumenPedido = array();

    // "formaPagoTotalTxt" muestra el total a pagar o advertencia si hay un error con algun producto en la vista.
    $formaPagoTotalTxt = "";


    if ($pedido != null) {
    
        // validar y obtener los codigos y precio de cada uno de los productos en el pedido
        foreach ($pedido as $key => $pla) {

            for ($i=0; $i < $pla->getCantidadElementos(); $i++) {    

                $sabores = $pla->getElemento($i)->getProducto()->getProdSabores();
                $producto_mdl->setSabores_mdl($sabores);
                $prodDetalle = $producto_mdl->getProductoDetalle_mdl();
                $pla->getElemento($i)->getProducto()->setProductoDetalle($prodDetalle);
            }
        }

        // agrupar los productos x codigo para mostrar el resumen del pedido
        foreach ($pedido as $key => $pla) {

            for ($i=0; $i < $pla->getCantidadElementos(); $i++) {   

                $prodID = $pla->getElemento($i)->getProducto()->getProductoID();
                $descripcion = $pla->getElemento($i)->getProducto()->getDescripcion();
                $codigo = $pla->getElemento($i)->getProducto()->getCodigo();
                $cantidad = $pla->getElemento($i)->getCantidad();

                // "La clave SI existe";
                if (array_key_exists($codigo,$resumenPedido)) {
                    if ($codigo == DESCONOCIDO) {

                        if(array_key_exists($descripcion, $resumenPedido[$codigo])) {
                            $resumenPedido[$codigo][$descripcion]->sumarCantidad($cantidad); 
                        } else {
                            $prodRes = $pla->getElemento($i)->getProducto()->getProductoResumen();
                            $prod_resumen = new Producto_resumen_Controlador( $cantidad, $prodRes['id'], $prodRes['codigo'], $prodRes['descripcion'], $prodRes['precioUnitario']);
                            $resumenPedido[$codigo][$descripcion] = $prod_resumen;
                        }
                        
                    } else {
                        $resumenPedido[$codigo]->sumarCantidad($cantidad);
                    }
                // "La clave NO existe";
                } else {
                    $prodRes = $pla->getElemento($i)->getProducto()->getProductoResumen();
                    $prod_resumen = new Producto_resumen_Controlador( $cantidad, $prodRes['id'], $prodRes['codigo'], $prodRes['descripcion'], $prodRes['precioUnitario']);

                    // SI es DESCONOCIDO => agregar al array "$resumenPedido" el cod "DESCONOCIDO" y dentro otro array con los demas desconocidos.
                    if ($codigo == DESCONOCIDO) {
                        $desconocidos = [];
                        $desconocidos[$prod_resumen->getDescripcion()] = $prod_resumen;
                        $resumenPedido[$codigo] = $desconocidos;
                    } else {
                        $resumenPedido[$codigo] = $prod_resumen;
                    }
                }
            }
        }
    }

    // insertar en la variable "$detallePedido" las bebidas que contenga el pedido
    if ($bebidas != null)  {
        foreach ($bebidas as $key => $bebida) {
            $nuevo = new Producto_resumen_Controlador( $bebida->cantidad, $bebida->id, $bebida->codigo, $bebida->nombre, $bebida->precio);
            array_push($resumenPedido, $nuevo);
        }
    }
        
    // obtener el total a pagar de "$resumenPedido"
    $total = 0;
    $cant = 0;

    if ( count($resumenPedido) > 0) {
        foreach ($resumenPedido as $key => $prod) {

            if (gettype($prod) === "array") {
                $total = NO_APLICA;
                $cant = NO_APLICA;
                $formaPagoTotalTxt = "<span class='ancho-50 txt-big txt-neg error-total'>Error!</span>";
                break;
            } else {
                $total += $prod->getTotal();
                $cant += $prod->getCantidad();
                $formaPagoTotalTxt = "<span class='ancho-50 txt-big txt-neg'>$" . $total . "</span>";
            }
        }

        $detallePedido->setTotal($total);
        $detallePedido->setTotalProductos($cant);
    }


    // debugCodigo($detallePedido, true);

    if ($detallePedido != null) {
        $detallePedidoJSON = $detallePedido->convert2JSON();
        $detallePedidoJSON = "let detallePedidoJSON = '" . $detallePedidoJSON . "';";
    } else {
        $detallePedidoJSON = "let detallePedidoJSON = '';";
    }

    // debugCodigo($resumenPedido, false);
    // debugCodigo($_SESSION, false);

// conversion del objeto "PEDIDO" en formato JSON
if(isset($pedido)) {
    $pedidoJson = convertirPedido2Json($pedido);
    $_SESSION['pedidoJSON'] = $pedidoJson;
    $pedidoJson = "let pedidoJson = '" . $pedidoJson . "';"; 
} else {
    $_SESSION['pedidoJSON'] = "[]";
    $pedidoJson = "let pedidoJson = '';"; 
}

// debugCodigo($bebidas, false);

// codigo para Javascript para la visualizacion
if ($bebidas != null)  {
    $hayBebidas = "var hayBebidas = true;";
} else {
    $hayBebidas = "var hayBebidas = false;";
}

// Serializar las variables para guardar los valores actualizados
$_SESSION['detallePedido'] = serialize($detallePedido);
$_SESSION['pedido'] = serialize($pedido);
$_SESSION['bebidas'] = serialize($bebidas);
$_SESSION['resumenPedido'] = serialize($resumenPedido);

// debugCodigo($detallePedido, true, "DetallePedido");
// debugCodigo($_SESSION, true, "Session");

require_once ("../vistas/plantilla.vista.php");
require_once ("../vistas/pagar.vista.php");
require_once ("../vistas/fin_pagina.vista.php");

