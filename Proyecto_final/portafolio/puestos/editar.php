<?php
include("../../Templates/header.php");
include("../../Database.php");

if (isset($_GET['txtID'])) {

     $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

     $sentencia = $conexion->prepare('SELECT * FROM tbl_puestos WHERE id=:id');
     $sentencia->bindParam(':id', $txtID);
     $sentencia->execute();
     $registro = $sentencia->fetch(PDO::FETCH_LAZY);
     $nombredelpuesto = $registro["nombredelpuesto"];
}

if ($_POST) {

     $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
     $nombredelpuesto = (isset($_POST["nombredelpuesto"]) ? $_POST["nombredelpuesto"] : "");
     $sentencia = $conexion->prepare("UPDATE tbl_puestos SET nombredelpuesto = :nombredelpuesto WHERE id=:id");
     $sentencia->bindParam(":nombredelpuesto", $nombredelpuesto);
     $sentencia->bindParam(":id", $txtID);
     $sentencia->execute();
     $mensaje ="Editado con exito";
     header("Location:index.php?mensaje=".$mensaje);
}
?>

<br>

<div class="card">
     <div class="card-header">
          Puestos
     </div>
     <div class="card-body">
          <form action="" method="post" enctype="multipart/form-data">

               <div class="mb-3">
                    <label for="txtID" class="form-label">ID:</label>
                    <input type="text" readonly class="form-control" name="txtID" id="txtID" aria-describedby="helpId" value="<?php echo $txtID?>">
               </div>

               <div class="mb-3">
                    <label for="nombredelpuesto" class="form-label">Nombre del puesto:</label>
                    <input type="text" class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" value="<?php echo $nombredelpuesto?>">
               </div>
               <button type="submit" class="btn btn-success">Editar</button>
               <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
          </form>
     </div>
     <div class="card-footer text-muted"></div>
</div>


<?php include("../../Templates/footer.php"); ?>