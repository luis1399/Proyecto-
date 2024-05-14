<?php
include "../../../../bd/conexion.php";
// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];

    // Validar los datos recibidos (puedes implementar validaciones más específicas según tus requisitos)
    if (empty($descripcion) || empty($precio)) {
        // Manejar el caso de datos incompletos
        echo "Por favor complete todos los campos.";
    } else {

         $sql = "INSERT INTO producto (descripcion,precio) VALUES ('$descripcion', '$precio')";
         mysqli_query($conexion, $sql);
         $sql2 = "INSERT INTO almacen (descripcion,stock) VALUES('$descripcion','0')";
         mysqli_query($conexion,$sql2);

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
