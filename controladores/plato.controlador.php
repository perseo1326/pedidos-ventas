<?php


class Plato_Controlador {

    private $cantTotal;
    private $elementos;
    private $status;
    private $nombrePlato;

    public function __construct ($cantidadTotal, $elemento, $estado, $nombrePlato) {
        if(gettype($elemento) == "array") {
            // print_r("Tenemos un ARRAY!!");
            $this->cantTotal = $cantidadTotal;
            $this->elementos = $elemento;
            $this->status = $estado;
            $this->nombrePlato = $nombrePlato;
        } else {
            print_r("El 'Elemento' NO es un array!!");
        }
	}

	public function getEstado() {
		return $this->status;
	}

    public function getElemento (int $indice) {
        if ($indice < count($this->elementos)) {
            return $this->elementos[$indice];
        }
        return null;
    }

    public function getCantidadElementos() {
        return count($this->elementos);
    }

    public function getNombrePlato() :string {
        return $this->nombrePlato;
    }

    public function getPlatoJson() {
        $objeto = new stdClass();
        $objeto->cantTotal = $this->cantTotal;
        $objeto->nombrePlato = $this->nombrePlato;
        $objeto->status = $this->status;
        $objeto->elementos = [];
        for ($i=0; $i < count($this->elementos); $i++) { 
            $objeto->elementos[$i] = $this->elementos[$i]->getElementoJson();
        }
        return $objeto;
    }

	public function setEstado($estado) {
		$this->status = $estado;
	}
}