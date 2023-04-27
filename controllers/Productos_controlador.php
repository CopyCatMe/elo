<?php
require_once("models/Productos_modelo.php");
$producto = new Productos_modelo();
$matrizProductos = $producto->get_productos();

require_once("views/Productos_view.php");
