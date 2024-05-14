<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Compra</title>
    <!-- Estilos Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Estilos Personalizados -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container form-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Formulario de Compra
                    </div>
                    <div class="card-body">
                    <form id="formularioCompra" action="consultas/almacen/guardar_compra.php" method="POST">
                            <div class="form-group">
                                <label for="codigoProducto">Código del Producto</label>
                                <input type="text" class="form-control" id="codigoProducto" name="codigoProducto" required>
                            </div>
                            <div class="form-group">
                                <label for="descripcionProducto">Descripción del Producto</label>
                                <input type="text" class="form-control" id="descripcionProducto" name="descripcionProducto" readonly>
                            </div>
                            <div class="form-group">
                                <label for="cantidad">Cantidad Comprada</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                            </div>
                            <a href="../" class="btn btn-secondary ml-2 bg-danger">Volver</a>
                            <button type="submit" class="btn btn-primary">Guardar Compra</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Al escribir en el campo de código del producto
            $('#codigoProducto').keyup(function() {
                // Obtener el código del producto ingresado por el usuario
                var codigoProducto = $(this).val();

                // Realizar la solicitud AJAX para obtener la descripción del producto
                $.ajax({
                    url: 'consultas/almacen/obtener_descripcion_producto.php', // Ruta del archivo PHP que maneja la consulta
                    method: 'POST',
                    data: { codigoProducto: codigoProducto },
                    success: function(response) {
                        // Mostrar la descripción del producto
                        $('#descripcionProducto').val(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>
