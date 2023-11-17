<?php
include("../../Templates/header.php");
include("../../Database.php");

if (isset($_GET['txtID'])) {

     $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

     $sentencia = $conexion->prepare('DELETE FROM tbl_usuarios WHERE id=:id');
     $sentencia->bindParam(':id', $txtID);
     $sentencia->execute();

     $mensaje = "Registro Eliminado con exito";
     header("Location:index.php?mensaje=" . $mensaje);
}

$sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios`");
$sentencia->execute();
$lista_tbl_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<br>
<div class="card bg-dark rounded-4">
     <div class="card-header">
          <a name="" id="" class="btn btn-outline-info" href="crear.php" role="button">Agregar Usuarios</a>
     </div>
     <div class="card-body text-light">
          <div class="table-responsive-sm">
               <table class="table text-light" id="tabla_id">
                    <thead>
                         <tr>
                              <th scope="col">ID</th>
                              <th scope="col">Nombre del Usuarios</th>
                              <th scope="col">Contraseña</th>
                              <th scope="col">Correo</th>
                              <th scope="col">Acciones</th>

                         </tr>
                    </thead>
                    <tbody>
                         <?php foreach ($lista_tbl_usuarios as $registros) { ?>
                              <tr class="">
                                   <td scope="row"> <?php echo $registros["id"] ?></td>
                                   <td><?php echo $registros["usuario"] ?></td>
                                   <td>*************</td>
                                   <td><?php echo $registros["correo"] ?></td>
                                   <td> <a class="btn btn-warning" href="editar.php?txtID=<?php echo $registros['id'] ?>" role="button">Editar</a>
                                        |
                                        <a class="btn btn-danger" href="javascript:borrar(<?php echo $registros['id'] ?>)" role="button">Eliminar</a>
                                   </td>
                              </tr>
                         <?php } ?>
                    </tbody>
               </table>
          </div>

     </div>
</div>

<?php include("../../Templates/footer.php"); ?>