<?php
include "../../../../bd/conexion.php";

// Verificar si se ha proporcionado un ID de cliente en la URL
if (isset($_GET['id'])) {
    // Obtener el ID del cliente de la URL
    $idProducto = $_GET['id'];

    // Preparar y ejecutar la consulta para eliminar el cliente
    $sql = "DELETE FROM servicio WHERE id_servicio = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idProducto);

    if ($stmt->execute()) {
        // Si la eliminación fue exitosa, redirigir a la página de origen usando HTTP_REFERER
        $referer = $_SERVER['HTTP_REFERER']; // Obtener la URL de la página de origen
        //echo $idCliente;
        header("Location: $referer");
        exit();
    } else {
        echo "Error al intentar eliminar el producto.";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
} else {
    // Si no se proporcionó un ID de cliente, mostrar un mensaje de error
    echo "ID de producto no proporcionado.";
}

// Cerrar la conexión
$conexion->close();
?>
