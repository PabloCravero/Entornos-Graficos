<?php
include ("../includes/conexion.inc");
include ("../includes/sesiones.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Total Store</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css"
    rel="stylesheet">
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" href="../css/footer.css">
  <?php
  // Incluir hojas de estilo específicas para cada página
  if ($page == 'home') {
    echo '<link rel="stylesheet" href="../css/home.css">';
  } elseif ($page == 'locales' || $page == 'baja_descuento' || $page == 'promocion_local' || $page == 'promociones' || $page == 'reportes' || $page == 'historial') {
    echo '<link rel="stylesheet" href="../css/listados.css">';
  } elseif ($page == 'promociones') {
    echo '<link rel="stylesheet" href="../css/promociones.css">';
  } elseif ($page == 'alta_local' || $page == 'alta_novedades' || $page == 'eliminacion_local' || $page == 'eliminacion_novedades' || $page == 'gestionar_descuentos' || $page == 'modificacion_local' || $page == 'modificacion_novedades' || $page == 'seccion_administrador' || $page == 'validar_duenio' || $page == 'alta_descuento' || $page == 'gestion_promocion' || $page == 'gestionar_solicitud' || $page == 'modificacion_perfil') {
    echo '<link rel="stylesheet" href="../css/admin_locales.css">';
  }

  ?>
</head>


<body>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>