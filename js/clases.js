
// *************************************************************
// definiciones de CLASES
// *************************************************************

// definicion de clase PRODUCTO
class Producto {
	constructor() {
		this.productoID = "";
		this.codigoProducto = "";
		this.descripcion = "";
		this.precio = 0;
		this.saborCodigo = [];
		this.saborTexto = [];
		this.frijolTop = false;
		this.verdura = false;
		this.qRallado = false;
		this.cebolla = false;
		this.tomate = false;
}

	setCopiarProducto (producto) {
		this.codigoProducto = producto.codigoProducto;
		this.descripcion = producto.descripcion;
		this.precio = producto.precio;
		this.saborCodigo = producto.saborCodigo;
		this.saborTexto = producto.saborTexto;
		this.frijolTop = producto.frijolTop;
		this.verdura = producto.verdura;
		this.qRallado = producto.qRallado;
		this.cebolla = producto.cebolla;
		this.tomate = producto.tomate;
	}

	setProdSabores(sabores) {
		sabores.forEach(element => {
			this.saborCodigo.push(element.codIngrediente);
			this.saborTexto.push(element.descripcion); 
		});
	}

	setProdToppings(frij, verd, qRay, cebo, toma) {
		this.frijolTop = frij;
		this.verdura = verd;
		this.qRallado = qRay;
		this.cebolla = cebo;
		this.tomate = toma;
	}

	getProdtoppings() {
		let top = {};
		top.frijolTop = this.frijolTop;
		top.verdura = this.verdura;
		top.qRallado = this.qRallado;
		top.cebolla = this.cebolla;
		top.tomate = this.tomate;
		return	top;
	}
}

// FIN definicion de clase PRODUCTO

// definicion de clase ELEMENTO
class Elemento {

	constructor(cantidad, producto) {
		this.producto = new Producto;
		this.producto.setCopiarProducto(producto);
		this.cantidad = cantidad;
	}
}
// FIN definicion de clase ELEMENTO

// definicion de clase PLATO
class Plato {
	constructor(cantidadTotal, elemento, estado, nombrePlato = "") {
		if (Array.isArray(elemento)) {	
			this.cantTotal = cantidadTotal;
			this.elementos = elemento;
			this.status = estado;
			this.nombrePlato = nombrePlato;
		} else {
			console.log("El 'Elemento' NO es un Array!!, NO se creo el plato.");
		}
	}

	getEstado() {
		return this.status;
	}

	setEstado(status) {
		this.status = status;
	}
}
// FIN definicion de clase PLATO

