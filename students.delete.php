<?php
session_start();
require_once("conexion.inc.php");
$conexion = new mysqli($servidor, $usuario, $passwd, $basedatos);
if (mysqli_connect_errno())
{
  echo "Error al establecer la conexión con la base de datos: " . mysqli_connect_error();
  exit();
}
$conexion->query("set names utf8");

$students = $_POST["students"];
$teacher = $_SESSION["user"]["id"];
	$conexion->query("delete from teach where teacher = $teacher AND student = $students");

echo 1;