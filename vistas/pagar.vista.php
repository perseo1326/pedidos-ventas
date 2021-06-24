    <div class="ancho-100 flex-container margen-a-05">
        <div class="ancho-66 padding-05 ">

            <h2 class="ancho-100 txt-centro txt-big margen-b-1">Resumen del Pedido</h2>

            <!-- Tabla para resumen de productos seleccionadas -->
            <div class="ancho-100">
                <table id="tablaResumenProductos" class="ancho-100 margen-b-1">
                    <thead>
                        <tr>
                            <th>Cant</th>
                            <th>Cód</th>
                            <th>Producto</th>
                            <th>Unidad</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody id="tResumen-datos">
                        <!-- datos dinamicos del pedido del cliente -->
                        <?php 
                            foreach ($resumenPedido as $key => $val) {
                                if (gettype($val) === "array") {
                                    foreach ($val as $key => $v) {
                                        $prod_desconocido = "desconocido";
                                        echo filaTablaResumenPedido($v, $prod_desconocido);
                                    }
                                } else {
                                    $prod_desconocido = "";
                                    echo filaTablaResumenPedido($val, $prod_desconocido);
                                }
                            }
                            echo "<tr class='totales txt-neg'>";
                                echo '<td class="txt-centro" style="width: auto;">' . $detallePedido->getTotalProductos() . '</td>'; 
                                echo '<td>Total Productos</td>'; 
                                echo '<td class="izq">Total a Pagar</td>';
                                echo '<td class="der"></td>';
                                echo '<td class="der">$ ' . $detallePedido->getTotal() . '</td>';
                            echo '</tr>';
                        ?>

                    </tbody>
                </table>
            </div>

            <!-- contenedor para el listado de PLATOS seleccionados -->
            <div id="listaPedidoPlatos" class="ancho-100 flex-container">
            </div>

        </div>

        <!-- ************************************************************* -->
        <!-- PANEL DE CONTROL - LATERAL -->

        <div class="flex-container ancho-33">
            <form id="form-pagar" class="ancho-100" name="form-pagar" action="main.controlador.php" method="POST">

                <input id="pagado-var" type="hidden" name="pagado" value="">
                <input id="destino-var" type="hidden" name="destino" value="">

                <!-- nombre para el pedido -->
                <div id="NombrePedido" class="borde borde-rad-05 margen-b-05 flex-container centrar-elem padding-05">
                    <h2><label class="txt-big margen-b-05" for="iNombrePedido">Nombre Pedido</label></h2>
                    <div class="flex-container limpiar-texto">
                        <input id="iNombrePedido" class="ancho-100 borde borde-rad-05 txt-medio limpiar" type="text" name="nombrePedido" />
                        <i class="fa fa-times" aria-hidden="true" onclick="javascript:limpiar('iNombrePedido')"></i>
                    </div>

                </div>

                <!-- forma de pedido: presencial o por telefono -->
                <div class="borde borde-rad-05 margen-b-05">

                    <!-- TITULO tipo de pedido -->
                    <div class="borde-b padding-05 margen-b-05">
                        <h2 class="txt-centro txt-big">Tipo de Pedido</h2>
                    </div>

                    <div id="tipo-pedido-div" class="flex-container centrar-elem margen-b-05">

                        <!-- pedido por telefono -->
                        <div class="ancho-50 flex-container centrar-elem">
                            <input class="" id="pedido-hablo" type="radio" name="tipo_pedido" value="<?php echo VIA_TELEFONO; ?>" />
                            <label class="pago-pedido" for="pedido-hablo">
                                <i class="txt-icono fa fa-phone" aria-hidden="true"></i>
                            </label>
                        </div>

                        <!-- pedido presencial -->
                        <div class="ancho-50 flex-container centrar-elem">
                            <input class="" id="pedido-aqui" type="radio" name="tipo_pedido" value="<?php echo PRESENCIAL; ?>" />
                            <label class="pago-pedido" for="pedido-aqui">
                                <i class="txt-icono fa fa-map-marker" aria-hidden="true"></i>
                            </label>
                        </div>

                    </div>


                    <!-- # TELEFONO para pedido por telefono -->
                    <div id="tel-pedido" class="ancho-100 padding-05 tel-pedido tel-pedido-disabled">
                        <label class="txt-medio" for="numtelefono" >No. Teléfono</label>
                        <div class="flex-container limpiar-texto">
                            <input id="iNumTelefono" class="ancho-100 borde borde-rad-05 limpiar" type="tel" name="numtelefono" autocomplete="off" />
                            <i class="fa fa-times" aria-hidden="true" onclick="javascript:limpiar('iNumTelefono')"></i>
                        </div>
                    </div>
                </div>

                <!-- forma de pago -->
                <div class="borde borde-rad-05">

                    <div class="borde-b margen-a-05">
                        <h2 class="txt-centro txt-big">Forma de pago</h2>
                    </div>

                    <div id="tipoPago-div" class="flex-container centrar-elem padding-05">
                        
                        <!-- PAGO EN EFECTIVO -->
                        <input id="formaPagoEfectivo" type="radio" name="forma-pago" value="<?php echo EFECTIVO; ?>" checked />
                        <label class="pago-pedido" for="formaPagoEfectivo">
                            <!-- <span class="borde borde-rad-05 padding-05 txt-medio">Efectivo</span> -->
                            <!-- <i class="txt-icono fa fa-money" aria-hidden="true"></i> -->
                            <i class="txt-icono fa fa-usd" aria-hidden="true"></i>
                        </label>
                        
                        <!-- PAGO CON TRANSFERENCIA -->
                        <input type="radio" name="forma-pago" id="formaPagoTransfer" value="<?php echo TRANSFERENCIA; ?>">
                        <label class="pago-pedido" for="formaPagoTransfer">
                            <!-- <span class="borde borde-rad-05 padding-05 txt-medio">Transfer</span> -->
                            <i class="txt-icono fa fa-credit-card" aria-hidden="true"></i>
                        </label>
                    </div>

                    <!-- TOTAL $$$ -->
                    <div class="flex-container padding-05">
                        <span class="ancho-50 txt-big">Total:</span>
                        <?php echo $formaPagoTotalTxt;?>
                    </div>

                    <!-- div para pago en EFECTIVO  -->
                    <div id="pago-efectivo" class="borde-rad-05 padding-05 tabcontent">

                        <label class="" for="efectivo">Efectivo Pago:</label>
                        <div class="flex-container limpiar-texto">
                            <input id="pagoEfectivo" class="borde borde-rad-05 ancho-100 limpiar txt-centro" type="number" min="0" max="10000" name="efectivo">
                            <i class="fa fa-times" aria-hidden="true" onclick="javascript:limpiar('pagoCambio'); limpiar('pagoEfectivo');"></i>
                        </div>

                        <label class="" for="cambio">Cambio:</label>
                        <div class="flex-container limpiar-texto">
                            <input id="pagoCambio" class="borde borde-rad-05 ancho-100 limpiar txt-centro" type="number" name="cambio" value="" readonly>
                            <!-- <i class="fa fa-times" aria-hidden="true" onclick="javascript:limpiar('pagoCambio')"></i> -->
                        </div>
                    </div>

                    <!-- div para pago con TRANSFERENCIA -->
                    <div id="pago-transfer" class="borde-rad-05 padding-05 tabcontent tabcontent-disabled">
                        <label class="" for="transferNum">Transferencia No.</label>
                        <div class="flex-container limpiar-texto">
                            <input id="pagoTransfer" class="borde borde-rad-05 ancho-100 limpiar txt-centro" type="text" name="transferNum">
                            <i class="fa fa-times" aria-hidden="true" onclick="javascript:limpiar('pagoTransfer')"></i>
                        </div>
                    </div>

                </div>

            </form>

            <!-- botones de acciones -->
            <div class="acciones ancho-100">
                <div class="btn-acciones">
                    <input id="confirmar" class="txt-medio padding-vert-05 margen-b-05" type="button" value="Confirmar" />
                    <input id="pedido" data-destino="<?php echo DESTINO_PEDIDO; ?>" class="txt-medio padding-vert-05 margen-b-05" type="button" value="Pedido" />
                    <input id="bebidas" data-destino="<?php echo DESTINO_BEBIDAS; ?>" class="txt-medio padding-vert-05 margen-b-05" type="button" value="Bebidas" />
                    <div class="ancho-100 padding-1"> </div>
                    <input id="cancelar" class="txt-medio padding-vert-05 margen-b-05" type="button" value="Cancelar" />
                </div>
            </div>
        </div>

    </div>

    <!-- modal para confirmar los datos de pago -->
    <div id="modal-pagar" class="modal">
        <div class="ancho-100 padding-1 borde-rad-1 modal-contenido">
            <div id="resumen-pedido" class="margen-b-05 plato flex-container">
                <h2 class="ancho-100 txt-big txt-centro">Confirmar Pedido</h2>
                <div class="ancho-100 flex-container">
                    <p class="ancho-50 txt-medio padding-05 txt-der">Nombre del Pedido:</p>
                    <p id="nombrePedido_Modal" class="ancho-50 txt-medio padding-05">John Skolik</p>
                </div>
                <div class="ancho-100 flex-container">
                    <p class="ancho-50 txt-medio padding-05 txt-der">Tipo de Pedido:</p>
                    <p id="tipoPedido_Modal" class="ancho-50 txt-medio padding-05">Telefono / 99 3252 0949</p>
                </div>
                <div class="ancho-100 flex-container">
                    <p class="ancho-50 txt-medio padding-05 txt-der">Forma de Pago:</p>
                    <p id="formaDePago_Modal" class="ancho-50 txt-medio padding-05">Transfer / 75136849582</p>
                </div>
                <div class="ancho-100 flex-container flex-centrar centrar-elem_">
                    <div class="ancho-25">
                        <input class="pago" type="radio" name="pago" id="iPagado">
                        <label class="margen-lateral-1 padding-05 borde borde-rad-05 txt-centro txt-medio" for="iPagado"><i class="fa fa-check" aria-hidden="true"></i>Pagado</label>
                    </div>
                    <div class="ancho-25">
                        <input class="pago" type="radio" name="pago" id="iPendiente">
                        <label class="debe margen-lateral-1 padding-05 borde borde-rad-05 txt-centro txt-medio" for="iPendiente"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Debe</label>
                    </div>
                </div>
            </div>
            <div class="flex-container flex-espaciados">
                <input
                id="btnConfirmarModal"
                data-destino="<?php echo DESTINO_CONFIRMAR; ?>"
                class="ancho-33 btn-inicio txt-medio"
                type="button"
                value="Confirmar"
                />

                <input
                id=""
                class="ancho-33 btn-inicio txt-medio"
                type="button"
                value="Regresar"
                onclick="javascript:document.getElementById('modal-pagar').style.display = 'none';"
                />
            </div>
        </div>
    </div>

    <script>
		<?php
			echo "$pedidoJson";
            echo "$detallePedidoJSON";
            echo "$hayBebidas";
		?>
	</script>

    <script src="../js/pagar.js"></script>