<?php

require_once "../modelos/producto.modelo.php";

// get the q parameter from URL
$saboresObj = $_REQUEST["sabores"];

$saboresObj = json_decode($saboresObj);

// verificamos si existio algun error al codificar en JSON.
$errorJson['codigo'] = json_last_error();
if ($errorJson['codigo'] != JSON_ERROR_NONE) {
    $errorJson['mensaje'] = isset($ERRORS_JSON[$errorJson['codigo']]) ? $ERRORS_JSON[$errorJson['codigo']] : 'Unknown error';
    $txtJson = "Error en la conversion JSON. codigo error: (" . $errorJson['codigo'] . ") Mensaje: " . $errorJson['mensaje'] . "<br>";
    // echo $txtJson;
}

$saboresCodigo = [];
// objeto para el acceso a la ddbb de un producto (panucho)
$producto_mdl = new Producto_modelo();

foreach ($saboresObj as $key => $sabor) {
    $saboresCodigo[$key] = $sabor->codIngrediente;
}

$producto_mdl->setSabores_mdl($saboresCodigo);
$prodDetalle = $producto_mdl->getProductoDetalle_mdl();

if (count($prodDetalle) == 1) {
    $prodDetalle = $prodDetalle[0];
    $prodDetalle = json_encode($prodDetalle);
} else {

    $prodDetalle = json_encode($prodDetalle);
}

// echo "este es un valor";
// echo print_r($prodDetalle);
    echo $prodDetalle;
// echo $productoValido . "-" . "valor de respuesta";


// [{"codIngrediente":"res","descripcion":"Res"},{"codIngrediente":"bola","descripcion":"Q. Bola"},{"codIngrediente":"camaron","descripcion":"Camarón"}]