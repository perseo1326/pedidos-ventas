<?php

?>

    <div id="hoja" class="">
        <p style="display: inline;">---------1---------2---------3---------4---------5---------6---------7---------8---------9---------0</p>
        <h2 class="centro">Pedido No.<?php echo $_SESSION['numUltimoPedido']; ?></h2>

        <!-- datos del cliente -->
        <div class="cliente">
            
            <!-- nombre para el pedido -->
            <h2>Nombre: <?php echo strtoupper($detallePedido->getNombre()); ?></h2>

            <!-- tipo de pedido (AQUI - LLAMADA) -->
            <p><?php echo $detallePedido->getTipoPedido() . $numTel; ?></p>

            <!-- estado pagado del pedido -->
            <p class="p-pago sub centro"><?php echo $estadoPagado; ?></p>
        </div>
        <br>
        
        <?php
        // iterar cada uno de los PLATOS y sus ELEMENTOS y PRODUCTOS
        foreach ($pedido as $key => $pla) {

            echo "<div class='p-plato'>";
            echo    "<h3>Plato No. " . ($key + 1) . "</h3>";
            $nombre = $pla->getNombrePlato();
            if ($nombre !== "") {
                echo "<h4>Nombre Plato: " . strtoupper($nombre) . "</h4>";
            }
            for ($i=0; $i < $pla->getCantidadElementos(); $i++) {    

                echo "<p>(<span class='p-cantidad'>" . $pla->getElemento($i)->getCantidad() ."</span>) " . $pla->getElemento($i)->getProducto()->getDescripcion() . "</p>";

                // valores para los toppings TO-DO
                $tops = $pla->getElemento($i)->getProducto()->getToppings();

                $tops = verToppingsComanda($tops);
                if ($tops != "") {
                    echo "<ul>";
                        echo $tops;
                    echo "</ul>";
                }
                // debugCodigo($tops, true, "toppings");

            }
            echo "</div>";
        }

        echo "<br>";

        // BEBIDAS
        if (count($bebidas) > 0 ) {
            echo "<div class='p-bebidas'>";
                echo "<h1 class='centro'>Bebidas:</h1>";
                foreach ($bebidas as $key => $bebida) {
                    echo "<p>(" . $bebida->cantidad . ") " . $bebida->nombre . "</p>";
                }
            echo "</div>";
            echo "<br>";
        }

        ?>

    </div>

    <!-- FIN DEL DOCUMENTO -->
