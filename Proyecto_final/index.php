<?php include("Templates/header.php");?>
<br>

<div class="p-5 mb-4 bg-light rounded-3">
  <div class="container-fluid py-5">
    <h1 class="display-5 fw-bold">Bienvenido al sistema de control de empleados: <?php echo $_SESSION['usuario'] ?> </h1>
    <p class="col-md-8 fs-4">Encontraras la opción de organizar a tus empleados por puestos de trabajos, creando el puesto de trabajos y el empleado con su respectiva foto, adicionalmente te damos la opción de generar una carta de recomendación.</p>
    <a name="" id="" class="btn btn-primary" href="portafolio/puestos/crear.php" role="button">Crea el primer puesto de trabajos</a>
  </div>
</div>
<?php include("templates/footer.php");?>
