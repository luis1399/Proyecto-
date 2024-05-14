<?php
// Verificar si el usuario está logueado
session_start();
if (!isset($_SESSION['usuario'])) {
    // Si no está logueado, redirigirlo a la página de inicio de sesión
    header("Location: ../login.php");
    exit;
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sistema Reisaa</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="../img/logo.png">
    <link rel="shortcut icon" type="image/x-icon" href="../img/logo.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
<style>
    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link:hover .text-primary {
    color: #ff0000 !important;
    background-color: #f0f0f0 !important;
}
</style>
</head>

<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="administracion@reisaa.com">administracion@reisaa.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:229-392-4143">229-392-4143</a>
                </div>
                <div>
                    <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin fa-sm fa-fw"></i></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">

       <a class="navbar-brand text-primary fs-4 fw-bold" href="#" style="margin-right: 100px;">Reisaa</a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="opciones/ver_cotizaciones.php">Cotizaciones</a>
                </li>
                <li class="nav-item">
                     <a class="nav-link" href="opciones/servicio.php">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="opciones/cliente.php">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="opciones/tecnico.php">Técnicos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="opciones/proveedor.php">Proveedores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="opciones/producto.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="opciones/compra.php">Compras</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="opciones/salida.php">Ventas/Pérdidas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="opciones/almacen.php">Almacen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="opciones/bitacora.php">Bitacora</a>
                </li>
            </ul>
            <?php if (isset($_SESSION['usuario'])) : ?>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="?logout=true">Salir</a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>

    </div>
</nav>




    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="ImagenInicio.png" alt="logo_empresa" width="500px" height="500px">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text-primary"><b>Reisaa</b> company</h1>
                                <h3 class="h2">Optimizando el Clima Industrial para tu Éxito</h3>
                                <p>
                                    Brindamos soluciones expertas en mantenimiento y reparación de climatización industrial. 
                                    Confiabilidad, eficiencia y calidad en cada servicio.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <p class="text-left text-light">
                        Copyright &copy; 2024 Reisaa 
                    </p>
                </div>
                <div class="col-auto">
                    <ul class="list-inline text-left footer-icons">
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                        </li>              
                    </ul>
                </div>
            </div>
            
        </div>
    </footer>

</body>

</html>