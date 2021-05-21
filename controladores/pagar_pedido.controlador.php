<?php


class PagarPedido_Controlador {

    protected $nombrePedido;
    protected $tipoPedido;
    protected $tipoPedido_numTelefono;
    protected $formaDePago;
    protected $formaDePago_numTransfer;
    protected $pagado;
    protected $total;
    protected $totalProd;


    public function __construct() {
        $this->nombrePedido = "";
        $this->tipoPedido = "";
        $this->tipoPedido_numTelefono = "";
        $this->formaDePago = "";
        $this->formaDePago_numTransfer = "";
        $this->pagado = PAGADO_NO;
        $this->total = 0;
        $this->totalProd = 0;
    }

    public function setNombre($nombre) {
        $this->nombrePedido = $nombre;
    }

    public function setTipoPedido($tipo, $detalle) {
        $this->tipoPedido = $tipo;
        $this->tipoPedido_numTelefono = $detalle;
    }

    public function setFormaPago($pago, $tipo) {
        $this->formaDePago = $pago;
        $this->formaDePago_numTransfer = $tipo;
    }

    public function setPagado($pago) {
        if($pago === PAGADO_SI)
            $this->pagado = PAGADO_SI;
        else 
            $this->pagado = PAGADO_NO;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function setTotalProductos($totalProd) {
        $this->totalProd = $totalProd;
    }

    public function copiarDetallePedido(PagarPedido_Controlador $objeto) {
        $this->nombrePedido = $objeto->nombrePedido;
        $this->tipoPedido = $objeto->tipoPedido;
        $this->tipoPedido_numTelefono = $objeto->tipoPedido_numTelefono;
        $this->formaDePago = $objeto->formaDePago;
        $this->formaDePago_numTransfer = $objeto->formaDePago_numTransfer;
        $this->pagado = $objeto->pagado;
        $this->total = $objeto->total;
        $this->totalProd = $objeto->totalProd;
    }

    public function getNombre() {
        return $this->nombrePedido;
    }

    public function getTipoPedido() {
        return $this->tipoPedido;
    }

    public function getTipoPedidoPresencial() :string {
        $aqui = "false";
        if($this->tipoPedido == PRESENCIAL) {
            $aqui = "true";
        }
        return $aqui;
    }

    public function getTipoPedidoViaTelefono() :string {
        $tel = "false";
        if($this->tipoPedido == VIA_TELEFONO) {
            $tel = "true";
        }
        return $tel;
    }

    public function getNumTelefono() :string {
        return $this->tipoPedido_numTelefono;
    }

    public function getPagoEfectivo() :string {
        $efectivo = "false";
        if($this->formaDePago == EFECTIVO) {
            $efectivo = "true";
        }
        return $efectivo;
    }

    public function getPagoTransferencia() :string {
        $transfer= "false";
        if($this->formaDePago == TRANSFERENCIA) {
            $transfer = "true";
        }
        return $transfer;
    }

    public function getTransferNum() :string {
        return $this->formaDePago_numTransfer;
    }

    public function getPagado() :string {
        return $this->pagado;
    }

    public function getTotal() {
        return $this->total;
    }
    
    public function getTotalProductos() {
        return $this->totalProd;
    }

    public function convert2JSON() :string {
        $objeto = new stdClass();
        $objeto->nombrePedido = $this->nombrePedido;
        $objeto->tipoPedido = $this->tipoPedido;
        $objeto->tipoPedido_numTelefono = $this->tipoPedido_numTelefono;
        $objeto->formaDePago = $this->formaDePago;
        $objeto->formaDePago_numTransfer = $this->formaDePago_numTransfer;
        // $objeto->pagado = $this->pagado;
        $objeto->pagado = "";
        $objeto->total = $this->total;
        $objeto->totalProd = $this->totalProd;
        $objJSON = json_encode($objeto);
        return $objJSON;
    }

}