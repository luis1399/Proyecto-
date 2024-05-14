<?php
include "../../../../bd/conexion.php";
// Verificar si se recibieron los datos del formulario
if(isset($_POST['idServicio'],$_POST['tamanio'],$_POST['categoria'],$_POST['subcategoria'], $_POST['descripcion'], $_POST['precio'])) {
    // Escribir los datos recibidos en un archivo de registro
    $datos = print_r($_POST, true);
    file_put_contents('datos_recibidos.log', $datos . PHP_EOL, FILE_APPEND);
      
    // Obtener los datos del formulario
    $idServicio = $_POST['idServicio'];
    $tamanio = $_POST['tamanio'];
    $categoria = $_POST['categoria'];
    $subcategoria = $_POST['subcategoria'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Preparar la consulta SQL para actualizar los datos del cliente
    $sql = "UPDATE servicio SET tamanio = ?, categoria = ?, sbcategoria = ?, descripcion = ?, precio = ? WHERE id_servicio = ?";

    // Preparar la sentencia
    $stmt = $conexion->prepare($sql);

    // Vincular los parámetros
    $stmt->bind_param("ssssdi", $tamanio, $categoria, $subcategoria, $descripcion, $precio, $idServicio);

    // Ejecutar la sentencia
    if ($stmt->execute()) {
        // Los datos se actualizaron correctamente
        echo "Los datos del producto se actualizaron correctamente";
    } else {
        // Error al actualizar los datos
        echo "Error al actualizar los datos del producto: " . $conexion->error;
    }

    // Cerrar la sentencia y la conexión
    $stmt->close();
    $conexion->close();
} else {
    // Si no se recibieron todos los datos del formulario, mostrar un mensaje de error
    file_put_contents('datos_recibidos.log', 'Sin datos');
    echo "Error: Todos los campos son obligatorios";
}
?>
