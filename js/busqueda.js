
let bRegresar = 	document.getElementById("regresar");
let bBuscar = 		document.getElementById("buscar2");
let iNumPedido = 	document.getElementById("numPedido");
let iNombre = 		document.getElementById("nombre");
let iPrecio = 		document.getElementById("precio");
let iNumTelefono = 	document.getElementById("numTelefono");
let iFecha = 		document.getElementById("fecha");

const ELEMENTOS = { NUMPEDIDO: "numPedido", 
					NOMBRE: "nombre", 
					TOTAL: "total",
					NUM_TELEFONO: "numTelefono",
					FECHA: "fecha" };

function busquedaAjax(elemento, valor) {
	console.log("en busqueda ajax " + elemento + ":" + valor);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			console.log(this.responseText),
			ver(this.responseText);
		}
	};
	xmlhttp.open("GET", "../ajax/buscarItem.ajax.php?elemento=" + elemento + '&valor=' + valor, true);
	// xmlhttp.open("POST", "../ajax/buscarItem.ajax.php", true);
	xmlhttp.send();
}

function ver (texto) {
	document.getElementById("ajax").innerHTML = texto;
}


// *************************************************************
// boton REGRESAR
bRegresar.onclick = function () {
	location.href = "../controladores/inicio.controlador.php";
};

bBuscar.onclick = function () {
	console.log(ELEMENTOS.NOMBRE + " : " + iNumPedido.value);
	// busquedaAjax(ELEMENTOS.NUMPEDIDO, iNumPedido.value );
	busquedaAjax(ELEMENTOS.NOMBRE, iNumPedido.value );
}

// iNumPedido.onkeyup = function (e) {
// 	if(!filtrarCaracteres(e)) {
// 		e.preventDefault();
// 	}
// 	console.log(this.value);
// }