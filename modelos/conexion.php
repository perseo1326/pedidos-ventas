<?php

// ****************************************************************
// configuracion para la conexion a la base de datos ddbb:
const DB_CONFIG = ['host' => 'localhost', 
                'ddbb_name' => 'ancalayola',
                'ddbb_user' => 'juan',
                'ddbb_pass' => 'juan' ];
// ****************************************************************


// ****************************************************************
// ***  clase conexion a base de datos
// ****************************************************************

class Conexion
{
    
    // ****************************************************************
    // funcion para la conexion a la ddbb
    public static function conectar(){
        $servername = DB_CONFIG['host'];
        $database = DB_CONFIG['ddbb_name']; 
        $username = DB_CONFIG['ddbb_user'];
        $password = DB_CONFIG['ddbb_pass'];
        $dsn = "mysql:host=$servername;dbname=$database;charset=utf8mb4";
        // $dsn_Options = _[ PDO::ATTR_EMULATE_PREPARES => false // turn off emulation mode for 'real' prepared statements 
        $dsn_Options = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // turn on errors in the form of exceptions
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // default fetch an associative array
                        PDO::MYSQL_ATTR_FOUND_ROWS => true ]; // get number of affected rows even on an UPDATE (use $statement->rowCount();)

        // Create a new connection to the MySQL database using PDO, $conexion is an object
        try { 
            $conexion = new PDO($dsn, $username, $password, $dsn_Options);
            // $statement = $conexion->prepare("SET NAMES 'utf8';");
            // $statement->execute();
            return $conexion;
        } 
        catch (PDOException $e) {
            debugCodigo($e, true);
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
            // die("Error de conexion: " . $e->getMessage()); // tuto "pildorasinformaticas - Youtube"
            // echo "Linea del error " . $e->getLine(); // tuto "pildorasinformaticas - Youtube"
            // return false;
        }
    }
}


/*
Modelo de conexion a base de datos MySQL con PDO 
Curso PHP MySql. Modelo Vista Controlador II. Vídeo 79
https://youtu.be/2Xb_n-GUSU0?t=416
*/
/* 
class Conexion {
    public static function conectar () {
        try {
        
            // $conexion = new PDO("mysql:host=$db_config['host']; dbname=$db_config['ddbb_name']", $db_config['ddbb_user'], $db_config['ddbb_pass']);
            $conexion = new PDO("mysql:host=192.168.1.101; dbname=ancalayola", "maria", "maria");
            
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $conexion->exec("SET CHARACTER SET UTF8");
        
        } catch (Exception $e) {

            die("Error de conexion: " . $e->getMessage());

            echo "Linea del error " . $e->getLine();

        }

        return $conexion;

    }
}
 */