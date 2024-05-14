<?php
include "../../../../bd/conexion.php";
// Verificar si se recibieron los datos del formulario
if(isset($_POST['idProveedor'], $_POST['rfc'], $_POST['nombre'], $_POST['direccion'], $_POST['correo'], $_POST['telefono'])) {
    // Escribir los datos recibidos en un archivo de registro
    $datos = print_r($_POST, true);
    file_put_contents('datos_recibidos.log', $datos . PHP_EOL, FILE_APPEND);
      
    // Obtener los datos del formulario
    $idProveedor = $_POST['idProveedor'];
    $rfc = $_POST['rfc'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    // Preparar la consulta SQL para actualizar los datos del cliente
    $sql = "UPDATE proveedor SET nombre = '$nombre',rfc='$rfc', direccion = '$direccion',correo='$correo', telefono = '$telefono' WHERE idProveedor = $idProveedor";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        // Los datos se actualizaron correctamente
        echo "Los datos del proveedor se actualizaron correctamente";
    } else {
        // Error al actualizar los datos
        echo "Error al actualizar los datos del proveedor: " . $conn->error;
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    // Si no se recibieron todos los datos del formulario, mostrar un mensaje de error
    echo "Error: Todos los campos son obligatorios";
}
?>
