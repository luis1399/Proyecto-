<?php
include "../../../../bd/conexion.php";
// Verificar si se envió un ID de cliente
if(isset($_POST['id'])){
    $idProducto = $_POST['id'];

    // Consulta para obtener los datos del cliente con el ID proporcionado
    $consulta = "SELECT * FROM producto WHERE idProducto = $idProducto";
    $resultado = $conexion->query($consulta);

    // Verificar si se encontraron resultados
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        // Devolver los datos del cliente en formato JSON
        echo json_encode($fila);
    } else {
        // Si no se encontraron resultados, devolver un JSON vacío o un mensaje de error
        echo json_encode(array('error' => 'Tecnico no encontrado'));
    }
} else {
    // Si no se proporcionó un ID de cliente, devolver un JSON vacío o un mensaje de error
    echo json_encode(array('error' => 'ID de Tecnico no proporcionado'));
}

// Cerrar la conexión
$conexion->close();
?>
