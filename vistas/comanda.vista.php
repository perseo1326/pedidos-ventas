<?php

    // impresion de ticket de comanda
    
    // $printer -> setPrintLeftMargin(32);
    // $printer -> setTextSize(2, 3);
    /*
    setJustification = (0, 1, 2)
        Printer::JUSTIFY_LEFT,
        Printer::JUSTIFY_CENTER,
        Printer::JUSTIFY_RIGHT
    */

    $texto = "";

    function linea($printer) {
        $linea = str_pad("=",48,"=");
        $printer -> selectPrintMode(0);
        $printer -> setEmphasis(true);
        $printer -> setUnderline(0);
        $printer -> text($linea);
    }

    // imprimir numero de plato
    function platoNum($printer, $texto) {
        $printer -> selectPrintMode(32);
        $printer -> setJustification(1);
        $printer -> setUnderline(0);
        $printer -> setEmphasis(false);
        $printer -> text($texto);
    }

    // imprimir nombre para el plato
    function nombrePlato($printer, $texto) {
        $printer -> setJustification(0);
        $printer -> selectPrintMode(32);
        $printer -> setUnderline(2);
        $printer -> setEmphasis(true);
        $printer -> text($texto);
    }        
    
    function producto($printer, $texto) {
        $printer -> setJustification(0);
        $printer -> selectPrintMode(33);
        $printer -> setUnderline(0);
        $printer -> setEmphasis(false);
        $printer -> text($texto);
    }

    function topping($printer, $texto) {
        $printer -> setJustification(2);
        $printer -> selectPrintMode(33);
        $printer -> setUnderline(0);
        $printer -> setEmphasis(false);
        $printer -> text($texto);    
    }

    function bebida($printer, $texto) {
        $printer -> selectPrintMode(33);
        $printer -> setJustification(0);
        $printer -> setUnderline(0);
        $printer -> setEmphasis(false);
        $printer -> text($texto);    
    }

    // *************************************************************
    // CREACION E IMPRESION DE LA COMANDA
    // *************************************************************
    
    // *************************************************************
    // DATOS DEL CLIENTE

    // No. Pedido - centrar texto
    $texto = "Pedido No. " . $_SESSION['numUltimoPedido'] . "\n";
    $printer -> setJustification($justification[1]);
    $printer -> selectPrintMode(56);
    $printer -> text($texto);
    
    $printer -> feed(1);

    // Nombre del pedido
    $texto = "Pedido: " . $detallePedido->getNombre() . "\n";
    if (strlen($texto) < 23) {
        $printer -> selectPrintMode(56);
    } else {
        $printer -> selectPrintMode(49);
    }
    
    $printer -> setJustification(0);
    $printer -> setEmphasis(true);
    $printer -> text($texto);

    $printer -> feed(1);
    
    // tipo de pedido y numero de telefono
    $texto = $detallePedido->getTipoPedido() . $numTel . "\n";
    $printer -> selectPrintMode(32);
    $printer -> setEmphasis(false);
    $printer -> text($texto);
    
    // estado del pago
    $texto = $estadoPagado . "\n";
    $printer -> setJustification($justification[2]);
    $printer -> selectPrintMode(48);
    $printer -> setUnderline(2);
    $printer -> text($texto);

    // linea plato
    linea($printer);

    // *************************************************************
    // DETALLE DE LOS PLATOS DEL PEDIDO

    // iterar cada uno de los PLATOS y sus ELEMENTOS y PRODUCTOS
    foreach ($pedido as $key => $pla) {

        $texto = "Plato No. " . ($key + 1) . "\n";
        platoNum($printer, $texto);

        $texto = $pla->getNombrePlato();
        if ($texto !== "") {
            $texto = "Nombre: " . $texto . "\n";
        }
        nombrePlato($printer, $texto);

        // imprimir productos del plato
        for ($i=0; $i < $pla->getCantidadElementos(); $i++) {    

            // imprimir productos del plato
            $texto = "(" . $pla->getElemento($i)->getCantidad() . ") " . $pla->getElemento($i)->getProducto()->getDescripcion() . "\n";
            producto($printer, $texto);

            // obtener los toppings seleccionados
            $tops = $pla->getElemento($i)->getProducto()->getToppings();
            
            // mostrar toppings - convertir a string
            $tops = verToppingsComanda($tops);
            if ($tops != "") {
                $tops = $tops . "\n";
                topping($printer, $tops);
            }
            // debugCodigo($tops, true, "toppings");

        }
        // linea plato
        linea($printer);
    }

    // *************************************************************
    // BEBIDAS 

    $texto = "BEBIDAS\n";
    $printer -> selectPrintMode(48);
    $printer -> setJustification($justification[1]);
    $printer -> setUnderline(2);
    $printer -> setEmphasis(true);
    $printer -> text($texto);

    $texto = "";
    if (count($bebidas) > 0 ) {
        foreach ($bebidas as $key => $bebida) {
            $texto = "(" . $bebida->cantidad . ") " . $bebida->nombre . "\n";
            bebida($printer, $texto);
        }
    }

    $printer -> feed(1);
    $printer -> cut();

