<?php
// Verificar si se recibieron los parámetros 'tamano' y 'categoria' desde la solicitud GET
if (isset($_GET['tamano']) && isset($_GET['categoria'])) {
    include "../../../../bd/conexion.php";
    // Obtener los parámetros enviados desde la solicitud GET
    $tamano = $_GET['tamano'];
    $categoria = $_GET['categoria'];

    // Preparar la consulta para obtener las subcategorías correspondientes al tamaño y categoría
    $sql = "SELECT DISTINCT sbcategoria FROM servicio WHERE tamanio = ? AND categoria = ?";
    $stmt = $conexion->prepare($sql);

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt) {
        // Enlazar parámetros a la consulta
        $stmt->bind_param("ss", $tamano, $categoria);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado de la consulta
        $result = $stmt->get_result();

        // Verificar si se encontraron subcategorías
        if ($result->num_rows > 0) {
            // Crear un array para almacenar las subcategorías
            $subcategorias = array();

            // Iterar sobre los resultados y almacenar las subcategorías en el array
            while ($row = $result->fetch_assoc()) {
                $subcategorias[] = $row['sbcategoria'];
            }

            // Devolver las subcategorías como un array JSON
            echo json_encode($subcategorias);
        } else {
            // Si no se encontraron subcategorías, devolver un array vacío
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
    // Si no se recibieron los parámetros esperados, devolver un mensaje de error
    echo "No se recibieron los parámetros esperados";
}
?>
