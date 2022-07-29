
// constante para indicar al servidor de donde viene la solicitud del ususario
const ORIGEN_PEDIDO = "PEDIDO_PAG";
// constantes para seleccionar el destino o siguiente pagina
const DESTINO_BEBIDAS = "BEBIDAS_PAG";
const DESTINO_PAGAR = "PAGAR_PAG";

// array constante con los sabores de los toppings
const kTop = {
	frijolTop: "Frijol",
	verdura: "Verdura",
	qRallado: "Q. Rayado",
	cebolla: "Cebolla",
	tomate: "Tomate",
	todo: "TODO",
	nada: "NADA",
};

var patronNumerico = /[0-9.]/;

// *************************************************************
// funcion para filtrar caracteres escritos en un input segun
// lo definido en el filtro o patron de una expresion regular "patron"
function filtrarCaracteres(evento) {
	let x = false;
	if (patronNumerico.test(evento.key)) {
		// patron valido
		x = true;
	} 
	console.log(evento);
	console.log(x);
	return x;
}

// *************************************************************
function mostrarModal(id) {
	modal = document.getElementById(id);
	console.log("mostrar modal id: " + id);
	// console.log(modal);
	// modal.style.display = "block";
	modal.style.visibility = "visible";
	// modal.classList.replace("no-visible1", "visible1");
}

// *************************************************************
// funcion para eliminar los nodos hijos de un elemento html
function limpiarHijosHTML(idElemHTML) {
	let padre = document.getElementById(idElemHTML);
	console.log("limpiarHijosHTML: '" + idElemHTML + "'");
	if (padre != null) {
		while (padre.firstChild) {
			//The list is LIVE so it will re-index each call
			padre.removeChild(padre.firstChild);
		}
	}
}

// *************************************************************
// funcion para limpiar los campos de texto con un 'click'
function limpiar(id) {
	document.getElementById(id).value = "";	
	document.getElementById(id).focus();	
}

// *************************************************************
// funcion para visualizar los toppings de un elemento
function dibujarToppings(producto) {

	// creacion del "div" donde se muestran los toppings
	let nodoToppings = document.createElement("div");
	nodoToppings.classList.add("flex-container", "flex-baseline");

	// agregar llamado funcion modalEditarPlato()

	let top = clase = "";
	if (
		producto.frijolTop &&
		producto.verdura &&
		producto.qRallado &&
		producto.cebolla &&
		producto.tomate
	) {
		// si todo verdadero => TODO
		top = '<p class="toppings top-si ">' + kTop.todo + "</p>";
	} else if (
		!producto.frijolTop &&
		!producto.verdura &&
		!producto.qRallado &&
		!producto.cebolla &&
		!producto.tomate
	) {
		// si todo falso => NADA
		top = '<p class="toppings top-no ">' + kTop.nada + "</p>";
	} else {
		// Seleccionar la clase CSS para cada uno de los items
		clase = producto.frijolTop ? "si" : "no";
		top += '<p class="toppings top-' + clase + '">' + kTop.frijolTop + "</p>";
		clase = producto.verdura ? "si" : "no";
		top += '<p class="toppings top-' + clase + '">' + kTop.verdura + "</p>";
		clase = producto.qRallado ? "si" : "no";
		top += '<p class="toppings top-' + clase + '">' + kTop.qRallado + "</p>";
		clase = producto.cebolla ? "si" : "no";
		top += '<p class="toppings top-' + clase + '">' + kTop.cebolla + "</p>";
		clase = producto.tomate ? "si" : "no";
		top += '<p class="toppings top-' + clase + '">' + kTop.tomate + "</p>";
	}

	nodoToppings.insertAdjacentHTML("beforeend", top);

	return nodoToppings;
}

// *************************************************************
//funcion para dibujar un "ELEMENTO" dentro de un plato
function dibujarElemento(indicePlato, indiceElemento, elemento) {

	// div contenedor de todo el elemento dentro del plato
	let padre = document.createElement("div");
	padre.id = "elem-" + indicePlato + "-" + indiceElemento;
	padre.classList.add("flex-container", "flex-baseline");
	padre.setAttribute("onclick", "javascript:modalEditarPlato(" + indicePlato + ")");

	
	// parrafo con la descripcion del elemento
	let hijo1 = document.createElement("p");
	hijo1.classList.add("producto", "txt-medio");
	
	// nodo de texto del parrafo con la cantidad y la descripcion del elemento
	let nodo1 =  document.createTextNode(elemento.cantidad + 
		' - ' + elemento.producto.descripcion);
	hijo1.appendChild(nodo1);
	
	// funcion para dibujar los diferentes estados de los toppings
	let hijo2Toppings = dibujarToppings(elemento.producto);

	padre.appendChild(hijo1);
	padre.appendChild(hijo2Toppings);

	return padre;
}

// *************************************************************
//funcion para dibujar un "plato" en la seccion del pedido
function dibujarPlato( indice, plato) {
	indice = Number(indice);
	if (indice == "NaN") {
		console.log("ERROR! preparando el dibujado de los platos.");
		return;
	}

	nodoPlato = document.createElement("div");
	nodoPlato.id = "pl-" + indice;
	nodoPlato.classList.add("ancho-100", "margen-b-05", "plato", "sombra-x");

	// nodo para la edicion del plato
	let nodoEdicion = document.createElement("div");
	nodoEdicion.classList.add("edicion", "txt-big");
	// TODO: colocar la funcion "javascript:modalEditarPlato" para editar el plato
	nodoEdicion.setAttribute("onclick", "javascript:modalEditarPlato(" + indice + ")");
	
	// icono de lapiz para la edicion del plato
	let nodoEdicionLapiz = '<i class="fa fa-pencil" aria-hidden="true"></i>';
	nodoEdicion.insertAdjacentHTML("beforeend", nodoEdicionLapiz);

	nodoPlato.appendChild(nodoEdicion);
	
	// Numero de plato y nombre de plato
	let nombre = plato.nombrePlato.toUpperCase();
	let name = "";

	if (nombre != "") {
		nombre = ' -- ' + nombre + ' -- ';
	}
	name = document.createElement("span");
	name.classList.add("txt-medio", "nombre");
	let nodoTextoNombre = document.createTextNode(nombre);
	name.appendChild(nodoTextoNombre);
	titulo = document.createElement("h2");
	titulo.classList.add("txt-medio");

	tituloTXT = document .createTextNode("Plato No. " + (indice + 1) );
	titulo.appendChild(tituloTXT);
	titulo.appendChild(name);

	nodoPlato.appendChild(titulo);

	for (let j = 0; j < plato.elementos.length; j++) {

		nodoElem = dibujarElemento(indice, j, plato.elementos[j]);
		nodoPlato.appendChild(nodoElem);
	}

	return nodoPlato;
}








// *************************************************************
// funcion para dibujar el numero del plato y su nombre
function modalEditarPlatoNombre(name, platoId) {
	name = "<span class='txt-medio'> \
				<input id='iModalEdicionNombre' class='borde borde-rad-05 txt-medio' type='text' value='" + name + "'/> \
			</span>";
	
	let insertarHTML = "<div> \
			<h2 class='txt-medio'>Plato No. " + (Number(platoId) + 1) + name + "</h2> \
		</div> ";
	return insertarHTML;
}

// *************************************************************
// funcion para dibujar un elemento de un producto para el modalEdicion 
function modalEditarElemento(elemento, elemId) {
	let insertarHTML = '<div id="elemento-' + elemId + '" class="flex-container flex-baseline"> \
			<a class="borde borde-rad-05 padding-03 color-focus color-botones _sombra-x" href="#"><i class="fa fa-times txt-big color-error" aria-hidden="true" onclick="javascript:console.log(this.id)"></i></a> \
			<p class="producto txt-medio">' + elemento.cantidad + ' - ' + elemento.producto.descripcion + '</p>';
	return insertarHTML;
}

// *************************************************************
// funcion para mostrar los toppings y editarlos
function ModalEditarToppings(toppings) {
	
	insertarHTML =	'<div id="' + 100 + '" class="flex-container flex-centrar margen-b-05"> \
				<p id="todoModal" onclick="javascript:toppingTodoNada(true)" class="toppings top-neutral">TODO</p> \
				<p id="frijolModal" onclick="javascript:toppingChange(this)" class="toppings ' + claseCSSToppings(toppings.frijolTop) + '">' + kTop.frijolTop + '</p> \
				<p id="verduraModal" onclick="javascript:toppingChange(this)" class="toppings ' + claseCSSToppings(toppings.verdura) + '">' + kTop.verdura + '</p> \
				<p id="QRALLADOModal" onclick="javascript:toppingChange(this)" class="toppings ' + claseCSSToppings(toppings.qRallado) + '">' + kTop.qRallado + '</p> \
				<p id="cebollaModal" onclick="javascript:toppingChange(this)" class="toppings ' + claseCSSToppings(toppings.cebolla) + '">' + kTop.cebolla + '</p> \
				<p id="tomateModal" onclick="javascript:toppingChange(this)" class="toppings ' + claseCSSToppings(toppings.tomate) + '">' + kTop.tomate + '</p> \
				<p id="nadaModal" onclick="javascript:toppingTodoNada(false)" class="toppings top-neutral">NADA</p> \
				</div> ';
	return insertarHTML;
}





// *************************************************************
// funcion para EDITAR PLATO
function modalEditarPlato(platoId) {

	// limpiar el modal
	// limpiarHijosHTML("platoEdicion");
	// debugger;
	console.log("platoEdicion - #plato: " + platoId);
	const modalEdicion = document.getElementById("platoEdicion");
	console.log(modalEdicion);
	modalEdicion.id = platoId;
	let insertarHTML = "";

	/*
	let plato = new Plato(pedido[platoId].cantTotal, pedido[platoId].elementos, pedido[platoId].status, pedido[platoId].nombrePlato);
	console.log("plato detalle:");
	console.log(plato); 

	// Escribir el # de plato en un div
	insertarHTML = modalEditarPlatoNombre(plato.nombrePlato, platoId);
	modalEdicion.insertAdjacentHTML("beforeend", insertarHTML);
	
	// Dibujar los elementos del plato
	insertarHTML = "";
	for (let i = 0; i < plato.elementos.length; i++) {
		const element = plato.elementos[i];
		toppings = element.producto.getProdtoppings();

		insertarHTML = modalEditarElemento(element, i);
		modalEdicion.insertAdjacentHTML("beforeend", insertarHTML);
		insertarHTML = ModalEditarToppings(toppings);
		modalEdicion.insertAdjacentHTML("beforeend", insertarHTML);
	}


	
	// inicializar la variable "toppings" con los toppings del elemento
	// toppings = plato.elementos[0].producto.getProdtoppings();

	// console.log(toppings);

	// modalEdicion.insertAdjacentHTML("beforeend", insertarHTML);
	
	*/
	
	mostrarModal("modalEdicion");	
}

// *************************************************************
// funcion para redibujar todo el pedido en la vista HTML
function refrescarListaPedido(pedido, contenedorPlatosId) {
	limpiarHijosHTML(contenedorPlatosId);
	console.log("refrescar lista pedido");
	let contenedorPlatos = document.getElementById(contenedorPlatosId);
	let plato = "";
	for (let i = 0; i < pedido.length; i++) {

			// dibuja un plato con su nombre de plato
			plato = dibujarPlato(i, pedido[i]);
		
			contenedorPlatos.insertBefore(plato, contenedorPlatos.childNodes[0]); 
			// contenedorPlatos.appendChild(plato);
		}
}

// *************************************************************

// *************************************************************


