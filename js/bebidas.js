// DEFINICION DE CLASES

class Bebida {
    constructor(codigo, id, nombre, precio, cantidad) {
        this.codigo = codigo;
        this.id = id;
        this.nombre = nombre;
        this.precio = precio;
        this.cantidad = cantidad;
    }
}

// *************************************************************
//  DEFINICION DE VARIABLES DE ELEMENTOS HTML
// *************************************************************

var btnPedido = document.getElementById("pedido");
var btnPagar = document.getElementById("pagar");
var btnCancelar = document.getElementById("cancelar");

// HTMLCollection con el listado de las bebidas
var listadoBebidas = document.getElementById("listado-bebidas").children;

// array para guardar el listado del pedido de bebidas
var bebidasPedido = [];

// inicializacion de la variable "bebidasPedido" en caso de haber un pedido en curso. (memoria de la app)
if (bebidasJson != "") {
	bebidas = JSON.parse(bebidasJson);
    iniciarBebidas();
}

// *************************************************************
// funcion para incializar los valores de un pedido en memoria (pendiente)
function iniciarBebidas() {
    bebidas.forEach(element => {
        let temp = document.getElementById(element.codigo);
        let divNumero = temp.getElementsByClassName("txt-bebida"); 
        temp.dataset['cantidad'] = Number(element.cantidad);
        divNumero[0].innerText = element.cantidad;
        divNumero[0].nextElementSibling.style.opacity = 0.5;
    });
    cargarBebidas();
}

// *************************************************************
// dibuja las filas segun las bebidas seleccionadas 
function actualizarTablaBebidas() {
    let tabla = document.getElementById("t-datos");
    // elimina las filas de la tabla    
    limpiarHijosHTML("t-datos");
    
    bebidasPedido.forEach(element => {
        if (element.cantidad > 0) { 
            let fila = "";
            fila = ' \
                <tr> \
                    <td class="txt-centro">' + element.cantidad + '</td> \
                    <td>' + element.nombre + '</td> \
                    <td class="der">$ ' + (element.precio * element.cantidad) + '</td> \
                </tr> ';
                tabla.insertAdjacentHTML("beforeend", fila);
        }
    });
}

// *************************************************************
// carga la variable "bebidasPedido" (array de objetos Bebidas) con las bebidas de la vista y sus propiedades
function cargarBebidas() {
    bebidasPedido = [];
    for (let i = 0; i < listadoBebidas.length; i++) {
        let cantidad = Number(listadoBebidas[i].dataset['cantidad']);
        if(cantidad > 0) {
            let codigo = listadoBebidas[i].id;
            let id = Number(listadoBebidas[i].dataset['id']);
            let nombre = listadoBebidas[i].dataset['nombre'];
            let precio = Number(listadoBebidas[i].dataset['precio']);
            let objeto = new Bebida(codigo, id, nombre, precio, cantidad);
            bebidasPedido.push(objeto);
        }
    }
    // console.log(bebidasPedido);
    actualizarTablaBebidas();
}

// *************************************************************
// funcion para modificar los valores de las cantidades de las bebidas
function bebidasCantidad(id, operacion) {
    let idCard = document.getElementById(id);
    let texto = idCard.getElementsByClassName("txt-bebida");
    texto = texto[0];
    let cantidad = Number(texto.innerText);
    if (operacion) {
        // sumar una unidad
        cantidad++;
        texto.nextElementSibling.style.opacity = 0.5;
    } else {
        // restar una unidad
        if (cantidad > 0) {
            cantidad--;
            texto.nextElementSibling.style.opacity = 0.5;
        }  
    }

    // actualizar la cantidad en el "data-cantidad" de la tarjeta bebida
    idCard.dataset['cantidad'] = cantidad

    if (cantidad === 0) {
        cantidad = "";
        texto.nextElementSibling.style.opacity = 1;
    }
    texto.innerText = cantidad;
    cargarBebidas();
}

// *************************************************************
// indica la pagina de destino seleccionada por el usuario y
// codifica el pedido en formato JSON.
function envioPedidoBebidas(paginaDestino) {
	// informar del destino seleccionado
	document.getElementById("destino-var").value = paginaDestino;
	// obtener el input que llevara los datos del pedido en JSON
	let datosSend = document.getElementById("bebidas-var");
	datosSend.value = JSON.stringify(bebidasPedido);
}

// *************************************************************
// **** BOTONES ACCIONES
// *************************************************************

btnPedido.onclick = function () {
    envioPedidoBebidas(btnPedido.dataset['destino']);
	document.getElementById("form-bebidas").submit();

}

btnPagar.onclick = function () {
    envioPedidoBebidas(btnPagar.dataset['destino']);
	document.getElementById("form-bebidas").submit();
}

btnCancelar.onclick = function () {
    window.location.assign("inicio.controlador.php");
}

// *************************************************************
// **** EJECUCION ONLOAD
// *************************************************************


