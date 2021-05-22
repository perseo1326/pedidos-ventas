<?php

session_start();

require_once 'admin/config.php';


?>

<!DOCTYPE html>
<html>

<head>

	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<link rel="stylesheet" href="./css/estilos.css" />

	<title>Anca la Yola</title>
</head>

    <body>
		<div class="flex-container fondo-suave centrar-elem" style="height: 400px">
			<input class="padding-1" id="boton" type="button" value="Ingresar al sistema....">
		</div>
	</body>
	<script>
		var boton = document.getElementById("boton");
		boton.onclick = function (e) {
			console.log(e);
			document.location.assign("controladores/inicio.controlador.php");
		}
	</script>
</html>
