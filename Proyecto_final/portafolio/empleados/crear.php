<?php
include("../../Templates/header.php");
include("../../Database.php");

if ($_POST) {

     $nombres = (isset($_POST["nombres"]) ? $_POST["nombres"] : "");
     $primerapellido = (isset($_POST["primerapellido"]) ? $_POST["primerapellido"] : "");
     $segundoapellido = (isset($_POST["segundoapellido"]) ? $_POST["segundoapellido"] : "");

     $foto = (isset($_FILES["foto"]['name']) ? $_FILES["foto"]['name'] : "");
     $cv = (isset($_FILES["cv"]['name']) ? $_FILES["cv"]['name'] : "");

     $idpuesto = (isset($_POST["idpuesto"]) ? $_POST["idpuesto"] : "");
     $fechaingreso = (isset($_POST["fechaingreso"]) ? $_POST["fechaingreso"] : "");

     $sentencia = $conexion->prepare("INSERT INTO tbl_empleados(id, nombres, primerapellido, segundoapellido, foto, cv, idpuesto, fechaingreso) VALUES (null, :nombres, :primerapellido, :segundoapellido, :foto, :cv, :idpuesto, :fechaingreso)");

     $sentencia->bindParam(":nombres", $nombres);
     $sentencia->bindParam(":primerapellido", $primerapellido);
     $sentencia->bindParam(":segundoapellido", $segundoapellido);

     $fecha_ = new DateTime();
     $nombre_archivo_foto = ($foto != '') ? $fecha_->getTimestamp() . "_" . $_FILES["foto"]['name'] : "";
     $tmp_foto = $_FILES["foto"]['tmp_name'];
     $ruta_foto = "./Fotos/" . $nombre_archivo_foto;
     if ($tmp_foto != '') {
          move_uploaded_file($tmp_foto, $ruta_foto);
     }
     $sentencia->bindParam(":foto", $nombre_archivo_foto);

     $nombre_archivo_cv = ($cv != '') ? $fecha_->getTimestamp() . "_" . $_FILES["cv"]['name'] : "";
     $tmp_cv = $_FILES["cv"]['tmp_name'];
     $ruta_cv = "./Fotos/" . $nombre_archivo_cv;
     if ($tmp_cv != '') {
          move_uploaded_file($tmp_cv, $ruta_cv);
     }

     $sentencia->bindParam(":cv", $nombre_archivo_cv);
     $sentencia->bindParam(":idpuesto", $idpuesto);
     $sentencia->bindParam(":fechaingreso", $fechaingreso);

     $sentencia->execute();
     $mensaje = "Empleado creado con exito";
     header("Location:index.php?mensaje=" . $mensaje);
}

$sentencia = $conexion->prepare("SELECT * FROM `tbl_puestos`");
$sentencia->execute();
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<br>
<div class="card bg-dark rounded-4 text-light">
     <div class="card-header">
          Agregar datos empleados
     </div>
     <div class="card-body">
          <form action="" method="post" enctype="multipart/form-data">
               <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" name="nombres" id="nombres" aria-describedby="helpId" required placeholder="Nombre completo">
               </div>

               <div class="mb-3">
                    <label for="primerapellido" class="form-label">Primer apellido</label>
                    <input type="text" class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" required placeholder="Primer apellido">
               </div>

               <div class="mb-3">
                    <label for="segundoapellido" class="form-label">Segundo apellido</label>
                    <input type="text" class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" required placeholder="Segundo apellido">
               </div>

               <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" name="foto" id="foto" required placeholder="Foto" aria-describedby="fileHelpId">
               </div>

               <div class="mb-3">
                    <label for="cv" class="form-label">Cv(PDF)</label>
                    <input type="file" class="form-control" name="cv" id="cv" required placeholder="cv" aria-describedby="fileHelpId">
               </div>

               <div class="mb-3">
                    <label for="idpuesto" class="form-label">Puesto:</label>
                    <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
                         <option value="" disabled selected>Seleccione uno</option>
                         <?php foreach ($lista_tbl_puestos as $registros) { ?>
                              <option value="<?php echo $registros["id"] ?>"><?php echo $registros["nombredelpuesto"] ?></option>
                         <?php } ?>

                    </select>
               </div>

               <div class="mb-3">
                    <label for="fechaingreso" class="form-label">Fecha de ingreso</label>
                    <input type="date" class="form-control" name="fechaingreso" id="fechaingreso" aria-describedby="emailHelpId">
               </div>

               <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">Agregar registro</button>&nbsp; &nbsp; &nbsp;
                    <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
               </div>
          </form>
     </div>
     <div class="card-footer text-muted">

     </div>
</div>


<?php include("../../Templates/footer.php"); ?>