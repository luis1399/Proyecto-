<?php
include "../../../../bd/conexion.php";

// Consulta para obtener el último folio registrado en la base de datos
$queryUltimoFolio = "SELECT folio FROM cotizacion ORDER BY folio DESC LIMIT 1";
$resultadoUltimoFolio = $conexion->query($queryUltimoFolio);

// Verificar si hay resultados
if ($resultadoUltimoFolio->num_rows > 0) {
    // Obtener el último folio y extraer el número
    $ultimoFolio = $resultadoUltimoFolio->fetch_assoc()['folio'];
    $ultimoNumero = (int)substr($ultimoFolio, 1); // Extraer el número del folio (sin el prefijo "C")
    
    // Incrementar el número del folio
    $nuevoNumero = $ultimoNumero + 1;
} else {
    // Si no hay folios registrados, iniciar con el número 1
    $nuevoNumero = 1;
}

// Construir el nuevo folio con el prefijo "C" y el número autoincrementable
$nuevoFolio = "C" . $nuevoNumero;

// Obtener los datos enviados por AJAX
$idCliente = $_POST['idCliente'];
$subtotal = $_POST['subtotal'];
$iva = $_POST['iva'];
$total = $_POST['total'];

// Insertar datos en la tabla cotizacion
$sql = "INSERT INTO cotizacion (folio, idCliente, subtotal, iva, total) VALUES (?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("siiii", $nuevoFolio, $idCliente, $subtotal, $iva, $total);

$stmt->execute();

$stmt->close();
$conexion->close();
?>
