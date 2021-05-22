<?php

class Bebidas_modelo {
    
    private $conex;
    private $bebidas;
    
    public function __construct(){
        require_once "../modelos/conexion.php";
        $this->conex = Conexion::conectar();
        $bebidas = array();
    }

    public function get_bebidas($bebidas_cod) {
        $this->bebidas = [];
        $statement = $this->conex->prepare("SELECT prod_id as id, prod_codigo AS codigo, prod_nombre AS nombre, prod_precio AS precio, prod_imagen AS imagen 
                FROM productos
                JOIN categorias ON productos.prod_categoria = categorias.cat_id
                WHERE categorias.cat_codigo = :bebida_codigo
                AND productos.prod_status = 'A'; ");

        $statement->bindValue(':bebida_codigo', $bebidas_cod, PDO::PARAM_STR);

        $statement->execute();

        while($registro = $statement->fetch()) {
            $this->bebidas[] = ($registro);
        }
        $statement = null;
        return $this->bebidas;
    }
}

