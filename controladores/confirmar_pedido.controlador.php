<?php
    session_start();

    // validar si la variable de sesion esta presente, sino enviar al inicio.
    if (!isset($_SESSION['detallePedido'])) {
        header('Location: inicio.controlador.php');
    } 

    require_once "../admin/config.php";
    require_once "../controladores/producto.controlador.php";
    require_once "../controladores/elemento.controlador.php";
    require_once "../controladores/plato.controlador.php";
    require_once "../controladores/funciones.controlador.php";
    require_once "../controladores/producto_resumen.controlador.php";

    require_once "../modelos/confirmar_pedido.modelo.php";
    require_once "../controladores/ordenJSON.controlador.php";

    require_once "../modelos/detallePedido.modelo.php";
    

    // debugCodigo($_SESSION, true);
    // debugCodigo($_SESSION['detallePedido'], false);
    

    $detallePedido = unserialize($_SESSION['detallePedido']);
    // debugCodigo($detallePedido, true, "detallePedido");

    $resumenPedido = unserialize($_SESSION['resumenPedido']);
    // debugCodigo($resumenPedido, true);

    $pedido = unserialize($_SESSION['pedido']);
    // debugCodigo($pedido, true, "pedido");

    $bebidas = unserialize($_SESSION['bebidas']);
    // debugCodigo($bebidas, true);

    $pedidoJSON = json_decode($_SESSION['pedidoJSON']);
    // debugCodigo($pedidoJSON, true);

    $bebidasJSON = json_decode($_SESSION['bebidasJSON']);
    // debugCodigo($bebidasJSON, true);

    $confirmarPedido_mdl = new ConfirmarPedido_modelo((int) $_SESSION["usuarioId"]);
    
    if (is_int($confirmarPedido_mdl->getNumPedido())) {
        echo "Numero de pedido: " . $confirmarPedido_mdl->showNumPedido() . "<br>";
        
        $confirmarPedido_mdl->copiarDetallePedido($detallePedido);
        $confirmarPedido_mdl->setEstadoPedido(ESTADO_PEDIDO['CREACION']);

        // TODO: confirmar el destino del pedido, "LLEVAR" OR "AQUI"
        $confirmarPedido_mdl->setDestinoPedido( PEDIDO_DESTINO['LLEVAR']);
        
        $orden = new OrdenJSON($pedidoJSON, $bebidasJSON);
        $confirmarPedido_mdl->setOrdenJSON($orden->Orden2JSON());
        
        $detallePedido_mdl = new DetallePedido_modelo($confirmarPedido_mdl->showNumPedido());
        
        // debugCodigo($confirmarPedido_mdl, true);
        // debugCodigo($detallePedido_mdl, true);

        // escribir el pedido en la ddbb
        if($confirmarPedido_mdl->confirmarPedidoDDBB() != 1) {
                echo "Error, registro del pedido en ddbb NO efectuado correctamente!";
                header('Location: pagar.controlador.php');
            } else {
                // insertar los productos de la venta en la ddbb (tabla: detallePedido)
                $detallePedido_mdl->insertarDetallePedidoDDBB($resumenPedido);

                // almacena el numero del ultimo pedido realizado, el que se encuentra en la ddbb
                $_SESSION['numUltimoPedido'] = (int) $confirmarPedido_mdl->showNumPedido(); 

                // creacion de la COMANDA
                require_once "comanda.controlador.php";
                // actualizar ddbb con el estado del pedido a en "PREPARACION"
                $confirmarPedido_mdl->setEstadoPedido(ESTADO_PEDIDO['PREPARACION']);
                if ($confirmarPedido_mdl->actualizarEstadoPedido() !== 1) {
                    echo "ha habido un ERROR actualizando el estado del pedido a PREPARACION";
                }


                header('Location: inicio.controlador.php');
            }
    } else {
        echo "ERROR! ha habido un error en el acceso a la ddbb.";
        header('Location: inicio.controlador.php');
    }

    // para efectos de depuracion
    echo "<a href='inicio.controlador.php'>Ir a inicio</a>";

