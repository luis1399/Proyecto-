<?php
include "../../../../bd/conexion.php";

// Verificar si se recibió el código del producto
if(isset($_POST['codigoProducto'])) {
    // Obtener el código del producto enviado desde la solicitud AJAX
    $codigoProducto = $_POST['codigoProducto'];

    // Consultar la base de datos para obtener la descripción del producto
    $sql = "SELECT descripcion FROM producto WHERE idProducto = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $codigoProducto);
    $stmt->execute();
    $stmt->bind_result($descripcion);

    // Obtener el resultado de la consulta
    if ($stmt->fetch()) {
        // Devolver la descripción del producto
        echo $descripcion;
    } else {
        // Si no se encontró el producto, devolver un mensaje de error
        echo "Producto no encontrado";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conexion->close();
} else {
    // Si no se recibió el código del producto, devolver un mensaje de error
    echo "Error: Código de producto no recibido";
}
?>
