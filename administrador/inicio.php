<?php include("templates/cabecera.php"); ?>
<div class="col-md-12">
    <div class="jumbotron">
        <h1 class="display-3">Bienvenid@ <?php echo $nombreUsuario; ?></h1>
        <p class="lead">Vamos a crear tus citas en el sitio web</p>
        <hr class="my-2">

        <p class="lead">
            <a class="btn btn-primary btn-lg" href="controllers/citas.php" role="button">Crear citas</a>
        </p>
    </div>
</div>
<?php include("templates/pie.php"); ?>