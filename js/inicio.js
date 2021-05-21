
// Modal para la busqueda en la primera pagina

let modalBusquedaPedido = document.getElementById("modalBusquedaPedido");
let btnModalBusquedaPedido = document.getElementById("btnModalBusquedaPedido");
let modalClose = document.getElementById("modalClose");

btnModalBusquedaPedido.onclick = function() {
    modalBusquedaPedido.style.display = "block";
}

// click en la X del modal para cerrarlo
modalClose.onclick = function() {
    modalBusquedaPedido.style.display = "none";
}

// click en la parte oscura del modal para cerrarlo
window.onclick = function(event) {
    if(event.target == modalBusquedaPedido) {
        modalBusquedaPedido.style.display = "none";
    }
}

//*******************************************************************
// funcion para conocer el ancho o alto del area de cliente disponible segun el tamaño de la ventana
function getWindowSize(direccion) {
    var valor = 0;
    if (direccion == 'h') {
      valor = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    }
    else if (direccion == 'v') {
      valor  = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
    }
    else {
      return false;
    }
    return valor;
  }
// Ajustes de la imagen en la primera pagina 
// calcular el ancho de la imagen para llenar bien la pantalla
var anchoPantalla = getWindowSize('h');
var altoPantalla = getWindowSize('v');
// relacion aspecto imagen alto x ancho -> 1:1.72
let anchoImg = (altoPantalla / 1.72);
// relacion aspecto flexbox izq(imagen) Vs flexbox der (botones) -> 1:1.32
let anchoBtns = (anchoImg / 1.32);
if ((anchoImg + anchoBtns) > anchoPantalla) {
    let imgBienvenida = document.getElementById("imgBienvenida");
    imgBienvenida.style.width = ( anchoImg - ((anchoBtns + anchoImg) - anchoPantalla)  + 'px');
    console.log(imgBienvenida.style.width );
}

// console.log("dentro de inicio.js");
    // console.log("nuevo valor de ancho " + x);
