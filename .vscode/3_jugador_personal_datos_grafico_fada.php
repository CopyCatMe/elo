<?php require_once('../Connections/FADA.php'); ?>

<?php
mysqli_query("SET NAMES 'utf8'");

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  global $FADA;

  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  //Agregamos $conexion en las funciones mysqli_real_escape_string y mysqli_escape_string
  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($FADA,$theValue) : mysqli_escape_string($FADA,$theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
$colname_elo_total = "-1";
if (isset($_GET['ID_Fada'])) {
  $colname_elo_total = $_GET['ID_Fada'];
}
mysqli_select_db($FADA,$database_FADA );
$query_elo_total = sprintf("SELECT * FROM `0_elo_fada_total` WHERE ID_Fada = %s", GetSQLValueString($colname_elo_total, "int"));
$elo_total = mysqli_query($FADA,$query_elo_total) or die(mysqli_error());
$row_elo_total = mysqli_fetch_assoc($elo_total);
$totalRows_elo_total = mysqli_num_rows($elo_total);

$colname_ASC = "-1";
if (isset($_GET['ID_Fada'])) {
  $colname_ASC = $_GET['ID_Fada'];
}
mysqli_select_db($FADA,$database_FAD);
$query_ASC = sprintf("SELECT E_FADA FROM `0_elo_fada_total` WHERE ID_Fada = %s ORDER BY E_FADA ASC", GetSQLValueString($colname_ASC, "int"));
$ASC = mysqli_query($FADA,$query_ASC) or die(mysqli_error());
$row_ASC = mysqli_fetch_assoc($ASC);
$totalRows_ASC = mysqli_num_rows($ASC);

$colname_DESC = "-1";
if (isset($_GET['ID_Fada'])) {
  $colname_DESC = $_GET['ID_Fada'];
}
mysqli_select_db($FADA,$database_FADA);
$query_DESC = sprintf("SELECT E_FADA FROM `0_elo_fada_total` WHERE ID_Fada = %s ORDER BY E_FADA DESC", GetSQLValueString($colname_DESC, "int"));
$DESC = mysqli_query($FADA,$query_DESC) or die(mysqli_error());
$row_DESC = mysqli_fetch_assoc($DESC);
$totalRows_DESC = mysqli_num_rows($DESC);


?>
<?php
$data_fada = array();
$data_lista = array();
for( $i=0; $i<12; $i++ )

while($row = mysqli_fetch_array($elo_total))
{
array_push($data_fada, $row["E_FADA"]);
array_push($data_lista, $row["Lista_elo"]);
}

include_once( 'ofc/php-ofc-library/open-flash-chart.php' );
$g = new graph();
$g->title( 'Grafica de Progreso Elo FADA ', '{font-size: 20px; color: #736AFF}' );

// sumamos 3 conjuntos de datos:
$g->set_data( $data_fada );

// sumamos los 3 tipos de líneas y etiquetas de las teclas
$g->line_dot( 2, 5,'#669900', 'FADA', 10 );
$g->line( 3, '#FF0000', 'FEDA', 10);    // <-- 3px thick + dots
$g->line_hollow( 2, 4, '#0000FF', 'FIDE', 10 );

$g->set_x_labels( $data_lista );
$g->set_x_label_style( 10, '#000000', 1 );
$g->set_bg_image('img/logo.png', '300', '100');

$g->set_y_min($row_ASC["E_FADA"]-5);
$g->set_y_max($row_DESC["E_FADA"]+10);

$g->y_label_steps(10);
$g->set_y_legend( 'ELO', 12, '#736AFF' );

echo $g->render();
?>
<?php 

mysqli_free_result($elo_total);

mysqli_free_result($ASC);

mysqli_free_result($DESC);
?>

<?php 
//5-desconectar la base de datos
mysqli_close($FADA);
?>
