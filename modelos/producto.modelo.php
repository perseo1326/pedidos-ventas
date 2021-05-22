<?php

require_once ("../admin/config.php");

// *************************************************************
// *************************************************************
// **********  NOTA IMPORTANTE

// se debe tener acceso a la constante "INDEFINIDO" => "config.php"
// se debe tener acceso a la constante "DESCONOCIDO" => "config.php"
// *************************************************************


class Producto_modelo {
    private $conex;
    private $sabores;
    private $productoDetalle;


    public function __construct(){
        require_once "../modelos/conexion.php";
        $this->conex = Conexion::conectar();
        $sabores = [];
        $productoDetalle = [];
    }

    public function setSabores_mdl($sabores) {
        $this->sabores = $sabores;
        $this->organizaSabores_mdl();
    }

    private function organizaSabores_mdl() {
		for ($i = 0; $i < 3; $i++) { 
			if(!isset($this->sabores[$i])) {
				$this->sabores[$i] = INDEFINIDO;
			}
		}
	}

    public function getProductoDetalle_mdl() {
        $this->productoDetalle = [];
        $statement = $this->conex->prepare("SELECT prod_id AS id, prod_codigo AS codigo, prod_precio AS precio 
                FROM productos  
                JOIN categorias ON prod_categoria = cat_id
                WHERE cat_codigo = :CAT_PANUCHOS 
                AND prod_status = 'A' 
                AND prod_ingrediente1 = (SELECT ingred_id FROM ingredientes WHERE ingred_status = 'A' AND ingred_codigo = :ingred_1)
                AND prod_ingrediente2 = (SELECT ingred_id FROM ingredientes WHERE ingred_status = 'A' AND ingred_codigo = :ingred_2)
                AND prod_ingrediente3 = (SELECT ingred_id FROM ingredientes WHERE ingred_status = 'A' AND ingred_codigo = :ingred_3); ");

        $statement->bindValue(':CAT_PANUCHOS', CATEG_PANUCHOS, PDO::PARAM_STR);
        $statement->bindValue(':ingred_1', $this->sabores[0], PDO::PARAM_STR);
        $statement->bindValue(':ingred_2', $this->sabores[1], PDO::PARAM_STR);
        $statement->bindValue(':ingred_3', $this->sabores[2], PDO::PARAM_STR);

        $statement->execute();

        while($registro = $statement->fetch()) {
            $this->productoDetalle[] = $registro;
        }
        
        $statement = null;
        // retornar los detalles del producto en cuestion: codigo y precio.
        return $this->productoDetalle;
    }

    public function getDetalle () {
        return $this->productoDetalle;
    }

}

