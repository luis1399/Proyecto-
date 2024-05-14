<?php
include "../../../../bd/conexion.php";
// Función para calcular el subtotal de los servicios
function calcularSubtotal($servicios) {
    $subtotal = 0;
    
    // Iterar sobre cada servicio para sumar sus precios al subtotal
    foreach ($servicios as $servicio) {
        $subtotal += $servicio['precio'];
    }
    
    return $subtotal;
}

// Recibir los datos del técnico, cliente y servicios
$tecnico = $_GET['tecnico'];
$cliente = $_GET['cliente'];

// Consulta para obtener el nombre del técnico
$queryTecnico = "SELECT nombre FROM tecnico WHERE idTecnico = $tecnico";
$resultadoTecnico = $conexion->query($queryTecnico);
$nombreTecnico = ($resultadoTecnico->num_rows > 0) ? $resultadoTecnico->fetch_assoc()['nombre'] : 'Técnico desconocido';

// Consulta para obtener el nombre del cliente
$queryCliente = "SELECT nombre FROM cliente WHERE idCliente = $cliente";
$resultadoCliente = $conexion->query($queryCliente);
$nombreCliente = ($resultadoCliente->num_rows > 0) ? $resultadoCliente->fetch_assoc()['nombre'] : 'Cliente desconocido';

$servicios = json_decode($_GET['servicios'], true);

// Calcular el subtotal
$subtotal = calcularSubtotal($servicios);

// Calcular el IVA (16% del subtotal)
$iva = $subtotal * 0.16;

// Calcular el total (subtotal más IVA)
$total = $subtotal + $iva;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización</title>
    <!-- Estilos Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <!-- Scripts Bootstrap y jQuery -->
    <script src="../../jquery/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Encabezado -->
    <div class="header bg-danger text-white py-4">
        <h1 class="text-center mb-0">Cotización</h1>
    </div>

    <div class="container mt-4">
        <!-- Mensaje de advertencia -->
        <div class="alert alert-warning" role="alert">
            <strong>¡Atención!</strong> Por favor, revisa cuidadosamente los datos antes de continuar.
        </div>

        <!-- Datos del técnico y cliente -->
        <div class="row">
            <div class="col-sm-6">
                <h3>Técnico:</h3>
                <p><?php echo $nombreTecnico; ?></p>
            </div>
            <div class="col-sm-6">
                <h3>Cliente:</h3>
                <p><?php echo $nombreCliente; ?></p>
            </div>
        </div>

        <!-- Tabla de servicios -->
        <h3 class="mt-4">Servicios</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Tamaño</th>
                    <th>Categoría</th>
                    <th>Sub Categoría</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($servicios as $servicio): ?>
                    <tr>
                        <td><?php echo $servicio['tamano']; ?></td>
                        <td><?php echo $servicio['categoria']; ?></td>
                        <td><?php echo $servicio['subcategoria']; ?></td>
                        <td><?php echo $servicio['descripcion']; ?></td>
                        <td><?php echo $servicio['precio']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Subtotal, IVA y Total -->
        <h3 class="mt-4">Resumen</h3>
        <div class="row">
            <div class="col-sm-4">
                <p><strong>Subtotal:</strong> <?php echo $subtotal; ?></p>
            </div>
            <div class="col-sm-4">
                <p><strong>IVA:</strong> <?php echo $iva; ?></p>
            </div>
            <div class="col-sm-4">
                <p><strong>Total:</strong> <?php echo $total; ?></p>
            </div>
        </div>

        <!-- Botones para confirmar cotización y regresar -->
        <div class="row mt-4">
            <div class="col-sm-6">
                <button type="button" class="btn btn-danger btn-block" onclick="window.history.back()">Regresar</button>
            </div>
            <div class="col-sm-6">
            <button type="button" class="btn btn-primary btn-block" onclick="confirmarCotizacion()">Confirmar Cotización</button>
            </div>
        </div>
    </div>

    <script>
        function confirmarCotizacion() {
    // Mostrar ventana modal de SweetAlert2 con botón de cancelar
    Swal.fire({
        title: 'Procesando Información',
        html: 'Guardando en la base de datos <br> <img src="../../img/email.gif" style="width: 50px;">', // Reemplaza "tu_archivo.gif" con la ruta de tu propio archivo GIF
        icon: 'info',
        showConfirmButton: false,
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        cancelButtonColor: '#ff0000', // Cambiar el color del botón de cancelar a rojo
        allowOutsideClick: false
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.cancel) {
            // Si el usuario hace clic en Cancelar, detener el temporizador y no redireccionar
            clearTimeout(temporizador);
        }
    });

    // Temporizador para redireccionar después de 3 segundos (3000 milisegundos)
    var temporizador = setTimeout(() => {
        // Obtener los datos necesarios para la cotización
        var tecnico = <?php echo $tecnico; ?>;
        var cliente = <?php echo $cliente; ?>;
        var subtotal = <?php echo $subtotal; ?>;
        var iva = <?php echo $iva; ?>;
        var total = <?php echo $total; ?>;
        var servicios = <?php echo $_GET['servicios']; ?>;

        // Crear la petición AJAX para insertar los datos de la cotización en la tabla cotizacion
        $.ajax({
            url: 'guardar_cotizacion.php', // Ruta al script PHP que manejará la inserción en la tabla cotizacion
            type: 'POST',
            data: {
                idCliente: cliente,
                subtotal: subtotal,
                iva: iva,
                total: total
            },
            success: function(response) {
                // La cotización se guardó correctamente en la tabla cotizacion

                // Ahora, insertar los datos de los servicios en la tabla servicios_cotizacion
                $.ajax({
                    url: 'guardar_servicios_cotizacion.php', // Ruta al script PHP que manejará la inserción en la tabla servicios_cotizacion
                    type: 'POST',
                    data: {
                        servicios: servicios
                    },
                    success: function(response) {
                        // Los servicios se guardaron correctamente en la tabla servicios_cotizacion

                        // Mostrar un mensaje de éxito y redirigir
                        Swal.fire({
                            title: '¡Cotización enviada con éxito!',
                            text: 'Se ha enviado la cotización al cliente.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Redirigir al index.php
                            window.location.href = '../../ver_cotizaciones.php';
                        });
                    }
                });
            }
        });
    }, 3000);
}


        
    </script>
</body>
</html>
