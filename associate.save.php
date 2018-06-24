<?php
session_start();
if (!isset($_SESSION["user"]))
{
  header("location:index.php");
}

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
foreach ($students as $valor) {
	$conexion->query("insert into teach (teacher, student) values ($teacher, $valor)");

}
echo 1;