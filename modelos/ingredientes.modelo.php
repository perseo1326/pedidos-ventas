<?php


class Ingredientes_modelo {
    private $saboresDetallePedido;
    private $ingredientes;

    public function __construct(){
        require_once "conexion.php";
        $this->conex = Conexion::conectar();
        $saboresDetallePedido = array();
        $ingredientes = array();
    }

    public function __destruct() {
        $this->conex = null;
    }


    public function getSaboresDetallesPedido() {
        $statement = $this->conex->prepare("SELECT ingred_codigo AS cod_ingrediente, ingred_ingrediente AS ingrediente, ingred_imagen AS imagen 
            FROM ingredientes
            WHERE ingred_tipo = :ingred_pedido AND 
            ingred_status = 'A'; ");

        $statement->bindValue(':ingred_pedido', INGRED_TIPO_PEDIDO, PDO::PARAM_STR);

        $statement->execute();

        while($registro = $statement->fetch()) {
            $this->saboresDetallePedido[] = $registro;
        }
        $statement = null;
        // retorna consulta de tabla=INGREDIENTES para los "botones" de la interfaz del modulo "PEDIDO", 
        // con codigo, ingrediente(nombre/descripcion), imagen
        return $this->saboresDetallePedido;
    }


    public function getIngredientes() {
        $statement = $this->conex->prepare("SELECT ingred_id AS ingred_id, ingred_codigo AS ingred_cod, ingred_ingrediente AS ingrediente 
                        FROM ingredientes
                        WHERE ingred_status = 'A'
                        AND ingred_tipo = :INDEFINIDO 
                        OR ingred_tipo = :PEDIDO; ");

        $statement->bindValue(':INDEFINIDO', INDEFINIDO, PDO::PARAM_STR);
        $statement->bindValue(':PEDIDO', INGRED_TIPO_PEDIDO, PDO::PARAM_STR);

        $statement->execute();

        while($registro = $statement->fetch()) {
            $this->ingredientes[] = $registro;
        }
        $statement = null;
        // retorna la consulta de los ingredientes con ID, codigo y nombre
        return $this->ingredientes;
    }


}

