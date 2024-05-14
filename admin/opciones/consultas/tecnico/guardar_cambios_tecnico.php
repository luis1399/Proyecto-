<?php
include "../../../../bd/conexion.php";
// Verificar si se recibieron los datos del formulario
if(isset($_POST['idTecnico'], $_POST['nombre'], $_POST['direccion'], $_POST['correo'], $_POST['celular'], $_POST['nss'], $_POST['curp'])) {
    // Escribir los datos recibidos en un archivo de registro
    $datos = print_r($_POST, true);
    file_put_contents('datos_recibidos.log', $datos . PHP_EOL, FILE_APPEND);
      
    // Obtener los datos del formulario
    $idTecnico = $_POST['idTecnico'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $celular = $_POST['celular'];
    $nss = $_POST['nss'];
    $curp = $_POST['curp'];

    // Preparar la consulta SQL para actualizar los datos del cliente
    $sql = "UPDATE tecnico SET nombre = '$nombre', direccion = '$direccion', correo = '$correo', celular = '$celular', nss = '$nss', curp = '$curp' WHERE idTecnico = $idTecnico";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        // Los datos se actualizaron correctamente
        echo "Los datos del tecnico se actualizaron correctamente";
    } else {
        // Error al actualizar los datos
        echo "Error al actualizar los datos del tecnico: " . $conn->error;
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    // Si no se recibieron todos los datos del formulario, mostrar un mensaje de error
    echo "Error: Todos los campos son obligatorios";
}
?>
