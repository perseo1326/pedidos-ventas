<?php

// require_once "../libs/vendor/autoload.php";

require_once "../admin/config.php";

    /* Change to the correct path if you copy this example! */
    // echo __DIR__;
    require_once  '../libs/vendor/autoload.php';
    use Mike42\Escpos\Printer;
    use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
    // use Mike42\Escpos\PrintConnectors\CupsPrintConnector;

    /* Most printers are open on port 9100, so you just need to know the IP 
    * address of your receipt printer, and then fsockopen() it on that port.
    */

    /* Font modes */
    $modes = array(
        Printer::MODE_FONT_B,
        Printer::MODE_EMPHASIZED,
        Printer::MODE_DOUBLE_HEIGHT,
        Printer::MODE_DOUBLE_WIDTH,
        Printer::MODE_UNDERLINE
    );
    
    $justification = array(
        Printer::JUSTIFY_LEFT,
        Printer::JUSTIFY_CENTER,
        Printer::JUSTIFY_RIGHT
    );

    try {
        $connector = new NetworkPrintConnector(PRINTER_ADDRESS, PRINTER_PORT);
        // $connector = new NetworkPrintConnector("192.168.1.101", 8000);
        // $connector = new CupsPrintConnector("tickets_1");

        $printer = new Printer($connector);

        $printer -> initialize();

        require_once "../vistas/comanda.vista.php";
        
        /* Close printer */
        $printer -> close();
    } catch (Exception $e) {
        echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
    }

?>

<!-- 

    use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
    $connector = new NetworkPrintConnector("192.168.1.252", 9100);

-->
