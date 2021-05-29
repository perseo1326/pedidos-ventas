
<body>
	<div class="flex-container centrar-elem ">
		<div class="">
			<!-- <a href="../controladores/comanda.controlador.php"> -->
			<a href="../controladores/imprimir_comanda.controlador.php">
				<img id="imgBienvenida" src="../images/doll.png" srcset="../images/doll.svg" alt="Anca la Yola muñeca"/>
			</a>
		</div>

		<div class="">
			<div class="inicio-botones">
				<a href="../controladores/main.controlador.php?destino=inicio"><button class="btn-inicio margen-b-1 ancho-100 txt-big">Iniciar Pedido</button></a>
				<a href="../controladores/main.controlador.php?destino=busqueda"><button class="btn-inicio margen-b-1 ancho-100 txt-big">Buscar Pedido</button></a>
				<button id="btnModalBusquedaPedido" class="no-visible btn-inicio margen-b-1 ancho-100 txt-big">Buscar Pedido</button>
			</div>
		</div>
	</div>

	<!-- Modal para la busqueda -->
	<div id="modalBusquedaPedido" class="modal">
		<div id="" class="padding-1 borde borde-rad-1 ancho-75 modal-contenido">
			<span id="modalClose" class="float-der close-modal ">&times;</span>
			<h2 class="txt-big margen-b-05">Búsqueda de Pedido</h2>
			<input type="text" class="borde borde-rad-05 ancho-100 margen-b-05" name="" id="">
			<br>
			<button class="btn-inicio margen-b-1 ancho-100 txt-big" type="submit">Buscar</button>
			</form>
		</div>
	</div>

	<script src="../js/inicio.js"></script>
</body>

</html>