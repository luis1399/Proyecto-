<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "Reisaa16082435#", "reisaa");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Inicializar variable para mensaje de error
$error_msg = "";

?>