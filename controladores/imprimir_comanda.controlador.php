<?php

// require_once "../libs/vendor/autoload.php";

    /* Change to the correct path if you copy this example! */
    // echo __DIR__;
    require_once  '../libs/vendor/autoload.php';
    use Mike42\Escpos\Printer;
    use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

    /* Most printers are open on port 9100, so you just need to know the IP 
    * address of your receipt printer, and then fsockopen() it on that port.
    */
    try {
        // $connector = new NetworkPrintConnector("192.168.1.251", 9100);
        $connector = new NetworkPrintConnector("192.168.1.101", 8000);
        $printer = new Printer($connector);


        $printer -> initialize();

        $printer -> text("--------------------------------------------------");
        $printer -> text("Pedido No: 2345\n");
        $printer -> text("123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 \n");
        $printer -> text("esta es la segunda impresion\n");
        $printer -> cut();
        
        /* Close printer */
        $printer -> close();
    } catch (Exception $e) {
        echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
    }

    
    // require_once "../vistas/comanda.vista.php";

    require_once ("../vistas/plantilla.vista.php");

    
?>

<div id="hoja" class="">
<p>---------1---------2---------3---------4---------5---------6---------7---------8---------9---------0</p>
<h2 class="centro">Pedido No. 23</h2>
<!-- <br> -->
<div class="p-plato">
    <h3>Plato No. 10</h3>
    <h4>AGUSTINIANO RODRIGUEZ</h4>
    <p>(<span class="p-cantidad">15</span>) P-Queso-Camarón-Frijol</p>
    <ul>
        <li class="sin">VERDURA</li>
        <!-- <li class="sin_"><span><img src="../images/otras/tomate_2.svg" alt=""></span></li> -->
        <li class="sin">TOMATE</li>
    </ul>
</div>

<!-- segundo plato -->
<div class="p-plato">
    <h3>Plato No. 2</h3>
    <h4>AGUSTINIANO RODRIGUEZ</h4>
    <p>(<span class="p-cantidad">2</span>) P-Queso-Camarón-Frijol</p>
    <p>(<span class="p-cantidad">1</span>) P-Camarón-Frijol</p>
        <ul>
            <li class="">NADA</li>
        </ul>
    <p>(<span class="p-cantidad">1</span>) P-Camarón-Frijol</p>
        <ul id="ul">
            <li class="sin">VERDURA</li>
            <li class="sin">RALLADO</li>
            <li class="sin">TOMATE</li>
            <li class="sin">CEBOLLA</li>
        </ul>
</div>
<!-- BEBIDAS -->
<br>
<div class="p-bebidas">
    <h1>Bebidas:</h1>
    <p>(2) Horchata Litro</p>
    <p>(1) Horchata 500ml</p>
    <p>(3) Coca-Cola 600ml</p>
</div>
<br>

<!-- final del pedido y datos del cliente -->
<div class="cliente">
    <h2>Marco Antonio Solis</h2>
    <p>llamada (9932520949)</p>
    <!-- <p>Aquí</p> -->
    <p class="p-pago sub centro">DEBE</p>
    <!-- <p class="p-pago sub">PAGADO</p> -->
</div>
<br>

<p>---------1---------2---------3---------4---------5---------6---------7---------8---------9---------0</p>
<h2 class="centro">Pedido No. 23</h2>
<!-- <br> -->
<div class="p-plato">
    <h3>Plato No. 10</h3>
    <h4>AGUSTINIANO RODRIGUEZ</h4>
    <p>(<span class="p-cantidad">15</span>) P-Queso-Camarón-Frijol</p>
    <ul>
        <li class="sub">FRIJOL</li>
        <li class="sub">RALLADO</li>
    </ul>
</div>
</div>

<script>
let u = document.getElementById("ul");
console.log(u);
</script>




    // require_once "../vistas/comanda.vista.html";

    require_once ("../vistas/fin_pagina.vista.php");