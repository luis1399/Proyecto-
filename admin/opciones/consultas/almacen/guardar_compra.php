<?php
// Verificar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    include "../../../../bd/conexion.php";

    // Obtener los datos del formulario
    $codigoProducto = $_POST["codigoProducto"];
    $cantidadComprada = $_POST["cantidad"];

    // Inicializar variables para la bitácora
    $idProducto = null;
    $descripcion = null;
    $precio = null;
    $subtotal = null;

    // Actualizar el stock en la tabla de almacenamiento
    $sqlUpdateStock = "UPDATE almacen SET stock = stock + ? WHERE id_producto = ?"; //corregir
    $stmtUpdateStock = $conexion->prepare($sqlUpdateStock);
    $stmtUpdateStock->bind_param("ii", $cantidadComprada, $codigoProducto);

    if ($stmtUpdateStock->execute()) {
        // Obtener la información del producto
        $sqlProducto = "SELECT idProducto, descripcion, precio FROM producto WHERE idProducto = ?";
        $stmtProducto = $conexion->prepare($sqlProducto);
        $stmtProducto->bind_param("i", $codigoProducto);
        $stmtProducto->execute();
        $resultProducto = $stmtProducto->get_result();

        if ($resultProducto->num_rows > 0) {
            $rowProducto = $resultProducto->fetch_assoc();
            $idProducto = $rowProducto["idProducto"];
            $descripcion = $rowProducto["descripcion"];
            $precio = $rowProducto["precio"];
            $subtotal = $cantidadComprada * $precio;
        }

        $tipoMovimiento = "Compra"; // Se asume que es una compra
        $fecha_hora = date("Y-m-d H:i:s"); // Fecha y hora actual
        $sqlInsertBitacora = "INSERT INTO bitacora (descripcion, tipo_movimiento, precio, cantidad, subtotal, fecha_hora) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtInsertBitacora = $conexion->prepare($sqlInsertBitacora);
        $stmtInsertBitacora->bind_param("ssdids",$descripcion, $tipoMovimiento, $precio, $cantidadComprada, $subtotal, $fecha_hora);
        $stmtInsertBitacora->execute();

        // Compra realizada exitosamente
        // Mostrar una ventana de alerta de "Agregado exitosamente"
        echo "<script>
                alert('Agregado exitosamente');
                window.location.href = '../../compra.php';
              </script>";
    } else {
        // Error al guardar la compra
        echo "<script>
                alert('Hubo un problema al realizar la compra.');
                window.history.back();
              </script>";
    }

    // Cerrar las conexiones
    $stmtUpdateStock->close();
    $stmtProducto->close();
    $stmtInsertBitacora->close();
    $conexion->close();
} else {
    // Si no se han enviado los datos del formulario, redirigir a otra página o mostrar un mensaje de error
    echo "Error: No se recibieron datos del formulario.";
}
?>
