<?php

// definicion de clase PRODUCTO

class Producto_Controlador {

	// propiedades
	protected $productoID;
	protected $codigoProducto;
	protected $descripcion;
	protected $precio;
	protected $saborCodigo;
	protected $saborTexto;
	protected $frijolTop;
	protected $verdura;
	protected $qRayado;
	protected $cebolla;
	protected $tomate;

	// metodos
	public function __construct() {
		$this->productoID = null;
		$this->codigoProducto = "";
		$this->descripcion = "";
		$this->precio = 0;
		$this->saborCodigo = array();
		$this->saborTexto = array();
		$this->frijolTop = false;
		$this->verdura = false;
		$this->qRayado = false;
		$this->cebolla = false;
		$this->tomate = false;
	}

	public function copiarProducto($producto) {

		$this->productoID = $producto->productoID;
		$this->codigoProducto = $producto->codigoProducto;
		$this->descripcion = $producto->descripcion;
		$this->precio = $producto->precio;
		$this->saborCodigo = $producto->saborCodigo;
		$this->saborTexto = $producto->saborTexto;
		$this->frijolTop = $producto->frijolTop;
		$this->verdura = $producto->verdura;
		$this->qRayado = $producto->qRayado;
		$this->cebolla = $producto->cebolla;
		$this->tomate = $producto->tomate;
	}

	public function setPrecio($precio) {
		$this->precio = $precio;
	}

	public function setProductoDetalle($prodDetalles) {
		if($this->validarProductoDetalle($prodDetalles)) {
			$prodDetalles = $prodDetalles[0];
			$this->productoID = $prodDetalles['id'];
			$this->codigoProducto = $prodDetalles['codigo'];
			$this->precio = number_format($prodDetalles['precio'], 0);
		} else {
			// producto NO existe OR el producto esta repetido!!
			$this->codigoProducto = DESCONOCIDO;
			$this->precio = NO_APLICA;
		}
	}

	private function validarProductoDetalle( $prodDetalles) {
		$detallesValidos = false;
		if (count($prodDetalles) == 1) {
			$detallesValidos = true;
		} 
		return $detallesValidos;
	}

	public function getProdSabores() {
		return $this->saborCodigo;
	}

	public function getProductoID() {
		return $this->productoID;
	}

	public function getCodigo() {
		return $this->codigoProducto;
	}

	public function getPrecio() {
		return $this->precio;
	}

	public function getDescripcion () :string {
		return $this->descripcion;
	}

	public function getProductoResumen() {
		$resumen = ['id' => ((int) $this->productoID), 
					'codigo' => $this->codigoProducto,
					'descripcion' => $this->descripcion,
					'precioUnitario' => $this->precio ];
		return $resumen;
	}

	public function getProductoJson() {
		$objeto = new stdClass();
		$objeto->productoID = (int) $this->productoID;
		$objeto->codigoProducto = $this->codigoProducto;
		$objeto->descripcion = $this->descripcion;
		$objeto->precio = $this->precio;
		$objeto->saborCodigo = $this->saborCodigo;
		$objeto->saborTexto = $this->saborTexto;
		$objeto->frijolTop = $this->frijolTop;
		$objeto->verdura = $this->verdura;
		$objeto->qRayado = $this->qRayado;
		$objeto->cebolla = $this->cebolla;
		$objeto->tomate = $this->tomate;
		return $objeto;
	}

	// retorna "TODO", "NADA" o un pequeño array con la primera posicion indicando si es "true" or "false" y los items que tienen ese valor en comun.
	public function getToppings () {
		$tops = null;
		$con = [];
		$sin = array();
		if ($this->frijolTop && $this->verdura && $this->qRayado && $this->cebolla && $this->tomate) {
			$tops = "TODO";
		} else if (!$this->frijolTop && !$this->verdura && !$this->qRayado && !$this->cebolla && !$this->tomate) {
			$tops = "NADA";
		} else {
			array_push($con, true);
			array_push($sin, false);
			$this->frijolTop ?	array_push($con, TOPPINGS['FRIJOLTOP'])	: array_push($sin, TOPPINGS['FRIJOLTOP']);
			$this->verdura ? 	array_push($con, TOPPINGS['VERDURA'])	: array_push($sin, TOPPINGS['VERDURA']);
			$this->qRayado ? 	array_push($con, TOPPINGS['QRAYADO']) 	: array_push($sin, TOPPINGS['QRAYADO']);
			$this->cebolla ? 	array_push($con, TOPPINGS['CEBOLLA']) 	: array_push($sin, TOPPINGS['CEBOLLA']);
			$this->tomate ? 	array_push($con, TOPPINGS['TOMATE']) 	: array_push($sin, TOPPINGS['TOMATE']);

			if (count($con) > count($sin)) {
				// '$con' es mayor cantidad, enviar el menor
				$tops = $sin;
			} else {
				// '$sin' es mayor cantidad, enviar el menor
				$tops = $con;
			}
		}
		return $tops;
	}

}

