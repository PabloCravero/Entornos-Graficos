<title>Modificacion</title>
</head>
<boby>
  <?php
  include ("conexion.inc");
  //Captura datos desde el Form anterior
  $vId = $_POST['id'];
  //Arma la instrucción SQL y luego la ejecuta
  $vSql = "SELECT * FROM ciudades WHERE id ='$vId' ";
  $vResultado = mysqli_query($link, $vSql) or die(mysqli_error($link));
  ;
  $fila = mysqli_fetch_array($vResultado);
  if (mysqli_num_rows($vResultado) == 0) {
    echo ("Ciudad Inexistente...!!! <br>");
    echo ("<A href='modificacion.html'>Continuar</A>");
  } else {
    ?>
    <FORM action="modificacion.php" method="POST" name="FormModi">
      <table width="356">
        <tr>
          <td width="103"> ID: </td>
          <td width="243"> <input type="text" name="ID" value="<?php
          echo ($fila['id']); ?>">
          </td>
        </tr>
        <tr>
          <td width="103"> Ingrese el nombre de la ciudad: </td>
          <td width="243"> <input type="TEXT" name="Ciudad" size="20" maxlength="20"
              value="<?php echo ($fila['city']); ?>">
          </td>
        </tr>
        <tr>
          <td width="103"> Pais: </td>
          <td width="243"> <input type="TEXT" name="pais" size="20" maxlength="20"
              value="<?php echo ($fila['country']); ?>">
          </td>
        </tr>
        <tr>
          <td width="103"> Habitantes: </td>
          <td width="243"> <input type="TEXT" name="habitantes" size="20" maxlength="40"
              value="<?php echo ($fila['populations']); ?>">
          </td>
        </tr>
        <tr>
          <td width="103"> Superficie: </td>
          <td width="243"> <input type="TEXT" name="superficie" size="20" maxlength="40"
              value="<?php echo ($fila['area']); ?>">
          </td>
        </tr>
        <tr>
          <td width="103"> ¿Tiene metro?: </td>
          <td width="243"> <input type="TEXT" name="metro" size="20" maxlength="40" value="<?php echo ($fila['bus']); ?>">
          </td>
        </tr>
        <tr>
          <td colspan="2" align="center"> <input type="SUBMIT" name="Submit" value="Modificar">
          </td>
        </tr>
      </table>
    </FORM>
    <?php
  }
  // Liberar conjunto de resultados
  mysqli_free_result($vResultado);
  // Cerrar la conexion
  mysqli_close($link);
  ?>