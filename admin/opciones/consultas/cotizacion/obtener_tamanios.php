<?php
include "../../../../bd/conexion.php";
// Realizar la consulta para obtener los tamaños únicos de la tabla "servicio"
$sql = "SELECT DISTINCT tamanio FROM servicio";
$result = $conexion->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Crear un array para almacenar los tamaños
    $tamanos = array();

    // Iterar sobre los resultados y almacenar los tamaños en el array
    while ($row = $result->fetch_assoc()) {
        $tamanos[] = $row['tamanio'];
    }

    // Devolver los tamaños como un array JSON
    echo json_encode($tamanos);
} else {
    // Si no se encontraron resultados, devolver un array vacío
    echo json_encode(array());
}

// Cerrar la conexión
$conexion->close();
?>
