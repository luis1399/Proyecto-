<?php
include "../../../../bd/conexion.php";
// Verificar si se recibieron los datos del formulario
if(isset($_POST['idProducto'], $_POST['descripcion'], $_POST['precio'])) {
    // Escribir los datos recibidos en un archivo de registro
    $datos = print_r($_POST, true);
    file_put_contents('datos_recibidos.log', $datos . PHP_EOL, FILE_APPEND);
      
    // Obtener los datos del formulario
    $idProducto = $_POST['idProducto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    // Preparar la consulta SQL para actualizar los datos del cliente
    $sql = "UPDATE producto SET descripcion = '$descripcion', precio = '$precio' WHERE idProducto = $idProducto";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        // Los datos se actualizaron correctamente
        echo "Los datos del producto se actualizaron correctamente";
    } else {
        // Error al actualizar los datos
        echo "Error al actualizar los datos del producto: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    // Si no se recibieron todos los datos del formulario, mostrar un mensaje de error
    echo "Error: Todos los campos son obligatorios";
}
?>
