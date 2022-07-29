<?php
	// session_start();

	$tituloPagina = (isset($tituloPagina)) ? (" - " . $tituloPagina) : "";

?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">  -->
		<!-- hoja de estilos para iconos -->
		<link rel="stylesheet" href="../css/all.css" />
		<!-- font Awsome 4.7 iconos -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- <link rel="stylesheet" href="../css/font-awesome.min.css"> -->
		<link rel="stylesheet" href="../css/estilos.css" />
		<link rel="stylesheet" href="../css/elementos.css" />
		<link rel="stylesheet" href="../css/impresora-comanda.css">
		<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
		<script src="../js/funcionesComunes.js"></script>
		<title>Anca la Yola <?php echo $tituloPagina; ?></title>
	</head>
	<body>
		<header class="flex-container ancho-100">
			<div class="ancho-75">
			</div>
			<div class="flex-container flex-der ancho-25">
				<div class="dropdown" >
					<button id="cerrarSesion" class="dropbtn">Administrador</button>
					<div class="dropdown-content">
						<a href="../controladores/cerrar_sesion.controlador.php">Cerrar Sesion</a>
					</div>
				</div>
			</div>
		</header>
