// *************************************************************
// **** ELEMENTOS HTML DE INTERACCION
// *************************************************************

let btnConfirmar = document.getElementById("confirmar");
var btnPedido = document.getElementById("pedido");
var btnBebidas = document.getElementById("bebidas");
var btnCancelar = document.getElementById("cancelar");

// elementos para el pedido por telefono o en tienda.
// input:radio
var pedidoAqui = document.getElementById("pedido-aqui");
var pedidoHablo = document.getElementById("pedido-hablo");

// div para el Telefono
let telPedido = document.getElementById("tel-pedido");
// div para mostrar el error en el tipo de pedido
let tipoPedido_div = document.getElementById("tipo-pedido-div");

// elementos para el nombre del pedido
let iNombrePedido = document.getElementById("iNombrePedido");
let nombrePedido_div = document.getElementById("NombrePedido")

// elementos para el tipo de pago: Efectivo / Transferencia
// radio button
var formaPagoEfectivo = document.getElementById("formaPagoEfectivo");
var formaPagoTransfer = document.getElementById("formaPagoTransfer");

// input:telefono
var iNumTelefono = document.getElementById("iNumTelefono");

// contenedores "div" para datos de pago en efectivo o transferencia
var pago_efectivo = document.getElementById("pago-efectivo");
var pago_transfer = document.getElementById("pago-transfer");

// contenedor "div" para mostrar Error! en tipo de pago
let tipoPago_div = document.getElementById("tipoPago-div");

// inputs number
var iPagoEfectivo = document.getElementById("pagoEfectivo");
var iPagoCambio = document.getElementById("pagoCambio");
var iPagoTransfer = document.getElementById("pagoTransfer");

// valores en la ventana de modal
let nombrePedido_Modal = document.getElementById("nombrePedido_Modal");
let tipoPedido_Modal = document.getElementById("tipoPedido_Modal");
let formaDePago_Modal = document.getElementById("formaDePago_Modal");
let btnConfirmarModal = document.getElementById("btnConfirmarModal");


// *************************************************************
// DECLARACION DE VARIABLES
// *************************************************************

const NO_APLICA = "N/A";
const PRESENCIAL = "AQUI";
const VIA_TELEFONO = "HABLO";
const EFECTIVO = "EFECTIVO";
const TRANSFERENCIA = "TRANSFERENCIA";
const PAGADO = "PAGADO";
const DEBE = "DEBE";

// var patron = /[0-9.]/;

// variable que contiene las estructuras de datos para el pedido
let pedidoPagar = [];

// variable que contiene los datos de pago, nombre, tipo de pedido, tipo de pago, etc.
let detallePedido = null;
detallePedido = JSON.parse(detallePedidoJSON);

// inicializacion de la variable "pedido" en caso de haber un pedido en curso. (memoria de la app)
if (pedidoJson != "") {
	pedidoPagar = JSON.parse(pedidoJson);
}

if(pedidoJson == "" && hayBebidas !== true) {
	alert("No se recibieron datos de pedido o el pedido esta en blanco.");
	console.log("No se recibieron datos de pedido o el pedido esta en blanco.");
}

// *************************************************************
// DECLARACION DE FUNCIONES
// *************************************************************

// *************************************************************
// retorna la forma de pago seleccionada (efectivo) o (transferencia)
// por defecto esta seleccionado "efectivo"
function formaDePagoValor() {
	let formaPago = "";
	if (formaPagoTransfer.checked) {
		formaPago = TRANSFERENCIA;
	} else {
		formaPago = EFECTIVO;
	}

	return formaPago;
}

// *************************************************************

function validarFormaDePago() {
	let error = "";
	let temp = formaDePagoValor();
	if (temp === TRANSFERENCIA && iPagoTransfer.value == "") {
		tipoPago_div.classList.add("fondo-error");
		error = "Debe indicar el número de la transferencia.\n";
	}
	return error;
}

// *************************************************************
// retorna el tipo de pedido: presencial(aqui), telefono(habló) o vacio ("")
function tipoPedidoValor() {
	let seleccion = "";
	if (document.getElementById("pedido-hablo").checked) {
		seleccion = VIA_TELEFONO;
	} else 
	if(document.getElementById("pedido-aqui").checked) {
		seleccion = PRESENCIAL;
	} else {
		seleccion = "";
	}

	return seleccion;
} 

// *************************************************************
// identifica si se selecciona hacer un pedido por: "telefono"
// y ajusta la clase correspondiente para que se muestre el label y el input text
function tipoPedidoSeleccion (typePedido) {
	if (typePedido.checked && typePedido.id == 'pedido-hablo') {
		telPedido.classList.remove("tel-pedido-disabled");
	} else {
		telPedido.classList.add("tel-pedido-disabled");
	}
}

// *************************************************************
// funcion para alternar detalles de pago con EFECTIVO o TRANSFERENCIA
function tipoPagoSeleccion(typePago) {
	if (typePago.checked && typePago.id == "formaPagoEfectivo") {
		
		pago_efectivo.classList.remove("tabcontent-disabled");
		pago_transfer.classList.add("tabcontent-disabled");
	} else {
		pago_efectivo.classList.add("tabcontent-disabled");
		pago_transfer.classList.remove("tabcontent-disabled");
	}
}

// *************************************************************
// validar el tipo de pedido, sino => Error!
function validarTipoPedido() {
	let error = "";
	let tipo = tipoPedidoValor();
	if(tipo === "") {
		tipoPedido_div.classList.add("fondo-error");
		error = "No ha seleccionado el tipo de Pedido.\n";
	} else if(tipo === VIA_TELEFONO && iNumTelefono.value == "") {
		tipoPedido_div.classList.add("fondo-error");
		error += "Debe proporcionar un numero de teléfono válido.\n";
	}

	return error;
}

// *************************************************************
// indica la pagina de destino seleccionada por el usuario y
function editarPedidoBebidas (paginaDestino) {
	// informar del destino seleccionado
	document.getElementById("destino-var").value = paginaDestino;
	// document.getElementById("pagado-var").value = pagado;
}

// *************************************************************
// actualiza los valores existentes para ser mostrados en la pagina al cargar ésta. (onload)
function actualizarDetallesPedido () {
	console.log("detalles pedido:");
	console.log(detallePedido);
	iNombrePedido.value = detallePedido.nombrePedido;
	iPagoTransfer.value = detallePedido.formaDePago_numTransfer;
	iNumTelefono.value = detallePedido.tipoPedido_numTelefono;

	// elegir el tipo de pedido
	if (detallePedido.tipoPedido == PRESENCIAL) {
		pedidoAqui.click();
	} else {
		pedidoHablo.click();
	}

	// elegir la forma de pago
	if (detallePedido.formaDePago == EFECTIVO) {
		formaPagoEfectivo.click();
	} else if(detallePedido.formaDePago == TRANSFERENCIA) {
		formaPagoTransfer.click();
	} 
}

// *************************************************************
// funcion para colocar los valores a "detallePedido"
function setDetallePedido(nombre, telefono, numTransf) {
	detallePedido.nombrePedido = nombre;
	detallePedido.tipoPedido = tipoPedidoValor();
	detallePedido.tipoPedido_numTelefono = telefono;
	detallePedido.formaDePago = formaDePagoValor();
	detallePedido.formaDePago_numTransfer = numTransf;
	console.log("detnro de set detalle pedido");
	console.log(detallePedido);
}

// *************************************************************
// funcion para cargar los valores de "detallePedido" en la ventana modal
function modalDetallePedido() {
	nombrePedido_Modal.innerHTML = detallePedido.nombrePedido;
	if (detallePedido.tipoPedido_numTelefono === "") {
		tipoPedido_Modal.innerHTML = detallePedido.tipoPedido;
	} else {
		tipoPedido_Modal.innerHTML = detallePedido.tipoPedido + " / " + detallePedido.tipoPedido_numTelefono;
	}
	if(detallePedido.formaDePago_numTransfer === "") {
		formaDePago_Modal.innerHTML = detallePedido.formaDePago;
	} else {
		formaDePago_Modal.innerHTML = detallePedido.formaDePago + " / " + detallePedido.formaDePago_numTransfer;
	}
}

// *************************************************************
// 	RESPUESTAS A EVENTOS
// *************************************************************

iNombrePedido.onfocus = function () {
	nombrePedido_div.classList.remove("fondo-error");
}

tipoPedido_div.onclick = function () {
	this.classList.remove("fondo-error");
}

tipoPago_div.onclick = function () {
	this.classList.remove("fondo-error");
}

pedidoAqui.onclick = function () {
	tipoPedidoSeleccion(this);
}

pedidoHablo.onclick	 = function () {
	tipoPedidoSeleccion(this);
}

formaPagoEfectivo.onclick = function () {
	tipoPagoSeleccion(this);
}

formaPagoTransfer.onclick = function () {
	tipoPagoSeleccion(this);
}

iNumTelefono.onkeypress = function (e) {
	if(!filtrarCaracteres(e)) {
		e.preventDefault();
	}
}

iNumTelefono.onfocus = function () {
	tipoPedido_div.classList.remove("fondo-error");
}

iPagoEfectivo.onkeyup = function (e) {
	iPagoCambio.value = "";
	if(!filtrarCaracteres(e) || (this.value > 10000)) {
		e.preventDefault();
	}

	// mostrar el cambio necesario segun el pago
	if ( !isNaN(detallePedido.total)) {
		if (this.value >= detallePedido.total) {
			iPagoCambio.value = Number(this.value - detallePedido.total); 
		}
	}
}

iPagoTransfer.onfocus = function () {
	tipoPago_div.classList.remove("fondo-error");
}

// *************************************************************
// **** BOTONES ACCIONES
// *************************************************************

btnConfirmar.onclick = function () {
	let msgError = "";
	let temp = "";
	// si hay productos con codigo DESCONOCIDO => Erorr!
	if(document.getElementsByClassName("desconocido").length != 0) {
		msgError = "Ha seleccionado uno o más productos NO válidos.\n";
	}

	// si nombre es vacio => Error!
	if (iNombrePedido.value == "") {
		nombrePedido_div.classList.add("fondo-error");
		msgError += "Debe asignar un nombre para el Pedido.\n";
	}

	// validar el tipo de pedido, sino Error!
	temp = validarTipoPedido();
	if(temp !== "") {
		msgError += temp;
	}

	// validar si la forma de pago esta correcta, sino Error!
	temp = validarFormaDePago();
	if(temp != "") {
		msgError += temp;
	}

	if (detallePedido === null && hayBebidas === false) {
		console.log("No hay pedido que procesar!");
		msgError += "No hay pedido que procesar!";
	}

	if (msgError == "") {
		setDetallePedido(iNombrePedido.value, iNumTelefono.value, iPagoTransfer.value);
		modalDetallePedido();
		mostrarModal("modal-pagar");
	} else {
		alert(msgError);
		console.log("Error(s):");
		console.log(msgError);
	}
}

// *************************************************************
btnPedido.onclick = function () {
    editarPedidoBebidas(btnPedido.dataset['destino']);
	document.getElementById("form-pagar").submit();
}

// *************************************************************
btnBebidas.onclick = function () {
    editarPedidoBebidas(btnBebidas.dataset['destino']);
	document.getElementById("form-pagar").submit();
}

// *************************************************************
btnCancelar.onclick = function () {
    editarPedidoBebidas(btnCancelar.dataset['destino']);
	document.getElementById("form-pagar").submit();
}

// *************************************************************
// boton confirmarModal, para enviar los datos a la ddbb
btnConfirmarModal.onclick = function () {
	// console.log("btnConfirmarModal");
	let estadoPago = document.getElementsByClassName("pago");
	if (estadoPago[0].checked) {
		detallePedido.pagado = PAGADO;
	} else if(estadoPago[1].checked) {
		detallePedido.pagado = DEBE;
	} else {
		detallePedido.pagado = "";
		alert("Debe seleccionar el estado del pago, PAGADO o PENDIENTE.");
		console.log("Debe seleccionar el estado del pago, PENDIENTE o PAGADO.");
	}
	
	// console.log("DetallePedido listo para enviar!!");
	// console.log(detallePedido);	

	if (detallePedido.pagado != "") {
		document.getElementById("destino-var").value = this.dataset['destino'];
		document.getElementById("pagado-var").value = detallePedido.pagado;
		document.getElementById("form-pagar").submit();
	}
}

// *************************************************************
// **** 	ONLOAD pagina
// *************************************************************

refrescarListaPedido(pedidoPagar, "listaPedidoPlatos", false);

if (detallePedido != null) {
	// actualizar los datos provenientes del servidor de una pagina anterior.
	actualizarDetallesPedido();
}

