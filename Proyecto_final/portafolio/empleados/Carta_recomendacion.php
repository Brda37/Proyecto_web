<?php
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
     $idpuesto = $registro["idpuesto"];
     $fechaingreso = $registro["fechaingreso"];
}
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Carta recomendación</title>
</head>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de Recomendación Laboral</title>
</head>
<body>

    <div class="carta">
        <div class="encabezado">
            <h2>Carta de Recomendación Laboral</h2>
        </div>

        <div class="contenido">
            <p>Fecha: <strong><?php echo date('d M Y')?></strong></p>

            <p>A quien corresponda,</p>

            <p>Me complace recomendar enfáticamente a <?php echo $nombres," ", $primerapellido, " ", $segundoapellido  ?> por su destacado desempeño en [nombre de la empresa/organización] durante el tiempo que trabajó con nosotros.</p>

            <p>[Nombre del Empleado] demostró ser un/a empleado/a excepcionalmente [calificación] y [otras cualidades destacadas]. Su capacidad para [descripción de habilidades o logros específicos] fue invaluable para nuestro equipo y contribuyó significativamente a [proyectos o logros específicos].</p>

            <p>Además de sus habilidades técnicas, [Nombre del Empleado] es una persona [cualidades personales, como ser confiable, trabajador/a en equipo, etc.]. Su actitud positiva y su ética de trabajo incansable lo/a hacen destacar entre sus compañeros.</p>

            <p>Estoy seguro/a de que [Nombre del Empleado] continuará teniendo éxito en sus futuras empresas. No dudaríamos en volver a contratarlo/a en el futuro, y lo/a recomiendo encarecidamente.</p>

            <p>Si necesitas más información, no dudes en contactarme.</p>

            <p>Atentamente,</p>

            <p>[Tu Nombre]</p>
            <p>[Tu Cargo]</p>
            <p>[Nombre de la Empresa/Organización]</p>
        </div>

        <div class="firma">
            <img src="[ruta de la firma]" alt="Firma">
        </div>
    </div>

</body>
</html>

</html>

<?php
$HTML=ob_get_clean();    
require_once("../../Libs/autoload.inc.php");
use Dompdf\Dompdf;

$dompdf = new Dompdf();

$opciones = $dompdf->getOptions();

$opciones -> set(array("isRemoteEnabled"=>true));

$dompdf->setOptions($opciones);

$dompdf-> loadHtml($HTML);

$dompdf-> setPaper('letter');

$dompdf -> render();

$dompdf -> stream("archivo.pdf", array("Attachment"=>false));

?>