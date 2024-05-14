<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Servicio</title>
    <!-- Estilos Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4 text-center">Cotizaciones</h1>

        <div class="row">
    <div class="col-sm-12">
        <div class="float-right"> <!-- Alineación a la derecha -->
            <button type="button" class="btn btn-danger mt-4" onclick="regresar()">Regresar</button>
            <button type="button" class="btn btn-primary mt-4 ml-2" data-toggle="modal" data-target="#modalAgregarServicio">Agregar</button>
        </div>
    </div>
</div>

        <div class="row mb-3">
    <div class="col-sm-6">
        <label for="tecnico">Técnico:</label>
        <select class="form-control" id="tecnico" name="tecnico" required>
            <option value="">Selecciona un técnico</option>
            <!-- Opciones de técnico se llenarán dinámicamente desde la base de datos -->
        </select>
    </div>
    <div class="col-sm-6">
        <label for="cliente">Cliente:</label>
        <select class="form-control" id="cliente" name="cliente" required>
            <option value="">Selecciona un cliente</option>
            <!-- Opciones de cliente se llenarán dinámicamente desde la base de datos -->
        </select>
    </div>
</div>



        <h2 class="mt-4">Servicios</h2>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Tamaño</th>
                    <th>Categoría</th>
                    <th>Sub Categoría</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="tbodyServiciosTemporales">
                <!-- Aquí se agregarán los servicios temporales -->
            </tbody>
        </table>

<!-- Botón "Siguiente" -->
<button type="button" class="btn btn-danger" onclick="siguientePagina()">Siguiente</button>
    </div>

    <!-- Modal Agregar Servicio -->
    <div class="modal fade" id="modalAgregarServicio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Servicio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarServicio">
                        <div class="form-group">
                            <label for="tamano">Tamaño:</label>
                            <select class="form-control" id="tamano" name="tamano" required>
                                <option value="">Selecciona un tamaño</option>
                                <!-- Opciones de tamaño se llenarán dinámicamente desde la base de datos -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="categoria">Categoría:</label>
                            <select class="form-control" id="categoria" name="categoria" required disabled>
                                <option value="">Selecciona una categoría</option>
                                <!-- Las opciones de categoría se llenarán dinámicamente después de seleccionar un tamaño -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="subcategoria">Sub Categoría:</label>
                            <select class="form-control" id="subcategoria" name="subcategoria" required disabled>
                                <option value="">Selecciona una subcategoría</option>
                                <!-- Las opciones de subcategoría se llenarán dinámicamente después de seleccionar una categoría -->
                            </select>
                        </div>

                        <div class="form-group">
                              <label for="descripcion">Descripción:</label>
                              <select class="form-control" id="descripcion" name="descripcion" required disabled>
                                    <option value="">Selecciona una descripción</option>
                                    <!-- Las opciones de descripción se llenarán dinámicamente después de seleccionar una subcategoría -->
                              </select>
                        </div>


                        <div class="form-group">
                            <label for="precio">Precio:</label>
                            <input type="text" class="form-control" id="precio" name="precio" readonly>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="agregarServicio()">Agregar Servicio</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts Bootstrap y jQuery -->
      <script src="jquery/jquery-3.7.1.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Llenar el combobox de tamaño desde la base de datos al cargar la página
            $.ajax({
                url: 'consultas/cotizacion/obtener_tamanios.php',
                type: 'GET',
                success: function(response) {
                    var tamanos = JSON.parse(response);
                    var selectTamano = $('#tamano');
                    $.each(tamanos, function(index, tamano) {
                        selectTamano.append('<option value="' + tamano + '">' + tamano + '</option>');
                    });
                }
            });

            // Llenar el combobox de técnico desde la base de datos al cargar la página
$.ajax({
    url: 'consultas/cotizacion/obtener_tecnicos.php',
    type: 'GET',
    success: function(response) {
        var tecnicos = JSON.parse(response);
        var selectTecnico = $('#tecnico');
        $.each(tecnicos, function(index, tecnico) {
            selectTecnico.append('<option value="' + tecnico.idTecnico + '">' + tecnico.nombre + '</option>');
        });
    }
});

// Llenar el combobox de cliente desde la base de datos al cargar la página
$.ajax({
    url: 'consultas/cotizacion/obtener_clientes.php',
    type: 'GET',
    success: function(response) {
        var clientes = JSON.parse(response);
        var selectCliente = $('#cliente');
        $.each(clientes, function(index, cliente) {
            selectCliente.append('<option value="' + cliente.idCliente + '">' + cliente.nombre + '</option>');
        });
    }
});

            // Manejar el cambio en el combobox de tamaño
            $('#tamano').change(function() {
                var tamanoSeleccionado = $(this).val();
                if (tamanoSeleccionado !== '') {
                    // Habilitar el combobox de categoría y llenarlo con las categorías correspondientes
                    $('#categoria').prop('disabled', false).empty().append('<option value="">Cargando...</option>');
                    $.ajax({
                        url: 'consultas/cotizacion/obtener_categorias.php',
                        type: 'GET',
                        data: { tamano: tamanoSeleccionado },
                        success: function(response) {
                            var categorias = JSON.parse(response);
                            var selectCategoria = $('#categoria');
                            selectCategoria.empty().append('<option value="">Selecciona una categoría</option>');
                            $.each(categorias, function(index, categoria) {
                                selectCategoria.append('<option value="' + categoria + '">' + categoria + '</option>');
                            });
                            // Limpiar y deshabilitar el combobox de subcategoría y descripción
                            $('#subcategoria').empty().prop('disabled', true).append('<option value="">Selecciona una subcategoría</option>');
                            $('#descripcion').val('').prop('disabled', true);
                        }
                    });
                } else {
                    // Si no se selecciona ningún tamaño, limpiar y deshabilitar los combobox de categoría, subcategoría y descripción
                    $('#categoria').empty().prop('disabled', true).append('<option value="">Selecciona una categoría</option>');
                    $('#subcategoria').empty().prop('disabled', true).append('<option value="">Selecciona una subcategoría</option>');
                    $('#descripcion').val('').prop('disabled', true);
                }
            });

            // Manejar el cambio en el combobox de categoría
            $('#categoria').change(function() {
                var categoriaSeleccionada = $(this).val();
                if (categoriaSeleccionada !== '') {
                    var tamanoSeleccionado = $('#tamano').val();
                    // Habilitar el combobox de subcategoría y llenarlo con las subcategorías correspondientes
                    $('#subcategoria').prop('disabled', false).empty().append('<option value="">Cargando...</option>');
                    $.ajax({
                        url: 'consultas/cotizacion/obtener_subcategorias.php',
                        type: 'GET',
                        data: { tamano: tamanoSeleccionado, categoria: categoriaSeleccionada },
                        success: function(response) {
                            var subcategorias = JSON.parse(response);
                            var selectSubcategoria = $('#subcategoria');
                            selectSubcategoria.empty().append('<option value="">Selecciona una subcategoría</option>');
                            $.each(subcategorias, function(index, subcategoria) {
                                selectSubcategoria.append('<option value="' + subcategoria + '">' + subcategoria + '</option>');
                            });
                            // Limpiar y deshabilitar el campo de descripción
                            $('#descripcion').val('').prop('disabled', true);
                        }
                    });
                } else {
                    // Si no se selecciona ninguna categoría, limpiar y deshabilitar el combobox de subcategoría y el campo de descripción
                    $('#subcategoria').empty().prop('disabled', true).append('<option value="">Selecciona una subcategoría</option>');
                }
            });

         // Manejar el cambio en el combobox de subcategoría
$('#subcategoria').change(function() {
    var subcategoriaSeleccionada = $(this).val();
    if (subcategoriaSeleccionada !== '') {
        // Obtener el tamaño y la categoría seleccionados
        var tamanoSeleccionado = $('#tamano').val();
        var categoriaSeleccionada = $('#categoria').val();
        
        // Habilitar el combobox de descripción
        $('#descripcion').prop('disabled', false);
        
        // Realizar una solicitud AJAX para obtener las descripciones correspondientes
        $.ajax({
            url: 'consultas/cotizacion/obtener_descripcion.php',
            type: 'GET',
            data: { tamano: tamanoSeleccionado, categoria: categoriaSeleccionada, subcategoria: subcategoriaSeleccionada },
            success: function(response) {
                // Convertir la respuesta en un array JavaScript
                var descripciones = JSON.parse(response);
                
                // Limpiar el combobox de descripción y agregar el placeholder
                $('#descripcion').empty().append('<option value="">Selecciona una descripción</option>');
                
                // Agregar las opciones de descripción al combobox
                $.each(descripciones, function(index, descripcion) {
                    $('#descripcion').append('<option value="' + descripcion + '">' + descripcion + '</option>');
                });
            }
        });
    } else {
        // Si no se selecciona ninguna subcategoría, deshabilitar el combobox de descripción y volver al placeholder
        $('#descripcion').prop('disabled', true).val('').attr('placeholder', 'Selecciona una descripción');
    }
});

            // Manejar el cambio en el combobox de descripción
            $('#descripcion').change(function() {
                var descripcionSeleccionada = $(this).val();
                if (descripcionSeleccionada !== '') {
                    var tamanoSeleccionado = $('#tamano').val();
                    var categoriaSeleccionada = $('#categoria').val();
                    var subcategoriaSeleccionada = $('#subcategoria').val();
                    
                    // Realizar una solicitud AJAX para obtener el precio correspondiente
                    $.ajax({
                        url: 'consultas/cotizacion/obtener_precio.php',
                        type: 'GET',
                        data: { 
                            tamano: tamanoSeleccionado, 
                            categoria: categoriaSeleccionada, 
                            subcategoria: subcategoriaSeleccionada, 
                            descripcion: descripcionSeleccionada 
                        },
                        success: function(response) {
                            // Mostrar el precio en el campo correspondiente
                            $('#precio').val(response);
                        }
                    });
                } else {
                    // Si no se selecciona ninguna descripción, limpiar el campo de precio
                    $('#precio').val('');
                }
            });
        });

        // Función para mostrar el modal de agregar servicio
        function mostrarModal() {
            $('#modalAgregarServicio').modal('show');
        }

        <!-- Modificación en la función agregarServicio() para incluir una columna de "Acción" con un botón de eliminación -->
function agregarServicio() {
    // Obtener los valores seleccionados
    var tamano = $('#tamano').val();
    var categoria = $('#categoria').val();
    var subcategoria = $('#subcategoria').val();
    var descripcion = $('#descripcion').val();
    var precio = $('#precio').val();

    // Agregar una nueva fila a la tabla
    $('#tbodyServiciosTemporales').append(
        '<tr>' +
        '<td>' + tamano + '</td>' +
        '<td>' + categoria + '</td>' +
        '<td>' + subcategoria + '</td>' +
        '<td>' + descripcion + '</td>' +
        '<td><input type="text" class="form-control precio-input" style="width: 100px;" value="' + precio + '"></td>' + // Campo de entrada para el precio con ancho fijo
        '<td><button type="button" class="btn btn-danger btn-eliminar">Eliminar</button></td>' + // Botón de eliminación
        '</tr>'
    );

    // Limpiar el modal después de agregar el servicio
    $('#modalAgregarServicio').modal('hide');
    $('#formAgregarServicio')[0].reset();

    // Escuchar cambios en el campo de precio en la tabla
    $('.precio-input').on('input', function() {
        // Actualizar el valor del precio en consecuencia
        var nuevoPrecio = $(this).val();
        // Si deseas aplicar validaciones o conversiones de formato de número aquí, puedes hacerlo
    });

    // Escuchar clics en el botón de eliminación
    $('.btn-eliminar').on('click', function() {
        $(this).closest('tr').remove(); // Eliminar la fila correspondiente
    });
}

function regresar() {
        window.location.href = 'ver_cotizaciones.php';
    }
    
    function obtenerServicios() {
    var servicios = [];

    // Recorrer cada fila de la tabla de servicios
    $('#tbodyServiciosTemporales tr').each(function() {
        var servicio = {};
        // Obtener los datos de cada columna de la fila
        servicio.tamano = $(this).find('td:eq(0)').text();
        servicio.categoria = $(this).find('td:eq(1)').text();
        servicio.subcategoria = $(this).find('td:eq(2)').text();
        servicio.descripcion = $(this).find('td:eq(3)').text();
        servicio.precio = $(this).find('td:eq(4) input').val(); // Obtener el precio del campo de entrada

        // Agregar el servicio al arreglo
        servicios.push(servicio);
    });

    return servicios;
}




function siguientePagina() {
    // Recopilar datos del técnico, cliente y servicios
    var tecnico = $('#tecnico').val();
    var cliente = $('#cliente').val();
    var servicios = obtenerServicios(); // Función para recopilar los servicios, deberás implementarla
    
    console.log("Técnico:", tecnico);
    console.log("Cliente:", cliente);
    console.log("Servicios:", servicios);

    var url = 'consultas/cotizacion/procesar_cotizacion.php?tecnico=' + tecnico + '&cliente=' + cliente + '&servicios=' + JSON.stringify(servicios);
    console.log("URL generada:", url);

    // Redirigir a la página de procesamiento de cotización con los datos como parámetros de URL
     window.location.href = url;
}

    </script>
</body>
</html>
