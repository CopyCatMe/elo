<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php require_once('../../models/FADA.php'); ?>

<?php


ini_set('display_errors', '1');
error_reporting(E_ALL);

mysqli_query($FADA,"SET NAMES 'utf8'");
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
if (isset($FADA,$_GET['ID_Fada'])) {
  $colname_elo_total = $_GET['ID_Fada'];
}
mysqli_select_db($FADA,$database_FADA );
$query_elo_total = sprintf("SELECT * FROM `0_elo_fada_total` WHERE ID_Fada = %s ORDER BY Lista ASC", GetSQLValueString($colname_elo_total, "int"));
$elo_total = mysqli_query( $FADA,$query_elo_total) or die(mysqli_error());
$row_elo_total = mysqli_fetch_assoc($elo_total);
$totalRows_elo_total = mysqli_num_rows($elo_total);
//? >
$colname_elo = "-1";
if (isset($FADA,$_GET['ID_Fada'])) {
  $colname_elo = $_GET['ID_Fada'];  
}
$colname_elo = "-1";
if (isset($FADA,$_GET['ID_Fada'])) {
  $colname_elo = $_GET['ID_Fada'];
}
mysqli_select_db( $FADA,$database_FADA);
$query_elo = sprintf("SELECT * FROM `0_elo_fada` WHERE ID_Fada = %s", GetSQLValueString($colname_elo, "int"));
$elo = mysqli_query( $FADA,$query_elo) or die(mysqli_error());
$row_elo = mysqli_fetch_assoc($elo);
$totalRows_elo = mysqli_num_rows($elo);
 // no direct access
//defined('_JEXEC') or die('Restricted access'); 
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
<title>Elo actual y estudio</title>
<link href="../modules/elo.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center"><h1>
      
    Elo actual y estudio</h1></td>
  </tr>
  <tr>
    <td align="center" valign="top"><table width="100%" border="0" align="center" cellspacing="0">
      <tr>
        <td width="150" rowspan="3" align="center" valign="middle"><img src="images/<?php echo $row_elo['Prov']; ?>" alt="prov" /></td>
        <td colspan="3" bgcolor="#669900"><span class="Estilo1">Apellidos y Nombre:</span></td>
      </tr>
      <tr>
        <td colspan="3" bgcolor="#FFFFFF"><?php echo htmlentities ($row_elo['Apellidos_Nombre']); ?></td>
      </tr>
      <tr>
        <td width="150" align="center" bgcolor="#669900"><span class="Estilo1">ID</span></td>
        <td width="200" align="center" bgcolor="#669900"><span class="Estilo1">Elo</span></td>
        <td width="150" align="center" bgcolor="#669900"><span class="Estilo1">Titl</span></td>
      </tr>
      <tr>
        <td width="150" bgcolor="#669900"><span class="Estilo1">ID FADA:</span></td>
        <td width="150" bgcolor="#FFFFCC"><?php echo $row_elo['ID_Fada']; ?></td>
        <td width="200" bgcolor="#FFFFCC"><?php echo $row_elo['E_FADA']; ?></td>
        <td width="150" bgcolor="#99FFCC"><div align="center">LISTA ELO</div></td>
      </tr>
      <tr>
        <td width="150" bgcolor="#669900"><span class="Estilo1">ID FEDA:</span></td>
        <td width="150" bgcolor="#FFFFCC"><?php echo $row_elo['ID_Feda']; ?></td>
        <td width="200" bgcolor="#FFFFCC"><?php echo $row_elo['E_FEDA']; ?></td>
        <td width="150" bgcolor="#66FF99"><div align="center"><?php echo $row_elo['Lista_elo']; ?></div></td>
      </tr>
      <tr>
        <td width="150" bgcolor="#669900"><span class="Estilo1">ID FIDE:</span></td>
        <td width="150" bgcolor="#FFFFCC"><a href="http://ratings.fide.com/card.phtml?event=<?php echo $row_elo['ID_Fide']; ?>" target="_blank"><?php echo $row_elo['ID_Fide']; ?></a></td>
        <td width="200" bgcolor="#FFFFCC"><?php echo $row_elo['E_FIDE']; ?></td>
        <td width="150" bgcolor="#FFFFCC"><?php echo $row_elo['Titl']; ?></td>
      </tr>
      <tr>
        <td width="150">&nbsp;</td>
        <td width="150">&nbsp;</td>
        <td width="200">&nbsp;</td>
        <td width="150">&nbsp;</td>
      </tr>
      <tr>
        <td width="150" bgcolor="#669900"><span class="Estilo1">Año Nac:</span></td>
        <td width="150" bgcolor="#FFFFCC"><?php echo $row_elo['FNac']; ?></td>
        <td width="200" bgcolor="#669900"><span class="Estilo1">Se:</span></td>
        <td width="150" bgcolor="#FFFFCC"><?php echo $row_elo['Se']; ?></td>
      </tr>
      <tr>
        <td width="150" bgcolor="#669900"><span class="Estilo1">Provincia</span></td>
        <td width="150" bgcolor="#FFFFCC"><?php echo $row_elo['Prov']; ?></td>
        <td width="200" bgcolor="#669900"><span class="Estilo1">Total partidas:</span></td>
        <td width="150" bgcolor="#FFFFCC"><?php echo $row_elo['T_Part']; ?></td>
      </tr>
      <tr>
        <td width="150" bgcolor="#669900"><span class="Estilo1">Z_Elo:</span></td>
        <td width="150" bgcolor="#FFFFCC"><?php echo $row_elo['Z_Elo']; ?></td>
        <td width="200" bgcolor="#669900"><span class="Estilo1">Estado:</span></td>
        <td width="150" bgcolor="#FFFFCC"><?php echo $row_elo['Federado']; ?></td>
      </tr>
      <tr>
        <td width="150">&nbsp;</td>
        <td width="150">&nbsp;</td>
        <td width="200">&nbsp;</td>
        <td width="150">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#669900"><span class="Estilo1">Ranking elo listado total:</span></td>
        <td width="200" bgcolor="#FFFFCC"><?php echo $row_elo['Raking_Elo']; ?></td>
        <td width="150" bgcolor="#669900"><span class="Estilo1">Provincia</span></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#669900"><span class="Estilo1">Ranking elo por prov.:</span></td>
        <td width="200" bgcolor="#FFFFCC"><?php echo $row_elo['Raking_Prov']; ?></td>
        <td width="150" bgcolor="#FFFFCC"><?php echo $row_elo['Prov']; ?></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#669900"><span class="Estilo1">Ranking elo jugadores FADA</span></td>
        <td width="200" bgcolor="#FFFFCC"><?php echo $row_elo['Raking_fada']; ?></td>
        <td width="150" bgcolor="#FFFFCC">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#669900" class="Estilo1">Ranking elo jugadores FADA Federado</td>
        <td width="200" bgcolor="#FFFFCC"><?php echo $row_elo['Raking_Federados']; ?></td>
        <td width="150" bgcolor="#FFFFCC">&nbsp;</td>
      </tr>
      <tr>
        <td width="150" bgcolor="#669900"><span class="Estilo1">Federado</span></td>
        <td width="150" bgcolor="#FFFFCC"><?php echo $row_elo['Federado']; ?></td>
        <td width="200">&nbsp;</td>
        <td width="150">&nbsp;</td>
      </tr>
      <tr>
        <td width="150" bgcolor="#669900"><span class="Estilo1">Club</span></td>
        <td colspan="3" bgcolor="#FFFFCC"><?php echo htmlentities ($row_elo['Club']); ?></td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
    </table>
    <br />
    <?php
	
// Creamos el Graficos	

require_once '../modules/ofc/php-ofc-library/open_flash_chart_object.php';
open_flash_chart_object("100%",450,'http://'. $_SERVER['SERVER_NAME']."/elo/jugador_personal_datos_grafico_fada_prueba.php?ID_Fada=".$colname_elo_total,false, "ofc/");echo "<br>";echo "<br>";echo "<br>";

open_flash_chart_object("99%",350,'http://'. $_SERVER['SERVER_NAME']."/elo/jugador_personal_datos_grafico_zelo_todos_prueba.php?ID_Fada=".$colname_elo_total,false, "ofc/");echo "<br>";echo "<br>";echo "<br>";

open_flash_chart_object("99%",350,'http://'. $_SERVER['SERVER_NAME']."/elo/jugador_personal_datos_grafico_prueba.php?ID_Fada=".$colname_elo_total,false, "ofc/");

?>
    <br />
    <br />
<div align="center"></div>
<hr />
    </td>
    <td valign="top"><table width="100%" border="0" cellspacing="0">
      <tr>
        <td colspan="5"><span class="Estilo11">Informe   completo</span></td>
      </tr>
      <tr>
        <td><span class="Estilo6"><span class="Estilo10">Periodo</span></span></td>
        <td><span class="Estilo6"><span class="Estilo10">Elo</span></span></td>
        <td><span class="Estilo6"><span class="Estilo10">Partidas</span></span></td>
        <td><span class="Estilo6"><span class="Estilo10">RC</span></span></td>
        <td>Z_Elo</td>
      </tr>
      <?php do { ?>
      <tr>
        <td><span class="Estilo2"><?php echo $row_elo_total['Lista_elo']; ?></span></td>
        <td><?php echo $row_elo_total['E_FADA']; ?></td>
        <td><?php echo $row_elo_total['P_Trim']; ?></td>
        <td><?php echo $row_elo_total['RC']; ?></td>
        <td><?php echo $row_elo_total['Z_Elo']; ?></td>
      </tr>
      <?php } while ($row_elo_total = mysqli_fetch_assoc($elo_total)); ?>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<p><br />
</p>
</body>
</html>
<?php
mysqli_free_result($elo_total);

mysqli_free_result($elo);
?>
