<?php
include ('../includes/sesiones.php');
include ('../includes/conexion.inc');
require '/storage/ssd5/392/22391392/public_html/libs/PHPMailer-master/src/Exception.php';
require '/storage/ssd5/392/22391392/public_html/libs/PHPMailer-master/src/PHPMailer.php';
require '/storage/ssd5/392/22391392/public_html/libs/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST["nombreUsuario"]);
  $clave = trim($_POST["claveUsuario"]);
  $clave_confirmada = trim($_POST["confirm-password"]);
  $tipoUsuario = isset($_POST["aplica-dueño"]) ? "Dueño de local" : "Cliente";

  if ($clave != $clave_confirmada) {
    $message = 'Las contraseñas no coinciden';
    $alertClass = 'alert danger';
  } else {
    $password_hash = password_hash($clave, PASSWORD_DEFAULT);

    $qry = "SELECT * FROM usuarios WHERE nombreUsuario = '$email'";
    $result = mysqli_query($link, $qry) or die(mysqli_error($link));
    $vResult = mysqli_fetch_array($result);

    if ($vResult) {
      $message = 'El correo ya está registrado';
      $alertClass = 'alert danger';
    } else {
      $token = bin2hex(random_bytes(50));
      $insert_qry = "INSERT INTO usuarios (nombreUsuario, claveUsuario, tipoUsuario, categoriaCliente, validation_token, is_validated) VALUES ('$email', '$password_hash', '$tipoUsuario', 'Inicial', '$token', 0)";
      if (mysqli_query($link, $insert_qry)) {
        $message = 'Registro exitoso. Revisa tu correo para confirmar tu registro';
        $alertClass = 'alert success';
        $mail = new PHPMailer(true);
        try {
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'totalstoreshopping@gmail.com';
          $mail->Password = 'dbgm xrgf hgoh cdte';
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port = 587;

          $mail->setFrom('totalstoreshopping@gmail.com', 'Total Store');
          $mail->addAddress($email);

          $mail->isHTML(true);
          $mail->Subject = 'Confirmación de Registro';
          $mail->Body = "Haz clic en el siguiente enlace para confirmar tu registro: <a href='https://totalstore00.000webhostapp.com/public/confirmar.php?token=$token'>Confirmar Registro</a>";

          $mail->send();
        } catch (Exception $e) {
          $message = 'Hubo un error al enviar el correo de confirmación';
          $alertClass = 'alert danger';
        }
      } else {
        $message = 'Hubo un error al registrarse. Por favor, inténtalo de nuevo';
        $alertClass = 'alert danger';
      }
    }
    mysqli_close($link);
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro - Total Store</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/sign-up.css">

  <style>
    .alert.success {
      background-color: #28a745;
      color: #fff;
      border: 1px solid #00b300;
    }

    .alert.danger {
      background-color: #dc3545;
      color: #fff;
      border: 1px solid #ff0000;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2 class="mt-5 text-center">Registrarse</h2>
    <form action="sign-up.php" method="post">
      <div class="form-group">
        <label for="nombre">Email:</label>
        <input type="text" class="form-control" id="nombre" name="nombreUsuario" required>
      </div>
      <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" class="form-control" id="clave" name="claveUsuario" required>
      </div>
      <div class="form-group">
        <label for="confirm-password">Confirmar Contraseña:</label>
        <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
      </div>
      <div class="form-group checkbox-container">
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="aplica-dueño" name="aplica-dueño">
          <label class="form-check-label" for="aplica-dueño">Aplicar para dueño</label>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
    </form>
    <?php if (!empty($message)): ?>
      <div class="<?php echo $alertClass; ?> text-center">
        <?php echo $message; ?>
      </div>
    <?php endif; ?>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>