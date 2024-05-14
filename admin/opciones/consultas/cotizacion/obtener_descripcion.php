<?php
// Verificar si se recibieron los parámetros 'tamano', 'categoria' y 'subcategoria' desde la solicitud GET
if (isset($_GET['tamano']) && isset($_GET['categoria']) && isset($_GET['subcategoria'])) {
    include "../../../../bd/conexion.php";

    // Obtener los parámetros enviados desde la solicitud GET
    $tamano = $_GET['tamano'];
    $categoria = $_GET['categoria'];
    $subcategoria = $_GET['subcategoria'];

    // Preparar la consulta para obtener las descripciones correspondientes al tamaño, categoría y subcategoría
    $sql = "SELECT descripcion FROM servicio WHERE tamanio = ? AND categoria = ? AND sbcategoria = ?";
    $stmt = $conexion->prepare($sql);

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt) {
        // Enlazar parámetros a la consulta
        $stmt->bind_param("sss", $tamano, $categoria, $subcategoria);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado de la consulta
        $result = $stmt->get_result();

        // Crear un array para almacenar las descripciones
        $descripciones = array();

        // Obtener todas las descripciones y almacenarlas en el array
        while ($row = $result->fetch_assoc()) {
            $descripciones[] = $row['descripcion'];
        }

        // Devolver el array de descripciones como JSON
        echo json_encode($descripciones);

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
