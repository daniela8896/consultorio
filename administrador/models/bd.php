<?php

$host= "localhost";
$bd= "consultorio";
$usuario= "root";
$contrasena= "";


//datos del deploy
// $host = "ftpupload.net";
// $bd = "epiz_31397039_consultorioWeb";
// $usuario = "epiz_31397039";
// $contrasena = "xMKQIVdCXn8QmI";


try {

$conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasena);

//exception lee cual fue el error y con getmessage lo muestra en caso de error
} catch (Exception $ex) {

echo $ex->getMessage();
}
