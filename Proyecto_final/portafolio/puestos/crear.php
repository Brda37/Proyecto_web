<?php 
include("../../Templates/header.php");
include("../../Database.php");

if ($_POST) {

     $nombredelpuesto = (isset($_POST["nombredelpuesto"]) ? $_POST["nombredelpuesto"] : "");

     $sentencia = $conexion->prepare("INSERT INTO tbl_puestos(id, nombredelpuesto) VALUES (null, :nombredelpuesto)");

     $sentencia->bindParam(":nombredelpuesto", $nombredelpuesto);
     $sentencia->execute();

     $mensaje ="Puesto creado con exito";
     header("Location:index.php?mensaje=".$mensaje);}
?>
<br>

<div class="card">
     <div class="card-header">
          Puestos
     </div>
     <div class="card-body">
          <form action="" method="post" enctype="multipart/form-data">
               <div class="mb-3">
                    <label for="nombredelpuesto" class="form-label">Nombre del puesto:</label>
                    <input type="text" class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del puesto">
               </div>
               <button type="submit" class="btn btn-success">Agregar</button>
               <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
          </form>
     </div>
     <div class="card-footer text-muted"></div>
</div>


<?php include("../../Templates/footer.php"); ?>