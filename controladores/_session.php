<?php

// visitar esta pagina para conocer mas sobre sesiones
// https://www.php.net/manual/es/function.session-set-cookie-params.php
// $lifetime=600;
// session_start();
// setcookie(session_name(),session_id(),time()+$lifetime);
// $sesion = session_get_cookie_params ();
// var_dump($sesion);

//Comprobamos si esta definida la sesión 'tiempo'.
if (isset($_SESSION['tiempo'])) {

    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];
    //Compraración para redirigir página, 
    // si la $vidasession es mayor a el tiempo permitido de la sesion (const TIEMPOSESION) =>
    // salir y cerrar la sesion, sino renovar la marca de tiempo.
    if ($vida_session > TIEMPOSESION) {
      error("La Sesión ha expirado.");
      // require 'cerrar.php';
    }
} else {
    //Activamos sesion tiempo.
    $_SESSION['tiempo'] = time();
}
