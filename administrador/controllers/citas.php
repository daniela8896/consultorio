<?php include("../templates/cabecera.php"); ?>

<?php
//la funcion isset evalua que no este vacio , si tiene algo ? imprime el name, de lo contrario : vacio
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtTema = (isset($_POST['txtTema'])) ? $_POST['txtTema'] : "";
$txtFecha = (isset($_POST['txtFecha'])) ? $_POST['txtFecha'] : "";
$fecha =  (isset($_POST['fecha'])) ? $_POST['fecha'] : "";

$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";



//con esto traemos la base de datos para poderla usar aca
include("../models/bd.php");



switch ($accion) {
    case "agregar":
        //estos son los parametros
        $sentenciaSQL = $conexion->prepare("INSERT INTO coder (nombre, tema, fecha) VALUES (:nombre, :tema, :fecha);");
        $sentenciaSQL->bindParam(':nombre', $txtNombre); //con bindparam le decimos cuales son los parametros a insertar y se le pone el valor que va a tener
        $sentenciaSQL->bindParam(':tema', $txtTema);
        $sentenciaSQL->bindParam(':fecha', $txtFecha);
        $sentenciaSQL->execute();


        break;

    case "modificar":
        $sentenciaSQL = $conexion->prepare("UPDATE coder SET nombre=:nombre, tema=:tema, fecha=:fecha WHERE id=:id");
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->bindParam(':tema', $txtTema);
        $sentenciaSQL->bindParam(':fecha', $txtFecha);
        $sentenciaSQL->execute();

        header("Location:citas.php");
        break;


    case "cancelar":
        //redirecciona a la misma pagina
        header("Location:citas.php");
        break;


    case "Seleccionar":

        $sentenciaSQL = $conexion->prepare("SELECT * FROM coder WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $cita = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombre = $cita['nombre'];
        $txtTema = $cita['tema'];
        $txtFecha = $cita['fecha'];

        break;


    case "Borrar":

        //con esto eliminamos 
        $sentenciaSQL = $conexion->prepare("DELETE FROM coder WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();


        header("Location:citas.php");
        //echo "presionado boton Borrar";
        break;

        //con enctype en la etiqueta form se pueden recepcionar las imagenes
}
//con esta sentencia selecciona todo de coder, luego se ejecuta la instruccion, luego se almacena todo en una variable con la ejecucion y se le agrega el metodo fechall que recupera todos los registros para que se pueda mostrar en la variable listacitas
$sentenciaSQL = $conexion->prepare("SELECT * FROM coder");
$sentenciaSQL->execute();
$listaCitas = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);





//INSERT INTO `coder` (`id`, `nombre`, `tema`, `fecha`) VALUES (NULL, 'daniela', 'requiero revision de mi proyecto', '2022-03-30');
?>

<div class="col-md-12 mb-5">
    <div class="card">
        <div class="card-header">
            Datos de la cita
        </div>
        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtID">ID:</label>
                    <input type="text" readonly required class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">

                </div>

                <div class="form-group">
                    <label for="txtNombre">Nombre:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Escribe tu nombre">

                </div>

                <div class="form-group">
                    <label for="txtNombre">Tema:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtTema; ?>" name="txtTema" id="txtTema" placeholder="Escribe el tema a tratar">

                </div>

                <div class="form-group">
                    <label for="txtNombre">Fecha:</label>
                    <input type="date" required class="form-control" value="<?php echo $txtFecha; ?>" name="txtFecha" id="txtFecha" placeholder="Fecha de la cita">

                </div>
                <!--asi se crea un select-->
                <!-- <select class="form-control mb-5">
                    <option value="<?php //echo $fecha; 
                                    ?>" name="fecha">Seleccione una fecha:</option>
                    <?php
                    // $query = $conexion->prepare("SELECT * FROM fechas");
                    // $query->execute();
                    // $data = $query->fetchAll();

                    // foreach ($data as $valores) :
                    //     echo '<option value="' . $valores["id"] . '">' . $valores["fecha"] . '</option>';
                    // endforeach;
                    ?>
                </select> -->

                <!--asi se crea un select-->
                <!-- <select class="form-control mb-5">
                    <option value="<?php //echo $fecha; 
                                    ?>" name="fecha">Seleccione una hora:</option>
                    <?php
                    // $query = $conexion->prepare("SELECT * FROM horas");
                    // $query->execute();
                    // $datosHoras = $query->fetchAll();

                    // foreach ($datosHoras as $datoHora) :
                    //     echo '<option value="' . $datoHora["id"] . '">' . $datoHora["nombre"] . '</option>';
                    // endforeach;
                    ?>
                </select> -->


                <div class="btn-group d-flex justify-content-around" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion == "Seleccionar") ? "Disabled" : ""; ?> value="agregar" class="btn btn-success ">Agregar</button>
                    <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "Disabled" : ""; ?> value="modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "Disabled" : ""; ?> value="cancelar" class="btn btn-info">Cancelar</button>
                </div>
            </form>
        </div>

    </div>



</div>
<div class="container">

    <div class="row w-100">
        <div class="d-flex align-items-center justify-content-center w-100 mt-5 mb-5">
            <h2 class="text-center">Estas son tus citas reservadas</h2>
        </div>


        <div class="col w-100">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tema</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($listaCitas as $cita) { ?>
                        <tr class="">
                            <td class=""><?php echo $cita['id']; ?></td>
                            <td class=""><?php echo $cita['nombre']; ?></td>
                            <td class="w-25"><?php echo $cita['tema']; ?></td>
                            <td class=""><?php echo $cita['fecha']; ?></td>

                            <td class="">

                                <form method="post" class="d-flex justify-content-center gap-3">

                                    <input type="hidden" name="txtID" id="txtID" value="<?php echo $cita['id']; ?>" />
                                    <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary " />
                                    <input type="submit" name="accion" value="Borrar" class="btn btn-danger" />


                                </form>

                            </td>
                        </tr>
                    <?php  } ?>

                </tbody>
            </table>
        </div>



    </div>
</div>



<?php include("../templates/pie.php"); ?>