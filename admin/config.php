<?php
// ****************************************************************
// CONSTANTES DEFINIDAS Y SU LOCALIZACION
// ****************************************************************

// definiciones de configuracion del sitio
// const SERVIDOR = "http://192.168.1.101/ancalayola/";
// $SERVIDOR = "http://192.168.1.101/ancalayola/";


// definiciones para las pagina destino que seleccione el usuario
const PEDIDO_PAG = 'PEDIDO_PAG';
const BEBIDAS_PAG = 'BEBIDAS_PAG';
const PAGAR_PAG = 'PAGAR_PAG';
const DESTINO_CONFIRMAR = "CONFIRMAR_PEDIDO";

// constante para indicar qeu un ingrediente es "INDEFINIDO" -> ver tabla ingredientes ddbb
const INDEFINIDO = "indef";

// constante para indicar qeu un ingrediente es de tipo "pedido" -> ver tabla ingredientes ddbb
const INGRED_TIPO_PEDIDO = 'pedido';

// MODULO PEDIDOS

//  constante con el tipo de categoria para la busqueda en la DDBB de los productos "panuchos"
const CATEG_PANUCHOS = "P";

// MODULO BEBIDAS

// Definir constante para elcodigo de las bebidas para la consulta en la ddbb
define('BEB_AGUAS_SABORES', 'AgS');     // AgS = Aguas de sabores
define('BEB_AGUAS_NORMAL', 'AgB');       // AgB = aguas embotelladas
define('BEB_COCACOLA', 'coca');         // coca = Coca-cola variedades
define('BEB_OTROS_REFRESCOS', 'ORefr');

// define la ruta de las imagenes
define('IMAGENES_RUTA', 'images/');

// MODULO PAGAR

const NO_APLICA = "N/A";
const UNKNOWN = "XXX";
// tipo de pedido
const PRESENCIAL = "AQUI";
const VIA_TELEFONO = "HABLO";
const EFECTIVO = "EFECTIVO";
const TRANSFERENCIA = "TRANSFERENCIA";

// estado del pago
const PAGADO = "PAGADO";
const DEBE = "DEBE";

// MODULO CONFIRMAR PEDIDO EN DDBB

// constantes que indican si un pedido ha sido pagado o no en la ddbb
const PAGADO_SI = 'Y';
const PAGADO_NO = 'N';

const ESTADO_PEDIDO = ['CREACION' => 'CREACION', 'PEDIDO' => 'PEDIDO', 'PREPARACION' => 'PREPARACION', 'TERMINADO' => 'TERMINADO', 'ENTREGADO' => 'ENTREGADO' ];

const PEDIDO_DESTINO = ['AQUI' => 'AQUI', 'LLEVAR' => 'LLEVAR', 'MIXTO' => 'MIXTO' ];

// ****************************************************************
// TIPOS DE SABORES Y CARACTERISTICAS

// MODULO PARA IMPRESION DE LA COMANDA

const TODO = "TODO";
const NADA = 'NADA';
const TOPPINGS = ['FRIJOLTOP' => 'FRIJOL', 'VERDURA' => 'REPOLLO', 'QRAYADO' => 'qRAYADO', 'CEBOLLA' => 'CEBOLLA', 'TOMATE' => 'TOMATE'];

// MODULO DE BUSQUEDA

const DIAS_SEMANA = ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'];
const MESES_ANNO = [' ', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dec'];

// contiene las columnas de la tabla "PEDIDOS" para las busquedas
const ELEMENTOS = ['numPedido' => 'pedidos_numPedido',
                    'nombre' => 'pedidos_nombre', 
                    'numTelefono' => 'pedidos_numtelefono', 
                    'total' => 'pedidos_total', 
                    'fecha' => 'pedidos_fcreacion' ]; 
