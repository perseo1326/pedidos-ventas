
		<!-- oncontextmenu="mostrarMenu(event, this.id, 'menu-contextual');return false;" -->
		<div id="panel-fondo" class="" onclick="javascript:esconderMenuPlato();"></div>

		<!-- tarjetas de los sabores -->
		<div id="panel-sabores" class="flex-container ancho-100 centrar-elem">
			
			<?php foreach ($saboresPedido as $key => $value) : ?>

				<!-- TARJETA SABORES <?php echo $key; ?> -->
				<div class="card-sabor" 
					data-codigo="<?php echo $value['cod_ingrediente']; ?>" 
					data-descripcion="<?php echo $value['ingrediente']; ?>">
					<input type="checkbox" name="<?php echo $value['cod_ingrediente']; ?>" id="<?php echo $value['cod_ingrediente']; ?>" />
					<label for="<?php echo $value['cod_ingrediente']; ?>">
						<div>
							<img
								class="card-imagen ancho-100"
								src="<?php echo '../' . IMAGENES_RUTA . $value['imagen']; ?>"
								alt="<?php echo $value['ingrediente']; ?>"
							/>
							<p class="txt-centro txt-medio"><?php echo $value['ingrediente']; ?></p>
						</div>
					</label>
				</div>

			<?php endforeach; ?>
		</div>

			<!-- nombre para el plato -->
		<div class="flex-container margen-05 fondo-suave centrar-elem flex-centrar padding-05 borde borde-rad-05">
			<p class="padding-05 txt-medio">Nombre para el plato: </p>
			<div class="flex-container limpiar-texto">
				<input class="borde borde-rad-05 txt-medio limpiar" type="text" name="iNombrePlato" id="iNombre-plato" autocomplete="off">
				<i class="fa fa-times" aria-hidden="true" onclick="javascript:limpiar('iNombre-plato')"></i>
			</div>
		</div>

		<!-- columna derecha -->
		<div class="float-der acciones ancho-25 clearfix">

			<!-- botones de acciones -->
			<div class="btn-acciones">
				<div class="flex-container centrar-elem margen-b-05">
					<div class="ancho-100 txt-centro">
						<label class="ancho-100 txt-big txt-centro padding-03" for="cantidad">Cantidad</label>
					</div>
					<div class="ancho-100 number-input">
						<button id="cantidadPlus" class="txt-big">
							&plus;
						</button>
						<input
							id="cantidad"
							class="txt-centro txt-medio"
							type="number"
							name="cantidad"
							min="1"
							step="1"
							max="99"
							value="1"
						/>
						<button id="cantidadMinus" class="txt-big">
							&minus;
						</button>
					</div>
				</div>

				<input
					id="adicionar"
					class="txt-medio margen-b-05 padding-vert-05"
					type="button"
					value="Añadir "
				/>
				<input
					id="nuevoPlato"
					class="txt-medio margen-b-05 padding-vert-05"
					type="button"
					value="Nuevo Plato"
				/>
				<input
					id="bebidas"
					data-destino="<?php echo DESTINO_BEBIDAS; ?>"
					class="txt-medio margen-b-05 padding-vert-05"
					type="button"
					value="Bebidas"
				/>
				<input
					id="pagar"
					data-destino="<?php echo DESTINO_PAGAR; ?>"
					class="txt-medio margen-b-05 padding-vert-05"
					type="button"
					value="Pagar"
				/>
				<input
					id="cancelar"
					class="txt-medio margen-b-05 padding-vert-05"
					type="button"
					value="Cancelar"
				/>
			</div>
		</div>

		<!-- seccion para los platos -->
		<div id="pedidoLista" class="float-izq pedido clearfix"></div>

		<!-- formulario escondido para el envio de la informacion del pedido -->
		<div>
			<form id="form-pedido" name="form-pedido" action="main.controlador.php" method="POST">
				<input id="pedido-var" type="hidden" name="pedido" value="">
				<input id="destino-var" type="hidden" name="destino" value="">
			</form>
		</div>

		<!-- modal para EDICION del plato -->
		<?php require_once "modalEdicion.vista.php"; ?>

	<script>
		<?php
			echo $pedidoJson;
		?>
	</script>

	<script src="../js/clases.js"></script>
	<script src="../js/pedido.js"></script>
