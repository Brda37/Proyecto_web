<?php
session_start();
if ($_POST) {
     include("Database.php");
     $sentencia = $conexion->prepare("SELECT *,count(*) as n_usuarios FROM `tbl_usuarios` WHERE usuario=:usuario AND password=:password");

     $usuario = $_POST["usuario"];
     $password = $_POST["password"];

     $sentencia->bindParam(":usuario", $usuario);
     $sentencia->bindParam(":password", $password);
     $sentencia->execute();

     $registro = $sentencia->fetch(PDO::FETCH_LAZY);
     if ($registro["n_usuarios" ]> 0) {
          $_SESSION['usuario'] = $registro["usuario"];
          $_SESSION['logueado'] = true;

          header("Location:index.php");
     } else {
          $mensaje = "Error usuario o contraseña son incorrectos";
     }
}
?>
<!doctype html>
<html lang="en">

<head>
     <title>Login</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
     <header>
     </header>
     <br><br>
     <main class="container">

          <div class="row">
               <div class="col-md-4">
               </div>
               <div class="col-md-4">
                    <div class="card">
                         <div class="card-header">
                              Login
                         </div>
                         <div class="card-body">

                              <?php if (isset($mensaje)) { ?>
                                   <div class="alert alert-danger" role="alert">
                                        <strong><?php echo $mensaje; ?></strong> Vuelve a intentarlo
                                   </div>
                              <?php } ?>
                              <form action="" method="post">
                                   <div class="mb-3">
                                        <label for="usuario" class="form-label">Usuario:</label>
                                        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario">
                                   </div>
                                   <div class="mb-3">
                                        <label for="password" class="form-label">Contraseña:</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                                   </div>
                                   <button type="submit" class="btn btn-primary">Entrar al sistema</button>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </main>
     <footer>
     </footer>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
     </script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
     </script>
</body>

</html>