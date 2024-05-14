<?php
include "../../bd/conexion.php";

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Realizar la consulta a la base de datos
$sql = "SELECT cotizacion.folio, cliente.nombre AS cliente_nombre, cotizacion.autorizado_1, cotizacion.autorizado_2, cotizacion.subtotal, cotizacion.iva, cotizacion.total FROM cotizacion INNER JOIN cliente ON cotizacion.idCliente = cliente.idCliente";
$result = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Clientes</title>
    <!-- Estilos Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Estilos DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
</head>
<body>
    <!--Botones e Imagen-->
<div class="container mt-3 mb-3">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-4 text-center">
            <a href="cotizacion.php" id="btnAgregarCliente" class="btn btn-primary">Nueva cotización</a>
        </div>
        <div class="col-md-4 text-center">
            <img src="img/cliente.png" class="img-fluid" alt="Imagen central">
        </div>
        <div class="col-md-4 text-center">
            <a href="../index.php" class="btn btn-danger">Regresar</a>
        </div>
    </div>
</div>


   
<div class="container mt-5">
<!--Titulo-->
<div class="container mt-5"><div class="row justify-content-center"><div class="col-md-6"><div class="card bg-primary text-white"><div class="card-body"><h4 class="mb-0 text-center">Cotizaciones Registradas</h4></div></div></div></div></div>

    <table id="tablaClientes" class="table table-striped table-bordered table-primary table-light" style="width:100%">
    <thead class="bg-primary text-white">
            <tr>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Autorización 1</th>
                <th>Autorización 2</th>
                <th>Subtotal</th>
                <th>IVA</th>
                <th>Total</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <!-- Los datos se cargarán aquí a través de PHP -->
            <?php
            // Mostrar los resultados de la consulta en la tabla
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["folio"] . "</td>";
                    echo "<td>" . $row["cliente_nombre"] . "</td>";
                    echo "<td>" . $row["autorizado_1"] . "</td>";
                    echo "<td>" . $row["autorizado_2"] . "</td>";
                    echo "<td>" . $row["subtotal"] . "</td>";
                    echo "<td>" . $row["iva"] . "</td>";
                    echo "<td>" . $row["total"] . "</td>";
                    echo "<td>";
                    echo '<a href="#" class="btn btn-warning btn-sm btnEditarCliente" data-id="' . $row["folio"] . '"><i class="fas fa-edit"></i> Editar</a>';
                    echo '<a href="#" class="btn btn-danger btn-sm btnEliminarCliente" data-id="' . $row["folio"] . '"><i class="fas fa-trash-alt"></i> Eliminar</a>';
                    echo "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Scripts Bootstrap y DataTables -->
<script src="jquery/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- JavaScript DataTables -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tablaClientes').DataTable({
        "language": {
            "url": "i18n/Spanish.json" // Ruta al archivo Spanish.json
        }
        });
    });

    

    // Eliminar cliente al hacer clic en el botón correspondiente
    $(document).on("click", ".btnEliminarCliente", function() {
        var idCliente = $(this).data("id");
        if (confirm("¿Estás seguro de que deseas eliminar este cliente?")) {
            window.location.href = "consultas/cotizacion/eliminar_cotizacion.php?id=" + idCliente;
        }
    });

    </script>
</body>
</html>
