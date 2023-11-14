<?php
include("../../Templates/header.php");
include("../../Database.php");

if (isset($_GET['txtID'])) {

     $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

     $sentencia = $conexion->prepare('SELECT * FROM tbl_empleados WHERE id=:id');
     $sentencia->bindParam(':id', $txtID);
     $sentencia->execute();
     $registro = $sentencia->fetch(PDO::FETCH_LAZY);
     $nombres = $registro["nombres"];
     $primerapellido = $registro["primerapellido"];
     $segundoapellido = $registro["segundoapellido"];

     $foto = $registro["foto"];
     $cv = $registro["cv"];

     $idpuesto = $registro["idpuesto"];
     $fechaingreso = $registro["fechaingreso"];
}

if ($_POST) {
     $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
     $nombres = (isset($_POST["nombres"]) ? $_POST["nombres"] : "");
     $primerapellido = (isset($_POST["primerapellido"]) ? $_POST["primerapellido"] : "");
     $segundoapellido = (isset($_POST["segundoapellido"]) ? $_POST["segundoapellido"] : "");
     $idpuesto = (isset($_POST["idpuesto"]) ? $_POST["idpuesto"] : "");
     $fechaingreso = (isset($_POST["fechaingreso"]) ? $_POST["fechaingreso"] : "");

     $sentencia = $conexion->prepare("UPDATE tbl_empleados SET nombres=:nombres, primerapellido=:primerapellido, segundoapellido=:segundoapellido, idpuesto=:idpuesto, fechaingreso=:fechaingreso WHERE id=:id");

     $sentencia->bindParam(":id", $txtID);
     $sentencia->bindParam(":nombres", $nombres);
     $sentencia->bindParam(":primerapellido", $primerapellido);
     $sentencia->bindParam(":segundoapellido", $segundoapellido);
     $sentencia->bindParam(":idpuesto", $idpuesto);
     $sentencia->bindParam(":fechaingreso", $fechaingreso);

     $foto = (isset($_FILES["foto"]['name']) ? $_FILES["foto"]['name'] : "");

     $fecha_ = new DateTime();

     $nombre_archivo_foto = ($foto != '') ? $fecha_->getTimestamp() . "_" . $_FILES["foto"]['name'] : "";
     $tmp_foto = $_FILES["foto"]['tmp_name'];
     $ruta_foto = "./Fotos/" . $nombre_archivo_foto;
     if ($tmp_foto != '') {
          move_uploaded_file($tmp_foto, $ruta_foto);

          $sentencia = $conexion->prepare("SELECT foto FROM `tbl_empleados` WHERE id=:id");
          $sentencia->bindParam(':id', $txtID);
          $sentencia->execute();
          $mensaje = "Editado con exito";
          header("Location:index.php?mensaje=" . $mensaje);
          $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);

          if (isset($registro_recuperado["foto"]) && $registro_recuperado["foto"] != "") {
               if (file_exists("./Fotos/" . $registro_recuperado["foto"])) {
                    unlink("./Fotos/" . $registro_recuperado["foto"]);
               }
          }
          $sentencia = $conexion->prepare("UPDATE tbl_empleados SET foto=:foto WHERE id=:id");
          $sentencia->bindParam(":foto", $nombre_archivo_foto);
          $sentencia->bindParam(":id", $txtID);
          $sentencia->execute();

          $mensaje = "Editado con exito";
          header("Location:index.php?mensaje=" . $mensaje);
     }

     $cv = (isset($_FILES["cv"]['name']) ? $_FILES["cv"]['name'] : "");

     $nombre_archivo_cv = ($cv != '') ? $fecha_->getTimestamp() . "_" . $_FILES["cv"]['name'] : "";
     $tmp_cv = $_FILES["cv"]['tmp_name'];
     $ruta_cv = "./Fotos/" . $nombre_archivo_cv;
     if ($tmp_cv != '') {
          move_uploaded_file($tmp_cv, $ruta_cv);

          $sentencia = $conexion->prepare("SELECT cv FROM `tbl_empleados` WHERE id=:id");
          $sentencia->bindParam(':id', $txtID);
          $sentencia->execute();
          $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);

          if (isset($registro_recuperado["cv"]) && $registro_recuperado["cv"] != "") {
               if (file_exists("./Fotos/" . $registro_recuperado["cv"])) {
                    unlink("./Fotos/" . $registro_recuperado["cv"]);
               }
          }

          $sentencia = $conexion->prepare("UPDATE tbl_empleados SET cv=:cv WHERE id=:id");
          $sentencia->bindParam(":cv", $nombre_archivo_cv);
          $sentencia->bindParam(":id", $txtID);
          $sentencia->execute();
     }


     $sentencia->execute();
     $mensaje = "Editado con exito";
     header("Location:index.php?mensaje=" . $mensaje);
}

$sentencia = $conexion->prepare("SELECT * FROM `tbl_puestos`");
$sentencia->execute();
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="card">
     <div class="card-header">
          Agregar datos empleados
     </div>
     <div class="card-body">
          <form action="" method="post" enctype="multipart/form-data">

               <div class="mb-3">
                    <label for="txtID" class="form-label">ID:</label>
                    <input type="text" readonly class="form-control" name="txtID" id="txtID" aria-describedby="helpId" value="<?php echo $txtID ?>">
               </div>

               <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" value="<?php echo $nombres ?>" class="form-control" name="nombres" id="nombres" aria-describedby="helpId" placeholder="Nombre completo">
               </div>

               <div class="mb-3">
                    <label for="primerapellido" class="form-label">Primer apellido</label>
                    <input type="text" value="<?php echo $primerapellido ?>" class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Primer apellido">
               </div>

               <div class="mb-3">
                    <label for="segundoapellido" class="form-label">Segundo apellido</label>
                    <input type="text" value="<?php echo $segundoapellido ?>" class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo apellido">
               </div>

               <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <br>
                    <img src="./Fotos/<?php echo $foto ?>" width="100px" height="100px" class="rounded">
                    <br>
                    <br>
                    <input type="file" class="form-control" name="foto" id="foto" placeholder="Foto" aria-describedby="fileHelpId">
               </div>

               <div class="mb-3">
                    <label for="cv" class="form-label">Cv(PDF)</label><a href="<?php echo $cv ?>"><?php echo $cv ?></a>
                    <input type="file" class="form-control" name="cv" id="cv" placeholder="cv" aria-describedby="fileHelpId">
               </div>

               <div class="mb-3">
                    <label for="idpuesto" class="form-label">Puesto:</label>
                    <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
                         <?php foreach ($lista_tbl_puestos as $registros) { ?>

                              <option <?php echo ($idpuesto == $registros['id']) ? "selected" : ""; ?> value="<?php echo $registros["id"] ?>"><?php echo $registros["nombredelpuesto"] ?></option>
                         <?php } ?>

                    </select>
               </div>

               <div class="mb-3">
                    <label for="fechaingreso" class="form-label">Fecha de ingreso</label>
                    <input type="date" value="<?php echo $fechaingreso ?>" class="form-control" name="fechaingreso" id="fechaingreso" aria-describedby="emailHelpId">
               </div>

               <button type="submit" class="btn btn-success">Editar Empleado</button>
               <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
          </form>
     </div>
     <div class="card-footer text-muted">

     </div>
</div>


<?php include("../../Templates/footer.php"); ?>