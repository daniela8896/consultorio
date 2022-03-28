<?php

session_start();
if ($_POST) {
    //la linea de post es la que se tenf¿dria que cambiar por una consulta a la base de datos
    if (($_POST['usuario'] == "daniela") && ($_POST['contrasena'] == "12345")) {
        $_SESSION['usuario'] = "ok";
        $_SESSION['nombreUsuario'] = "Daniela";
        header('Location:inicio.php');
    } else {
        $mensaje = "Error: el usuario o contraseña son incorrectos";
    }
}
?>



<!doctype html>
<html lang="en">

<head>
    <title>Administrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min (1).css">
    
</head>

<body>

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Iniciar sesión
                    </div>
                    <div class="card-body">
                        <?php if (isset($mensaje)) {  ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $mensaje; ?>
                            </div>
                        <?php } ?>
                        <form method="POST">

                            <div class="form-group">
                                <label>Usuario</label>
                                <input type="text" class="form-control" name="usuario" placeholder="Escribe tu usuario">



                                <div class="form-group">
                                    <label>Contraseña:</label>
                                    <input type="password" class="form-control" name="contrasena" placeholder="Escribe tu contraseña">
                                </div>


                                <button type="submit" class="btn btn-primary mt-3">Entrar al administrador</button>

                        </form>



                    </div>

                </div>

            </div>

        </div>
    </div>

</body>

</html>