<?php
include "../../bd/conexion.php";

// Realizar la consulta a la base de datos
$sql = "SELECT * FROM tecnico";
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
            <a href="#" id="btnAgregarTecnico" class="btn btn-primary">Agregar Nuevo Técnico</a>
        </div>
        <div class="col-md-4 text-center">
            <img src="img/tecnico.png" class="img-fluid" alt="Imagen central" width=150px>
        </div>
        <div class="col-md-4 text-center">
            <a href="../index.php" class="btn btn-danger">Regresar</a>
        </div>
    </div>
</div>

    <!-- Modal Agregar Nuevo Técnico -->
    <div class="modal fade" id="modalAgregarTecnico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Tecnico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarTecnico" action="consultas/tecnico/nuevo_tecnico.php" method="POST">
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
                            <label for="telefono">Celular</label>
                            <input type="tel"class="form-control" id="celular"  name="celular"  required>
                        </div>
                        <div class="form-group">
                            <label for="direccion">NSS</label>
                            <input type="text"class="form-control" id="nss"  name="nss" required>
                        </div>
                        <div class="form-group">
                            <label for="direccion">CURP</label>
                            <input type="text"class="form-control" id="curp"  name="curp" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" form="formAgregarTecnico">Agregar Tecnico</button>
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
                        <input type="hidden" id="idTecnicoEditar" name="idTecnicoEditar">
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
                            <label for="telefonoEditar">Celular</label>
                            <input type="tel" class="form-control" id="celularEditar" name="celularEditar" required>
                        </div>
                        <div class="form-group">
                            <label for="direccionEditar">NSS</label>
                            <input type="text" class="form-control" id="nssEditar" name="nssEditar" required>
                        </div>
                        <div class="form-group">
                            <label for="direccionEditar">CURP</label>
                            <input type="text" class="form-control" id="curpEditar" name="curpEditar" required>
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
<div class="container mt-5"><div class="row justify-content-center"><div class="col-md-6"><div class="card bg-danger text-white"><div class="card-body"><h2 class="mb-0 text-center">Técnicos Registrados</h2></div></div></div></div></div>

    <table id="tablaClientes" class="table table-striped table-bordered table-primary table-light" style="width:100%">
    <thead class="bg-primary text-white">
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Correo</th>
                <th>Celular</th><!--NSS CURP-->
                <th>NSS</th>
                <th>CURP</th>
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
                    echo "<td>" . $row["celular"] . "</td>";
                    echo "<td>" . $row["nss"] . "</td>";
                    echo "<td>" . $row["curp"] . "</td>";
                    echo "<td>";
                    echo '<a href="#" class="btn btn-warning btn-sm btnEditarTecnico" data-id="' . $row["idTecnico"] . '"><i class="fas fa-edit"></i> Editar</a>';
                    echo '<a href="#" class="btn btn-danger btn-sm btnEliminarTecnico" data-id="' . $row["idTecnico"] . '"><i class="fas fa-trash-alt"></i> Eliminar</a>';
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
        var idTecnico = $(this).data("id");
        // Realizar una solicitud AJAX para obtener los datos del cliente con el ID proporcionado
        $.ajax({
            url: "consultas/tecnico/obtener_tecnico.php",
            method: "POST",
            data: { id: idTecnico },
            dataType: "json",
            success: function(data) {
                // Rellenar los campos del modal con los datos obtenidos
                $("#idTecnicoEditar").val(data.idTecnico);
                $("#nombreEditar").val(data.nombre);
                $("#direccionEditar").val(data.direccion);
                $("#correoEditar").val(data.correo);
                $("#celularEditar").val(data.celular);
                $("#nssEditar").val(data.nss);
                $("#curpEditar").val(data.curp);
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
        var idCliente = $(this).data("id");
        if (confirm("¿Estás seguro de que deseas eliminar este tecnico?")) {
            window.location.href = "consultas/tecnico/eliminar_tecnico.php?id=" + idCliente;
        }
    });


        $(document).ready(function() {
        // Vincula el evento de clic al botón "Guardar Cambios" después de que se haya cargado el DOM
        $("#btnGuardarCambios").click(function() {
            // Obtener los datos del formulario de edición
            var idTecnico = $("#idTecnicoEditar").val();
            var nombre = $("#nombreEditar").val();
            var direccion = $("#direccionEditar").val();
            var correo = $("#correoEditar").val();
            var celular = $("#celularEditar").val();
            var nss = $("#nssEditar").val();
            var curp = $("#curpEditar").val();
            //console.log("ID Tecnico :", idTecnico);
            //console.log("Nombre:", nombre);
            // Realizar una solicitud AJAX para actualizar los datos del cliente
            $.ajax({
                url: "consultas/tecnico/guardar_cambios_tecnico.php",
                method: "POST",
                data: {
                    idTecnico: idTecnico,
                    nombre: nombre,
                    direccion: direccion,
                    correo: correo,
                    celular: celular,
                    nss: nss,
                    curp: curp

                },
                success: function(response) {
                    // Recargar la página para mostrar los cambios actualizados
                    //console.log(response);
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
