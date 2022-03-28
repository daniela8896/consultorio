<?php include("template/cabecera.php"); ?>

<?php

include("administrador/models/bd.php");

$sentenciaSQL = $conexion->prepare("SELECT * FROM coder");
$sentenciaSQL->execute();
$listaCitas = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC)

?>

<?php foreach ($listaCitas as $cita) { ?>


    <div class="col-md-4 mb-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center "><?php echo $cita['nombre']; ?></h2>

                <div class="d-flex justify-content-between">
                    <p class="">Tema de la cita:</p>
                    <p class="card-title"><?php echo $cita['tema']; ?></p>
                </div>

                <div class="d-flex justify-content-between ">
                    <p>Fecha de la cita:</p>
                    <p class="card-title"><?php echo $cita['fecha']; ?></p>
                </div>

                <a href="./administrador/index.php" name='' id="" role="button" class="btn btn-primary">Ver más</a>
            </div>
        </div>
    </div>

<?php }  ?>


<?php include("template/pie.php"); ?>