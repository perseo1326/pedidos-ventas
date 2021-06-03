<?php

session_start();

require_once "../controladores/funciones.controlador.php";

require_once "../admin/config.php";
require_once "../controladores/sesion.controlador.php";
require_once "../modelos/buscar.modelo.php";

// contiene las columnas de la tabla "PEDIDOS" para las busquedas
// constante declarada en "config.php"
// const ELEMENTOS = ['numPedido' => 'pedidos_numPedido',
//                     'nombre' => 'pedidos_nombre', 
//                     'fecha' => 'pedidos_fcreacion', 
//                     'numTelefono' => 'pedidos_numtelefono', 
//                     'total' => 'pedidos_total' ];


debugCodigo($_GET, true);

if (isset($_GET['elemento']) && isset($_GET['valor'])) {

    $busqueda = new Buscar_modelo;

    $elemento = $_GET['elemento'];
    // validar el dato y asegurar que es NUMERICO, sin puntos, etc
    $valor =    limpiarDatos($_GET['valor']);
    if (!is_numeric($valor)) {
        // si el valor no es numerico => el registro No. 0 !E => mostrara ERROR!
        $valor = 0;
    }


    if (array_key_exists($elemento, ELEMENTOS) ) {
        $busqueda->buscarElemento(ELEMENTOS[$elemento], $valor);
        if ($busqueda->countResultadosBusqueda() == 0) {
            $error = "No se obtuvieron datos de la búsqueda.\n";
            echo "No se obtuvieron datos de la búsqueda.\n";
        }
        
    } 

    debugCodigo($busqueda, true, "BUSQUEDA");


}
