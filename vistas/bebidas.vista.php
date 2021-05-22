
		<div class="flex-container flex-top">
			
		<!-- contenedor para las bebidas -->
			<div id="listado-bebidas" class="ancho-66 flex-container centrar-elem">
				
				<?php foreach ($listado_bebidas as $item => $value) : ?>
					<!-- Tarjetas para las bebidas -->
					<div id="<?php echo $value['codigo']; ?>" class="card-sabor bebida-card" title="Precio $<?php echo $value['precio']; ?>" data-id="<?php echo $value['id']; ?>" data-nombre="<?php echo $value['nombre']; ?>" data-precio="<?php echo $value['precio']; ?>" data-cantidad="0">
						<div class="bebida cant-bebida">
							<div class="txt-bebida"></div>
								<img
									class="card-imagen ancho-100"
									src="../images/pruebas/<?php echo $value['imagen']; ?>"
									alt="<?php echo $value['nombre']; ?>"
								/>
							<p class="txt-centro txt-medio"><?php echo $value['nombre']; ?></p>
						</div>
						<div class="flex-container">
							<button class="ancho-50 txt-medio txt-centro " onclick="javascript:bebidasCantidad('<?php echo $value['codigo']; ?>', true);">&plus;</button>
							<button class="ancho-50 txt-medio txt-centro " onclick="javascript:bebidasCantidad('<?php echo $value['codigo']; ?>', false);">&minus;</button>
						</div>
					</div>

				<?php endforeach; ?>

			</div>
		
			<!-- contenedor para el listado de productos seleccionados -->
			<div class="flex-container ancho-33">
				<h2 class="ancho-100 txt-centro txt-big margen-b-1">Bebidas</h2>
				<!-- Tabla para resumen de bebidas seleccionadas -->
				<div class="ancho-100">
					<table id="tabla" class="ancho-100 margen-b-1">
						<thead>
							<tr>
								<th>Cant</th>
								<th>Producto</th>
								<th>Precio</th>
							</tr>
						</thead>
						<tbody id="t-datos">
							<!-- datos dinamicos del pedido del cliente -->
						</tbody>
					</table>
				</div>

				<!-- botones de acciones -->
				<div class="acciones ancho-100">
					<div class="btn-acciones">
						<input
							id="pedido"
							data-destino="<?php echo DESTINO_PEDIDO; ?>"
							class="padding-05 txt-medio margen-b-05"
							type="button"
							value="Pedido"
						/>
						<input
							id="pagar"
							data-destino="<?php echo DESTINO_PAGAR; ?>"
							class="padding-05 txt-medio margen-b-05"
							type="button"
							value="Pagar"
						/>
						<input
							id="cancelar"
							class="padding-05 txt-medio margen-b-05"
							type="button"
							value="Cancelar"
						/>
					</div>
				</div>
			</div>

			<!-- formulario escondido para el envio de la informacion del pedido -->
			<div>
				<form id="form-bebidas" name="form-bebidas" action="main.controlador.php" method="POST">
					<input id="bebidas-var" type="hidden" name="bebidas" value="">
					<input id="destino-var" type="hidden" name="destino" value="">
				</form>
			</div>
		</div>

	</body>
		<script>
			<?php
				echo $bebidasJson;
			?>
		</script>
		<script src="../js/bebidas.js">
		</script>
