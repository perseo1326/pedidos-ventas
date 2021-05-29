<?php

require_once "../controladores/ordenJSON.controlador.php";

class Buscar_Controlador {
    protected $numPedido;
    protected $nombrePedido;
    protected $fecha;
    protected $tipoPedido;
    protected $numTelefono;
    protected $estado;
    protected $pagado;
    protected $total;
    protected OrdenJSON $orden;
    protected $notas;

    public function __construct() {
        $this->numPedido = (int) 0;
        $this->nombrePedido = "";
        $this->fecha = "";
        $this->tipoPedido = "";
        $this->numTelefono = "";
        $this->estado = "";
        $this->pagado = "";
        $this->total = (int) 0;
        $this->orden = new OrdenJSON;
        $this->notas ="";
    }

    public function copiarPedido($objeto) {
        $this->numPedido = $objeto['pedido'];
        $this->nombrePedido = $objeto['nombre'];
        $this->fecha = $objeto['fecha'];
        $this->tipoPedido = $objeto['tipo'];
        $this->numTelefono = $objeto['telefono'];
        $this->estado = $objeto['estado'];
        $this->pagado = $objeto['pagado'];
        $this->total = (int) $objeto['total'];
        $this->notas = $objeto['notas'];
        return ($this->orden->JSON2Orden($objeto['orden']));
    }

    public function getNumPedido() :int {
        return $this->numPedido;
    }

    public function getNombre() :string {
        return $this->nombrePedido;
    }

    public function getTipoPedido() :string {
        return $this->tipoPedido;
    }

    public function getstatusPagado() :string {
        $status = DEBE;
        if ($this->pagado === PAGADO_SI) {
            $status = PAGADO;
        }
        return $status;
    }

    public function getTotal() :int {
        return $this->total;
    }

    public function getTelefono() :string {
        return $this->numTelefono;
    }

    public function getFecha(bool $withYear = false) :string {
        $formato = DIAS_SEMANA[date_format($this->fecha, "w")];
        $formato = $formato . " " . date_format($this->fecha, "d-");
        $formato = $formato . MESES_ANNO[date_format($this->fecha, "n")];
        if ($withYear) {
            $formato = $formato . date_format($this->fecha, "-y");
        }
        return $formato;
    }

    public function getHora() :string {
        return date_format($this->fecha, "h:i a");
    }

}