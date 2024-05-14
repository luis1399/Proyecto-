<?php
include "../../../../bd/conexion.php";

// Obtener los parámetros de la solicitud GET
$tamano = $_GET['tamano'];
$categoria = $_GET['categoria'];
$subcategoria = $_GET['subcategoria'];
$descripcion = $_GET['descripcion'];

// Consulta para obtener el precio
$sql = "SELECT precio FROM servicio WHERE tamanio = '$tamano' AND categoria = '$categoria' AND sbcategoria = '$subcategoria' AND descripcion = '$descripcion'";

$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    // Obtener el precio y devolverlo como respuesta
    $row = $result->fetch_assoc();
    $precio = $row['precio'];
    echo $precio;
} else {
    // Si no se encuentra ningún precio, devolver un mensaje de error
    echo "Precio no encontrado";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
