<?php
include "../../../../bd/conexion.php";

// Obtener los datos enviados por AJAX
$folio = $_POST['folio'];
$servicios = $_POST['servicios'];

// Insertar datos de los servicios en la tabla servicios_cotizacion
foreach ($servicios as $servicio) {
    // Obtener los detalles del servicio
    $tamano = $servicio['tamano'];
    $categoria = $servicio['categoria'];
    $subcategoria = $servicio['subcategoria'];
    $descripcion = $servicio['descripcion'];

    // Consultar el idServicio correspondiente en la tabla servicios
    $sql = "SELECT id_servicio FROM servicio WHERE tamanio = ? AND categoria = ? AND sbcategoria = ? AND descripcion = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssss", $tamano, $categoria, $subcategoria, $descripcion);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    // Verificar si se encontró el servicio
    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $idServicio = $row['id_servicio'];

        // Insertar el idServicio y el precio en la tabla servicios_cotizacion
        $precio = $servicio['precio'];
        $sql_insert = "INSERT INTO cotizacion_detalle (folio, idServicio, precio) VALUES (?, ?, ?)";
        $stmt_insert = $conexion->prepare($sql_insert);
        $stmt_insert->bind_param("sii", $folio, $idServicio, $precio);
        $stmt_insert->execute();
        $stmt_insert->close();
    } else {
        // El servicio no fue encontrado en la base de datos
        // Aquí puedes manejar esta situación, por ejemplo, omitir la inserción o registrar un error
        // Por simplicidad, en este ejemplo, simplemente imprimimos un mensaje de error
        echo "Error: Servicio no encontrado para los detalles proporcionados.";
    }

    $stmt->close();
}

$conexion->close();
?>
