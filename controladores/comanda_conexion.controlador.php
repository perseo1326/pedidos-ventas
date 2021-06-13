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
        $connector = new NetworkPrintConnector(PRINTER_ADDRESS, PRINTER_PORT);
        // $connector = new NetworkPrintConnector("192.168.1.101", 8000);
        $printer = new Printer($connector);

        $printer -> initialize();

        require_once "../vistas/comanda.vista.php";
        
        /* Close printer */
        $printer -> close();
    } catch (Exception $e) {
        echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
    }

?>


