<?php
include "../../../../bd/conexion.php";

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $tamanio = $_POST['tamano'];
    $categoria = $_POST['categoria'];
    $subcategoria=$_POST['subcategoria'];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];

    // Validar los datos recibidos (puedes implementar validaciones más específicas según tus requisitos)
    if (empty($descripcion) || empty($precio)||empty($tamanio)||empty($categoria)||empty($subcategoria)) {
        // Manejar el caso de datos incompletos
        echo "Por favor complete todos los campos.";
    } else {

         $sql = "INSERT INTO servicio (tamanio,categoria,sbcategoria,descripcion,precio) VALUES ('$tamanio','$categoria','$subcategoria','$descripcion', '$precio')";
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
