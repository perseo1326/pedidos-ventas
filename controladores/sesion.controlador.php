<?php

// require_once "../admin/config.php";

if (!isset($_SESSION['usuarioNombre']) && !isset($_SESSION['usuarioId'])) {

    // NO hay una sesion activa, forzar cierre de sesion e ir al login
    header('Location: ../controladores/cerrar_sesion.controlador.php');
}

// continuar con la ejecucion normal del script
