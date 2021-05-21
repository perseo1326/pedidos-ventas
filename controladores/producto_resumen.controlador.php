<?php

// *************************************************************
// CLASE OBJETO RESUMEN

class Producto_Resumen_Controlador {
    protected $productoID;
	protected $codigoProd;
	protected $descripcion;
	protected $cantidad;
	protected $precioUnidad;

	public function __construct ($cantidad = 0, $id = 0, $codigo = '', $descripcion = '', $precioUnitario = 0) { 
		$this->productoID = $id;
		$this->codigoProd = $codigo;
		$this->descripcion = $descripcion;
		$this->cantidad = $cantidad;
		$this->precioUnidad = $precioUnitario;
	}

	public function getCodigo() {
		return $this->codigoProd;
	}

	public function getDescripcion() {
		return $this->descripcion;
	}

	public function getCantidad() {
		return $this->cantidad;
	}

	public function getPrecioUnidad() {
		return $this->precioUnidad;
	}

	public function getTotal() :int {
		return ($this->cantidad * $this->precioUnidad);
	}

	public function setCantidad ($cantidad) {
		$this->cantidad = $cantidad;
	}

	public function copiar($prodResumenControlador) {
		$this->productoID = $prodResumenControlador->productoID;
		$this->codigoProd = $prodResumenControlador->codigoProd;
		$this->descripcion = $prodResumenControlador->descripcion;
		$this->cantidad = $prodResumenControlador->cantidad;
		$this->precioUnidad = $prodResumenControlador->precioUnidad;
	}

	public function sumarCantidad($cantidad) {
		$this->cantidad += $cantidad;
	}
}

?>
