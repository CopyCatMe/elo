<?php
class Conectar{
    public static function conexion(){
		try{
        	$conexion = new PDO('mysql:host=localhost;dbname=fadaj_333', 'root', '');
        	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conexion->exec("SET CHARACTER SET UTF8");
		}catch (Exception $e){
			die("Error" . $e->getMessaga());
			echo "Linea del error" . $e->getLine();
		}
        return $conexion;
  }  
}

# $hostname_FADA = "localhost";
# $database_FADA = "fadaj_333";
# $username_FADA = "root";
# $password_FADA = "";
?>
