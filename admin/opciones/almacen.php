<?php
include "../../bd/conexion.php";
// Realizar la consulta a la base de datos
$sql = "SELECT * FROM almacen";
$result = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Técnicos</title>
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
<!--Titulo-->
<div class="container mt-5"><div class="row justify-content-center"><div class="col-md-6"><div class="card bg-primary text-white"><div class="card-body"><h2 class="mb-0 text-center">Almacen</h2></div></div></div></div></div>

    <table id="tablaClientes" class="table table-striped table-bordered table-primary table-light" style="width:100%">
    <thead class="bg-primary text-white">
            <tr>
                <th>Código</th>
                <th>Descripcion</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            <!-- Los datos se cargarán aquí a través de PHP -->
            <?php
            // Mostrar los resultados de la consulta en la tabla
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_producto"] . "</td>";
                    echo "<td>" . $row["descripcion"] . "</td>";
                    echo "<td>" . $row["stock"] . "</td>";

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

   
    </script>
</body>
</html>
