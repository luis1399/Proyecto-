<?php
include "../../../../bd/conexion.php";
// Consulta para obtener los técnicos
$sql = "SELECT idTecnico, nombre FROM tecnico";
$result = $conexion->query($sql);

$tecnicos = array();

// Si se encontraron resultados, guardarlos en un array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tecnicos[] = $row;
    }
}

// Cerrar la conexión
$conexion->close();

// Devolver los técnicos en formato JSON
echo json_encode($tecnicos);
?>
