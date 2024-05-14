<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Cliente</title>
</head>
<body>
    <h2>Formulario de Cliente</h2>
    <form id="clienteForm" action="obtener_cliente.php" method="POST">
        <label for="idCliente">ID del Cliente:</label>
        <input type="text" id="idCliente" name="id" required>
        <button type="submit">Obtener Cliente</button>
    </form>

    <h2>Respuesta del Servidor:</h2>
    <div id="respuestaCliente"></div>

    <script>
        document.getElementById('clienteForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar que el formulario se envíe por defecto
            
            // Obtener el formulario y el ID del cliente
            var form = event.target;
            var idCliente = form.elements['id'].value;

            // Enviar la solicitud AJAX a obtener_cliente.php
            var xhr = new XMLHttpRequest();
            xhr.open(form.method, form.action, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    // Manejar la respuesta del servidor
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            document.getElementById('respuestaCliente').innerHTML = JSON.stringify(response.data, null, 2);
                        } else {
                            document.getElementById('respuestaCliente').innerHTML = "Error: " + response.error;
                        }
                    } else {
                        document.getElementById('respuestaCliente').innerHTML = "Error en la solicitud. Código de estado: " + xhr.status;
                    }
                }
            };
            xhr.send('id=' + encodeURIComponent(idCliente));
        });
    </script>
</body>
</html>
