<?php

$host="localhost";
$bd="consultorio";
$usuario="root";
$contrasena="";

try {

$conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasena);

//exception lee cual fue el error y con getmessage lo muestra en caso de error
} catch (Exception $ex) {

echo $ex->getMessage();
}
