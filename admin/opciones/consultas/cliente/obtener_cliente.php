<?php
include "../../../../bd/conexion.php";

// Inicializar un array para almacenar la respuesta JSON
$response = array();

// Verificar si se envió un ID de cliente
if(isset($_POST['id'])){
    $idCliente = $_POST['id'];
    // Escapar el ID de cliente para evitar inyección SQL
    $idCliente = $conexion->real_escape_string($idCliente);
    
    // Consulta para obtener los datos del cliente con el ID proporcionado
    $consulta = "SELECT * FROM cliente WHERE idCliente = $idCliente";
    
    $resultado = $conexion->query($consulta);
    
    // Verificar si se encontraron resultados
    if ($resultado) {
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            // Devolver los datos del cliente en formato JSON
            $response['success'] = true;
            $response['data'] = $fila;
        } else {
            // Si no se encontraron resultados, devolver un mensaje de error
            $response['success'] = false;
            $response['error'] = 'Cliente no encontrado';
            $response['id_cliente'] = $idCliente; // Incluir el ID del cliente en el mensaje de error
            http_response_code(404); // Devolver código de estado 404
        }
    } else {
        // Si hay un error en la consulta, devolver un mensaje de error
        $response['success'] = false;
        $response['error'] = 'Error en la consulta: ' . $conexion->error;
        http_response_code(500); // Devolver código de estado 500 (error interno del servidor)
    }
} else {
    // Si no se proporcionó un ID de cliente, devolver un mensaje de error
    $response['success'] = false;
    $response['error'] = 'ID de cliente no proporcionado';
    http_response_code(400); // Devolver código de estado 400 (solicitud incorrecta)
}

// Cerrar la conexión
$conexion->close();

// Devolver la respuesta JSON
echo json_encode($response);
?>
