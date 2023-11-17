<?php
$url_base = "http://localhost/Proyecto_final/";
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location:" . $url_base . "login.php");
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Proyecto final</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<style>
    body {
        background-image: url('../../Templates/BackGroundTemplates.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-color: #212529;
    }

    .btn:hover {
        transition: 0.8s;
    }

    option {
        color: black;
    }
</style>

<body>
    <header>
    </header>
    <nav class="navbar navbar-expand navbar-dark bg-dark text-light p-3 ">
        <ul class="nav navbar-nav ms-2 border-light">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base ?>" aria-current="page">Sistema<span class="visually-hidden">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base ?>portafolio/empleados/index.php">Empleados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base ?>portafolio/puestos/index.php">Puestos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base ?>portafolio/usuarios/index.php">Usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base ?>cerrar.php">Cerrar sesión</a>
            </li>
        </ul>
    </nav>
    <main class="container">
        <br>
        <br>
        <br>
        <?php if (isset($_GET['mensaje'])) {
        ?>
            <script>
                Swal.fire({
                    icon: "success",
                    title: "<?php echo $_GET['mensaje']; ?>"
                });
            </script>
        <?php } ?>