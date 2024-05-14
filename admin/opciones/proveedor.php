<?php
include "../../bd/conexion.php";

// Realizar la consulta a la base de datos
$sql = "SELECT * FROM proveedor";
$result = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Proveedores</title>
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
            <a href="#" id="btnAgregarTecnico" class="btn btn-primary">Agregar Nuevo Proveedor</a>
        </div>
        <div class="col-md-4 text-center">
            <img src="img/proveedor.png" class="img-fluid" alt="Imagen central" width=200px>
        </div>
        <div class="col-md-4 text-center">
            <a href="../index.php" class="btn btn-danger">Regresar</a>
        </div>
    </div>
</div>

    <!-- Modal Agregar Nuevo Proveedor -->
    <div class="modal fade" id="modalAgregarTecnico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarTecnico" action="consultas/proveedor/nuevo_proveedor.php" method="POST">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="direccion">RFC</label>
                            <input type="text"class="form-control" id="rfc"  name="rfc" required>
                        </div>
                        <div class="form-group">
                            <label for="correo">Direccion</label>
                            <input type="text" class="form-control" id="direccion"  name="direccion" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Correo</label>
                            <input type="email"class="form-control" id="correo"  name="correo"  required>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Telefono</label>
                            <input type="tel"class="form-control" id="telefono"  name="telefono" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" form="formAgregarTecnico">Agregar Proveedor</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Edición -->
    <div class="modal fade" id="modalEditarTecnico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Técnico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarTecnico">
                        <input type="hidden" id="idProveedorEditar" name="idProveedorEditar">
                        <div class="form-group">
                            <label for="nombreEditar">Nombre</label>
                            <input type="text" class="form-control" id="nombreEditar" name="nombreEditar" required>
                        </div>
                        <div class="form-group">
                            <label for="rfcEditar">RFC</label>
                            <input type="text" class="form-control" id="rfcEditar" name="rfcEditar" required>
                        </div>
                        <div class="form-group">
                            <label for="direccionEditar">Direccion</label>
                            <input type="text" class="form-control" id="direccionEditar" name="direccionEditar" required>
                        </div>
                        <div class="form-group">
                            <label for="correoEditar">Correo</label>
                            <input type="email" class="form-control" id="correoEditar" name="correoEditar" required>
                        </div>
                        <div class="form-group">
                            <label for="telefonoEditar">Telefono</label>
                            <input type="tel" class="form-control" id="telefonoEditar" name="telefonoEditar" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarCambios">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
<div class="container mt-5">
<!--Titulo-->
<div class="container mt-5"><div class="row justify-content-center"><div class="col-md-6"><div class="card bg-primary text-white"><div class="card-body"><h2 class="mb-0 text-center">Proveedores Registrados</h2></div></div></div></div></div>

    <table id="tablaClientes" class="table table-striped table-bordered table-primary table-light" style="width:100%">
    <thead class="bg-primary text-white">
            <tr>
                <th>Nombre</th>
                <th>RFC</th>
                <th>Direccion</th>
                <th>Correo</th><!--NSS CURP-->
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Los datos se cargarán aquí a través de PHP -->
            <?php
            // Mostrar los resultados de la consulta en la tabla
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td>" . $row["rfc"] . "</td>";
                    echo "<td>" . $row["direccion"] . "</td>";
                    echo "<td>" . $row["correo"] . "</td>";
                    echo "<td>" . $row["telefono"] . "</td>";
                    echo "<td>";
                    echo '<a href="#" class="btn btn-warning btn-sm btnEditarTecnico" data-id="' . $row["idProveedor"] . '"><i class="fas fa-edit"></i> Editar</a>';
                    echo '<a href="#" class="btn btn-danger btn-sm btnEliminarTecnico" data-id="' . $row["idProveedor"] . '"><i class="fas fa-trash-alt"></i> Eliminar</a>';
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

    // Abrir modal de edición al hacer clic en el botón editar
    $(document).on("click", ".btnEditarTecnico", function() {
        var idProveedor = $(this).data("id");
        // Realizar una solicitud AJAX para obtener los datos del cliente con el ID proporcionado
        $.ajax({
            url: "consultas/proveedor/obtener_proveedor.php",
            method: "POST",
            data: { id: idProveedor },
            dataType: "json",
            success: function(data) {
                // Rellenar los campos del modal con los datos obtenidos
                $("#idProveedorEditar").val(data.idProveedor);
                $("#nombreEditar").val(data.nombre);
                $("#rfcEditar").val(data.rfc);
                $("#direccionEditar").val(data.direccion);
                $("#correoEditar").val(data.correo);
                $("#telefonoEditar").val(data.telefono);
                // Mostrar el modal de edición
                $("#modalEditarTecnico").modal("show");
            },
            error: function(xhr, status, error) {
                // Manejar errores si es necesario
                console.error(xhr.responseText);
            }
        });
    });

    // Mostrar modal de agregar cliente al hacer clic en el botón correspondiente
    $("#btnAgregarTecnico").click(function() {
        $("#modalAgregarTecnico").modal("show");
    });

    // Eliminar cliente al hacer clic en el botón correspondiente
    $(document).on("click", ".btnEliminarTecnico", function() {
        var idProveedor = $(this).data("id");
        if (confirm("¿Estás seguro de que deseas eliminar este proveedor?")) {
            window.location.href = "consultas/proveedor/eliminar_proveedor.php?id=" + idProveedor;
        }
    });


        $(document).ready(function() {
        // Vincula el evento de clic al botón "Guardar Cambios" después de que se haya cargado el DOM
        $("#btnGuardarCambios").click(function() {
            // Obtener los datos del formulario de edición
            var idProveedor = $("#idProveedorEditar").val();
            var rfc = $("#rfcEditar").val();
            var nombre = $("#nombreEditar").val();
            var direccion = $("#direccionEditar").val();
            var correo = $("#correoEditar").val();
            var telefono = $("#telefonoEditar").val();
            // Realizar una solicitud AJAX para actualizar los datos del cliente
            $.ajax({
                url: "consultas/proveedor/guardar_cambios_proveedor.php",
                method: "POST",
                data: {
                    idProveedor: idProveedor,
                    rfc : rfc,
                    nombre: nombre,
                    direccion: direccion,
                    correo: correo,
                    telefono: telefono
                },
                success: function(response) {
                    // Recargar la página para mostrar los cambios actualizados
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Manejar errores si es necesario
                    console.error(xhr.responseText);
                }
            });
        });
    });
    </script>
</body>
</html>
