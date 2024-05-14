<?php
include "../../bd/conexion.php";

// Realizar la consulta a la base de datos
$sql = "SELECT * FROM bitacora";
$result = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Bitácora</title>
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
            <img src="img/almacen.png" class="img-fluid" alt="Imagen central" width=200px>
        </div>
        <div class="col-md-4 text-center">
            <a href="../index.php" class="btn btn-danger">Regresar</a>
        </div>
    </div>
</div>
    <div class="container mt-5">
    <div class="container mt-5"><div class="row justify-content-center"><div class="col-md-6"><div class="card bg-primary text-white"><div class="card-body"><h3 class="mb-0 text-center">Bitacora de movimientos</h3></div></div></div></div></div>
        <table id="tablaMovimientos" class="table table-striped table-bordered table-primary table-light" style="width:100%">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Descripción</th>
                    <th>Movimiento</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Fecha Hora</th>
                </tr>
            </thead>
            <tbody>
 <!-- Los datos se cargarán aquí a través de PHP -->
 <?php
            // Mostrar los resultados de la consulta en la tabla
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["descripcion"] . "</td>";
                    echo "<td>" . $row["tipo_movimiento"] . "</td>";
                    echo "<td>" . $row["precio"] . "</td>";
                    echo "<td>" . $row["cantidad"] . "</td>";
                    echo "<td>" . $row["subtotal"] . "</td>";
                    echo "<td>" . $row["fecha_hora"] . "</td>";
                    echo "</tr>";
                }
            }
            ?>
            </tbody>
        </table>
        <div class="text-center mt-3">
            <h4>Total Subtotal: <span id="totalSubtotal">0</span></h4>
        </div>
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
            // Inicializar DataTable
            $('#tablaMovimientos').DataTable({
                "language": {
                    "url": "i18n/Spanish.json" // Ruta al archivo Spanish.json
                }
            });

            // Calcular el total del subtotal al cargar la página
            calcularTotalSubtotal();

            // Calcular el total del subtotal cada vez que cambie la tabla
            $('#tablaMovimientos').on('draw.dt', function() {
                calcularTotalSubtotal();
            });

            function calcularTotalSubtotal() {
                var total = 0;
                $('#tablaMovimientos tbody tr').each(function() {
                    total += parseFloat($(this).find('td:nth-child(5)').text());
                });
                $('#totalSubtotal').text(total.toFixed(2));
            }
        });
    </script>
</body>
</html>
