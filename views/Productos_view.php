0_elo_fada0_elo_fada
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Documento sin título</title>
  <link href="elo.css" rel="stylesheet" type="text/css" />
</head>

<body>

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
    <?php foreach ($matrizProductos as $registro) { ?>
      <tr>
        <td><?php echo //$registro['ID_Fada']; ?></td>
        <td><?php echo //$registro['ID_Feda']; ?></td>
        <td><a href="http://ratings.fide.com/card.phtml?event=<?php echo //$registro['ID_Fide']; ?>" target="_blank">
                <?php echo //$registro['ID_Fide']; ?></a></td>
        <td><a href="../../3_jugador_personal_datos_fada.php?ID_Fada=<?php echo $registro['ID_Fada']; ?>">
                <?php echo htmlentities($registro['Apellidos_Nombre']); ?></a></td>
        <td><?php echo $registro['FNac']; ?></td>
        <td><?php echo $registro['Se']; ?></td>
        <td><?php echo $registro['Prov']; ?></td>
        <td><?php echo $registro['Estado']; ?></td>
      </tr>
  </table>



<?php
      //foreach ($matrizProductos as $registro) {

      //echo $registro["Apellidos_Nombre"];
    }

?>
</body>

</html>