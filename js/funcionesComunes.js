
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
function prepararDibujarPlato(indice, pedidoCopia, editarPlato) {
	indice = Number(indice);
	let name = pedidoCopia[indice].nombrePlato.toUpperCase();
	if (name != "") {
		name = "<span class='txt-medio nombre'> -- " + name + " -- </span>";
	}

	let platoHTML = ' \
    <div id="pl-' +	indice + '" class="ancho-100 margen-b-05 plato sombra-x"> ';
	if(editarPlato) {
        platoHTML += '<div class=" edicion clearfix"> \
				<span class="bloque" onclick="javascript:dibujarEditarPlato(\'menuEditarPlato-' + indice + '\')"><i id="editarPlato-' + indice + '" class="fa fa-pen-square txt-medio"></i></span> \
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


