<?php virtual('elo/models/FADA.php'); ?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
		<title>1_2_jugador_elo</title>
		<title>Jugadores FADA <?php echo $_GET['jugador_buscar']; ?></title>
	<link href="../../elo.css" rel="stylesheet" type="text/css" />
</head>
<?php
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

$currentPage = $_SERVER["PHP_SELF"];

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_o_elo = 10;
$pageNum_o_elo = 0;
if (isset($_GET['pageNum_o_elo'])) {
  $pageNum_o_elo = $_GET['pageNum_o_elo'];
}
$startRow_o_elo = $pageNum_o_elo * $maxRows_o_elo;

$colname_o_elo = "-1";
if (isset($_GET['Apellidos_Nombre'])) {
  $colname_o_elo = $_GET['Apellidos_Nombre'];
}
mysqli_select_db($FADA, $database_FADA);
$query_o_elo = sprintf("SELECT * FROM `0_elo_fada` WHERE Apellidos_Nombre LIKE %s", GetSQLValueString("%" . $colname_o_elo . "%", "text"));
$query_limit_o_elo = sprintf("%s LIMIT %d, %d", $query_o_elo, $startRow_o_elo, $maxRows_o_elo);
$o_elo = mysqli_query($FADA, $query_limit_o_elo ) or die(mysqli_error());
$row_o_elo = mysqli_fetch_assoc($o_elo);

if (isset($_GET['totalRows_o_elo'])) {
  $totalRows_o_elo = $_GET['totalRows_o_elo'];
} else {
  $all_o_elo = mysqli_query($FADA,$query_o_elo);
  $totalRows_o_elo = mysqli_num_rows($all_o_elo);
}
$totalPages_o_elo = ceil($totalRows_o_elo/$maxRows_o_elo)-1;

$queryString_o_elo = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_o_elo") == false && 
        stristr($param, "totalRows_o_elo") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_o_elo = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_o_elo = sprintf("&totalRows_o_elo=%d%s", $totalRows_o_elo, $queryString_o_elo);

$queryString_o_elo = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_o_elo") == false && 
        stristr($param, "totalRows_o_elo") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_o_elo = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_o_elo = sprintf("&totalRows_o_elo=%d%s", $totalRows_o_elo, $queryString_o_elo);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>3_jugador_elo.php</title>
</head>
<body>
<p align="center">Jugadores con apellidos del <?php echo ($startRow_o_elo + 1) ?> al <?php echo min($startRow_o_elo + $maxRows_o_elo, $totalRows_o_elo) ?> de <?php echo $totalRows_o_elo ?> jugadores</p>
<table border="0" align="center" cellspacing="0">
  <tr>
    <td align="center" bordercolor="#006600" bgcolor="#00CC00"><span class="Estilo1">ID_Fada</span></td>
    <td align="center" bordercolor="#006600" bgcolor="#00CC00"><span class="Estilo1">ID_Feda</span></td>
    <td align="center" bordercolor="#006600" bgcolor="#00CC00"><span class="Estilo1">ID_Fide</span></td>
    <td align="center" bordercolor="#006600" bgcolor="#00CC00"><span class="Estilo1">Apellidos_Nombre</span></td>
    <td align="center" bordercolor="#006600" bgcolor="#00CC00"><span class="Estilo1">FNac</span></td>
    <td align="center" bordercolor="#006600" bgcolor="#00CC00"><span class="Estilo1">Se</span></td>
    <td align="center" bordercolor="#006600" bgcolor="#00CC00"><span class="Estilo1">Prov</span></td>
    <td align="center" bordercolor="#006600" bgcolor="#00CC00"><span class="Estilo1">Estado</span></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_o_elo['ID_Fada']; ?></td>
      <td><?php echo $row_o_elo['ID_Feda']; ?></td>
      <td><a href="http://ratings.fide.com/card.phtml?event=<?php echo $row_o_elo['ID_Fide']; ?>" target="_blank"><?php echo $row_o_elo['ID_Fide']; ?></a></td>
      <td><a href="../../3_jugador_personal_datos_fada.php?ID_Fada=<?php echo $row_o_elo['ID_Fada']; ?>"><?php echo htmlentities ($row_o_elo['Apellidos_Nombre']); ?></a></td>
      <td><?php echo $row_o_elo['FNac']; ?></td>
      <td><?php echo $row_o_elo['Se']; ?></td>
      <td><?php echo $row_o_elo['Prov']; ?></td>
      <td><?php echo $row_o_elo['Estado']; ?></td>
    </tr>
    <?php } while ($row_o_elo = mysqli_fetch_assoc($o_elo)); ?>
</table>
<div align="center"></div>

<table border="0" align="center">
  <tr>
    <td><?php if ($pageNum_o_elo > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_o_elo=%d%s", $currentPage, 0, $queryString_o_elo); ?>">Primero</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_o_elo > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_o_elo=%d%s", $currentPage, max(0, $pageNum_o_elo - 1), $queryString_o_elo); ?>">Anterior</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_o_elo < $totalPages_o_elo) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_o_elo=%d%s", $currentPage, min($totalPages_o_elo, $pageNum_o_elo + 1), $queryString_o_elo); ?>">Siguiente</a>
          <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_o_elo < $totalPages_o_elo) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_o_elo=%d%s", $currentPage, $totalPages_o_elo, $queryString_o_elo); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
<a href="../../models/FADA.php">m </a>
</body>
</html>
<?php
mysqli_free_result($o_elo);
?>
