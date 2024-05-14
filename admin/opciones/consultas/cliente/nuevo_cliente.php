<?php
include "../../../../bd/conexion.php";
// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];

    // Validar los datos recibidos (puedes implementar validaciones más específicas según tus requisitos)
    if (empty($nombre) || empty($direccion) || empty($correo) || empty($telefono)) {
        // Manejar el caso de datos incompletos
        echo "Por favor complete todos los campos.";
    } else {

         $sql = "INSERT INTO cliente (nombre, direccion, correo, telefono) VALUES ('$nombre', '$direccion', '$correo', '$telefono')";
         mysqli_query($conexion, $sql);

        // Redirigir a la página de origen (index.php en este caso)
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    }
} else {
    // Redireccionar si se intenta acceder al archivo directamente sin enviar datos del formulario
    header("Location: index.php");
    exit;
}
?>
