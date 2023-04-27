<?php
// consulta y devuelve todos los registros de la base de datos

class Productos_modelo
{

	private $db;
	private $productos;

	public function __construct()
	{

		require_once("models/conectar.php");
		$this->db = Conectar::conexion();
		$this->productos = array();
	}
	public function get_productos()
	{

		$consultas = $this->db->query("SELECT Apellidos_Nombre FROM 0_elo_fada");

		while ($filas = $consultas->fetch(PDO::FETCH_ASSOC)) {
			$this->productos[] = $filas;
		}
		return $this->productos;
	}
}