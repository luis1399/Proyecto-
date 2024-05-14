<?php
// Verificar si se recibió el parámetro 'tamano' desde la solicitud GET
if (isset($_GET['tamano'])) {
    include "../../../../bd/conexion.php";

    // Obtener el tamaño enviado desde la solicitud GET
    $tamano = $_GET['tamano'];

    // Preparar la consulta para obtener las categorías correspondientes al tamaño
    $sql = "SELECT DISTINCT categoria FROM servicio WHERE tamanio = ?";
    $stmt = $conexion->prepare($sql);

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt) {
        // Enlazar parámetros a la consulta
        $stmt->bind_param("s", $tamano);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado de la consulta
        $result = $stmt->get_result();

        // Verificar si se encontraron categorías
        if ($result->num_rows > 0) {
            // Crear un array para almacenar las categorías
            $categorias = array();

            // Iterar sobre los resultados y almacenar las categorías en el array
            while ($row = $result->fetch_assoc()) {
                $categorias[] = $row['categoria'];
            }

            // Devolver las categorías como un array JSON
            echo json_encode($categorias);
        } else {
            // Si no se encontraron categorías, devolver un array vacío
            echo json_encode(array());
        }

        // Cerrar la consulta
        $stmt->close();
    } else {
        // Si hubo un error en la preparación de la consulta, devolver un mensaje de error
        echo "Error en la preparación de la consulta";
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    // Si no se recibió el parámetro 'tamano', devolver un mensaje de error
    echo "No se recibió el tamaño";
}
?>
