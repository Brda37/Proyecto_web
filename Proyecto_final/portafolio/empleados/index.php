<?php
include("../../Templates/header.php");
include("../../Database.php");

if (isset($_GET['txtID'])) {

     $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

     $sentencia = $conexion->prepare("SELECT foto, cv FROM `tbl_empleados` WHERE id=:id");
     $sentencia->bindParam(':id', $txtID);
     $sentencia->execute();
     $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);

     if(isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!=""){
         if(file_exists("./Fotos/".$registro_recuperado["foto"])){
          unlink("./Fotos/".$registro_recuperado["foto"]);
         } 
     }

     if(isset($registro_recuperado["cv"]) && $registro_recuperado["cv"]!=""){
          if(file_exists("./Fotos/".$registro_recuperado["cv"])){
           unlink("./Fotos/".$registro_recuperado["cv"]);
          } 
      }
     $sentencia = $conexion->prepare('DELETE FROM tbl_empleados WHERE id=:id');
     $sentencia->bindParam(':id', $txtID);


     $sentencia->execute();
     header("Location:index.php");
     
     $mensaje ="Registro Eliminado con exito";
     header("Location:index.php?mensaje=".$mensaje);
}
$sentencia = $conexion->prepare("SELECT *, (SELECT nombredelpuesto FROM tbl_puestos WHERE tbl_puestos.id=tbl_empleados.idpuesto limit 1) as puesto FROM `tbl_empleados`");
$sentencia->execute();
$lista_tbl_empleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<br>

<div class="card">
     <div class="card-header">
          Empleados &nbsp; &nbsp;
          <a name="" id="" class="btn btn-dark" href="crear.php" role="button">Agregar empleado</a>
     </div>
     <div class="card-body">
          <div class="table-responsive-sm">
               <table class="table" id="tabla_id">
                    <thead>
                         <tr>
                              <th scope="col">ID</th>
                              <th scope="col">Nombres</th>
                              <th scope="col">Primer apellido</th>
                              <th scope="col">Segundo apellido</th>
                              <th scope="col">Foto</th>
                              <th scope="col">CV</th>
                              <th scope="col">Puesto</th>
                              <th scope="col">Fecha de ingreso</th>
                              <th scope="col">Acciones</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php foreach ($lista_tbl_empleados as $registros) { ?>
                              <tr class="">
                                   <td scope="row"><?php echo $registros["id"] ?></td>
                                   <td scope="row"><?php echo $registros["nombres"] ?></td>
                                   <td><?php echo $registros["primerapellido"] ?></td>
                                   <td><?php echo $registros["segundoapellido"] ?></td>
                                   <td> <img src="./Fotos/<?php echo $registros['foto'] ?>" width="50px" height="50px" class="img-fluis rounded"></td>
                                   <td><a href="./Fotos/<?php echo $registros["cv"] ?>"><?php echo $registros["cv"] ?> </a></td>
                                   <td><?php echo $registros["puesto"] ?> </td>
                                   <td><?php echo $registros["fechaingreso"] ?> </td>
                                   <td>
                                        <a class="btn btn-primary" href="Carta_recomendacion.php?txtID=<?php echo $registros['id'] ?>" role="button">Carta</a> |
                                        <a class="btn btn-warning" href="editar.php?txtID=<?php echo $registros['id'] ?>" role="button">Editar</a> |
                                        <a class="btn btn-danger" href="javascript:borrar(<?php echo $registros['id'] ?>)">Eliminar</a>
                                   </td>
                              </tr>
                         <?php } ?>
                    </tbody>
               </table>
          </div>
     </div>
</div>

<?php include("../../Templates/footer.php"); ?>