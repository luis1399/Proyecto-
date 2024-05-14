<?php
include "../../../../bd/conexion.php";

// Consulta SQL para obtener los clientes
$sql = "SELECT idCliente, nombre FROM cliente";

// Ejecutar la consulta
$result = $conexion->query($sql);

// Array para almacenar los clientes
$clientes = array();

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Recorrer los resultados y almacenarlos en el array
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }
}

// Cerrar la conexión
$conexion->close();

// Devolver los clientes en formato JSON
echo json_encode($clientes);
?>
