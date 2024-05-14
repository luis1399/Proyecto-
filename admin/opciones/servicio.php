<?php
include "../../bd/conexion.php";

// Realizar la consulta a la base de datos
$sql = "SELECT * FROM servicio";
$result = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Productos</title>
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
            <a href="#" id="btnAgregarTecnico" class="btn btn-primary">Agregar Nuevo Servicio</a>
        </div>
        <div class="col-md-4 text-center">
            <img src="img/servicio.png" class="img-fluid" alt="Imagen central" width=200px>
        </div>
        <div class="col-md-4 text-center">
            <a href="../index.php" class="btn btn-danger">Regresar</a>
        </div>
    </div>
</div>

    <!-- Modal Agregar Nuevo Servicio -->
    <div class="modal fade" id="modalAgregarTecnico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Servicio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarTecnico" action="consultas/servicio/nuevo_servicio.php" method="POST">
                    <div class="form-group">
                <label for="tamano">Tamaño</label>
                    <select class="form-control" id="tamano" name="tamano" required>
                        <option value="">Selecciona un tamaño</option>
                        <option value="Chico">Chico</option>
                        <option value="Mediano">Mediano</option>
                        <option value="Grande">Grande</option>
                        <option value="Industrial">Industrial</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="categoria">Categoría</label>
                    <select class="form-control" id="categoria" name="categoria" required>
                        <option value="">Selecciona una categoría</option>
                        <option value="Preventivo">Preventivo</option>
                        <option value="Correctivo">Correctivo</option>
                    </select>
                </div>

            <div class="form-group">
                <label for="subcategoria">Subcategoría</label>
                    <select class="form-control" id="subcategoria" name="subcategoria" required>
                    <option value="">Selecciona una subcategoría</option>
                    <option value="Básico">Básico</option>
                    <option value="Intermedio">Intermedio</option>
                    <option value="Avanzado">Avanzado</option>
                    </select>
                </div>

                        <div class="form-group">
                            <label for="nombre">Descripcion</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="text" class="form-control" id="precio" name="precio" pattern="\d+(\.\d{1,2})?" title="Debe ser un número decimal con hasta dos decimales" required>                        
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" form="formAgregarTecnico">Agregar Servicio</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Edición -->
    <div class="modal fade" id="modalEditarTecnico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Servicio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditarTecnico">
                        <input type="hidden" id="idServicioEditar" name="idServicioEditar">
                        <div class="form-group">
                        <label for="tamanoEditar">Tamaño</label>
                        <select class="form-control" id="tamanoEditar" name="tamanoEditar" required>
                            <option value="">Selecciona un tamaño</option>
                            <option value="Chico">Chico</option>
                            <option value="Mediano">Mediano</option>
                            <option value="Grande">Grande</option>
                            <option value="Industrial">Industrial</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categoriaEditar">Categoría</label>
                        <select class="form-control" id="categoriaEditar" name="categoriaEditar" required>
                            <option value="">Selecciona una categoría</option>
                            <option value="Preventivo">Preventivo</option>
                            <option value="Correctivo">Correctivo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subcategoriaEditar">Subcategoría</label>
                        <select class="form-control" id="subcategoriaEditar" name="subcategoriaEditar" required>
                            <option value="">Selecciona una subcategoría</option>
                            <option value="Básico">Básico</option>
                            <option value="Intermedio">Intermedio</option>
                            <option value="Avanzado">Avanzado</option>
                        </select>
                    </div>
                        <div class="form-group">
                            <label for="descripcionEditar">Nombre</label>
                            <input type="text" class="form-control" id="descripcionEditar" name="descripcionEditar" required>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="text" class="form-control" id="precioEditar" name="precioEditar" required>
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
<div class="container mt-5"><div class="row justify-content-center"><div class="col-md-6"><div class="card bg-danger text-white"><div class="card-body"><h2 class="mb-0 text-center">Servicios Registrados</h2></div></div></div></div></div>

    <table id="tablaClientes" class="table table-striped table-bordered table-primary table-light" style="width:100%">
    <thead class="bg-primary text-white">
            <tr>
                <th>ID Servicio</th>
                <th>Tamaño</th>
                <th>Categoría</th>
                <th>Sub Categoría</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            <!-- Los datos se cargarán aquí a través de PHP -->
            <?php
            // Mostrar los resultados de la consulta en la tabla
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_servicio"] . "</td>";
                    echo "<td>" . $row["tamanio"] . "</td>";
                    echo "<td>" . $row["categoria"] . "</td>";
                    echo "<td>" . $row["sbcategoria"] . "</td>";
                    echo "<td>" . $row["descripcion"] . "</td>";
                    echo "<td>" . $row["precio"] . "</td>";
                    echo "<td>";
                    echo '<a href="#" class="btn btn-warning btn-sm btnEditarTecnico" data-id="' . $row["id_servicio"] . '"><i class="fas fa-edit"></i> Editar</a>';
                    echo '<a href="#" class="btn btn-danger btn-sm btnEliminarTecnico" data-id="' . $row["id_servicio"] . '"><i class="fas fa-trash-alt"></i> Eliminar</a>';
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
        var idServicio = $(this).data("id");
        // Realizar una solicitud AJAX para obtener los datos del cliente con el ID proporcionado
        $.ajax({
            url: "consultas/servicio/obtener_servicio.php",
            method: "POST",
            data: { id: idServicio },
            dataType: "json",
            success: function(data) {
                // Rellenar los campos del modal con los datos obtenidos
                $("#idServicioEditar").val(data.idServicio);
                $("#tamanoEditar").val(data.tamanio);
                $("#categoriaEditar").val(data.categoria);
                $("#subcategoriaEditar").val(data.sbcategoria);
                $("#descripcionEditar").val(data.descripcion);
                $("#precioEditar").val(data.precio);
                $("#idServicioEditar").val(idServicio);
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
        var idProducto = $(this).data("id");
        if (confirm("¿Estás seguro de que deseas eliminar este servicio?")) {
            window.location.href = "consultas/servicio/eliminar_servicio.php?id=" + idProducto;
        }
    });


        $(document).ready(function() {
        // Vincula el evento de clic al botón "Guardar Cambios" después de que se haya cargado el DOM
        $("#btnGuardarCambios").click(function() {
            // Obtener los datos del formulario de edición
            var idServicio = $("#idServicioEditar").val();
            var tamanio = $("#tamanoEditar").val();
            var categoria = $("#categoriaEditar").val();
            var subcategoria = $("#subcategoriaEditar").val();
            var descripcion = $("#descripcionEditar").val();
            var precio = $("#precioEditar").val();
            // Realizar una solicitud AJAX para actualizar los datos del cliente
            $.ajax({
                url: "consultas/servicio/guardar_cambios_servicio.php",
                method: "POST",
                data: {
                    idServicio: idServicio,
                    tamanio : tamanio,
                    categoria : categoria,
                    subcategoria : subcategoria,
                    descripcion: descripcion,
                    precio: precio
                },
                success: function(response) {
                    // Recargar la página para mostrar los cambios actualizados
                    //alert(response); // Muestra la respuesta del servidor en una alerta para depurar
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
