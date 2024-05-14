<?php
include "../../bd/conexion.php";

// Realizar la consulta a la base de datos
$sql = "SELECT * FROM cliente";
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
            <a href="#" id="btnAgregarCliente" class="btn btn-primary">Agregar Nuevo Cliente</a>
        </div>
        <div class="col-md-4 text-center">
            <img src="img/cliente.png" class="img-fluid" alt="Imagen central">
        </div>
        <div class="col-md-4 text-center">
            <a href="../index.php" class="btn btn-danger">Regresar</a>
        </div>
    </div>
</div>

    <!-- Modal Agregar Nuevo Cliente -->
    <div class="modal fade" id="modalAgregarCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarCliente" action="consultas/cliente/nuevo_cliente.php" method="POST">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text"class="form-control" id="direccion"  name="direccion" required>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo</label>
                            <input type="email" class="form-control" id="correo"  name="correo" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="tel"class="form-control" id="telefono"  name="telefono"  required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" form="formAgregarCliente">Agregar Cliente</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Edición -->
    <div class="modal fade" id="modalEditarCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarCliente">
                        <input type="hidden" id="idClienteEditar" name="idCliente">
                        <div class="form-group">
                            <label for="nombreEditar">Nombre</label>
                            <input type="text" class="form-control" id="nombreEditar" name="nombreEditar" required>
                        </div>
                        <div class="form-group">
                            <label for="direccionEditar">Dirección</label>
                            <input type="text" class="form-control" id="direccionEditar" name="direccionEditar" required>
                        </div>
                        <div class="form-group">
                            <label for="correoEditar">Correo</label>
                            <input type="email" class="form-control" id="correoEditar" name="correoEditar" required>
                        </div>
                        <div class="form-group">
                            <label for="telefonoEditar">Teléfono</label>
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
<div class="container mt-5"><div class="row justify-content-center"><div class="col-md-6"><div class="card bg-primary text-white"><div class="card-body"><h2 class="mb-0 text-center">Clientes Registrados</h2></div></div></div></div></div>

    <table id="tablaClientes" class="table table-striped table-bordered table-primary table-light" style="width:100%">
    <thead class="bg-primary text-white">
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Correo</th>
                <th>Teléfono</th>
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
                    echo "<td>" . $row["direccion"] . "</td>";
                    echo "<td>" . $row["correo"] . "</td>";
                    echo "<td>" . $row["telefono"] . "</td>";
                    echo "<td>";
                    echo '<a href="#" class="btn btn-warning btn-sm btnEditarCliente" data-id="' . $row["idCliente"] . '"><i class="fas fa-edit"></i> Editar</a>';
                    echo '<a href="#" class="btn btn-danger btn-sm btnEliminarCliente" data-id="' . $row["idCliente"] . '"><i class="fas fa-trash-alt"></i> Eliminar</a>';
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

    $(document).on("click", ".btnEditarCliente", function() {
    var idCliente = $(this).data("id");
    // Realizar una solicitud AJAX para obtener los datos del cliente con el ID proporcionado
    $.ajax({
        url: "consultas/cliente/obtener_cliente.php",
        method: "POST",
        data: { id: idCliente },
        dataType: "json",
        success: function(data) {
            if (data.success) {
                // Rellenar los campos del modal con los datos obtenidos
                $("#idClienteEditar").val(data.data.idCliente);
                $("#nombreEditar").val(data.data.nombre);
                $("#direccionEditar").val(data.data.direccion);
                $("#correoEditar").val(data.data.correo);
                $("#telefonoEditar").val(data.data.telefono);
                // Mostrar el modal de edición
                $("#modalEditarCliente").modal("show");
            } else {
                // Mostrar un mensaje al usuario si no se encontraron datos del cliente
                alert("No se encontraron datos del cliente.");
            }
        },
        error: function(xhr, status, error) {
    // Manejar errores si es necesario
    console.error(xhr.responseText);
    var errorMessage = "Error al obtener datos del cliente. Por favor, inténtelo de nuevo más tarde";
    if (xhr.responseJSON && xhr.responseJSON.error) {
        errorMessage += "\nError: " + xhr.responseJSON.error;
        if (xhr.responseJSON.query) {
            errorMessage += "\nConsulta: " + xhr.responseJSON.query;
        }
    }
    alert(errorMessage);
}
    });
});


    // Mostrar modal de agregar cliente al hacer clic en el botón correspondiente
    $("#btnAgregarCliente").click(function() {
        $("#modalAgregarCliente").modal("show");
    });

    // Eliminar cliente al hacer clic en el botón correspondiente
    $(document).on("click", ".btnEliminarCliente", function() {
        var idCliente = $(this).data("id");
        if (confirm("¿Estás seguro de que deseas eliminar este cliente?")) {
            window.location.href = "consultas/cliente/eliminar_cliente.php?id=" + idCliente;
        }
    });


        $(document).ready(function() {
        // Vincula el evento de clic al botón "Guardar Cambios" después de que se haya cargado el DOM
        $("#btnGuardarCambios").click(function() {
            // Obtener los datos del formulario de edición
            var idCliente = $("#idClienteEditar").val();
            var nombre = $("#nombreEditar").val();
            var direccion = $("#direccionEditar").val();
            var correo = $("#correoEditar").val();
            var telefono = $("#telefonoEditar").val();
            // Realizar una solicitud AJAX para actualizar los datos del cliente
            $.ajax({
                url: "consultas/cliente/guardar_cambios_cliente.php",
                method: "POST",
                data: {
                    idCliente: idCliente,
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
