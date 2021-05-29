<?php

?>

<div class="ancho-100 padding-05">
    <h1 class="ancho-100 padding-05 txt-centro txt-big">Búsqueda de Pedido por:</h1>
    <form class="" action="" method="post">
        <div id="uno" class="flex-container ancho-100">
            <div class="ancho-25 padding-05">
                <label for="numPedido" class="ancho-100">Pedido No.</label>
                <input type="text" name="numPedido" id="" class="ancho-100" placeholder="Pedido #">
            </div>
            <div class="ancho-75 padding-05">
                <label for="nombre" class="ancho-100">Nombre</label>
                <input type="text" name="nombre" id="" class="ancho-100" placeholder="Nombre">
            </div>
        <!-- </div> -->
        <!-- <div id="dos" class="flex-container ancho-100"> -->
            <div class="ancho-25 padding-05">
                <label for="nombre" class="ancho-100">Precio</label>
                <input type="text" name="nombre" id="" class="ancho-100" placeholder="$">
            </div>
            <div class="ancho-25 padding-05">
                <label for="numPedido" class="ancho-100">No. Teléfono</label>
                <input type="text" name="numPedido" id="" class="ancho-100" placeholder="Teléfono">
            </div>
            <div class="ancho-25 padding-05">
                <label for="nombre" class="ancho-100">Fecha</label>
                <input type="text" name="nombre" id="" class="ancho-100" placeholder="Fecha">
            </div>
        </div>
        <div id="dos" class="flex-container ancho-100 centrar-elem margen-b-1">
            <button id="buscar" class="padding-05 ancho-25" type=""><span><i class="fa fa-search" aria-hidden="true"></i></span> Buscar</button>
            <button id="regresar" class="padding-05 ancho-25" type="reset"><span><i class="fa fa-undo" aria-hidden="true"></i></span> Regresar</button>
        </div>
    </form>

    <hr class="">
    
    <div class="flex-container ancho-100">
        <h2 class="margen-b-05 txt-centro txt-big ancho-100">Resultados</h2>
        <div class="flex-container ancho-100">
            <!-- Tabla resumen de pedidos -->
            <div class="ancho-100 borde">
                <table id="busqueda-pedidos" class="ancho-100 margen-b-1">
                    <thead>
                        <tr>
                            <th>No. Pedido</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Pagado</th>
                            <th>Precio</th>
                            <th>Telefono</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Detalle</th>
                            <th>Notas</th>
                        </tr>
                    </thead>
                    <tbody id="t-busqueda">
                        <!-- datos de los pedidos -->
                        <?php foreach ($mostrarUltimosPedidos as $key => $pedido) : ?>
                            <tr id='<?php echo $pedido->getNumPedido(); ?>'>
                                <td class='txt-centro'><?php echo $pedido->getNumPedido(); ?></td>
                                <td><?php echo $pedido->getNombre(); ?></td>
                                <td class='txt-centro'><?php echo $pedido->getTipoPedido(); ?></td>
                                <td class='txt-centro'><?php echo $pedido->getstatusPagado(); ?></td>
                                <td class='txt-centro'>$<?php echo $pedido->getTotal();?></td>
                                <td><?php echo $pedido->getTelefono();?></td>
                                <td><?php echo $pedido->getFecha(); ?></td>
                                <td><?php echo $pedido->getHora();?></td>
                                <td class='txt-centro'><a href='#'><i class='fa fa-chevron-circle-right' aria-hidden='true'></i></a></td>
                                <td class='txt-centro'><a href='#'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i></a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="../js/busqueda.js"></script>
