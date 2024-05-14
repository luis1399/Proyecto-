<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "bd/conexion.php";
session_start();
if (isset($_SESSION['usuario'])) {
    header("Location: admin/index.php");
    exit;
} 

// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['password'];

    // Consulta para verificar la existencia del usuario y la contraseña
    $consulta = "SELECT * FROM usuarios WHERE usuario='$usuario' AND password=SHA2('$contrasena', 256)";
    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows == 1) {
        // Inicio de sesión exitoso
        $_SESSION['usuario'] = $usuario;
        header("Location: admin/index.php");
        exit(); // Terminar la ejecución del script después de redirigir
    } else {
        // Inicio de sesión fallido
        $error_msg = "Usuario o contraseña incorrectos. Inténtalo de nuevo.";
    }
}

// Cerrar la conexión
$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesión</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Estilos personalizados -->
  <style>
    .login-form {
      width: 300px;
      margin: 0 auto;
      margin-top: 100px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="login-form">
        
        <div class="text-center mb-4">
            <img src="img/logo.png" alt="Logo de la empresa" width="150">
          </div>
          <h2 class="text-center mb-4">Inicio de sesión</h2>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
              <input type="text" class="form-control" name ="usuario" placeholder="Usuario" required="required">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name = "password" placeholder="Contraseña" required="required">
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn-danger btn-block text-white">Iniciar sesión</button>
            </div>
          </form>
          <?php if (!empty($error_msg)) : ?>
                        <div class="alert alert-danger mt-3" role="alert">
                            <?php echo $error_msg; ?>
                        </div>
          <?php endif; ?>
          <p class="text-center"><a href="#">¿Olvidaste tu contraseña?</a></p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
