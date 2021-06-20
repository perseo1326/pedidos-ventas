
// *************************************************************
// VARIABLES PRESENTACION
// *************************************************************

// sabores - checkboxes
// NOTA: tener presente que estos id's DEBEN ser iguales a los codigos almacenados 
// en la tabla "INGREDIENTES" en la ddbb. Este proceso es automatico

let panelSabores = document.getElementsByClassName("card-sabor");

var cbPollo = 	panelSabores[0].getElementsByTagName("input")[0];
var cbCerdo = 	panelSabores[1].getElementsByTagName("input")[0];
var cbRes = 	panelSabores[2].getElementsByTagName("input")[0];
var cbQueso = 	panelSabores[3].getElementsByTagName("input")[0];
var cbBola = 	panelSabores[4].getElementsByTagName("input")[0];
var cbCamaron = panelSabores[5].getElementsByTagName("input")[0];
var cbFfrijol = panelSabores[6].getElementsByTagName("input")[0];
var cbAzucar = 	panelSabores[7].getElementsByTagName("input")[0];
// var cbManual = 	panelSabores[8].getElementsByTagName("input")[0];
// *************************************************************

var iNombrePlato = 	document.getElementById("iNombre-plato");

var iCantidad =  	document.getElementById("cantidad");
var bCantPlus =  	document.getElementById("cantidadPlus");
var bCantMinus = 	document.getElementById("cantidadMinus");

var bAdicionar = 	document.getElementById("adicionar");
var bNuevoPlato = 	document.getElementById("nuevoPlato");
var bBebidas = 		document.getElementById("bebidas");
var bPagar = 		document.getElementById("pagar");
var bRegresar = 	document.getElementById("cancelar");

var modalEdicion = document.getElementById("modalEdicion");
var modalEdicionAceptar = 	document.getElementById("modalEdicionAceptar");

// *************************************************************
// *** 	CONSTANTES Y VARIABLES DE DEFINICIONES
// ***  ESTRUCTURAS DE DATOS
// *************************************************************

// variable para expresion regular
let patronAlfaNumerico = /[a-zA-Z0-9]/;
// patt.test(

// variable que contiene las estructuras de datos para el pedido
var pedido = [];

// inicializacion de la variable "pedido" en caso de haber un pedido en curso. (memoria de la app)
if (pedidoJson != "") {
	pedidoTemporal = JSON.parse(pedidoJson);
	
	pedidoTemporal.forEach(pla => {
		elem = [];

		pla.elementos.forEach(e => {
			e = new Elemento(e.cantidad, e.producto);
			elem.push(e);
		});
		
		platoPedido = new Plato(pla.cantTotal, elem, pla.status, pla.nombrePlato);
		pedido.push(platoPedido);
	});
}

// console.log("valor de pedido:");
// console.log(pedido);

// estado de un plato, abierto o cerrado
const status = { CERRADO: "CERRADO", ABIERTO: "ABIERTO" };

// array con los sabores
const kSabores = {
	pollo: { 
		codIngrediente:	panelSabores[0].dataset['codigo'],
		descripcion:	panelSabores[0].dataset['descripcion'] } ,	// "Pollo",
	cerdo: {
		codIngrediente:	panelSabores[1].dataset['codigo'],
		descripcion:	panelSabores[1].dataset['descripcion'] } ,	// "Pierna",
	res: {
		codIngrediente:	panelSabores[2].dataset['codigo'],
		descripcion:	panelSabores[2].dataset['descripcion'] },	// "Res",
	queso: {
		codIngrediente:	panelSabores[3].dataset['codigo'],
		descripcion:	panelSabores[3].dataset['descripcion'] },	// "Queso",
	bola: {
		codIngrediente:	panelSabores[4].dataset['codigo'],
		descripcion:	panelSabores[4].dataset['descripcion'] }, // "Bola",
	camaron: {
		codIngrediente:	panelSabores[5].dataset['codigo'],
		descripcion:	panelSabores[5].dataset['descripcion'] },	// "Camarón",
	frijol: {
		codIngrediente:	panelSabores[6].dataset['codigo'],
		descripcion:	panelSabores[6].dataset['descripcion'] },	// "Frijol",
	azucar: {
		codIngrediente:	panelSabores[7].dataset['codigo'],
		descripcion:	panelSabores[7].dataset['descripcion'] }	// "Azúcar",
};

// variables temporales para SABORES y TOPPINGS
var sabores = [];
var toppings = {
	frijolTop: false, 
	verdura: false, 
	qRallado: false,
	cebolla: false,
	tomate: false
}

// *************************************************************
// *** 	FUNCIONES ***
// *************************************************************

// DIV contenedor de los PEDIDOS
var pedidoLista = document.getElementById("pedidoLista");

// operadores del input[number] para incrementar y decrementar el valor de la CANTIDAD 
bCantPlus.onclick = function () {
	iCantidad.stepUp();
};
bCantMinus.onclick = function () {
	iCantidad.stepDown();
};

// click en la X del modal para cerrarlo
modalEdicionAceptar.onclick = function () {
	// setToppings();
	modalEdicion.style.display = "none";
	// refrescarListaPedido(pedido, "pedidoLista", true);
};

// *************************************************************
// funcion para DEseleccionar todos los sabores
function limpiarSabores() {
	cbPollo.checked = false;
	cbCerdo.checked = false;
	cbRes.checked = false;
	cbQueso.checked = false;
	cbBola.checked = false;
	cbCamaron.checked = false;
	cbFfrijol.checked = false;
	cbAzucar.checked = false;
	// cbManual.checked = false;
	iCantidad.value = 1;
}

// *************************************************************
// funcion para verificar si el valor de CANTIDAD es valido
function validarCantNumero(cantidad) {
	let valor = Number(cantidad);
	if (valor == NaN || valor <= 0) return false;
	else 
		return true;
}
// *************************************************************
// funcion para contar cuantos sabores han sido seleccionados
// sin tener encuenta Azucar y Manual.
function contarSabores() {
	let i = 0;
	sabores = [];
	if (cbPollo.checked) {
		sabores[i] = kSabores.pollo;
		i++;
	}
	if (cbCerdo.checked) {
		sabores[i] = kSabores.cerdo;
		i++;
	}
	if (cbRes.checked) {
		sabores[i] = kSabores.res;
		i++;
	}
	if (cbQueso.checked) {
		sabores[i] = kSabores.queso;
		i++;
	}
	if (cbBola.checked) {
		sabores[i] = kSabores.bola;
		i++;
	}
	if (cbCamaron.checked) {
		sabores[i] = kSabores.camaron;
		i++;
	}
	if (cbFfrijol.checked) {
		sabores[i] = kSabores.frijol;
		i++;
	}
	// console.log("sabores:");
	// console.log(sabores);
	// *************************************************************
	// TO-DO: creacion del producto y posible verificacion de sabores correctos
	// *************************************************************
	return sabores.length;
}

// *************************************************************
//funcion para validar el numero de sabores seleccionados
function validarSabores() {
	
	// caso: ninguno seleccionado
	if (
		!cbAzucar.checked &&
		!cbPollo.checked &&
		!cbCerdo.checked &&
		!cbRes.checked &&
		!cbQueso.checked &&
		!cbBola.checked &&
		!cbCamaron.checked &&
		!cbFfrijol.checked
	) {
		alert("¡No se ha seleccionado Sabor!");
		console.log("¡No se ha seleccionado Sabor!");
		return false;
		
		// caso: solo AZUCAR seleccionado
	} else if (
		cbAzucar.checked &&
		!cbPollo.checked &&
		!cbCerdo.checked &&
		!cbRes.checked &&
		!cbQueso.checked &&
		!cbBola.checked &&
		!cbCamaron.checked &&
		!cbFfrijol.checked
	) {
		// contarSabores();
		sabores = [];
		sabores.push(kSabores.azucar);
		console.log("solo AZUCAR seleccionado");
		return true;
	
		// caso: NO azucar && menor o igual a 3 ingredientes
	} else if (!cbAzucar.checked && contarSabores() < 4) {
		console.log("Seleccion valida");
		return true;

		// caso: seleccion NO valida
	} else {
		alert("Seleccion NO válida, revise su selección de sabores.");
		sabores = [];
		return false;
	}
}

// *************************************************************
// funcion para saber si el plato anterior esta en estado abierto o cerrado
function existePlatoAbierto(indice) {
	let est = false;
	if (indice > 0) {
		const estado = pedido[indice - 1].status;
		if (estado == status.ABIERTO) {
			est = true;
		} else {
			est = false;
		}
	}
	return est;
}

// *************************************************************
// funcion para cerrar un plato y evitar adicionar mas elementos en él
function cerrarPlato(indice) {
	if (indice > 0) {
		pedido[indice - 1].status = status.CERRADO;
	}
}

// *************************************************************
// funcion para crear un producto
function crearProducto(sabor, codigo = "", precio = 0) {
	producto = new Producto();
	producto.setProdSabores(sabor);
	producto.codigo = codigo;
	producto.precio = precio;
	producto.descripcion = producto.saborTexto.join(" / ");
	const azucar = producto.saborCodigo[0] == kSabores.azucar.codIngrediente ? true : false;
	// si el sabor es de azucar => 
	if (azucar) {
		// ningun topping 
		producto.setProdToppings(false, false, false, false, false);
	} else {
		// todos los toppings
		producto.setProdToppings(true, true, true, true, true);
	}
	return producto;
}

// *************************************************************
// funcion para crear un plato nuevo
function crearNuevoPlato(cantidad, elemento, nombrePlato) {
	let estado = null;
	let arregloElementos = [];
	if (cantidad <= 2) {
		//estado: plato ABIERTO
		estado = status.ABIERTO;
	} else {
		// estado: plato CERRADO
		estado = status.CERRADO;
	}
	if (Array.isArray(elemento)) {
		arregloElementos = elemento;
	} else {
		arregloElementos.push(elemento);
	}
	var plato = new Plato(cantidad, arregloElementos, estado, nombrePlato);
	return plato;
}

// *************************************************************
// funcion para cambiar la clase CSS de un topping
function toppingChange(topping) {
	topping.classList.toggle("top-si");
	topping.classList.toggle("top-no");
}

// *************************************************************
// funcion para identificar la clase CSS correcta
function claseCSSToppings(valor) {
	if (valor) {
		return "top-si";
	} else {
		return "top-no";
	}
}

// *************************************************************
// funcion para alternar las clases CSS de los toppings en el modal
function toppingTodoNada (valor) {
	if (valor) {
		frijolModal.classList.remove("top-no");
		frijolModal.classList.add("top-si");
		verduraModal.classList.remove("top-no");
		verduraModal.classList.add("top-si");
		QRALLADOModal.classList.remove("top-no");
		QRALLADOModal.classList.add("top-si");
		cebollaModal.classList.remove("top-no");
		cebollaModal.classList.add("top-si");
		tomateModal.classList.remove("top-no");
		tomateModal.classList.add("top-si");
	} else {
		frijolModal.classList.remove("top-si");
		frijolModal.classList.add("top-no");
		verduraModal.classList.remove("top-si");
		verduraModal.classList.add("top-no");
		QRALLADOModal.classList.remove("top-si");
		QRALLADOModal.classList.add("top-no");
		cebollaModal.classList.remove("top-si");
		cebollaModal.classList.add("top-no");
		tomateModal.classList.remove("top-si");
		tomateModal.classList.add("top-no");
	}
}

// *************************************************************
// funcion para editar los toppings
function editarToppings(idElemHtml) {
	// limpiar el modal
	limpiarHijosHTML("plato");
	const modalTops = document.getElementById("plato");
	const id = idElemHtml.split('-');
	let elemento = new Elemento (pedido[id[1]].elementos[id[2]].cantidad, pedido[id[1]].elementos[id[2]].producto); 
	// Escribir el # de plato en un div
	let insertarHTML = '<div> \
		<h2 class="txt-medio">Plato No. ' + (Number(id[1]) + 1) + '</h2> \
	</div> ';

	modalTops.insertAdjacentHTML("beforeend", insertarHTML);
	
	insertarHTML = '<div id="elemento" class="flex-container flex-baseline"> \
						<p class="producto txt-medio">' + 
						elemento.cantidad + ' - ' +
						// elemento.producto.sabor.join(" / ") + '</p>';
						elemento.producto.descripcion + '</p>';
	
						// inicializar la variable "toppings" con los toppings del elemento
	toppings = elemento.producto.getProdtoppings();
	
	insertarHTML +=	'<div id="' + idElemHtml + '" class="flex-container centrar-elem margen-b-05"> \
				<p id="todoModal" onclick="javascript:toppingTodoNada(true)" class="toppings top-neutral">TODO</p> \
				<p id="frijolModal" onclick="javascript:toppingChange(this)" class="toppings ' + claseCSSToppings(toppings.frijolTop) + '">' + kTop.frijolTop + '</p> \
				<p id="verduraModal" onclick="javascript:toppingChange(this)" class="toppings ' + claseCSSToppings(toppings.verdura) + '">' + kTop.verdura + '</p> \
				<p id="QRALLADOModal" onclick="javascript:toppingChange(this)" class="toppings ' + claseCSSToppings(toppings.qRallado) + '">' + kTop.qRallado + '</p> \
				<p id="cebollaModal" onclick="javascript:toppingChange(this)" class="toppings ' + claseCSSToppings(toppings.cebolla) + '">' + kTop.cebolla + '</p> \
				<p id="tomateModal" onclick="javascript:toppingChange(this)" class="toppings ' + claseCSSToppings(toppings.tomate) + '">' + kTop.tomate + '</p> \
				<p id="nadaModal" onclick="javascript:toppingTodoNada(false)" class="toppings top-neutral">NADA</p> \
				</div> ';
	modalTops.insertAdjacentHTML("beforeend", insertarHTML);
	
	mostrarModal("modal-toppings");	
}

// *************************************************************
// funcion para almacenar los estados de los toppings desde la vista al objeto JS
function setToppings() {
	const elemHTML = document.getElementById("elemento").children[1];
	let id = elemHTML.id.split('-');
	let frij = elemHTML.children[1].classList.contains("top-si");
	let verd = elemHTML.children[2].classList.contains("top-si");
	let qRay = elemHTML.children[3].classList.contains("top-si");
	let cebo = elemHTML.children[4].classList.contains("top-si");
	let toma = elemHTML.children[5].classList.contains("top-si");
	pedido[id[1]].elementos[id[2]].producto.setProdToppings(frij, verd, qRay, cebo, toma);
}

// *************************************************************
// funcion para mostrar el cuadro de opciones de edicion de un plato
function dibujarEditarPlato(menuEditar) {
	// document.getElementById("panel-fondo").classList.add("panel-fondo");
	// document.getElementById(menuEditar).classList.remove("no-visible");
}

// *************************************************************
// funcion para esconder el menu de editar plato
function esconderMenuPlato() {
	let fondo = document.getElementById("panel-fondo");
	let menusEditar = document.getElementsByClassName("menuEditarPlato");
	for (let i = 0; i < menusEditar.length; ++i) {
		menusEditar[i].classList.add("no-visible");
	}
	fondo.classList.remove("panel-fondo");
}

// *************************************************************
// funcion para revisar el estado (ABIERTO_CERRADO) del plato previo a uno eliminado
function revisarEstado(platoId) {
	if (platoId > 0) {
		if (pedido[platoId].cantTotal < 3 && pedido[platoId].status == status.CERRADO) {
			pedido[platoId].status = status.ABIERTO;
		}
		// console.log(pedido[platoId]);
	}
} 

// *************************************************************
function eliminarPlato(platoId) {
	platoId = Number(platoId);
	console.log(platoId);
	const borrado = pedido.splice(platoId,1);
	if (borrado === null) {
		console.log("hubo un problema al eliminar el plato!!!");
		alert("hubo un problema al eliminar el plato!!!");
	}
	//revisar el estado del plato anterior y abrirlo si es necesario
	revisarEstado(platoId - 1);
	esconderMenuPlato();
	refrescarListaPedido(pedido, "pedidoLista", true);
}

// *************************************************************
// funcion para "clonar" un plato
function clonarPlato(platoId) {
	let nombre = prompt("Nombre para el nuevo plato", "");
	console.log(patronAlfaNumerico.test(nombre));
	platoId = Number(platoId);
	elem = [];
	pedido[platoId].elementos.forEach(i => {
		let prod = new Producto();
		prod.setCopiarProducto(i.producto);
		let e = new Elemento(i.cantidad, prod);
		elem.push(e);
	});
	var nuevoPlato = new Plato(pedido[platoId].cantTotal, elem, pedido[platoId].status, nombre);
	pedido.splice((platoId + 1), 0, nuevoPlato);
	console.log(pedido);
	esconderMenuPlato();
	refrescarListaPedido(pedido, "pedidoLista", true);
}

// *************************************************************
// funcion para editar un plato
function editarPlato(platoId) {
	platoId = Number(platoId);
	console.log("editar plato: ");
	console.log(pedido[platoId]);

	esconderMenuPlato();
	refrescarListaPedido(pedido, "pedidoLista", true);
}

// *************************************************************
// valida y obtiene el codigo del producto de la ddbb
function validarSaboresDDBB(arraySabores) {
	let respuesta = null;
	console.log("*** array sabores ***");
	str = JSON.stringify(arraySabores);
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				console.log("respuesta del servidor:");
				console.log(this.responseText);
				document.getElementById("ajax").innerHTML = this.responseText;
				respuesta = this.responseText;
			}
		};
		xmlhttp.open("GET", "../ajax/validarsabores.ajax.php?sabores=" + str, true);
		xmlhttp.send();
		return respuesta;
}

// *************************************************************
// boton "configuracion MANUAL"
/*
cbManual.onclick = function () {
	if (cbManual.checked) {
		// mostrarModal();
		limpiarSabores();
		alert("Función aún no definida.");
		if(typeof(Storage) !== "undefined") {
			console.log(kSabores);
		} else {
			document.getElementById("result").innerHTML = "Lo sentimos, su navegador no soporta web storage...";
		}
	};
}
*/

// *************************************************************
// indica la pagina de destino seleccionada por el usuario y
// codifica el pedido en formato JSON.
function envioPedido(paginaDestino) {
	// informar del destino seleccionado
	document.getElementById("destino-var").value = paginaDestino;
	// obtener el input que llevara los datos del pedido en JSON
	let datosSend = document.getElementById("pedido-var");
	datosSend.value = JSON.stringify(pedido);
}

// *************************************************************
// Botones de ACCIONES
// *************************************************************

// boton ADICIONAR
bAdicionar.onclick = function () {
	let error = false;
	const validCant = validarCantNumero(iCantidad.value);
	const selSabores = validarSabores();
	if (validCant && selSabores) {
		const cant = Number(iCantidad.value);
		const indicePedido = pedido.length;
		const prod = crearProducto(sabores);
		const elem = new Elemento(cant, prod);
		if (existePlatoAbierto(indicePedido)) {
			// console.log("plato abierto");
			// si el status del plato es "ABIERTO" => AÑADIR el elemento al plato actual
			const cantPlato = pedido[indicePedido - 1].cantTotal;
			if (cant + cantPlato <= 3) {
				// console.log("cantidad menor de 3");
				pedido[indicePedido - 1].cantTotal = cantPlato + cant;
				pedido[indicePedido - 1].elementos.push(elem);
				if (pedido[indicePedido - 1].cantTotal >= 3) {
					// cerrar plato
					cerrarPlato(indicePedido);
				}
			} else {
				error = true;
				alert("¡No se puede Añadir la cantidad seleccionada al plato existente! \n ¡RECUERDE! La cantidad máxima por plato es de 3 productos.");
			}
		} else {
			// console.log("plato anterior Cerrado");
			const nuevoPlato = crearNuevoPlato(cant, elem, iNombrePlato.value); // nombre para el plato
			pedido.push(nuevoPlato);
			iNombrePlato.value = "";
		}

		// si no hay un error => redibujar la lista de platos en la vista
		if (!error) {
			refrescarListaPedido(pedido, "pedidoLista", true);
			limpiarSabores();
		}

	}
	console.log("Pedido total: ");
	console.log(pedido);
};

// *************************************************************
// boton NUEVO PLATO
bNuevoPlato.onclick = function () {
	const validCant = validarCantNumero(iCantidad.value);
	const selSabores = validarSabores();
	// validar si los sabores elegidos EXISTEN en la ddbb
	// let respuestaJson = 
	// validarSaboresDDBB(sabores); // solicitud AJAX
	// respuestaJson = JSON.parse(respuestaJson);
	// console.log("valor de respuesta json");
	// console.log(respuestaJson);
	if (validCant && selSabores) {
		const cant = Number(iCantidad.value);
		const indicePedido = pedido.length;
		const prod = crearProducto(sabores);
		const elem = new Elemento(cant, prod);
		cerrarPlato(indicePedido); // cerrar plato anterior
		const nuevoPlato = crearNuevoPlato(cant, elem, iNombrePlato.value); // nombre para el plato
		pedido.push(nuevoPlato);
		iNombrePlato.value = "";
		
		// dibujar todos los elementos
		refrescarListaPedido(pedido, "pedidoLista", true);
		limpiarSabores();

	} else {
		if (!validCant) {
			alert('¡La "Cantidad" seleccionada NO es válida!');
			iCantidad.value = "";
			iCantidad.focus();
		} else {
			alert("¡La selección de sabores NO es válida!");
			limpiarSabores();
		}
	}
	console.log("Pedido total: ");
	console.log(pedido);
};

// *************************************************************
// boton BEBIDAS
bBebidas.onclick = function () {
	envioPedido(bBebidas.dataset['destino']);
	document.getElementById("form-pedido").submit();
};

// *************************************************************
// boton PAGAR
bPagar.onclick = function () {
	// informar del destino seleccionado
	envioPedido(bPagar.dataset['destino']);
	document.getElementById("form-pedido").submit();
};

// *************************************************************
// boton REGRESAR
bRegresar.onclick = function () {
	location.href = "../controladores/inicio.controlador.php";
};

// *************************************************************
// *************************************************************
// FUNCIONES EJECUTADAS AL CARGAR LA PAGINA DE PEDIDOS
limpiarSabores();

// redibujar los platos de un pedido en la vista
refrescarListaPedido(pedido, "pedidoLista", true);
