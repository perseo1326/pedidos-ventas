<?php 
session_start();


session_unset();
session_destroy();
$_SESSION = array();

// redirigir a la pagina de login
header('Location: ../index.php');

die();

?>