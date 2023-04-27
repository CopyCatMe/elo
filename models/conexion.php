<?php

class Conexion{

	public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=fadaj_333","root","");
		return $link;

	}

}
