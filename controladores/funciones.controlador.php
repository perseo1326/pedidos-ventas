<?php

    require_once "../controladores/producto.controlador.php";
    require_once "../controladores/elemento.controlador.php";
    require_once "../controladores/plato.controlador.php";


    // arreglo con los codigos de error para conversiones JSON en PHP
    static $ERRORS_JSON = array(
        JSON_ERROR_NONE => 'No error',
        JSON_ERROR_DEPTH => 'Maximum stack depth exceeded',
        JSON_ERROR_STATE_MISMATCH => 'State mismatch (invalid or malformed JSON)',
        JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
        JSON_ERROR_SYNTAX => 'Syntax error',
        JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded'
    );
    // añadir estas dos siguientes lineas al codigo para efectuar la comprobacion de errores JSON
    // $error = json_last_error();
    // $error = isset($ERRORS[$error]) ? $ERRORS[$error] : 'Unknown error';



    // *************************************************************
    // *************************************************************
    // funcion para hacer debug del codigo, tipo = true => "var_dump()", sino "print_r()"
    function debugCodigo($variable, $tipo, $mensaje = '') {
        echo "<br>*********************************<br>";
        if ($mensaje != '') {
            echo "MENSAJE: " . $mensaje . "<br>";
        }
        echo "<pre>";
        if($tipo) {
            var_dump($variable);
        } else {
            print_r($variable);
        }
        echo "</pre>";
        echo "<br>*********************************<br>";
    }
    // *************************************************************

    // *************************************************************
    function limpiarDatos($datos, $tipo = 'S') {
        $datos = trim($datos);
        $datos = stripslashes($datos);
        $datos = htmlspecialchars($datos);

        // por defecto tratamos el "$dato" como una cadena, sino "E" OR "e" => Email
        if ($tipo == 'E' || $tipo == 'e') {
            $datos = filter_var($datos, FILTER_SANITIZE_EMAIL);
        } else {
            $datos = filter_var(strtolower($datos), FILTER_SANITIZE_STRING);
        }
        return $datos;
    }

    // *************************************************************
    function verificarErrorJSON() {
        // verificamos si existio algun error al codificar en JSON.
        $error = null;
        $errorJson['codigo'] = json_last_error();
        if ($errorJson['codigo'] != JSON_ERROR_NONE) {
            $errorJson['mensaje'] = isset($ERRORS_JSON[$errorJson['codigo']]) ? $ERRORS_JSON[$errorJson['codigo']] : 'Unknown error';
            $error = "Error en la conversion JSON. codigo error: (" . $errorJson['codigo'] . ") Mensaje: " . $errorJson['mensaje'] . "<br>";
            // $pedidoJson = null;
        }
        // return $pedidoJson;
        return $error;
    }

    // *************************************************************
    // funcion para la conversion del Objeto "pedido" en un objeto JSON valido.
    // return SUCCESS = cadena Json, ERROR = null.
    function convertirPedido2Json($pedido) {
        $arrayPlatos = [];
        for ($i=0; $i < count($pedido); $i++) { 
            $arrayPlatos[$i] = $pedido[$i]->getPlatoJson();
        }
    
        $pedidoJson = json_encode($arrayPlatos);
        $error = verificarErrorJSON();
        if ($error != null) {
            $pedidoJson = null;
            debugCodigo($error, false);
        }

        return $pedidoJson;
    }

    // *************************************************************
    // funcion para convertir datos JSON en el objeto "PEDIDO"
    function convertObject2Pedido( $pedidoObject) {
        // stdClass
        // Plato_controlador
        $pedido = [];
        if (isset($pedidoObject[0])) {
            if ((get_class($pedidoObject[0])) != "Plato_controlador") {

                // convertimos los valores JSON a objetos 'Plato_controlador', 'Elemento_controlador' y 'Producto_controlador'
                foreach ($pedidoObject as $key => $pla) {
                    $elem = [];
                    for ($i=0; $i < count($pla->elementos) ; $i++) { 

                        $e = new Elemento_controlador($pla->elementos[$i]->cantidad, $pla->elementos[$i]->producto);
                        array_push($elem, $e);
                    }
                    $nuevoPlato = new Plato_controlador($pla->cantTotal, $elem, $pla->status, $pla->nombrePlato);
                    array_push($pedido, $nuevoPlato);
                }
            } else {
                // si la variable "$pedidoObject[0]" es de tipo "Plato_Controlador" => NO hay nada que cambiar
                $pedido = $pedidoObject;
            }
        } else {
            // No hay datos (platos) en la variable "$pedidoObject" == null
            $pedido = null;
        }
        return $pedido;
    }

    // *************************************************************
    // funcion para visualizar la tabla de resumen de productos en el modulo de pago
    function filaTablaResumenPedido(Producto_resumen_Controlador $val, $prod_desconocido) : string {
        
        $filaHtml =  "<tr class='" . $prod_desconocido . "'>";
        $filaHtml .=  '<td class="txt-centro" style="width: auto;">' . $val->getCantidad() . '</td>'; 
        $filaHtml .=  '<td>' . $val->getCodigo() . '</td>'; 
        $filaHtml .=  '<td class="izq">' . $val->getDescripcion() . '</td>';
        $filaHtml .=  '<td class="der">$ ' . $val->getPrecioUnidad() . '</td>';
        if ($val->getPrecioUnidad() == NO_APLICA) {
            $filaHtml .=  '<td class="der">' . NO_APLICA . '</td>';
        } else {
            $filaHtml .=  '<td class="der">$ ' . ($val->getCantidad() * $val->getPrecioUnidad()) . '</td>';
        }
        $filaHtml .=  '</tr>';
        return $filaHtml;
    }

    // *************************************************************
    // funcion para imprimir los diferentes toppings de un pedido en la comanda    
    function verToppingsComanda($tops) {
        $toppings = "";

        if ($tops === TODO) {
            $toppings = "";
        } else if($tops === NADA) {
            $toppings = "<li>NADA</li>";
        } else if(is_array($tops)) {
            if ($tops[0] === true) {
                foreach ($tops as $key => $t) {
                    if ($key > 0) {
                        $toppings = ($toppings . "<li class=''>CON_" . $t . "</li>");
                    }
                }
            } else {
                foreach ($tops as $key => $t) {
                    if ($key > 0) {
                        $toppings = ($toppings . "<li class='sin'>" . $t . "</li>");
                    }
                }
            }
            
        } else {
            $toppings = "ERROR! en los toppings";
        }
        return $toppings;
    }


