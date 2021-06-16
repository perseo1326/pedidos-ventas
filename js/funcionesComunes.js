
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
	nada: "NATURAL",
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
	modal.style.display = "block";
	console.log("mostrar modal id: " + id);
}

// *************************************************************
// funcion para eliminar los nodos hijos de un elemento html
function limpiarHijosHTML(idElemHTML) {
	let padre = document.getElementById(idElemHTML);
	while (padre.firstChild) {
		//The list is LIVE so it will re-index each call
		padre.removeChild(padre.firstChild);
	}
}

// *************************************************************
// funcion para limpiar los campos de texto con un 'click'
function limpiar(id) {
	document.getElementById(id).value = "";	
	document.getElementById(id).focus();	
}

// *************************************************************
//funcion para dibujar un "plato" en la seccion del pedido
function prepararDibujarPlato( indice, pedidoCopia, editarPlato) {
	indice = Number(indice);
	let name = pedidoCopia[indice].nombrePlato.toUpperCase();
	if (name != "") {
		name = "<span class='txt-medio nombre'> -- " + name + " -- </span>";
	}

	let platoHTML = ' \
    <div id="pl-' +	indice + '" class="ancho-100 margen-b-05 plato sombra-x"> ';
	if(editarPlato) {
        platoHTML += '<div class=" edicion clearfix"> \
				<span class="bloque" onclick="javascript:modalEditarPlato(' + indice + ')"><i id="editarPlato-' + indice + '" class="fa fa-pen-square txt-medio"></i></span> \
			</div> ';
	}
	platoHTML +=	'<div class="menuEditarPlato no-visible" id="menuEditarPlato-' + indice + '" oncontextmenu="return false;"> \
			<h3 class="padding-05">Opciones de Plato</h3> \
			<div> \
				<span class="padding-hor-1 padding-05 bloque" onclick="javascript:editarPlato(' + indice + ')">Editar Plato...</span> \
				<span class="padding-hor-1 padding-05 bloque" onclick="javascript:clonarPlato(' + indice + ')">Duplicar Plato</span> \
				<span class="padding-hor-1 padding-05 bloque" onclick="javascript:eliminarPlato(' + indice + ')">Eliminar Plato</span> \
			</div> \
		</div> \
		<div> \
            <h2 class="txt-medio ">Plato No. ' + (indice + 1) + name + '</h2> \
        </div> \
    </div> ';
	return platoHTML;
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
	let insertarHTML2 = '<div id="elemento-' + elemId + '" class="flex-container flex-baseline"> \
			<p class="producto txt-medio">' + elemento.cantidad + ' - ' + elemento.producto.descripcion + '</p>';
	return insertarHTML2;
}

// *************************************************************
// funcion para mostrar los toppings y editarlos
function ModalEditarToppings(toppings) {
	
	insertarHTML =	'<div id="' + 100 + '" class="flex-container centrar-elem margen-b-05"> \
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
	limpiarHijosHTML("platoEdicion");
	const modalEdicion = document.getElementById("platoEdicion");
	modalEdicion.id = platoId;
	let insertarHTML = "";

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
	
	
	
	mostrarModal("modalEdicion");	
}

// *************************************************************
//funcion para dibujar "ELEMENTOS" dentro de un plato
function dibujarElementos(indicePlato, nuevoPlato, editarToppings) {
	var htmlElem = "";
	const plato = document.getElementById("pl-" + indicePlato); // nodo abuelo
	for (let i = 0; i < nuevoPlato.elementos.length; i++) {
		let padre = document.createElement("div");
		padre.id = "elem-" + indicePlato + "-" + i;
		padre.classList.add("flex-container", "flex-baseline");
		
		let hijo1 = document.createElement("p");
		hijo1.classList.add("producto", "txt-medio");
		
		let nodo1 =  document.createTextNode(nuevoPlato.elementos[i].cantidad + 
			' - ' + nuevoPlato.elementos[i].producto.descripcion);
		hijo1.appendChild(nodo1);
		
		let hijo2 = document.createElement("input");
		hijo2.setAttribute("type", "button");
		hijo2.setAttribute("value", "Toppings");
		if (editarToppings) {
			// permitir editar los Toppings
			hijo2.setAttribute("onclick", ("javascript:editarToppings('" + padre.id + "');"))
			// hijo2.onclick = function() { 
				// 	editarToppings(padre.id);
			// };
			hijo2.removeAttribute("disabled");
		} else {
			hijo2.setAttribute("disabled", "");
		}
			
		let hijo3 = document.createElement("div");
		hijo3.classList.add("flex-container", "flex-baseline");
		htmlElem =  dibujarToppings(nuevoPlato.elementos[i].producto);
		hijo3.insertAdjacentHTML("beforeend", htmlElem);

		padre.appendChild(hijo1);
		padre.appendChild(hijo2);
		padre.appendChild(hijo3);

		plato.appendChild(padre);
	}
}

// *************************************************************
// funcion para visualizar los toppings de un elemento
function dibujarToppings(producto) {
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
		top +=
			'<p class="toppings top-' + clase + '">' + kTop.frijolTop + "</p>";
		clase = producto.verdura ? "si" : "no";
		top += '<p class="toppings top-' + clase + '">' + kTop.verdura + "</p>";
		clase = producto.qRallado ? "si" : "no";
		top += '<p class="toppings top-' + clase + '">' + kTop.qRallado + "</p>";
		clase = producto.cebolla ? "si" : "no";
		top += '<p class="toppings top-' + clase + '">' + kTop.cebolla + "</p>";
		clase = producto.tomate ? "si" : "no";
		top += '<p class="toppings top-' + clase + '">' + kTop.tomate + "</p>";
	}
	return top;
}

// *************************************************************
// funcion para redibujar todo el pedido en la vista HTML
function refrescarListaPedido(pedido, contenedorPlatosId, editarPlato) {
	limpiarHijosHTML(contenedorPlatosId);
	let contenedorPlatos = document.getElementById(contenedorPlatosId);
	let plato = "";
	for (let i = 0; i < pedido.length; i++) {
			plato = prepararDibujarPlato(i, pedido, editarPlato);
			// contenedorPlatos.insertAdjacentHTML("beforeend", plato);
			contenedorPlatos.insertAdjacentHTML("afterbegin", plato);
			dibujarElementos(i,pedido[i], editarPlato);
			// console.log(pedido[i].elementos.length);
		}
}

// *************************************************************

// *************************************************************


