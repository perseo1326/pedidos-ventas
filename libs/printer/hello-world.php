<?php
/* Call this file 'hello-world.php' */
require __DIR__ . '/vendor/autoload.php';
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
$connector = new FilePrintConnector("php://stdout");
$printer = new Printer($connector);
$printer -> text("\n\n\n\n\n\n\n\nHello World!\n");
echo "hola mundo...!\n";
$printer -> cut();
$printer -> close();
echo "\nfin del script";